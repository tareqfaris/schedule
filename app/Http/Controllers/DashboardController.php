<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;
class DashboardController extends Controller
{
   public function index(){
    $schedules=Schedule::query();
    $day=Carbon::now()->translatedFormat('N');
 
   $schedules=$schedules->where('day',$day)->paginate(25);
   $days=collect([]);
   for ($i=0; $i < 7; $i++) { 
       $days->put(Carbon::now()->subDays($i)->translatedFormat('N'),Carbon::now()->subDays($i)->translatedFormat('l'));
   }
  return  view('dashboard',compact('schedules','day','days'));
   }
}

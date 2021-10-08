<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Schedule;
use App\Models\Department;
use Carbon\Carbon;
class HomeController extends Controller{

    public function index(){
        $schedules=Schedule::query();
       $departments=Department::get();
       $day=Carbon::now()->translatedFormat('N');
       $schedules=$schedules->where('day',$day)->get();
       $articles=Article::orderby('id','desc')->where('status',1)->limit(3)->where('department_id',0)->get();
       return view('index',compact('departments','schedules','articles'));
    }

    public function schedule(){

    }

    public function department(Department $department){
        return view('department',compact('department'));
    }
    public function article(Article $article){
        return view('article',compact('article'));
    }
}

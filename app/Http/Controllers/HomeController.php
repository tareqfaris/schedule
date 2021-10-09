<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Schedule;
use App\Models\Department;
use Carbon\Carbon;
class HomeController extends Controller{

    public function index(Request $request){
        $departments=Department::get();
       $day=Carbon::now()->translatedFormat('N');
 
       $articles=Article::orderby('id','desc')->where('status',1)->limit(3)->where('department_id',0)->get();
       $schedules=Schedule::query();
        $day=Carbon::now()->translatedFormat('N');
        if ($request->has('day')) {
           $day=$request->day;
        }
        if ($request->has('department_id') && $request->department_id !=0) {
           $schedules->where('department_id',$request->department_id);
        }
        if ($request->has('section_id') && $request->section_id !=0) {
           $schedules->where('section_id',$request->section_id);
        }
        if ($request->has('teacher_id') && $request->teacher_id !=0) {
           $schedules->where('teacher_id',$request->teacher_id);
        }
        if ($request->has('material_id') && $request->material_id !=0) {
           $schedules->where('material_id',$request->material_id);
        }
        $days=collect([]);
      for ($i=0; $i < 7; $i++) { 
          $days->put(Carbon::now()->subDays($i)->translatedFormat('N'),Carbon::now()->subDays($i)->translatedFormat('l'));
      }

      $schedules=$schedules->where('day',$day)->paginate(25)->appends($request->except('page'));
       return view('index',compact('departments','schedules','articles','days','day'));
    }

    public function schedule(){

    }

    public function department(Request $request,Department $department){
      $day=Carbon::now()->translatedFormat('N');
      $articles=Article::orderby('id','desc')->where('status',1)->limit(3)->whereIn('department_id',[0,$department->id])->get();
      $schedules=Schedule::query();
       $day=Carbon::now()->translatedFormat('N');
       if ($request->has('day')) {
          $day=$request->day;
       }
       if ($request->has('section_id') && $request->section_id !=0) {
          $schedules->where('section_id',$request->section_id);
       }
       if ($request->has('teacher_id') && $request->teacher_id !=0) {
          $schedules->where('teacher_id',$request->teacher_id);
       }
       if ($request->has('material_id') && $request->material_id !=0) {
          $schedules->where('material_id',$request->material_id);
       }
       $days=collect([]);
     for ($i=0; $i < 7; $i++) { 
         $days->put(Carbon::now()->subDays($i)->translatedFormat('N'),Carbon::now()->subDays($i)->translatedFormat('l'));
     }
     $schedules=$schedules->where('department_id',$department->id)->where('day',$day)->paginate(25)->appends($request->except('page'));
      return view('department',compact('department','schedules','articles','days','day'));
    }
    public function article(Article $article){
        return view('article',compact('article'));
    }
}

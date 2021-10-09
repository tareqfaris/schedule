<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;
class SchedulesController extends Controller
{

    public function index(Request $request){
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
      return  view('admin.schedules.index',compact('schedules','days','day'));
    }

   
    public function create(){
        return  view('admin.schedules.create');
    }


    public function store(Request $request){
        $request->validate([
            'day'=>'required',
            'department_id'=>'required',
            'teacher_id'=>'required',
        ]);
        Schedule::create([
            'day'=>$request->day,
            'department_id'=>$request->department_id,
            'teacher_id'=>$request->teacher_id,
            'material_id'=>$request->material_id,
            'section_id'=>$request->section_id,
            'time_start'=>$request->time_start,
            'type'=>$request->type,
            'time_end'=>$request->time_end,
            'class_id'=>$request->class_id,
            'class'=>$request->class,
        ]);
        return redirect()->route('schedules.index');
       
    }


    public function show(Schedule $schedule){
        return  view('admin.schedules.show',compact('schedule'));
    }


    public function edit(Schedule $schedule){
        return  view('admin.schedules.edit',compact('schedule'));
    }


    public function update(Request $request,Schedule $schedule){

        $request->validate([
            'day'=>'required',
            'department_id'=>'required',
            'teacher_id'=>'required',
        ]);
        $schedule->update([
            'day'=>$request->day,
            'department_id'=>$request->department_id,
            'teacher_id'=>$request->teacher_id,
            'material_id'=>$request->material_id,
            'section_id'=>$request->section_id,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'class_id'=>$request->class_id,
            'class'=>$request->class,
            'type'=>$request->type,
        ]);
        return redirect()->route('schedules.index');
      
    }

    public function destroy(Schedule $schedule){
       $schedule->delete();
       return redirect()->route('schedules.index');
    }
}

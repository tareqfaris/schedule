<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
class TeachersController extends Controller
{
    public function index(){
        (auth()->user()->level !=1)??abort(404);
        $teachers=Teacher::paginate(20);
        return view('admin.teachers.index',compact('teachers'));
    }

    public function create(){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.teachers.create');
    }

    public function store(Request $request){
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
            'avatar'=>'image',
        ]);
        $teacher=Teacher::create([
            'name'=>$request->name,
            'department_id'=>$request->department_id,
        ]);
        if ($request->hasFile('avatar')) {
            $file=$request->file('avatar');
            $filename=$teacher->id.'_'.rand(0,9999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/teachers'),$filename);
            $teacher->avatar=$filename;
            $teacher->save();
        }
        return redirect()->route('teachers.index');
    }

 
    public function show(Teacher $teacher){
        return view('admin.teachers.show',compact('teacher'));
    }


    public function edit(Teacher $teacher){
        (auth()->user()->level !=1)??abort(404);
       return view('admin.teachers.edit',compact('teacher'));
    }


    public function update(Request $request,Teacher $teacher){
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
            'avatar'=>'image',
        ]);
        $teacher->update([
            'name'=>$request->name,
            'department_id'=>$request->department_id,
        ]);
        if ($request->hasFile('avatar')) {
            $file=$request->file('avatar');
            $filename=$teacher->id.'_'.rand(0,9999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/teachers'),$filename);
            $teacher->avatar=$filename;
            $teacher->save();
        }
        return redirect()->route('teachers.index');
    }


    public function destroy(Teacher $teacher){
        (auth()->user()->level !=1)??abort(404);
        $teacher->delete();
        return redirect()->route('teachers.index');
    }
}

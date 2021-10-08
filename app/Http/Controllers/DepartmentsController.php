<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentsController extends Controller
{
    public function index(){
        (auth()->user()->level !=1)??abort(404);
        $departments=Department::withCount('teacher','material')->paginate(20);
        return view('admin.departments.index',compact('departments'));
    }

    public function create(){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.departments.create');
    }

    public function store(Request $request) {
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
         ]);
        $department=Department::create([
              'name'=>$request->name,
              'description'=>$request->description,
        ]);
        
        if ($request->hasFile('logo')) {
            $file=$request->file('logo');
            $filename=$department->id.'_'.rand(0,9999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/departments'),$filename);
            $department->logo=$filename;
            $department->save();
        }
        session()->flash('success','تم إضافة القسم');
        return redirect()->route('departments.index');
    }

    public function show(Department $department){
       return view('admin.departments.show',compact('department'));
    }


    public function edit(Department $department){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.departments.edit',compact('department'));
    }


    public function update(Request $request, Department $department){
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
            'logo'=>'image'
        ]);
        $department->update([
              'name'=>$request->name,
              'description'=>$request->description,
        ]);
        if ($request->hasFile('logo')) {
            $file=$request->file('logo');
            $filename=$department->id.'_'.rand(0,9999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/departments'),$filename);
            $department->logo=$filename;
            $department->save();
        }
        return redirect()->route('departments.index');
    }


    public function destroy(Department $department){
        (auth()->user()->level !=1)??abort(404);
         $department->delete();
         return redirect()->back();
    }
}

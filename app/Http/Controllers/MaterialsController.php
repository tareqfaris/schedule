<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
class MaterialsController extends Controller
{
    public function index(){
        (auth()->user()->level !=1)??abort(404);
      $materials=Material::paginate(25);
      return view('admin.materials.index',compact('materials'));
    }

    public function create(){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.materials.create');
    }


    public function store(Request $request){
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
        ]);
        $teacher=Material::create([
            'name'=>$request->name,
            'department_id'=>$request->department_id,
        ]);
        return redirect()->route('materials.index');
    }


    public function show(Material $material){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.materials.show',compact('material'));
    }


    public function edit(Material $material){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.materials.edit',compact('material'));
    }


    public function update(Request $request,Material $material){
        (auth()->user()->level !=1)??abort(404);
        $request->validate([
            'name'=>'required',
         ]);
        $material->update([
            'name'=>$request->name,
            'department_id'=>$request->department_id,
        ]);
 
        return redirect()->route('materials.index');
    }


    public function destroy(Material $material){
        (auth()->user()->level !=1)??abort(404);
        $material->delete();
        return redirect()->route('materials.index');
    }
}

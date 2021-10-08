<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class ArticlesController extends Controller
{
  
    public function index(){
        $articles=Article::orderBy('id','desc')->paginate(20);
        return view('admin.articles.index',compact('articles'));
    }

  
    public function create(){
       return view('admin.articles.create');
    }

   
    public function store(Request $request){
        
       $request->validate([
           'title'=>'required',
           'content'=>'required',
       ]);
       $article=Article::create([
           'title'=>$request->title,
           'content'=>$request->content,
           'department_id'=>$request->department_id,
           'user_id'=>auth()->user()->id,
           'section_id'=>$request->section_id,
           'status'=>$request->status,
       ]);
       if ($request->hasFile('image')) {
           $file=$request->file('image');
           $filename=rand(0,99999).'_'.time().'.'.$file->getClientOriginalExtension();
           $file->move(public_path('uploads/articles'),$filename);
           $article->image=$filename;
           $article->save();
       }
       return redirect()->route('articles.index');
    }

 
    public function show(Article $article){
        //
    }

   
    public function edit(Article $article){
        return view('admin.articles.edit',compact('article'));
    }

   
    public function update(Request $request,Article $article){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        $article->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'department_id'=>$request->department_id,
            'section_id'=>$request->section_id,
            'status'=>$request->status,
        ]);
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $filename=rand(0,99999).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/articles'),$filename);
            $article->image=$filename;
            $article->save();
        }
        return redirect()->route('articles.index');
    }

   
    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('articles.index');
    }
}

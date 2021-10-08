<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
   DepartmentsController,TeachersController,MaterialsController,SchedulesController,UserController,ArticlesController,DashboardController,HomeController
};
Route::get('/',[HomeController::class,'index']);
 
view()->share('sections',collect([
    1=>'الاولى',
    2=>'الثانية',
    3=>'الثالثة',
    4=>'الرابعة',
    5=>'الخامسة'
]));
view()->share('levels',collect([
    0=>'مستخدم',
    1=>'مدير',
    2=>'محرر'
]));
 
 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::middleware(['auth','isAdmin'])->prefix('admin')->group(function () {
 Route::resource('departments',DepartmentsController::class);   
 Route::resource('teachers',TeachersController::class);  
 Route::resource('materials',MaterialsController::class);  
 Route::resource('schedules',SchedulesController::class);
 Route::resource('articles',ArticlesController::class);
 Route::prefix('users')->group(function () {
     Route::get('/',[UserController::class,'index'])->name('users.index');
     Route::get('create',[UserController::class,'create'])->name('users.create');
     Route::post('/',[UserController::class,'store'])->name('users.store');
     Route::delete('/{user}/delete',[UserController::class,'destroy'])->name('users.destroy');
     Route::get('/{user}/edit',[UserController::class,'edit'])->name('users.edit');
     Route::put('/{user}/update',[UserController::class,'update'])->name('users.update');
 });
});

Route::get('department/{department}',[HomeController::class,'department'])->name('department.home');
Route::get('article/{article}',[HomeController::class,'article'])->name('article.show');


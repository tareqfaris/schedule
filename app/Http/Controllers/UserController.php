<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
class UserController extends Controller{
    public function index(){
        (auth()->user()->level !=1)??abort(404);
        $users=User::paginate(20);
        return view('admin.users.index',compact('users'));
    }

    public function create(){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.users.create');
    }
    public function edit(User $user){
        (auth()->user()->level !=1)??abort(404);
        return view('admin.users.edit',compact('user'));
    }
    
    public function store(Request $request){
        (auth()->user()->level !=1)??abort(404);
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string','confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index');
    }

    public function update(Request $request,User $user){
        (auth()->user()->level !=1)??abort(404);
        Validator::make($request->all(), [
            'level' => ['required'],
        ])->validate();

         $user->level=$request->level;
         $user->save();

        return redirect()->route('users.index');
    }

}

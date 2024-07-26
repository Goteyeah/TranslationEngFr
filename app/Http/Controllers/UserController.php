<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
    
            'user' => 'required|string|max:50|alpha', // la traduction ne contient que des lettres ( rule: alpha)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = user::all();
        return view('section_list',compact('user'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */



    public function update(Request $request, User $user, int $id)
    {
      $user = user::findOrFail($id);
        $user->blocked = true;
        $user->save();
        dump('bloque');

        
        
      return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        
        $user=User::findOrFail($id);
        $user->translation()->delete();
        $user->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin'){
                return redirect('dashboard')->with('success','Berhasil Login!' );
            } elseif (Auth::user()->role == 'petugas') {
                return redirect('/data/petugas')->with('success','Berhasil Login!');
            }
        } else {
            return redirect()->back()->with('Erorr', 'Gagal Login!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

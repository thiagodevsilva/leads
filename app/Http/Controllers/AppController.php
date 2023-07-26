<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $leads = Auth::user()->leads()->with(['address', 'user'])->get();
        return view('layouts.app', compact('leads'));
    }
}

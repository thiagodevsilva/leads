<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leads;

class AppController extends Controller
{
    public function index()
    {
        $leads = Auth::user()->leads()->with(['address', 'user'])->get();
        return view('layouts.app', compact('leads'));
    }

    public function markAsContacted($id)
    {
        $lead = Leads::findOrFail($id);
        
        if ($lead->contacted_pending) {
            $lead->contacted_pending = false;
            $lead->contacted_when = now();
        } else {
            $lead->contacted_pending = true;
            $lead->contacted_when = null;
        }
        
        $lead->save();
    
        return response()->json(['message' => 'Lead updated successfully']);
    }
}

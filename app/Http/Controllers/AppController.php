<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leads;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->leads()->with(['address', 'user']);

        if ($request->input('show_only_pending') === 'true') {
            $query->where('contacted_pending', true);
        }
    
        if ($request->input('recent_first') === 'true') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }
    
        $leads = $query->paginate(10);
    
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

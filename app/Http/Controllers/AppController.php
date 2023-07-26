<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leads;

/**
 * Controla as ações de usuarios autenticados
 */
class AppController extends Controller
{
    /**
     * Carrega os leads por usuario e seus recursos
     */
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            $query = Leads::with(['address', 'user']);
        } else {
            $query = Auth::user()->leads()->with(['address', 'user']);
        }
    
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
    
        $leadsByUser = Leads::selectRaw('user_id, SUBSTRING_INDEX(users.name, " ", 1) as name, COUNT(*) as count')
            ->join('users', 'users.id', '=', 'leads.user_id')
            ->where('contacted_pending', true)
            ->groupBy('user_id', 'name') // note que mudamos 'users.name' para 'name'
            ->get()
            ->toArray();
    
        return view('layouts.app', compact('leads', 'leadsByUser'));
    }     

    /**
     * Salva no banco de dados que o contato foi realizado e guarda o momento também
     */
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

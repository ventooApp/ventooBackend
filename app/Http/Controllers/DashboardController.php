<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Businesse;
use App\Models\Commande;
use App\Models\Guideconfiguration;
use App\Models\Categorieactualite;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data['title'] ='Tableau de bord';
        $data['menu'] ='dashboard';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["businesse"] = Businesse::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->created_by)->first();

        $data["nombre_de_client"] = User::where([ 'created_by' => Auth::user()->id,'active' => 1])->count();

        $data["nombre_de_commande"] = Commande::where([ 'businesse_id' => $data["businesse"]->id])->count();

        $data["guideconfigurations"] = Guideconfiguration::orderBy('id', 'desc')->get();
        
        $data["actualites"] = Actualite::orderBy('id', 'desc')
            ->with('categorieactualite')->has('categorieactualite')
            ->get();

        return view('dashboard',$data);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}

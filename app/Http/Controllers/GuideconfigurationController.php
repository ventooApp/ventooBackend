<?php

namespace App\Http\Controllers;

use App\Models\Guideconfiguration;
use App\Models\User;
use App\Models\Businesse;
use App\Models\Faq;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GuideconfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Guide';
        $data['menu'] ='guideconfiguration';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])->first();

        $data["businesse"] = Businesse::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->created_by)->first();

        $businesseId = $data["businesse"]->id; // Remplacez par l'ID du client pour lequel vous souhaitez connaître le pourcentage des guides

        $guidesCount = DB::table('guideconfigurations')
                        ->whereRaw('JSON_CONTAINS(businesses, \'["' . $businesseId . '"]\')')
                        ->count();
        
        $totalGuidesCount = DB::table('guideconfigurations')->count();
        
        $pourcentage_arrondi = ($guidesCount / $totalGuidesCount) * 100;  
        $data["percentage"] = round($pourcentage_arrondi, 2);

        $data["guideconfigurations"] = Guideconfiguration::orderBy('id', 'desc')->get();
        
        $data["faqs"] = Faq::orderBy('id', 'desc')->get();

        $data["nombre_de_produit"] = Produit::where([ 'boutique_id' => $data["businesse"]->id])->count();

        return view('guide.index',$data);
    
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Guideconfiguration $guideconfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guideconfiguration $guideconfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guideconfiguration $guideconfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guideconfiguration $guideconfiguration)
    {
        //
    }
}

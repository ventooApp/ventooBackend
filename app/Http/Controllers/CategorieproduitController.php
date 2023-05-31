<?php

namespace App\Http\Controllers;

use App\Models\Categorieproduit;
use App\Models\User;
use App\Models\Produit;
use App\Models\Businesse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategorieproduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] ='Créer une catégorie';
        $data['menu'] ='catégorie';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["businesse"] = Businesse::where('user_id', $data["user"]->id)->orWhere('user_id', $data["user"]->created_by)->first();

        return view('categorieproduit.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required|min:3',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'libelle.required' => 'Le nom compet est obligatoire',
                'image.required' => 'Les images du produit sont obligatoire',
            ]
        );

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["businesse"] = Businesse::where('user_id', $data["user"]->id)->orWhere('user_id', $data["user"]->created_by)->first();
        
        $categorieproduit = new Categorieproduit();

        $categorieproduit->libelle = htmlspecialchars($request->libelle);
        $categorieproduit->boutique_id = $data["businesse"]->id;

        $image = $request->file('image');
        $nom_image = time() . '_' . $image->getClientOriginalName();
        $image->move('categorie-produit-images', $nom_image);
        $categorieproduit->image = $nom_image;

        if($categorieproduit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre catégorie a été créé avec success.');
            return back();

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorieproduit $categorieproduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorieproduit $categorieproduit, $id)
    {
        $id = htmlspecialchars($id);
        $data['title'] ='Modifier une catégorie';
        $data['menu'] ='categorieproduit';
        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["businesse"] = Businesse::where('user_id', $data["user"]->id)->orWhere('user_id', $data["user"]->created_by)->first();

        $data["categorieproduit"] = Categorieproduit::orderBy('id', 'desc')
            ->where('boutique_id', $data["businesse"]->id)
            ->first();

        return view('categorieproduit.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'libelle' => 'required|min:3',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'libelle.required' => 'Le nom compet est obligatoire',
                'image.nullable' => 'Les images du produit sont obligatoire',
            ]
        );

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["businesse"] = Businesse::where('user_id', $data["user"]->id)->orWhere('user_id', $data["user"]->created_by)->first();
            
        $categorieproduit =  Categorieproduit::find($id);
        if(empty($categorieproduit))
        {
            session()->flash("type","error");
            session()->flash("message","Erreur catégorie produit introuvable introuvable");
            return back();
        }

        $categorieproduit->libelle = htmlspecialchars($request->libelle);
        $categorieproduit->boutique_id = $data["businesse"]->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $nom_image = time() . '_' . $image->getClientOriginalName();
            $image->move('categorie-produit-images', $nom_image);
            $categorieproduit->image = $nom_image;
        }
        

        if($categorieproduit->save())
        {
            //Supprime l'image du serveur
            // if ($request->file('image')) {
            //     $filePath = public_path('categorie-produit-images/' . $nom_image);
            //     if (file_exists($filePath)) {
            //         unlink($filePath);
            //     }
            // }
            
            session()->flash('type','alert-success');
            session()->flash('message','Votre catégorie a été modifié avec success.');
            return back();

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        // Récupérer la catégorie à mettre à jour
        $categorieproduit = Categorieproduit::find($id);

        // Modifier le statut de tous les produits de la catégorie
        $categorieproduit->produits()->update(['status' => '2']);

        // Mettre à jour les autres champs de la catégorie
        $categorieproduit->status = '0';

        if($categorieproduit->save())
            {
                session()->flash('type','alert-success');
                session()->flash('message','Votre catégorie a été supprimé avec success.');
                return back();

            }else {
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur est survenue.');
                return back();
            }

    }
}

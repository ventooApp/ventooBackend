<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\User;
use App\Models\Businesse;
use App\Models\Devise;
use App\Models\Categorieproduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use DateTime;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Produits';
        $data['menu'] ='produit';
        
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $data["categorieproduits"] = Categorieproduit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "1"]
            ])
            ->get();

        // LISTE DES PRODUITS
        $data["produits"] = Produit::orderBy('id', 'desc')
        ->where([
            ['boutique_id', '=', $data["businesse"]->id],
            ['status', '!=', "2"]
        ])
        ->with('categorieproduit')
        ->has('categorieproduit')
        ->get();
    
        
        // LISTE DES PRODUITS ACTIF
        $data["produitsActives"] = Produit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "1"]
            ])
            ->with('categorieproduit')->has('categorieproduit')
            ->get();
        
        // LISTE DES PRODUITS DESACTIVE
        $data["produitsDesactives"] = Produit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "0"]
            ])
            ->with('categorieproduit')->has('categorieproduit')
            ->get();

        return view('produit.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] ='Ajouter un produit';
        $data['menu'] ='produit';
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $data["categorieproduits"] = Categorieproduit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "1"]
            ])
            ->get();

        return view('produit.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required',
                'price' => 'required',
                'qte' => 'required',
                'description' => 'required',
                'active' => 'nullable',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'categorie' => 'required|exists:categorieproduits,id',
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $categorieproduit = Categorieproduit::where('id', $request->categorie)->first();
        if (empty($categorieproduit)) {
            session()->flash('type', 'alert-danger');
			session()->flash('message', 'Une erreur est survenue');
			return back();
        }
    
        $produit = new Produit();
        $produit->libelle = htmlspecialchars($request->libelle);
        $produit->price = htmlspecialchars($request->price);
        $produit->description = htmlspecialchars($request->description);
        $produit->qte = htmlspecialchars($request->qte);
        $produit->status = $request->active == 'on' ? '1' : '0';
        $produit->created_by = Auth::user()->id;
        $produit->boutique_id = $data["businesse"]->id;
        $produit->categorieproduit_id = $categorieproduit->id;
    
        // Vérifier s'il y a des images envoyées avec la requête
        if($request->hasFile('image')) {
            $images = $request->file('image');
    
            $imageNames = [];
    
            // Enregistrer chaque image et ajouter le nom de l'image à un tableau
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move('produit-images', $imageName);
                $imageNames[] = $imageName;
            } 
    
            // Joindre les noms d'images en une seule chaîne de caractères séparée par des points-virgules
            $produit->image = implode(';', $imageNames);
            // dd($produit->image);
        }
    
        if($produit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre produit a été créé avec success.');
            return Redirect()->route('produit.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit, $id)
    {
        $id = htmlspecialchars($id);
        $data['title'] ='Détails produit';
        $data['menu'] ='produit';
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $data["produit"] = Produit::orderBy('id', 'desc')
            ->where([
                'boutique_id' => $data["businesse"]->id,
                'id' => $id
                ])
            ->with('categorieproduit')->has('categorieproduit')
            ->first();

            $data["categorieproduits"] = Categorieproduit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "1"]
            ])
            ->get();

        $date = new DateTime();

        setlocale(LC_TIME, 'fr_FR.UTF-8');

        $data["created_at"] = strftime('%d %B %Y à %H:%M:%S');

        return view('produit.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit, $id)
    {
        $id = htmlspecialchars($id);
        $data['title'] ='Modifier un produit';
        $data['menu'] ='produit';
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $data["produit"] = Produit::orderBy('id', 'desc')
            ->where([
                'boutique_id' => $data["businesse"]->id,
                'id' => $id
                ])
            ->with('categorieproduit')->has('categorieproduit')
            ->first();

            $data["categorieproduits"] = Categorieproduit::orderBy('id', 'desc')
            ->where([
                ['boutique_id', '=', $data["businesse"]->id],
                ['status', '=', "1"]
            ])
            ->get();

        return view('produit.edit',$data);
    }

    public function deleteProductImage($productId, $imageName)
    {
        $produit = Produit::find($productId);

        if (!$produit) {
            session()->flash('type','alert-danger');
            session()->flash('message','Aucun produit trouvé.');
            return back();
        }

        // Supprime le nom de l'image de la liste des images du produit
        $images = explode(';', $produit->image);
        $index = array_search($imageName, $images);
        if ($index !== false) {
            unset($images[$index]);
            $produit->image = implode(';', $images);
            $produit->save();
        }

        // Supprime l'image du serveur
        // $filePath = public_path('produit-images/' . $imageName);
        // if (file_exists($filePath)) {
        //     unlink($filePath);
        // }

        session()->flash('type','alert-success');
        session()->flash('message','Image modifer avec success.');
        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $request->validate(
            [
                'libelle' => 'required',
                'price' => 'required',
                'qte' => 'required',
                'description' => 'required',
                'active' => 'nullable',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'categorie' => 'required|exists:categorieproduits,id',
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
        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        $categorieproduit = Categorieproduit::where('id', $request->categorie)->first();
        if (empty($categorieproduit)) {
            session()->flash('type', 'alert-danger');
			session()->flash('message', 'Une erreur est survenue');
			return back();
        }
    
        $produit =  Produit::find($id);
        if(empty($produit))
        {
            session()->flash("type","error");
            session()->flash("message","Erreur utilisateur introuvable");
            return back();
        }

        $produit->libelle = htmlspecialchars($request->libelle);
        $produit->price = htmlspecialchars($request->price);
        $produit->description = htmlspecialchars($request->description);
        $produit->qte = htmlspecialchars($request->qte);
        $produit->status = $request->active == 'on' ? '1' : '0';
        $produit->created_by = Auth::user()->id;
        $produit->boutique_id = $data["businesse"]->id;
        $produit->categorieproduit_id = $categorieproduit->id;
    
        if($request->hasFile('image')) {
            $images = $request->file('image');
        
            $imageNames = [];
        
            // Enregistrer chaque image et ajouter le nom de l'image à un tableau
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move('produit-images', $imageName);
                $imageNames[] = $imageName;
            } 
        
            // Vérifier s'il y a des images existantes pour ce produit
            if($produit->image != null) {
                // Joindre les noms d'images existantes et les nouveaux noms d'images en une seule chaîne de caractères séparée par des points-virgules
                $produit->image = $produit->image . ';' . implode(';', $imageNames);
            } else {
                // Enregistrer le nom de la première nouvelle image comme le nom d'image de ce produit
                $produit->image = $imageNames[0];
            }
        }
        
    
        if($produit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre produit a été modifiée avec success.');
            return back();

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }

    public function updateQuantite(Request $request) {
        $id = $request->input('id');
        $quantite = $request->input('qte');
    
        $produit = Produit::find($id);
        $produit->qte = $quantite;
        $produit->save();
    
        if($produit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Quantité mise a jour avec success.');
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
    public function destroy(Produit $produit, $id)
    {
        $id = htmlspecialchars($id);

        $produit =  Produit::find($id);

        if(empty($produit))
        {
            session()->flash("type","error");
            session()->flash("message","Erreur utilisateur introuvable");
            return back();
        }

        $produit->satus = "2";

        if($produit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre produit a été supprimé avec success.');
            return back();

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }

    // Méthode pour mettre à jour le statut d'un client
    public function activateDeactivateProduit(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->status = $request->input('status');
        $produit->save();

        session()->flash('type','alert-success');
        session()->flash('message','Votre produit a été modifié avec success.');
        return Redirect()->route('produit.index');
    }
}

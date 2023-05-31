<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use App\Models\Canalachat;
use App\Models\Businesse;
use App\Models\Devise;
use App\Models\Commandeproduit;
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

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Commandes';
        $data['menu'] ='commande';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["canalachats"] = Canalachat::orderBy('id', 'desc')->get();

        $data["clients"] = User::orderBy('id', 'desc')->get();

        $data["businesse"] = Businesse::where('user_id', $data["user"]->id)->orWhere('user_id', $data["user"]->created_by)->first();

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

        // LISTE DES COMMANDES
        // $data["commandes"] = Commande::orderBy('id', 'desc')
        // ->where([
        //     ['businesse_id', '=', $data["businesse"]->id],
        //     ['status', '!=', "0"]
        // ])
        // ->get();
        $data["commandes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '!=', "0"]
        ])
        ->get();
        //dd($data["commandes"]);

        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "1"]
            ])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "2"]
            ])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "3"]
        ])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "4"]
        ])
        ->get();

        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "6"]
        ])
        ->get();

        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '=', "5"]
        ])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        return view('commande.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] ='Ajouter une commande';
        $data['menu'] ='commande';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["canalachats"] = Canalachat::orderBy('id', 'desc')->get();

        $data["clients"] = User::orderBy('id', 'desc')->get();
        
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

        return view('commande.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'client' => 'required|exists:users,id',
                'canal' => 'required|exists:canalachats,id',
                'produits' => 'required|array|min:1',
                'quantites' => 'required|array|min:1',
                // 'total_achat' => 'required',
                'adresse' => 'required',
            ],
            [
                'client.required' => "Veuillez selectonnée le client",
                'produits.required' => "Veuillez ajouter le(s) produit(s) pour la commande",
                'quantites.required' => "Veuillez ajouter le(s) quantite(s) pour la commande",
                'total_achat.required' => 'Total achat obligatoire',
                'adresse.required' => 'Adresse de livraison obligatoire',
            ]

        );

        $data["client"] = User::where([
            'id' => htmlspecialchars($request->client),
            // 'role' => 2
        ])->first();

        $data["canalachat"] = Canalachat::where([
            'id' => htmlspecialchars($request->canal)
        ])->first();

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

        if (empty($data["businesse"]->devise_id)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue. Veuillez choisir la devise de votre boutique');
            return back();
        }
        
        $data["devise"] = Devise::where([
            'id' => $data["businesse"]->devise_id,
        ])->first();

        $commande = new Commande();

        $cmd_random = mt_rand(10000000, 99999999);

        $commande->no_commande = 'VTOO-' . $cmd_random;
        $commande->client_id = $data["client"]->id;
        $commande->canalachat_id = $data["canalachat"]->id;
        $commande->mobile = $data['client']->mobile;
        $commande->devise = $data["devise"]->id;
        $commande->adresse = htmlspecialchars($request->adresse);
        $commande->total_achat = 0;
        $commande->user_id = $data["user"]->id;
        $commande->businesse_id = $data["businesse"]->id;
        $commande->status = '2';

        $commande->save();

        // Ajout des produits à la commande
        $produits = $request->produits;
        $quantites = $request->quantites;
        $total_achat = 0;

        $recap = "Votre commande n {$commande->no_commande} : ";

        foreach ($produits as $key => $produit_id) {
            // Récupération du produit
            $produit = Produit::find($produit_id);
            $quantite = $quantites[$key];
                    
            // Vérification de la quantité disponible
            if ($produit->qte < $quantite) {
                session()->flash('type','alert-danger');
                session()->flash('message','Le produit '.$produit->libelle.' n\'a pas assez de quantité ('.$produit->qte.') disponible.');
                return back();
            }
        
            // Ajout du produit à la commande
            $commande_produit = new Commandeproduit();
            $commande_produit->commande_id = $commande->id;
            $commande_produit->produit_id = $produit_id;
            $commande_produit->quantite = $quantite;
            $commande_produit->montant = intval($produit->price) * intval($quantite);
                        
            $commande_produit->save();
        
            // Déduction de la quantité commandée de la quantité disponible du produit
            $produit->qte -= $quantite;
            $produit->save();
        
            // Ajout du montant du produit au total d'achat de la commande
            $total_achat += $commande_produit->montant;

            
            $produitName = $produit->libelle;
            $produitPrice = intval($produit->price) * intval($quantite);
            $produitQuantite = $quantite;
            $recap .= "{$produitName} x{$produitQuantite} à {$produitPrice} {$data["devise"]->devise}, ";

            // $recap .= "Votre commande n°{$commande->no_commande} : {$produitName} x{$produitQuantite} à {$produitPrice} {$data["devise"]->devise}";
            // $message = "Votre compte Ventoo est créé ! Accédez-y avec: {$user->mobile} et le mot de passe: {$pass} sur https://www.ventoo.io";
            // $this->sendMessage($message, $mobile);

        }
        
    
        // Mise à jour du total d'achat de la commande
        $commande->total_achat = $total_achat;
        $commande->produits = json_encode($produits);
        $commande->quantites = json_encode($quantites);

    
        if($commande->save())
        {
            $recap = rtrim($recap, ", ");

            // Ajouter le total de la commande
            $recap .= ' - Total : ' . $total_achat . ' '.$data["devise"]->devise;

            $mobile = '225'.''.$data["client"]->mobile;


            $this->sendMessage($recap, $mobile);

            session()->flash('type','alert-success');
            session()->flash('message','Votre commande a été créé avec success.');
            return Redirect()->route('commande.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande, $id)
    {
        $id = htmlspecialchars($id);

        $data['title'] ='Modifié une commande';
        $data['menu'] ='commande';

        $data["user"] = User::where([
            'id' => Auth::user()->id,
            'role' => 2
        ])
        ->orWhere([
            'id' => Auth::user()->id,
            'role' => 3
        ])
        ->first();

        $data["canalachats"] = Canalachat::orderBy('id', 'desc')->get();

        $data["clients"] = User::orderBy('id', 'desc')->get();
        
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

        $data["commande"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '!=', "0"],
            ['commandes.id', '=', $id],
        ])
        ->first();

        return view('commande.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $request->validate(
            [
                'client' => 'required|exists:users,id',
                'canal' => 'required|exists:canalachats,id',
                'produits' => 'required|array|min:1',
                'quantites' => 'required|array|min:1',
                'status' => 'required',
                'adresse' => 'required',
            ],
            [
                'client.required' => "Veuillez selectonnée le client",
                'produits.required' => "Veuillez ajouter le(s) produit(s) pour la commande",
                'quantites.required' => "Veuillez ajouter le(s) quantite(s) pour la commande",
                'total_achat.required' => 'Total achat obligatoire',
                'status.required' => 'Statut de livraison obligatoire',
                'adresse.required' => 'Adresse de livraison obligatoire',
            ]

        );

        $data["client"] = User::where([
            'id' => htmlspecialchars($request->client),
            // 'role' => 2
        ])->first();

        $data["canalachat"] = Canalachat::where([
            'id' => htmlspecialchars($request->canal)
        ])->first();

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

        if (empty($data["businesse"]->devise_id)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue. Veuillez choisir la devise de votre boutique');
            return back();
        }
        
        $data["devise"] = Devise::where([
            'id' => $data["businesse"]->devise_id,
        ])->first();

        $commande =  Commande::find($id);
        if(empty($commande))
        {
            session()->flash("type","error");
            session()->flash("message","Erreur Commnade introuvable");
            return back();
        }

        $commande->client_id = $data["client"]->id;
        $commande->canalachat_id = $data["canalachat"]->id;
        $commande->mobile = $data['client']->mobile;
        $commande->devise = $data["devise"]->id;
        $commande->adresse = htmlspecialchars($request->adresse);
        $commande->total_achat = 0;
        $commande->user_id = $data["user"]->id;
        $commande->businesse_id = $data["businesse"]->id;
        $commande->status = '2';

        // Supprimer tous les produits associés à la commande
        $commande_produits = $commande->commandeproduits;
        foreach ($commande_produits as $commande_produit) {
            $produit = Produit::find($commande_produit->produit_id);
            $produit->qte += $commande_produit->quantite;
            $produit->save();
            $commande_produit->delete();
        }

        // Ajout des produits à la commande
        $produits = $request->produits;
        $quantites = $request->quantites;
        $total_achat = 0;

        foreach ($produits as $key => $produit_id) {
            // Récupération du produit
            $produit = Produit::find($produit_id);
            $quantite = $quantites[$key];
    
            // Vérification de la quantité disponible
            if ($produit->qte < $quantite) {
                session()->flash('type', 'alert-danger');
                session()->flash('message', 'Le produit ' . $produit->libelle . ' n\'a pas assez de quantité (' . $produit->qte . ') disponible.');
                return back();
            }

                // Vérification de la quantité commandée
                if (empty($quantite)) {
                    continue;
                }
    
            // Ajout du produit à la commande
            $commande_produit = new Commandeproduit();
            $commande_produit->commande_id = $commande->id;
            $commande_produit->produit_id = $produit_id;
            $commande_produit->quantite = $quantite;
            $commande_produit->montant = intval($produit->price) * intval($quantite);
    
            $commande_produit->save();
    
            // Déduction de la quantité commandée de la quantité disponible du produit
            $produit->qte -= $quantite;
            $produit->save();
    
            // Ajout du montant du produit au total d'achat de la commande
            $total_achat += $commande_produit->montant;
        }
        
    
        // Mise à jour du total d'achat de la commande
        $commande->total_achat = $total_achat;
        $commande->produits = json_encode($produits);
        $commande->quantites = json_encode($quantites);
        // $commande->save();
    
        if($commande->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre commande a été modifiée avec success.');
            return Redirect()->route('commande.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }

    // Méthode pour en cours de livraison d'une commande
    public function commandeEnCours($id)
    {
        $id = htmlspecialchars($id);
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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $commande = Commande::findOrFail($id);

        if ($commande->businesse_id == $data["businesse"]->id) {

            $commande->status = '0';
        
            if ($commande->save()) {
                session()->flash('type','alert-success');
                session()->flash('message','Commande modifié avec success.');
                return back();
            }else {
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur est survenue.');
                return back();
            }
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
        
    }

    // Méthode pour validé desactivé une commande
    public function commandeValideDelete($id)
    {
        $id = htmlspecialchars($id);
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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $commande = Commande::findOrFail($id);

        if ($commande->businesse_id == $data["businesse"]->id) {

            $commande->status = '0';
        
            if ($commande->save()) {
                session()->flash('type','alert-success');
                session()->flash('message','Commande modifié avec success.');
                return back();
            }else {
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur est survenue.');
                return back();
            }
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
        
    }

    // Méthode pour validé une commande
    public function commandeValide($id)
    {
        $id = htmlspecialchars($id);
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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $commande = Commande::findOrFail($id);

        if ($commande->businesse_id == $data["businesse"]->id) {

            $commande->status = '3';
        
            if ($commande->save()) {
                session()->flash('type','alert-success');
                session()->flash('message','Commande modifié avec success.');
                return back();
            }else {
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur est survenue.');
                return back();
            }
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
        
    }
    // Méthode pour validé une commande
    public function commandeAbandonne($id)
    {
        $id = htmlspecialchars($id);
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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $commande = Commande::findOrFail($id);

        if ($commande->businesse_id == $data["businesse"]->id) {

            $commande->status = '0';
        
            if ($commande->save()) {
                session()->flash('type','alert-success');
                session()->flash('message','Commande modifié avec success.');
                return back();
            }else {
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur est survenue.');
                return back();
            }
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function commandeCeMois()
    {
        $data['title'] ='Les commandes de ce mois';
        $data['menu'] ='commande';

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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $data["commandes"] = Commande::orderBy('id', 'desc')
            ->join('users', 'commandes.client_id', '=', 'users.id')
            ->select('commandes.*', 'users.name', 'users.mobile')
            ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '!=', "0"]
            ])
            ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
            ->get();

        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "1"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "2"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "3"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "4"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();
        
        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "5"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();
        
        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "6"],
        ])
        ->whereBetween('commandes.created_at', [$monthStart, $monthEnd])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        return view('commande.cemois',$data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function commandeCetteSemaine()
    {
        $data['title'] ='Les commandes de cette semaine';
        $data['menu'] ='commande';

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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $weekStartDate = Carbon::now()->startOfWeek(); // date de début de la semaine
        $weekEndDate = Carbon::now()->endOfWeek(); // date de fin de la semaine

        $data["commandes"] = Commande::orderBy('id', 'desc')
            ->join('users', 'commandes.client_id', '=', 'users.id')
            ->select('commandes.*', 'users.name', 'users.mobile')
            ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '!=', "0"],
                ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
                ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],            ])

            ->get();
        
        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "1"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "2"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "3"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "4"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();
        
        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "5"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();
        
        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "6"],
            ['commandes.created_at', '>=', Carbon::now()->startOfWeek()],
            ['commandes.created_at', '<=', Carbon::now()->endOfWeek()],
        ])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();


        return view('commande.cettesemaine',$data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function commandeSemainePasse()
    {
        $data['title'] ='Les commandes de la semaine passé';
        $data['menu'] ='commande';

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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        // Obtenir la date de début et la date de fin de la semaine passée
        $weekStart = Carbon::now()->subWeek()->startOfWeek();
        $weekEnd = Carbon::now()->subWeek()->endOfWeek();

        $data["commandes"] = Commande::orderBy('id', 'desc')
            ->join('users', 'commandes.client_id', '=', 'users.id')
            ->select('commandes.*', 'users.name', 'users.mobile')
            ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '!=', "0"],
                ['commandes.created_at', '>=', $weekStart],
                ['commandes.created_at', '<=', $weekEnd]
            ])
            ->get();
        
        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "1"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "2"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "3"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "4"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();
        
        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "5"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();
        
        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "6"],
            ['commandes.created_at', '>=', $weekStart],
            ['commandes.created_at', '<=', $weekEnd]
        ])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        return view('commande.semainepasse',$data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function commandeLeMoisDernier()
    {
        $data['title'] ='Les commandes du mois passé';
        $data['menu'] ='commande';

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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $now = now();
        $lastMonth = $now->copy()->subMonth();
        $startDate = $lastMonth->startOfMonth();
        $endDate = $lastMonth->endOfMonth();

        $data["commandes"] = Commande::orderBy('id', 'desc')
            ->join('users', 'commandes.client_id', '=', 'users.id')
            ->select('commandes.*', 'users.name', 'users.mobile')
            ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '!=', "0"]
            ])
            ->whereBetween('commandes.created_at', [$startDate, $endDate])
            ->get();

        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "1"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "2"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "3"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "4"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();
        
        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "5"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();
        
        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "6"],
        ])
        ->whereBetween('commandes.created_at', [$startDate, $endDate])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();


        return view('commande.lemoisdernier',$data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function commandeToday()
    {
        $data['title'] ='Les commandes du jour';
        $data['menu'] ='commande';

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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        $data["commandes"] = Commande::orderBy('id', 'desc')
            ->join('users', 'commandes.client_id', '=', 'users.id')
            ->select('commandes.*', 'users.name', 'users.mobile')
            ->with('commandeproduits.produit')
            ->where([
                ['commandes.businesse_id', '=', $data["businesse"]->id],
                ['commandes.status', '!=', "0"],
                [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
            ])
            ->get();

        
        // LISTE DES COMMANDES LIVRE
        $data["commandeLivres"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "1"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();

        // LISTE DES COMMANDES EN ATTENTE
        $data["commandeEnAttentes"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "2"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();

        // LISTE DES COMMANDES EN COUR
        $data["commandeEnCours"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "3"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();

        // LISTE DES COMMANDES ANNULE
        $data["commandeAnnules"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "4"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();
        
        // LISTE DES COMMANDES validee
        $data["commandeValides"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "5"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();
        
        // LISTE DES COMMANDES ABANDONNEE
        $data["commandeAbandonnees"] = Commande::orderBy('id', 'desc')
        ->join('users', 'commandes.client_id', '=', 'users.id')
        ->select('commandes.*', 'users.name', 'users.mobile')
        ->with('commandeproduits.produit')
        ->where([
            ['commandes.businesse_id', '=', $data["businesse"]->id],
            ['commandes.status', '=', "6"],
            [DB::raw('DATE(commandes.created_at)'), '=', Carbon::today()->toDateString()]
        ])
        ->get();

        $data["devise"] = Devise::where('id', $data["businesse"]->devise_id)->first();

        return view('commande.today',$data);

    }

    public function sendMessage($message = "", $reciever = "") 
    {
       try{
            // $message_encoded = urlencode($message);
            // dd($message_encoded);
            // dd($message,$reciever); 
            
            $username = "ali.ouattara08@yahoo.com";
            $password = "QSmlF476";
            $sender_id = "Ventoo";
              
        $url="https://vavasms.com/api/v1/text/single";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => 
            '{
                "username" : "'.$username.'",
                "password" : "'.$password.'",
                "sender_id" : "'.$sender_id.'",
                "phone" : "'.$reciever.'",
                "message" : "'.$message.'"
            }',
            CURLOPT_HTTPHEADER => array(
                // 'Authorization: Bearer '.$apikey,
                'Content-Type: application/json'
              ),
        ));
       
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);

            if(curl_errno($ch))
            {
                echo 'error:' . curl_error($ch);
            }
            curl_close($ch);
            $final = json_decode($output);

            // dd($final);
                
        }catch (Exception $e) {
            return false;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}

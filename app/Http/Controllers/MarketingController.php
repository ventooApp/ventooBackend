<?php

namespace App\Http\Controllers;

use App\Models\Marketing;
use App\Models\Produit;
use App\Models\User;
use App\Models\Businesse;
use App\Models\Devise;
use App\Models\Categorieproduit;
use App\Models\Reductionproduit;
use App\Models\Reductionpaniermoyen;
use App\Models\Zone;
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


class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Marketing';
        $data['menu'] ='marketing';
        
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

        return view('marketing.index',$data);
    }

    public function getProductByCategory(Request $request)
    {
        $category_id = $request->category_id;

        $products = Produit::where('categorieproduit_id', $category_id)->get();

        return response()->json($products);
    }

    public function calculateDiscountValue(Request $request)
    {
        $price = $request->price;
        $percentage = $request->percentage;

        $discount_value = ($price * $percentage) / 100;

        return response()->json(['discount_value' => $discount_value]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function createLivraisonGratuite()
    {
        $data['title'] ='Ajouter une livraison gratuite';
        $data['menu'] ='marketing';
        
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

        return view('marketing.createlivraisongratuite',$data);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function createReconqueteClient()
    {
        $data['title'] ='Reconquête client';
        $data['menu'] ='marketing';
        
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

        return view('marketing.createreconqueteclient',$data);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function createPanierAbandonne()
    {
        $data['title'] ='Panier Abandonné';
        $data['menu'] ='marketing';
        
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

        return view('marketing.createpanierabandonne',$data);
    }

        /**
     * Display a listing of the resource.
     */
    public function indexLivraisonGratuite()
    {
        $data['title'] ='Livraison gratuite';
        $data['menu'] ='marketing';
        
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

        return view('marketing.livraisongratuite',$data);
    }

            /**
     * Display a listing of the resource.
     */
    public function indexReconqueteClient()
    {
        $data['title'] ='Reconquête client';
        $data['menu'] ='marketing';
        
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

        return view('marketing.reconqueteclient',$data);
    }

                /**
     * Display a listing of the resource.
     */
    public function indexPanierAbandonne()
    {
        $data['title'] ='Panier abandonné';
        $data['menu'] ='marketing';
        
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

        return view('marketing.panierabandonne',$data);
    }



    /**
     * Display a listing of the resource.
     */
    public function indexReductionSurLesProduit(Request $request)
    {
        $data['title'] ='Réductions sur les produits';
        $data['menu'] ='marketing';
        
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

        // $data["reductionSurLesProduits"] = Reductionproduit::orderBy('id', 'desc')
        // ->where([
        //     ['businesse_id', '=', $data["businesse"]->id]
        // ])
        // ->with('categorieproduit', 'produit', 'zone')->has('categorieproduit')
        // ->get();

        $reductionSurLesProduits = Reductionproduit::orderBy('id', 'desc')
        ->where([
            ['businesse_id', '=', $data["businesse"]->id],
            ['status', '!=', 2]
        ])
        ->with('categorieproduit', 'produit', 'zone')
        ->has('categorieproduit');
    
        $date_filter = $request->input('date_filter');
        $selected_date_filter = $request->input('date_filter', 'today');

    
        if ($date_filter) {
            switch ($date_filter) {
                case 'all':
                    break;
                case 'today':
                    $reductionSurLesProduits->whereDate('created_at', Carbon::today());
                    break;
                case 'current_week':
                    $reductionSurLesProduits->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'previous_week':
                    $reductionSurLesProduits->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()]);
                    break;
                case 'current_month':
                    $reductionSurLesProduits->whereMonth('created_at', Carbon::now()->month);
                    break;
                case 'last_month':
                    $reductionSurLesProduits->whereMonth('created_at', Carbon::now()->subMonth()->month);
                    break;
            }
        }
    
        $data["reductionSurLesProduits"] = $reductionSurLesProduits->get();

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

        $data["zones"] = Zone::orderBy('id', 'desc')->get();

        return view('marketing.reductionsurproduit',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createReductionSurLesProduit()
    {
        $data['title'] ='Ajouter une réduction sur les produits';
        $data['menu'] ='marketing';
        
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

        $data["zones"] = Zone::orderBy('id', 'desc')->get();


        return view('marketing.createreductionsurproduit',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRecductionProduit(Request $request)
    {
        $data['title'] ='Réductions sur les produits';
        $data['menu'] ='marketing';
        // dd($request->all());
        $request->validate(
            [
                'libelle' => 'required|min:5',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'price' => 'required',
                'percentage' => 'required',
                'discount_value' => 'required',
                'category_id' => 'required|exists:categorieproduits,id',
                'product_id' => 'required|exists:produits,id',
                'zone' => 'required|exists:zones,id',
            ],
            [
                'libelle.required' => 'Le nom de la campagne est obligatoire',
                'date_debut.required' => 'La date de début de la campagne est obligatoire',
                'date_fin.required' => 'La date de fin de la campagne est obligatoire',
                'percentage.unique' => 'Le pourcentage de reduction de la campagne est obligatoire',
                'discount_value.unique' => 'La valeur du pourcentage de reduction de la campagne est obligatoire',
                'category_id.required' => 'Lactégorie de produit pour la campagne est obligatoire',
                'product_id.required' => 'Le produit pour la campagne est obligatoire',
                'zone.required' => 'La zone dans laquelle la reduction sera appliquée est obligatoire',
            ]
        );

        $categorie = Categorieproduit::where('id', htmlspecialchars($request->category_id))->first();
        $produit = Produit::where('id', htmlspecialchars($request->product_id))->first();
        $zone = Zone::where('id', htmlspecialchars($request->zone))->first();

        if (empty($categorie) || empty($produit) || empty($zone)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue');
            return back();
        }

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


        $discountValue = $produit->price * (htmlspecialchars($request->percentage) / 100);

        $reductionproduit = new Reductionproduit();

        $reductionproduit->libelle = htmlspecialchars($request->libelle);
        $reductionproduit->date_debut = htmlspecialchars($request->date_debut);
        $reductionproduit->date_fin = htmlspecialchars($request->date_fin);
        $reductionproduit->pourcentage = htmlspecialchars($request->percentage);
        $reductionproduit->valeur_pourcentage = intval($discountValue);
        $reductionproduit->categorieproduit_id = $categorie->id;
        $reductionproduit->produit_id = $produit->id;
        $reductionproduit->zone_id = $zone->id;
        $reductionproduit->businesse_id = $data["businesse"]->id;
        $reductionproduit->user_id = $data["user"]->id;
        $reductionproduit->price = $produit->price;

        if($reductionproduit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été créé avec success');
            return Redirect()->route('marketing.reduction-sur-les-produit');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRecductionProduit(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $data['title'] ='Réductions sur les produits';
        $data['menu'] ='marketing';
        // dd($request->all());
        $request->validate(
            [
                'libelle' => 'required|min:5',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'price' => 'required',
                'percentage' => 'required',
                'discount_value' => 'required',
                'category_id' => 'required|exists:categorieproduits,id',
                'product_id' => 'required|exists:produits,id',
                'zone' => 'required|exists:zones,id',
            ],
            [
                'libelle.required' => 'Le nom de la campagne est obligatoire',
                'date_debut.required' => 'La date de début de la campagne est obligatoire',
                'date_fin.required' => 'La date de fin de la campagne est obligatoire',
                'percentage.unique' => 'Le pourcentage de reduction de la campagne est obligatoire',
                'discount_value.unique' => 'La valeur du pourcentage de reduction de la campagne est obligatoire',
                'category_id.required' => 'Lactégorie de produit pour la campagne est obligatoire',
                'product_id.required' => 'Le produit pour la campagne est obligatoire',
                'zone.required' => 'La zone dans laquelle la reduction sera appliquée est obligatoire',
            ]
        );

        $categorie = Categorieproduit::where('id', htmlspecialchars($request->category_id))->first();
        $produit = Produit::where('id', htmlspecialchars($request->product_id))->first();
        $zone = Zone::where('id', htmlspecialchars($request->zone))->first();

        if (empty($categorie) || empty($produit) || empty($zone)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue');
            return back();
        }

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


        $discountValue = $produit->price * (htmlspecialchars($request->percentage) / 100);

        $reductionproduit = Reductionproduit::find($id);

        $reductionproduit->libelle = htmlspecialchars($request->libelle);
        $reductionproduit->date_debut = htmlspecialchars($request->date_debut);
        $reductionproduit->date_fin = htmlspecialchars($request->date_fin);
        $reductionproduit->pourcentage = htmlspecialchars($request->percentage);
        $reductionproduit->valeur_pourcentage = intval($discountValue);
        $reductionproduit->categorieproduit_id = $categorie->id;
        $reductionproduit->produit_id = $produit->id;
        $reductionproduit->zone_id = $zone->id;
        $reductionproduit->businesse_id = $data["businesse"]->id;
        $reductionproduit->user_id = $data["user"]->id;
        $reductionproduit->price = $produit->price;

        if($reductionproduit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été modifiée avec success');
            // return view('marketing.reductionsurproduit',$data);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function deleteRecductionProduit(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $data['title'] ='Réductions sur les produits';
        $data['menu'] ='marketing';

        $reductionproduit = Reductionproduit::find($id);

        $reductionproduit->status = 2;

        if($reductionproduit->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été supprimé avec success');
            return back();
        }

    }


    /**
     * Display a listing of the resource.
     */
    public function indexReductionSurLePanierMoyen(Request $request)
    {
        $data['title'] ='Réductions sur le panier moyen';
        $data['menu'] ='marketing';
        
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


        $recductionPanierMoyens = Reductionpaniermoyen::orderBy('id', 'desc')
        ->where([
            ['businesse_id', '=', $data["businesse"]->id],
            ['status', '!=', 2]
        ])
        ->with('zone')
        ->has('zone');
    
        $date_filter_rpm = $request->input('date_filter_rpm');
        $selected_date_filter_rpm = $request->input('date_filter_rpm', 'today');

    
        if ($date_filter_rpm) {
            switch ($date_filter_rpm) {
                case 'all':
                    break;
                case 'today':
                    $recductionPanierMoyens->whereDate('created_at', Carbon::today());
                    break;
                case 'current_week':
                    $recductionPanierMoyens->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'previous_week':
                    $recductionPanierMoyens->where([
                        ['created_at', '>=', Carbon::now()->subWeek()->startOfWeek()],
                        ['created_at', '<=', Carbon::now()->subWeek()->endOfWeek()]
                    ]);
                    break;
                case 'current_month':
                    $recductionPanierMoyens->whereMonth('created_at', Carbon::now()->month);
                    break;
                case 'last_month':
                    $recductionPanierMoyens->whereMonth('created_at', Carbon::now()->subMonth()->month);
                    break;
            }
        }
        
    
        $data["recductionPanierMoyens"] = $recductionPanierMoyens->get();

        $data["zones"] = Zone::orderBy('id', 'desc')->get();

        return view('marketing.reductionsurlepaniermoyen',$data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createReductionSurLePanierMoyen()
    {
        $data['title'] ='Ajouter une réduction ';
        $data['menu'] ='marketing';
        
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

        $data["zones"] = Zone::orderBy('id', 'desc')->get();

        return view('marketing.createreductionsurlepaniermoyen',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRecductionPanierMoyen(Request $request)
    {
        $request->validate(
            [
                'libelle' => 'required|min:5',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'seuil' => 'required',
                'percentage' => 'required',
                'zone' => 'required|exists:zones,id',
            ],
            [
                'libelle.required' => 'Le nom de la campagne est obligatoire',
                'date_debut.required' => 'La date de début de la campagne est obligatoire',
                'date_fin.required' => 'La date de fin de la campagne est obligatoire',
                'percentage.required' => 'Le pourcentage de reduction de la campagne est obligatoire',
                'zone.required' => 'La zone dans laquelle la reduction sera appliquée est obligatoire',
                'zone.exists' => 'Le seuil est obligatoire',
                'seuil.required' => 'Le seuil est obligatoire',
            ]
        );

        $zone = Zone::where('id', htmlspecialchars($request->zone))->first();

        if (empty($zone)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue');
            return back();
        }

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

        $reductionpaniermoyen = new Reductionpaniermoyen();

        $reductionpaniermoyen->libelle = htmlspecialchars($request->libelle);
        $reductionpaniermoyen->date_debut = htmlspecialchars($request->date_debut);
        $reductionpaniermoyen->date_fin = htmlspecialchars($request->date_fin);
        $reductionpaniermoyen->pourcentage = htmlspecialchars($request->percentage);
        $reductionpaniermoyen->seuil = htmlspecialchars($request->seuil);
        $reductionpaniermoyen->zone_id = $zone->id;
        $reductionpaniermoyen->businesse_id = $data["businesse"]->id;
        $reductionpaniermoyen->user_id = $data["user"]->id;

        if($reductionpaniermoyen->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été créé avec success');
            return Redirect()->route('marketing.reduction-sur-le-panier-moyen');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRecductionPanierMoyen(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $request->validate(
            [
                'libelle' => 'required|min:5',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'seuil' => 'required',
                'percentage' => 'required',
                'zone' => 'required|exists:zones,id',
            ],
            [
                'libelle.required' => 'Le nom de la campagne est obligatoire',
                'date_debut.required' => 'La date de début de la campagne est obligatoire',
                'date_fin.required' => 'La date de fin de la campagne est obligatoire',
                'percentage.required' => 'Le pourcentage de reduction de la campagne est obligatoire',
                'zone.required' => 'La zone dans laquelle la reduction sera appliquée est obligatoire',
                'zone.exists' => 'Le seuil est obligatoire',
                'seuil.required' => 'Le seuil est obligatoire',
            ]
        );

        $zone = Zone::where('id', htmlspecialchars($request->zone))->first();

        if (empty($zone)) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue');
            return back();
        }

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

        $reductionpaniermoyen = Reductionpaniermoyen::find($id);

        $reductionpaniermoyen->libelle = htmlspecialchars($request->libelle);
        $reductionpaniermoyen->date_debut = htmlspecialchars($request->date_debut);
        $reductionpaniermoyen->date_fin = htmlspecialchars($request->date_fin);
        $reductionpaniermoyen->pourcentage = htmlspecialchars($request->percentage);
        $reductionpaniermoyen->seuil = htmlspecialchars($request->seuil);
        $reductionpaniermoyen->zone_id = $zone->id;
        $reductionpaniermoyen->businesse_id = $data["businesse"]->id;
        $reductionpaniermoyen->user_id = $data["user"]->id;

        if($reductionpaniermoyen->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été modifiée avec success');
            return Redirect()->route('marketing.reduction-sur-le-panier-moyen');
        }
    }

        /**
     * Display the specified resource.
     */
    public function deleteRecductionPanierMoyen(Request $request, $id)
    {
        $id = htmlspecialchars($id);

        $data['title'] ='Réductions sur les produits';
        $data['menu'] ='marketing';

        $recductionPanierMoyen = RecductionPanierMoyen::find($id);

        $recductionPanierMoyen->status = 2;

        if($recductionPanierMoyen->save())
        {
            session()->flash('type','alert-success');
            session()->flash('message','Votre camapgne a été supprimé avec success');
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAchterObtenir()
    {
        $data['title'] ='Acheter X Obtenir Y';
        $data['menu'] ='marketing';
        
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

        return view('marketing.acheterobtenir',$data);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function createReductionAcheterObtenir()
    {
        $data['title'] ='Ajouter une réduction ';
        $data['menu'] ='marketing';
        
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

        return view('marketing.createreductionacheterobtenir',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marketing $marketing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marketing $marketing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marketing $marketing)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Businesse;
use App\Models\Devise;
use App\Models\Commandeproduit;
use App\Models\Commande;
use App\Models\Canalachat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] ='Clients';
        $data['menu'] ='client';

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

        // TOUT LES CLIENTS DE LA BOUTIQUE
        // $data["clientAlls"] = User::where('created_by', $data["businesse"]->id)
        //     ->orderBy('id', 'desc')->get();

        $data["clientAlls"] = DB::table('users')
            ->join('commandes', 'users.id', '=', 'commandes.client_id')
            ->join('canalachats', 'canalachats.id', '=', 'commandes.canalachat_id')
            ->select('users.id', 'users.name', 'users.mobile','users.client_actif', DB::raw('MAX(canalachats.libelle) as canalachat_libelle'), DB::raw('COUNT(DISTINCT commandes.id) as nombre_commandes'))
            ->where('users.active', '1')
            ->where('users.role', 4)
            // ->where('commandes.status', '1')
            ->where('users.created_by', $data["businesse"]->id)
            ->groupBy('users.id', 'users.name', 'users.mobile')
            ->havingRaw('COUNT(DISTINCT commandes.id) > 0')
            ->get();


        // LES NOUVEAU CLIENTS
        // $data["clientNews"] = User::where([
        //     'created_by' => $data["businesse"]->id,
        //         ])
        //     ->whereMonth('created_at', Carbon::now()->month)
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->get();
        $data["clientNews"] = DB::table('users')
            ->join('commandes', 'users.id', '=', 'commandes.client_id')
            ->join('canalachats', 'canalachats.id', '=', 'commandes.canalachat_id')
            ->select('users.id', 'users.name', 'users.mobile', 'users.client_actif', DB::raw('MAX(canalachats.libelle) as canalachat_libelle'), DB::raw('COUNT(DISTINCT commandes.id) as nombre_commandes'))
            ->where('users.active', '1')
            ->where('users.role', 4)
            // ->where('commandes.status', '1')
            ->whereMonth('users.created_at', Carbon::now()->month)
            ->whereYear('users.created_at', Carbon::now()->year)
            ->where('users.created_by', $data["businesse"]->id)
            ->groupBy('users.id', 'users.name', 'users.mobile')
            // ->havingRaw('COUNT(DISTINCT commandes.id) > 0')
            ->get();


        // LES CLIENTS ACTIFS
        $data["clientActifs"] = DB::table('users')
        ->join('commandes', 'users.id', '=', 'commandes.client_id')
        ->join('canalachats', 'canalachats.id', '=', 'commandes.canalachat_id')
        ->select('users.id', 'users.name', 'users.mobile','users.client_actif', DB::raw('MAX(canalachats.libelle) as canalachat_libelle'), DB::raw('COUNT(DISTINCT commandes.id) as nombre_commandes'))
        ->where('users.active', '1')
        ->where('users.client_actif', 1)
        ->where('users.role', 4)
        // ->where('commandes.status', '1')
        ->where('users.created_by', $data["businesse"]->id)
        ->groupBy('users.id', 'users.name', 'users.mobile')
        ->havingRaw('COUNT(DISTINCT commandes.id) > 0')
        ->get();

        // LES CLIENTS INACTIFS
        $data["clientInactifs"] = DB::table('users')
        ->join('commandes', 'users.id', '=', 'commandes.client_id')
        ->join('canalachats', 'canalachats.id', '=', 'commandes.canalachat_id')
        ->select('users.id', 'users.name', 'users.mobile','users.client_actif', DB::raw('MAX(canalachats.libelle) as canalachat_libelle'), DB::raw('COUNT(DISTINCT commandes.id) as nombre_commandes'))
        ->where('users.active', '1')
        ->where('users.client_actif', 0)
        ->where('users.role', 4)
        // ->where('commandes.status', '1')
        ->where('users.created_by', $data["businesse"]->id)
        ->groupBy('users.id', 'users.name', 'users.mobile')
        ->havingRaw('COUNT(DISTINCT commandes.id) > 0')
        ->get();
        // dd($data["clientInactifs"]);
        

        return view('client.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details($id)
    {
        $id = htmlspecialchars($id);
        $data['title'] ='Liste des commandes';
        $data['menu'] ='client';

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

        $data["client"] = User::findOrFail($id);
        $data["commandes"] = Commande::where('client_id', $id)
        ->with('commandeproduits.produit')
            ->get();

    
        return view('client.details',$data);
    }

    // Méthode pour mettre à jour le statut d'un client
    public function activateDeactivate(Request $request, $id)
    {
        $client = User::findOrFail($id);
        $client->client_actif = $request->input('client_actif');
        $client->save();

        session()->flash('type','alert-success');
        session()->flash('message','Votre client a été modifié avec success.');
        return Redirect()->route('client.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'mobile' => 'required|unique:users',
                'email' => 'nullable',
                'adresse' => 'required',
            ],
            [
                'name.required' => "Veuillez entrer le nom complet du client",
                'mobile.required' => "Veuillez ajouter le numéro du client",
                'adresse.required' => 'Adresse de livraison obligatoire',
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

        if (empty($data["businesse"])) {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }

        if (empty($request->email)) {
            $email = htmlspecialchars($request->mobile).''.'@ventoo.io';
        }else {
            $email = htmlspecialchars($request->email);
        }

        $user = new User();

        $password_random = mt_rand(10000000, 99999999);

        $user->name = htmlspecialchars($request->name);
        $user->mobile = htmlspecialchars($request->mobile);
        $user->adresse = htmlspecialchars($request->adresse);
        $user->email = $email;
        $user->created_by = $data["user"]->id;
        $user->businesse_id = $data["businesse"]->id;
        $user->password = Hash::make($password_random);
        $user->role = 4;

        if($user->save())
        {
            $mobile = '225'.''.$user->mobile;
            $pass = $password_random;
            $message = "Votre compte Ventoo est créé ! Accédez-y avec: {$user->mobile} et le mot de passe: {$pass} sur https://www.ventoo.io";
            $this->sendMessage($message, $mobile);

            session()->flash('type','alert-success');
            session()->flash('message','Votre client a été créé avec success.');
            return back();

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','Une erreur est survenue.');
            return back();
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function saveClientviaCsv(Request $request)
    {

        // Vérifiez si un fichier CSV a été téléchargé
        if ($request->hasFile('csv')) {
            $path = $request->file('csv')->getRealPath();

            // Ouvrir le fichier CSV et lire la première ligne (les en-têtes)
            // $handle = fopen($path, 'r');
            $csv_data = file_get_contents($path);
            $csv_data = strip_tags($csv_data);
            $handle = fopen('data://text/plain,' . $csv_data, 'r');

            $headers = fgetcsv($handle, 1000, ',');

            $count = 0; // compteur de ligne

            // Boucler sur chaque ligne à partir de la deuxième ligne
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $count++;

                $users = User::where([
                    'id' => Auth::user()->id,
                    'role' => 2
                ])
                ->orWhere([
                    'id' => Auth::user()->id,
                    'role' => 3
                ])
                ->first();
        
                $businesses = Businesse::where('user_id', $users->id)->orWhere('user_id', $users->created_by)->first();
        
                if (empty($businesses)) {
                    session()->flash('type','alert-danger');
                    session()->flash('message','Une erreur est survenue.');
                    return back();
                }

                if (count($data) < 3) {
                    continue; // Passer à la ligne suivante
                }
                
                // Vérifier si l'utilisateur avec le même mobile existe déjà dans la base de données
                $existingUser = User::where('mobile', $data[1])->first();
                if ($existingUser) {
                    continue; // Passer à l'utilisateur suivant
                }
            
                $password_random = mt_rand(10000000, 99999999);
            
                // Créer un nouvel utilisateur avec les données de chaque ligne
                $user = new User([
                    'name' => $data[0],
                    'mobile' => $data[1],
                    'email' => $data[2],
                    'password' => Hash::make($password_random),
                    'role' => 4,
                ]);

                // Enregistrer l'utilisateur dans la base de données
                if ($user->save()) {
            
                    $usr = User::where('id', $user->id)->first();
                    $usr->businesse_id = $businesses->id;
                    $usr->created_by = $users->id;
                    $usr->role = 4;
            
                    if ($usr->save()) {
                        $mobile = '225'.''.$usr->mobile;
                        $pass = $password_random;
                        $message = "Votre compte Ventoo est créé ! Accédez-y avec: {$user->mobile} et le mot de passe: {$pass} sur https://www.ventoo.io";
                        $this->sendMessage($message, $mobile);
            
                        session()->flash('type','alert-success');
                        session()->flash('message','Votre client a été créé avec success.');
                        return back();
                    }
            
                } else {
                    session()->flash('type', 'alert-danger');
                    session()->flash('message', 'Erreur veuillez réessayer');
                    return back();
                }
            }
            

            fclose($handle);
        }else {
            // Si aucun fichier CSV n'a été téléchargé, affichez un message d'erreur
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'Erreur veuillez réessayer');
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }


    public function sendMessage($message = "", $reciever = "") 
    {
       try{
            // $message_encoded = urlencode($message);
            // dd($message_encoded);
            
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
                
        }catch (Exception $e) {
            return false;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}

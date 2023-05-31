<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector; 
use Session;
use App\Models\User;
use App\Models\Businesse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showlogin()
    {
        return view('auth.login');
    }

    /**
     * connexion des utilisateurs
     * @param Request $request
     */

    public function login(Request $request)
    { 
        $request->validate(
            [
                'email_mobile' => 'required',
                'password' => 'required',
            ],
            [
                'email_mobile.required' => 'Email is required',
                'password.required' => 'Password is required',

            ]

        );

        // $credentials = $request->only('email', 'password');
        $login_type = filter_var( $request->email_mobile, FILTER_VALIDATE_EMAIL ) ? 'email' : 'mobile';

        $credentials = [$login_type => $login_type == 'mobile' ? '225'.''.$request->email_mobile : $request->email_mobile, 'password'=>$request->password];

        if (Auth::attempt($credentials)) {
            $user = User::where('mobile', '225'.$request->email_mobile)->orWhere('email', $request->email_mobile)->first();

            if ($user->role == 2 && $user->active == 1) {
                return Redirect()->route('dashboard');
            }else {
                session()->flash('type','alert-danger');
                session()->flash('message',"Merci de contacter l'administrateur pour activer votre compte");
                Auth::logout();
                //return redirect('/login');
                return back();
            }
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message',"Numéro de téléphone ou mot de passe incorrect");
            return back();
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:5',
                'store_name' => 'required|min:3',
                'domain_name' => 'required|unique:businesses',
                'mobile' => 'required|unique:users',
                'checkbox' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'name.required' => 'Le nom compet est obligatoire',
                'store_name.required' => 'Le nom de la boutique est obligatoire',
                'domain_name.required' => 'Le nom de domaine est obligatoire',
                'mobile.unique' => 'Ce numero de téléphone est déjà utilisé',
                'mobile.required' => 'Le numéro de téléphone est obligatoire',
                // 'email.required' => 'Email is required',
                'checkbox.required' => 'Veuillez svp accepter les politiques de confidentialité',
                'password.required' => 'Le mot de passe est obligatoire',
            ]
        );
        $user = new User();

        $user->name = htmlspecialchars($request->name);
        $user->mobile = '225'.''.htmlspecialchars($request->mobile);
        $user->email = $user->mobile.''.'@ventoo.io';
        $user->role = 2;
        $user->password = Hash::make($request->password);

        if($user->save())
        {
            $user = User::where('mobile', $user->mobile)->first();

            $businesse = new Businesse();
            $businesse->name = htmlspecialchars($request->store_name);
            $businesse->domain_name = htmlspecialchars($request->domain_name);
            $businesse->user_id = $user->id;

            if ($businesse->save()) {
                session()->flash('type','alert-success');
                session()->flash('message','Votre compte a été créé avec success');
                return view('auth.login');
            }

        }
    }


        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showregister()
    {
        return view('auth.register');
    }
}

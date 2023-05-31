<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\GuideconfigurationController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategorieproduitController;
use App\Http\Controllers\MarketingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function (){

    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/guide-de-configuration', [GuideconfigurationController::class, 'index'])->name('guide.index');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('/liste-des-produits', [ProduitController::class, 'index'])->name('produit.index');
    Route::get('/ajouter-un-produits', [ProduitController::class, 'create'])->name('produit.create');
    Route::post('/produitStore', [ProduitController::class, 'store'])->name('produitStore');
    Route::get('/produit-edit/{id}', [ProduitController::class, 'edit'])->name('produit.edit');
    Route::get('/produit-show/{id}', [ProduitController::class, 'show'])->name('produit.show');
    Route::get('/produit-destroy/{id}', [ProduitController::class, 'destroy'])->name('produit.destroy');
    Route::post('/produit-update/{id}', [ProduitController::class, 'update'])->name('produit.update');
    Route::get('/produits/{productId}/images/{imageName}/delete', [ProduitController::class, 'deleteProductImage'])->name('produits.images.delete');
    Route::post('/update_quantite', [ProduitController::class, 'updateQuantite']);
    Route::post('/produits/activate-deactivate/{id}', [ProduitController::class, 'activateDeactivateProduit'])->name('produits.activate-deactivate');


    // Route::get('/produits/{productId}/images/{imageName}/delete', 'ProduitController@deleteImage')
    // ->name('produits.images.delete');



    Route::get('/liste-des-commandes', [CommandeController::class, 'index'])->name('commande.index');
    Route::get('/ajouter-une-commande', [CommandeController::class, 'create'])->name('commande.create');
    Route::post('/enregistrer-une-commande', [CommandeController::class, 'store'])->name('commande.store');
    Route::get('/modifier-une-commande/{id}', [CommandeController::class, 'edit'])->name('commande.edit');
    Route::post('/update-une-commande/{id}', [CommandeController::class, 'update'])->name('commande.update');
    Route::get('/livre/{id}', [CommandeController::class, 'commandeLivre'])->name('commande.livre');
    // Route::post('/en-attente/{id}', [CommandeController::class, 'commandeEnAttente'])->name('commande.en-attente');
    Route::get('/en-cours/{id}', [CommandeController::class, 'commandeEnCours'])->name('commande.en-cours');
    // Route::post('/annule/{id}', [CommandeController::class, 'commandeAnnule'])->name('commande.annule');
    Route::get('/valide/{id}', [CommandeController::class, 'commandeValide'])->name('commande.valide');
    Route::get('/valide-delete/{id}', [CommandeController::class, 'commandeValideDelete'])->name('commande.valide-delete');
    Route::get('/abandonne/{id}', [CommandeController::class, 'commandeAbandonne'])->name('commande.abandonne');

    Route::get('/commande-ce-mois', [CommandeController::class, 'commandeCeMois'])->name('commande.cemois');
    Route::get('/commande-cette-semaine', [CommandeController::class, 'commandeCettesemaine'])->name('commande.cettesemaine');
    Route::get('/commande-semaine-passee', [CommandeController::class, 'commandeSemainePasse'])->name('commande.semainepasse');
    Route::get('/commande-le-mois-dernier', [CommandeController::class, 'commandeLeMoisDernier'])->name('commande.lemoisdernier');
    Route::get('/commande-ce-jour', [CommandeController::class, 'commandeToday'])->name('commande.today');


    Route::get('/liste-des-client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/ajouter-un-client', [ClientController::class, 'create'])->name('client.create');
    Route::post('/enregistrer-un-client', [ClientController::class, 'store'])->name('client.store');
    Route::post('/enregistrer-un-client-csv', [ClientController::class, 'saveClientviaCsv'])->name('client.store-csv');
    Route::get('/clients/{id}/details', [ClientController::class, 'details'])->name('clients.details');
    Route::post('/clients/activate-deactivate/{id}', [ClientController::class, 'activateDeactivate'])->name('clients.activate-deactivate');
    
    Route::get('/ajouter-une-catégorie', [CategorieproduitController::class, 'create'])->name('categorieproduit.create');
    Route::get('/modifier-une-catégorie/{id}', [CategorieproduitController::class, 'edit'])->name('categorieproduit.edit');
    Route::get('/destroy-une-catégorie/{id}', [CategorieproduitController::class, 'destroy'])->name('categorieproduit.destroy');
    Route::post('/ajouter-une-categorie-de-produit', [CategorieproduitController::class, 'store'])->name('categorieproduit.store');
    Route::post('/update-une-categorie-de-produit/{id}', [CategorieproduitController::class, 'update'])->name('categorieproduit.update');
    
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');

    Route::get('/products/get-by-category', [MarketingController::class, 'getProductByCategory'])->name('products.get-by-category');
    Route::get('/calculate-discount-value', [MarketingController::class, 'calculateDiscountValue'])->name('calculate-discount-value');

    Route::get('/reduction-sur-les-produit', [MarketingController::class, 'indexReductionSurLesProduit'])->name('marketing.reduction-sur-les-produit');
    Route::get('/enregistrer-reduction-sur-les-produit', [MarketingController::class, 'createReductionSurLesProduit'])->name('marketing.create-reduction-sur-les-produit');
    Route::post('/store-reduction-sur-les-produit', [MarketingController::class, 'storeRecductionProduit'])->name('marketing.store-reduction-sur-les-produit');
    Route::post('/update-reduction-sur-les-produit/{id}', [MarketingController::class, 'updateRecductionProduit'])->name('marketing.update-reduction-sur-les-produit');
    Route::get('/delete-reduction-sur-les-produit/{id}', [MarketingController::class, 'deleteRecductionProduit'])->name('marketing.delete-reduction-sur-les-produit');

    //PANIER MOYEN
    Route::get('/reduction-sur-le-panier-moyen', [MarketingController::class, 'indexReductionSurLePanierMoyen'])->name('marketing.reduction-sur-le-panier-moyen');
    Route::get('/enregistrer-reduction-sur-le-panier-moyen', [MarketingController::class, 'createReductionSurLepanierMoyen'])->name('marketing.create-reduction-sur-le-panier-moyen');
    Route::post('/store-reduction-sur-le-panier-moyen', [MarketingController::class, 'storeRecductionPanierMoyen'])->name('marketing.store-reduction-sur-le-panier-moyen');
    Route::post('/update-reduction-sur-le-panier-moyen/{id}', [MarketingController::class, 'updateRecductionPanierMoyen'])->name('marketing.update-reduction-sur-le-panier-moyen');
    Route::get('/delete-reduction-sur-le-panier-moyen/{id}', [MarketingController::class, 'deleteRecductionPanierMoyen'])->name('delete-reduction-sur-le-panier-moyen');

    Route::get('/acheter-x-obtenir-y', [MarketingController::class, 'indexAchterObtenir'])->name('marketing.acheter-obtenir');
    Route::get('/enregistrer-reduction-acheter-obtenir', [MarketingController::class, 'createReductionAcheterObtenir'])->name('marketing.create-reduction-acheter-obtenir');

    Route::get('/livraison-gratuite', [MarketingController::class, 'indexLivraisonGratuite'])->name('marketing.livraison-gratuite');
    Route::get('/enregistrer-livraison-gratuite', [MarketingController::class, 'createLivraisonGratuite'])->name('marketing.create-livraison-gratuite');

    Route::get('/reconquete-client', [MarketingController::class, 'indexReconqueteClient'])->name('marketing.reconquete-client');
    Route::get('/enregistrer-reconquete-client', [MarketingController::class, 'createReconqueteClient'])->name('marketing.create-reconquete-client');

    Route::get('/panier-abandonne', [MarketingController::class, 'indexPanierAbandonne'])->name('marketing.panier-abandonne');
    Route::get('/enregistrer-panier-abandonne', [MarketingController::class, 'createPanierAbandonne'])->name('marketing.create-panier-abandonne');
});

Route::get('/', [UserController::class, 'showlogin']);
Route::get('/login', [UserController::class, 'showlogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('logins');

Route::get('/register', [UserController::class, 'showregister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('registers');

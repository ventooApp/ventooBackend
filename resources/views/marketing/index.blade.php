@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

<div class="row tb-content-marketing">

    <div class="col-xl-12">
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
        </div>
        <div class="col-md-6" style="text-align:right">
            <a href="{{ route('commande.create') }}" class="btn btn-dark waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span>Ajouter une commande
            </a>
        </div>
    </div>
        <div class="nav-align-top nav-tabs-shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Réductions et Automatisations
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                        tabindex="-1">Campagnes en cours</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false"
                        tabindex="-1">Parrainage</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <div class="all-content-home-marketing">
                        <div class="card mb-5">
                            <div class="container mt-3 mb-3 content-markt-all">
                                <h6>Coupons et réductions</h6>
                                <div class="row">
                                    <div class="col-md-6 content-markt divider-left">
                                        <a href="{{ route('marketing.reduction-sur-les-produit') }}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-discount ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Réduction sur les produits</h6>
                                                    <p class="card-text">Rémise sur les produits</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 content-markt">
                                        <a href="{{ route('marketing.reduction-sur-le-panier-moyen')}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-plus ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Réduction sur le panier moyen</h6>
                                                    <p class="card-text">Rémise sur le montant total des achats</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="row divider-home-mark">
                                    <div class="col-md-6 content-markt divider-left">
                                        <a href="{{ route('marketing.acheter-obtenir')}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-gift ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Acheter X obtenir Y</h6>
                                                    <p class="card-text">Recevoir un produit en plus</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 content-markt">
                                        <a href="{{ route('marketing.livraison-gratuite')}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-truck-delivery ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Livraison gratuite</h6>
                                                    <p class="card-text">Réduction sur les frais d'expédition</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card mb-5">
                            <div class="container mt-3 mb-3 content-markt-all">
                                <h6>Automatisations</h6>
                                <div class="row">
                                    <div class="col-md-6 content-markt divider-left">
                                        <a href="{{ route('marketing.reconquete-client')}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-user-heart ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Reconquête client</h6>
                                                    <p class="card-text">Renouez avec vos clients inactif et sans <br> commande avec une
                                                        remise unique</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 content-markt">
                                        <a href="{{ route('marketing.panier-abandonne')}}">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-x ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Panier abandonné</h6>
                                                    <p class="card-text">Ramener vos clients à finaliser leurs achats <br>avec une relance
                                                        ou une remise spéciale</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important;">
                        <div class="table table-striped">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date de début</th>
                                        <th>Date de fin</th>
                                        <th>Catégories</th>
                                        <th>Produits</th>
                                        <th>Reductions</th>
                                        <th>Statuts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>qsdfg</td>
                                        <td>fdsd</td>
                                        <td>reg ef</td>
                                        <td>sdffdg</td>
                                        <td>fg</td>
                                        <td>fg</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="" class="text-body">
                                                    <i class="ti ti-eye ti-sm me-2"></i>
                                                </a>

                                                <a href="" class="text-body">
                                                    <i class="ti ti-edit ti-sm me-2"></i>
                                                </a>
                                                <a href="" class="delete-link text-body delete-record">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">   
                    <div class="all-content-home-marketings mt-3">
                        <div class="card mb-5">
                            <div class="container mt-3 mb-3 content-markt-all">
                                <div class="row">
                                    <div class="col-md-4 content-markt">
                                        <a href="">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-discount ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Réduction sur les produits</h6>
                                                    <p class="card-text">Rémise sur les produits</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 content-markt">
                                        <a href="">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-plus ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Réduction sur le panier moyen</h6>
                                                    <p class="card-text">Rémise sur le montant total des achats</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 content-markt">
                                        <a href="">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <div class="badge bg-label-warning roundeds p-3"><i style="color: #313131"
                                                            class="ti ti-shopping-cart-plus ti-xl"></i></div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">Réduction sur le panier moyen</h6>
                                                    <p class="card-text">Rémise sur le montant total des achats</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 content-marktts">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h6>Invitez une personne par SMS et WhatsApp</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                aria-label="Dollar amount (with dot and two decimal places)">
                                            <span class="input-group-text"><i style="color: #fff;background: #313131; padding: 4px;"
                                                    class="ti ti-brand-telegram ti-sm"></i></span>
                                            <span class="input-group-text"><i style="color: #fff;background: #313131; padding: 4px;"
                                                    class="ti ti-brand-whatsapp ti-sm"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 content-marktqs">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h6>Invitez une personne via votre lien de parrainage</h6>
                                    </div>
                                    <div class="card-body clipboard-ui">
                                        <input style="height: 42px;" class="form-control mb-1" id="clipboard-example" type="text"
                                            value="Copy Me!" readonly />
                                        <button class="clipboard-btn" data-clipboard-action="copy"
                                            data-clipboard-target="#clipboard-example">
                                            Copiez le lien
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                    {{-- <div class="card mt-3" style="box-shadow: none !important;">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Dates</th>
                                        <th>Boutique</th>
                                        <th>Statuts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>sdffdg</td>
                                        <td>fg</td>
                                        <td>fg</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="" class="text-body">
                                                    <i class="ti ti-eye ti-sm me-2"></i>
                                                </a>

                                                <a href="" class="text-body">
                                                    <i class="ti ti-edit ti-sm me-2"></i>
                                                </a>
                                                <a href="" class="delete-link text-body delete-record">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <!-- Bootstrap Table with Header - Light -->
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')

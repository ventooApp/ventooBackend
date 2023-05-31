@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


<div class="row">
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
        </div>
        <div class="col-md-6" style="text-align:right">
            <div class="btn-group me-3 dropdown-toggle_btn">
                <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Cette semaine
                </button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item" href="{{ route('commande.index') }}">Tout temps</a></li>
                    <li><a class="dropdown-item" href="{{ route('commande.cettesemaine') }}">Cette semaine</a></li>
                    <li><a class="dropdown-item" href="{{ route('commande.semainepasse') }}">Semaine passée</a></li>
                    <li><a class="dropdown-item" href="{{ route('commande.cemois') }}">Ce mois</a></li>
                    <li><a class="dropdown-item" href="{{ route('commande.lemoisdernier') }}">Le mois dernier</a></li>
                    <li><a class="dropdown-item" href="{{ route('commande.today') }}">Aujourd'hui</a></li>
                </ul>
            </div>
            <a href="{{ route('commande.create') }}" class="btn btn-dark waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span>Ajouter une commande
            </a>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Toutes les commandes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                        tabindex="-1">
                        En attentes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false"
                        tabindex="-1">
                        Commande validées
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-en-cours-de-livraison" aria-controls="navs-top-en-cours-de-livraison"
                        aria-selected="false" tabindex="-1">
                        En cours de livraison
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-livree" aria-controls="navs-top-livree" aria-selected="false"
                        tabindex="-1">
                        Livrées
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-annulee" aria-controls="navs-top-annulee" aria-selected="false"
                        tabindex="-1">
                        Annulées
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-abandonnee" aria-controls="navs-top-abandonnee" aria-selected="false"
                        tabindex="-1">
                        Abandonnées
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandes->isNotEmpty())
                                        @foreach ($commandes as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '1' || $item->status == '4')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                        @endif
                                                        @if ($item->status == '2')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.livre', ['id' => $item->id]) }}" class="text-body">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                    <path d="M9 12l2 2l4 -4"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="javascript:;" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                        @if ($item->status == '5')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.valide', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                                    <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                                                    <path d="M3 9l4 0"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('commande.valide-delete', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                        @if ($item->status == '3')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.en-cours', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                        @if ($item->status == '6')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="javascript:;" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                        
                                                                
                                                            
                                                            
                                                             
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeEnAttentes->isNotEmpty())
                                        @foreach ($commandeEnAttentes as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        
                                                        @if ($item->status == '2')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.livre', ['id' => $item->id]) }}" class="text-body">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                    <path d="M9 12l2 2l4 -4"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="javascript:;" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeValides->isNotEmpty())
                                        @foreach ($commandeValides as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '5')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.valide', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                                    <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                                                    <path d="M3 9l4 0"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('commande.valide-delete', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-en-cours-de-livraison" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeEnCours->isNotEmpty())
                                        @foreach ($commandeEnCours as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '3')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.en-cours', ['id' => $item->id]) }}" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-livree" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeLivres->isNotEmpty())
                                        @foreach ($commandeLivres as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '1' || $item->status == '4')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-annulee" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeAnnules->isNotEmpty())
                                        @foreach ($commandeAnnules as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '1' || $item->status == '4')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                        @endif
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-abandonnee" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Statuts</th>
                                        <th>Téléphones</th>
                                        <th>Total</th>
                                        <th>Date de commande</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($commandeAbandonnees->isNotEmpty())
                                        @foreach ($commandeAbandonnees as $key => $item)
                                            <div class="modal fade" id="id{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Les produits commandé</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="p-0 m-0">
                                                                @foreach ($item->commandeproduits as $commandeproduit)
                                                                    <li class="d-flex mb-4 pb-1">
                                                                        <div class="me-3">
                                                                            @foreach (explode(';', $commandeproduit->produit->image) as $index => $imageName)
                                                                                @if ($index == 0)
                                                                                    <img src="{{ asset('produit-images/' . $imageName) }}" class="rounded" width="46">
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                        </div> <br>
                                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                            <div class="me-2">
                                                                                <h6 class="mb-0">{{ $commandeproduit->libelle }}</h6>
                                                                                <small class="text-muted d-block">Quantité(s): {{ $commandeproduit->quantite }}</small>
                                                                            </div>
                                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                                <p class="mb-0 fw-semibold">{{ number_format($commandeproduit->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->no_commande }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill
                                                    @php
                                                    if ($item->status == '1') {
                                                        echo 'bg-label-success';
                                                        $status = 'Livré';
                                                      }elseif ($item->status == '2') {
                                                        echo 'bg-label-warning';
                                                        $status = 'En attente';
                                                      }elseif ($item->status == '3') {
                                                        echo 'bg-label-primary';
                                                        $status = 'En cours';
                                                      }elseif ($item->status == '4') {
                                                        echo 'bg-label-danger';
                                                        $status = 'Annulée';
                                                      }elseif ($item->status == '5') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Validée';
                                                        } elseif ($item->status == '6') {
                                                        echo 'bg-label-secondary';
                                                        $status = 'Abandonnée';
                                                        } 
                                                    @endphp
                                                    ">
                                                        {{ $status }}
                                                    </span>

                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                <td> {{ $item->created_at }} </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->status == '6')
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}" class="text-body">
                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                            </a>
                                                            <a href="{{ route('commande.edit', ['id' => $item->id]) }}" class="text-body">
                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                            </a>
                                                            <a href="javascript:;" class="text-body delete-record">
                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

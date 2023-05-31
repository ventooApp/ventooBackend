@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

@if(session()->has("message"))
<div class="alert {{session()->get('type')}}">{{ session()->get('message') }}</div>
@endif
<div class="row">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
        </div>
        <div class="col-md-6" style="text-align:right">
            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#import" class="me-3">Importer des clients</a>
            <button type="button" class="btn btn-dark waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalCenter">
                <span class="ti-xs ti ti-plus me-1"></span>Ajouter un client
            </button>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Tous les clients
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                        tabindex="-1">
                        Nouveaux clients
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false"
                        tabindex="-1">
                        Clients actifs
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-inactif" aria-controls="navs-top-inactif" aria-selected="false"
                        tabindex="-1">
                        Clients inactifs
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
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Téléphones</th>
                                        <th>Commande</th>
                                        <th>Source</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($clientAlls->isNotEmpty())
                                        @foreach ($clientAlls as $key => $item)
                                            @php
                                                $phrase = $item->name;
                                                $mot = strtok($phrase, " ");
                                                $initial = strtoupper(substr($mot, 0, 1));

                                                $color = ["primary", "secondary", "success", "danger", "warning", "info"];
                                                shuffle($color);
                                            @endphp     
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-flex w-100 flex-wrap align-items-center gap-2">
                                                    <div class="avatar avatar-sm me-2">
                                                        <span class="avatar-initial rounded-circle bg-{{ $color[0] }}">{{ $initial }}</span>
                                                    </div>
                                                    <div>{{ $item->name }}</div>
                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ $item->nombre_commandes }}</td>
                                                <td> {{ $item->canalachat_libelle }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('clients.details', ['id' => $item->id]) }}" class="text-body">
                                                            <i class="ti ti-eye ti-sm me-2"></i>
                                                        </a>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input toggle-client-actif" type="checkbox" id="flexSwitchCheckChecked" data-client-id="{{ $item->id }}" {{ $item->client_actif == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
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
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Téléphones</th>
                                        <th>Commande</th>
                                        <th>Source</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($clientNews->isNotEmpty())
                                        @foreach ($clientNews as $key => $item)
                                            @php
                                                $phrase = $item->name;
                                                $mot = strtok($phrase, " ");
                                                $initial = strtoupper(substr($mot, 0, 1));

                                                $color = ["primary", "secondary", "success", "danger", "warning", "info"];
                                                shuffle($color);
                                            @endphp     
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-flex w-100 flex-wrap align-items-center gap-2">
                                                    <div class="avatar avatar-sm me-2">
                                                        <span class="avatar-initial rounded-circle bg-{{ $color[0] }}">{{ $initial }}</span>
                                                    </div>
                                                    <div>{{ $item->name }}</div>
                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ $item->nombre_commandes }}</td>
                                                <td> {{ $item->canalachat_libelle }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('clients.details', ['id' => $item->id]) }}" class="text-body">
                                                            <i class="ti ti-eye ti-sm me-2"></i>
                                                        </a>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input toggle-client-actif" type="checkbox" id="flexSwitchCheckChecked" data-client-id="{{ $item->id }}" {{ $item->client_actif == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
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
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Téléphones</th>
                                        <th>Commande</th>
                                        <th>Source</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($clientActifs->isNotEmpty())
                                        @foreach ($clientActifs as $key => $item)
                                            @php
                                                $phrase = $item->name;
                                                $mot = strtok($phrase, " ");
                                                $initial = strtoupper(substr($mot, 0, 1));

                                                $color = ["primary", "secondary", "success", "danger", "warning", "info"];
                                                shuffle($color);
                                            @endphp     
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-flex w-100 flex-wrap align-items-center gap-2">
                                                    <div class="avatar avatar-sm me-2">
                                                        <span class="avatar-initial rounded-circle bg-{{ $color[0] }}">{{ $initial }}</span>
                                                    </div>
                                                    <div>{{ $item->name }}</div>
                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ $item->nombre_commandes }}</td>
                                                <td> {{ $item->canalachat_libelle }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('clients.details', ['id' => $item->id]) }}" class="text-body">
                                                            <i class="ti ti-eye ti-sm me-2"></i>
                                                        </a>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input toggle-client-actif" type="checkbox" id="flexSwitchCheckChecked" data-client-id="{{ $item->id }}" {{ $item->client_actif == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-inactif" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none !important">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Noms</th>
                                        <th>Téléphones</th>
                                        <th>Commande</th>
                                        <th>Source</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if ($clientInactifs->isNotEmpty())
                                        @foreach ($clientInactifs as $key => $item)
                                            @php
                                                $phrase = $item->name;
                                                $mot = strtok($phrase, " ");
                                                $initial = strtoupper(substr($mot, 0, 1));

                                                $color = ["primary", "secondary", "success", "danger", "warning", "info"];
                                                shuffle($color);
                                            @endphp     
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-flex w-100 flex-wrap align-items-center gap-2">
                                                    <div class="avatar avatar-sm me-2">
                                                        <span class="avatar-initial rounded-circle bg-{{ $color[0] }}">{{ $initial }}</span>
                                                    </div>
                                                    <div>{{ $item->name }}</div>
                                                </td>
                                                <td> {{ $item->mobile }} </td>
                                                <td>{{ $item->nombre_commandes }}</td>
                                                <td> {{ $item->canalachat_libelle }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('clients.details', ['id' => $item->id]) }}" class="text-body">
                                                            <i class="ti ti-eye ti-sm me-2"></i>
                                                        </a>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input toggle-client-actif" type="checkbox" id="flexSwitchCheckChecked" data-client-id="{{ $item->id }}" {{ $item->client_actif == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
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


<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form  action="{{ route('client.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Ajouter un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Nom complet" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="mobile" class="form-label">Numéro de téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text">CI (+225)</span>
                                <input name="mobile" type="text" id="mobile" class="form-control phone-number-mask">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Adresse E-mail (Optionel)</label>
                            <input type="text" name="email" class="form-control" placeholder="john@ventoo.io" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Adresse de livraison</label>
                            <input type="text" name="adresse" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Fermé
                    </button>
                    <button class="btn btn-dark">Ajouter le client</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- import -->
<div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form  action="{{ route('client.store-csv') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Ajouter les clients par CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Assurez-vous que les clients clients que vous allez enregistrer ont << Accepter le marketing par E-mail et par SMS>>
                    </p>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="csv" class="form-label">Ajouter un fichier CSV</label>
                            <input type="file" name="csv" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Fermé
                    </button>
                    <button class="btn btn-dark">Ajouter le client</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

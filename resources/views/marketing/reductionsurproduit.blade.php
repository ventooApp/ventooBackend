@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

@if(session()->has("message"))
    <div class="alert {{session()->get('type')}}">{{ session()->get('message') }}</div>
@endif
<div class="row mb-3">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-1">
                <button class="btn btn-outline-dark" onclick="history.back()" style="padding: 2px 4px !important;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l14 0"></path>
                        <path d="M5 12l4 4"></path>
                        <path d="M5 12l4 -4"></path>
                    </svg>
                </button>
            </div>
            <div class="col-md-11 mt-1">
                <h6 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-5" style="text-align:right">
        <div class="row">
            <div class="col-md-5" style="text-align:right">
                <form action="{{ route('marketing.reduction-sur-les-produit') }}" method="GET">
                    <div class="input-group">
                        @php
                            $selected_date_filter = null;
                        @endphp
                        <select class="form-control" name="date_filter" onchange="this.form.submit()">
                            <option value="" disabled selected>Filtrer par date</option>
                            <option value="all" @if($selected_date_filter == 'all') selected @endif>All</option>
                            <option value="today" @if($selected_date_filter == 'today') selected @endif>Aujourd'hui</option>
                            <option value="this_week" @if($selected_date_filter == 'this_week') selected @endif>Cette semaine</option>
                            <option value="last_week" @if($selected_date_filter == 'last_week') selected @endif>Semaine dernière</option>
                            <option value="this_month" @if($selected_date_filter == 'this_month') selected @endif>Ce mois-ci</option>
                            <option value="last_month" @if($selected_date_filter == 'last_month') selected @endif>Mois dernier</option>
                        </select>
                    </div>
                </form>
                
            </div>
            <div class="col-md-7">
                <a href="{{ route('marketing.create-reduction-sur-les-produit') }}" class="btn btn-dark waves-effect waves-light">
                    <span class="ti-xs ti ti-plus me-1"></span>Créer une promotion
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Table with Header - Light -->
<div class="card" style="box-shadow: none !important;">
    <div class="table table-striped">
        <table class="table" id="product-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nom de la campagne</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Catégories</th>
                    <th>Produits</th>
                    <th>Réductions</th>
                    <th>Statuts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if ($reductionSurLesProduits->isNotEmpty())
                    @foreach ($reductionSurLesProduits as $key => $reductionSurLesProduit)
                    <!-- Modal -->
                    <div class="modal fade" id="id{{ $reductionSurLesProduit->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="background: #fff">
                            <div class="modal-content">
                                <form  action="{{ route('marketing.update-reduction-sur-les-produit', ['id' => $reductionSurLesProduit->id]) }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Modifier la campagne</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="libelle" class="form-label">Nom de la promotion</label>
                                            <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $reductionSurLesProduit->libelle }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="date_debut" class="form-label">Date de début</label>
                                                    <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $reductionSurLesProduit->date_debut }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="date_fin" class="form-label">Date de fin</label>
                                                    <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $reductionSurLesProduit->date_fin }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="categorie" class="form-label">Catégorie</label>
                                            <select class="form-select" name="category_id" id="category">
                                                <option selected="">Selectionnez une catégorie</option>
                                                @foreach ($categorieproduits as $categorieproduit)
                                                    <option value="{{ $categorieproduit->id }}"  {{ $reductionSurLesProduit->categorieproduit->id == $categorieproduit->id ? 'selected' : '' }}>{{ $categorieproduit->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="produits" class="form-label">Produits</label>
                                            <select name="product_id" id="product" class="form-control">
                                                @foreach ($produits as $produit)
                                                    @if ($reductionSurLesProduit->produit->id == $produit->id)
                                                        <option value="{{ $produit->id }}" {{ $reductionSurLesProduit->produit->id == $produit->id ? 'selected' : '' }}>{{ $produit->libelle }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            {{-- <select class="form-select" id="produits" name="produits" id="produits">
                                                <option selected="">Selectionnez le(s) produit(s)</option>
                                                @foreach ($produits as $produit)
                                                    <option value="{{ $produit->id }}">{{ $produit->libelle }}</option>
                                                @endforeach
                                            </select> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="zone" class="form-label">Zone</label>
                                            <select class="form-select" id="zone" name="zone" id="zone">
                                                <option selected="">Selectionnez la zone</option>
                                                @foreach ($zones as $zone)
                                                    <option value="{{ $zone->id }}" {{ $reductionSurLesProduit->zone->id == $zone->id ? 'selected' : '' }}>{{ $zone->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pourcentagereduction" class="form-label">Prix du produit</label>
                                            <input type="number" name="price" id="price" class="form-control" readonly value="{{ $reductionSurLesProduit->price }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="percentage" class="form-label">Pourcentage de la réduction</label>
                                            <input type="text" class="form-control" id="percentage" name="percentage" value="{{ $reductionSurLesProduit->pourcentage }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="discount_value" class="form-label">Montant de la réduction</label>
                                            <input type="text" class="form-control" id="discount_value" name="discount_value" readonly value="{{ $reductionSurLesProduit->valeur_pourcentage }}">
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
                        @php
                            $date1 = \Carbon\Carbon::parse($reductionSurLesProduit->date_debut);
                            $formatted_date1 = $date1->locale('fr_FR')->isoFormat('LL');
                            $date2 = \Carbon\Carbon::parse($reductionSurLesProduit->date_fin);
                            $formatted_date2 = $date2->locale('fr_FR')->isoFormat('LL');
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reductionSurLesProduit->libelle }}</td>
                            <td>{{ $formatted_date1 }}</td>
                            <td>{{ $formatted_date2 }}</td>
                            <td>{{ $reductionSurLesProduit->categorieproduit->libelle }}</td>
                            <td>{{ $reductionSurLesProduit->produit->libelle }}</td>
                            <td>{{ $reductionSurLesProduit->pourcentage }} %</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="flexSwitchCheckChecked"
                                        {{ $reductionSurLesProduit->status == 1 ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#id{{ $reductionSurLesProduit->id }}" class="text-body">
                                        <i class="ti ti-edit ti-sm me-2"></i>
                                    </a>
                                    <a href="{{ route('marketing.delete-reduction-sur-les-produit', ['id' => $reductionSurLesProduit->id]) }}" class="delete-link text-body delete-record">
                                        <i class="ti ti-trash ti-sm mx-2"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>Pas de campgne pour le moment...</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap Table with Header - Light -->

@include('layouts.footer')

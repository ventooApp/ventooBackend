@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

@if(session()->has("message"))
    <div class="alert {{session()->get('type')}}">{{ session()->get('message') }}</div>
@endif

<form action="{{ route('marketing.store-reduction-sur-le-panier-moyen') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-1">
                    <button class="btn btn-outline-dark" onclick="history.back()" style="padding: 2px 4px !important;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-dark waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span>Lancer la réduction
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Form controls -->
        <div class="col-md-8">
            <div class="card mb-4" style="box-shadow: none !important;">
                <h5 class="card-header">Détails de la campagne</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Nom de la promotion</label>
                        <input type="text" class="form-control" id="libelle" name="libelle">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_debut" class="form-label">Date de début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_fin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="date_fin" name="date_fin">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zone" class="form-label">Zone</label>
                        <select class="form-select" id="zone" name="zone" id="zone">
                            <option selected="">Selectionnez la zone</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4" style="box-shadow: none !important;">
                <h5 class="card-header">Réduction</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="seuil" class="form-label">Montant à atteindre</label>
                        <input type="text" class="form-control" id="seuil" name="seuil">
                    </div>
                    <div class="mb-3">
                        <label for="percentage" class="form-label">Pourcentage de la réduction</label>
                        <input type="text" class="form-control" id="percentage" name="percentage">
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

@include('layouts.footer')

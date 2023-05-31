@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


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
        <a href="" class="btn btn-dark waves-effect waves-light">
            <span class="ti-xs ti ti-plus me-1"></span>Lancer la réduction
        </a>
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
                            <input type="text" class="form-control" id="date_debut" name="date_debut">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="text" class="form-control" id="date_fin" name="date_fin">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="zone" class="form-label">Zone</label>
                    <select class="form-select" id="zone" name="zone" id="zone">
                        <option selected="">Selectionnez la zone</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                    <label for="pourcentagereduction" class="form-label">Produit acheté</label>
                    <input type="text" class="form-control" id="pourcentagereduction" name="pourcentagereduction">
                </div>
                <div class="mb-3">
                    <label for="montantreduction" class="form-label">Produit offert</label>
                    <input type="text" class="form-control" id="montantreduction" name="montantreduction">
                </div>
            </div>
        </div>
    </div>

</div>

@include('layouts.footer')

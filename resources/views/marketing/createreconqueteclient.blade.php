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
            Lancer la canpagne
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
                    <label for="client_inactif" class="form-label">Clients inactifs</label>
                    <select class="form-select" id="client_inactif" name="client_inactif" id="client_inactif">
                        <option selected="">Selectionnez les clients inactif</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="code_promotionnel" class="form-label">Code promotionnel</label>
                    <select class="form-select" id="code_promotionnel" name="code_promotionnel" id="code_promotionnel">
                        <option selected="">Selectionnez le produit</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="valeur_code" class="form-label">Valeur du code en FCFA</label>
                    <input type="text" class="form-control" id="valeur_code" name="valeur_code">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>

</div>

@include('layouts.footer')

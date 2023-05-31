@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


<div class="row mb-3">
    <div class="col-md-6">
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
    <div class="col-md-6" style="text-align:right">
        <div class="btn-group me-3 dropdown-toggle_btn">
            <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect"
                data-bs-toggle="dropdown" aria-expanded="false">
                Tout 
            </button>
            <ul class="dropdown-menu" style="">
                <li><a class="dropdown-item" href="{{ route('commande.index') }}">Tout</a></li>
                <li><a class="dropdown-item" href="{{ route('commande.cettesemaine') }}">Cette semaine</a></li>
                <li><a class="dropdown-item" href="{{ route('commande.semainepasse') }}">Semaine passée</a></li>
                <li><a class="dropdown-item" href="{{ route('commande.cemois') }}">Ce mois</a></li>
                <li><a class="dropdown-item" href="{{ route('commande.lemoisdernier') }}">Le mois dernier</a></li>
                <li><a class="dropdown-item" href="{{ route('commande.today') }}">Aujourd'hui</a></li>
            </ul>
        </div>
        <a href="{{ route('marketing.create-reduction-acheter-obtenir') }}" class="btn btn-dark waves-effect waves-light">
            <span class="ti-xs ti ti-plus me-1"></span>Créer une promotion
        </a>
    </div>
</div>

<!-- Bootstrap Table with Header - Light -->
<div class="card" style="box-shadow: none !important;">
    <div class="table table-striped">
        <table class="table">
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
                <tr>
                    <td>1</td>
                    <td>qsdfg</td>
                    <td>fdsd</td>
                    <td>reg ef</td>
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

@include('layouts.footer')

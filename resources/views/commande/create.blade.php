@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

@if (session()->has('message'))
<div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
@endif

<form action="{{ route('commande.store') }}" method="post" class="content-form-produit">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
                </div>
                <div class="col-md-6" style="text-align:right">
                    <button class="btn btn-dark waves-effect waves-light">
                        Enregistrer la commande
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="client" class="form-label">Sélectionnez un client</label>
                        <select name="client" id="client" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="canal" class="form-label">Choisissez le canal d'achat</label>
                        <select name="canal" id="canal" class="form-control">
                            @foreach ($canalachats as $canalachat)
                                <option value="{{ $canalachat->id }}">{{ $canalachat->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="mb-4">
                                <label for="selectpickerMultiple" class="form-label">Selectionnez le(s) produit(s)</label>
                                <select name="produits[]" id="selectpickerMultiple" class="selectpicker w-100" data-style="btn-default"
                                    multiple data-icon-base="ti" data-tick-icon="ti-check text-white"
                                    data-live-search="true">
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->libelle }} - {{ number_format($produit->price , 2, ',', ' ') }} {{ $devise->devise }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button"
                                class="btn rounded-pill btn-icon btn-outline-primary mt-4 waves-effect">
                                <span class="tf-icons ti ti-plus"></span>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-11">
                                <label for="quantites" class="form-label">Quantités (Selectionnez la quantité dans l'ordre
                                    d'ajout du produit)</label>
                                <input required type="number" id="quantites" class="form-control" name="quantites[]" />
                                <div id="inputs"></div>
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                    class="btn rounded-pill btn-icon btn-outline-primary mt-4 waves-effect">
                                    <span class="tf-icons ti ti-plus add-input"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="flatpickr-datetime" class="form-label">Statut de la commande</label>
                        <select name="status" class="form-control">
                            <option value="1">Livrée</option>
                            <option value="2">En attente</option>
                            <option value="3">En cour</option>
                        </select>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse de livraison</label>
                        <input type="text" class="form-control" id="adresse" name="adresse">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const addInput = document.querySelector('.add-input');
    const inputsContainer = document.querySelector('#inputs');

    addInput.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'number';
        input.className = 'form-control mt-3';
        input.name = 'quantites[]';
        inputsContainer.appendChild(input);
    });

</script>

@include('layouts.footer')

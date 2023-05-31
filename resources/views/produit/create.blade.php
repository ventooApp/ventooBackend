@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


<div class="content-img-drop mb-3">
    <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <form method="post" action="{{ route('produitStore') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div>
                                    <div class="custom-file-upload">
                                      <input type="file" id="images" name="image[]" multiple>
                                      <label for="file-input">
                                        <i class="fas fa-upload"></i>
                                      </label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-10">
                                <div id="preview"></div>
                            </div>
                        </div>
                        <div class="mb-3  mt-200">
                            <label for="libelle" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" id="libelle" name="libelle">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix du produit</label>
                            <input class="form-control" type="number" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="select2Basic" class="form-label">Sélectionnez la catégorie du produit</label>
                            <select name="categorie" id="select2Basic" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
                                @foreach ($categorieproduits as $categorieproduit)
                                    <option value="{{ $categorieproduit->id }}">{{ $categorieproduit->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="qte" class="form-label">Quantités</label>
                            <input type="number" class="form-control" id="qte" name="qte">
                        </div>
                        <div class="mb-3">
                            <label for="active" class="form-label">Visibilitez du produit</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="active" name="active"
                                    checked="">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark mb-4"> Entregistrer le produit </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@include('layouts.footer')

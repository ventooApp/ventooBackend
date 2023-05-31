@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

<div class="col-6">
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{ route('categorieproduit.update', ['id' => $categorieproduit->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div>
                            <div class="custom-file-upload">
                              <input type="file" id="images" name="image">
                              <label for="file-input">
                                <i class="fas fa-upload"></i>
                              </label>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div id="preview"></div>
                        @if ($categorieproduit->image)
                            <div class="images">
                                <img src="{{ asset('categorie-produit-images/' . $categorieproduit->image) }}" alt="Avatar" class="rounded_circle" />
                            </div>
                        @endif
                    </div>
                </div>
                  
                <div class="content-form-categorie mt-3">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Nom de la catégorie</label>
                        <input class="form-control" type="text" id="libelle" name="libelle" value="{{ $categorieproduit->libelle }}">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark">Ajouter la catégorie</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
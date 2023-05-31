@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


<div class="content-img-drop mb-3">
    <button class="btn btn-outline-dark mb-3" onclick="history.back()" style="padding: 2px 4px !important;">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l14 0"></path>
            <path d="M5 12l4 4"></path>
            <path d="M5 12l4 -4"></path>
         </svg>
    </button>
    <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <form method="post" action="{{ route('produit.update', ['id' => $produit->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <div class="custom-file-upload">
                                      <input type="file" id="images" name="image[]" multiple>
                                      <label for="file-input">
                                        <i class="fas fa-upload"></i>
                                      </label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-9">
                                <div id="preview"></div>
                                @if ($produit->image)
                                    <div class="images-avatar">
                                            @foreach (explode(';', $produit->image) as $key=> $imageName)
                                              <div class="position-a-truch">
                                                <img src="{{ asset('produit-images/' . $imageName) }}"
                                                        alt="Avatar"
                                                        class="avatar" />
                                                        <a  href="{{ route('produits.images.delete', ['productId' => $produit->id, 'imageName' => $imageName]) }}"
                                                            onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')"
                                                            class="delete-image-link">
                                                            <i class="ti ti-trash ti-sm mx-2"></i>
                                                        </a>
                                              </div>
                                            @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3  mt-200" style="margin-top: 10px">
                            <label for="libelle" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" value="{{$produit->libelle}}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix du produit</label>
                            <input class="form-control" type="number" id="price" name="price" value="{{$produit->price}}">
                        </div>
                        <div class="mb-3">
                            <label for="select2Basic" class="form-label">Sélectionnez la catégorie du produit</label>
                            <select name="categorie" id="select2Basic" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
                                @foreach ($categorieproduits as $categorieproduit)
                                    <option value="{{ $categorieproduit->id }}" {{ $categorieproduit->id ==  $produit->categorieproduit_id ? 'selected' : ''}}>{{ $categorieproduit->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{!!html_entity_decode($produit->description)!!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="qte" class="form-label">Quantités</label>
                            <input type="number" class="form-control" id="qte" name="qte" value="{{$produit->qte}}">
                        </div>
                        <div class="mb-3">
                            <label for="active" class="form-label">Visibilitez du produit</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-produit" type="checkbox" id="flexSwitchCheckChecked" name="active" data-produit-id="{{ $produit->id }}"
                                {{$produit->status == 1 ? 'checked' : ''}}>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark mb-4"> Modifier le produit </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



@include('layouts.footer')

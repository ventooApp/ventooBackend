@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')
<button class="btn btn-outline-dark mb-3" onclick="history.back()" style="padding: 2px 4px !important;">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M5 12l14 0"></path>
      <path d="M5 12l4 4"></path>
      <path d="M5 12l4 -4"></path>
   </svg>
</button>
    <div class="row">
        <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
        <div class="col-xl-8 col-md-6 mb-2 show-produit">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="mb-0">Image(s) du produit</h6>
                @if ($produit->image)
                    <div class="images-avatar mt-3">
                            @foreach (explode(';', $produit->image) as $key=> $imageName)
                                <div class="position-a-truch">
                                <img src="{{ asset('produit-images/' . $imageName) }}"
                                        alt="Avatar"
                                        class="avatar" />
                                        {{-- <a  href="{{ route('produits.images.delete', ['productId' => $produit->id, 'imageName' => $imageName]) }}"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')"
                                            class="delete-image-link">
                                            <i class="ti ti-trash ti-sm mx-2"></i>
                                        </a> --}}
                                </div>
                            @endforeach
                    </div>
                @endif
                <hr class="mt-3">
                <ul class="p-0 m-0 mt-3">
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-success roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                         </svg>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Quantités</h6>
                      <div class="d-flex">
                        <p class="mb-0 ">{{ $produit->qte }} en stock</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-info roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 4h6v6h-6z"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                         </svg>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Catégories</h6>
                      <div class="d-flex">
                        <p class="mb-0 ">{{ $produit->categorieproduit->libelle }}</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-warning roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                         </svg>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Nombres de vue du produit</h6>
                      <div class="d-flex">
                        <p class="mb-0 ">967 vue(s)</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-primary roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                            <path d="M19 16v6"></path>
                            <path d="M22 19l-3 3l-3 -3"></path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                         </svg>    
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Date d'ajout</h6>
                      <div class="d-flex">
                        <p class="mb-0 ">{{ $created_at }}</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-secondary roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                            <path d="M9 7l6 0"></path>
                            <path d="M9 11l6 0"></path>
                            <path d="M9 15l4 0"></path>
                         </svg>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Description</h6>
                      
                    </div>
                  </li>
                  <p class="mb-0 ">
                    {!!html_entity_decode($produit->description)!!}
                </p>
                </ul>
              </div>
            </div>
          </div>
        <div class="col-xl-4 col-md-12 mb-2 show-produit">
            <div class="card ">
              <div class="card-body">
                <h6 class="mb-0" style="font-weight: bold; color:black">{{ $produit->libelle }}</h6>
                <ul class="p-0 m-0 mt-3">
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-success roundeds p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                         </svg>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">{{ url('produit/'.$produit->id) }}</h6>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                      <div class="badge bg-label-info roundeds p-2">
                            <a href="{{ route('produit.edit', ['id' => $produit->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                             </svg>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                          <a href="{{ route('produit.edit', ['id' => $produit->id]) }}" class="mb-0 ms-3 font-wight-light">Modifié le produit</a>
                        </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-warning roundeds p-2">
                        <a  href="{{ route('produit.destroy', ['id' => $produit->id]) }}" class="delete-link">
                            
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7l16 0"></path>
                            <path d="M10 11l0 6"></path>
                            <path d="M14 11l0 6"></path>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                         </svg>
                        </a>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <a href="{{ route('produit.destroy', ['id' => $produit->id]) }}" class="delete-link mb-0 ms-3 font-wight-light">Supprimé produit</a>
                    </div>
                  </li>
                  <li class="mb-2 pb-1 d-flex justify-content-between align-items-center">
                    <div class=" p-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                id="flexSwitchCheckChecked"
                                {{ $produit->status == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Visibilité du produit</h6>
                    </div>
                  </li>
                  
                </ul>
              </div>
            </div>
          </div>
    </div>

@include('layouts.footer')

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

<h4 class="fw-bold"> {{ $title }}</h4>
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card" style="box-shadow: none !important">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Total achats</th>
                            <th>Téléphones</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($commandes->isNotEmpty())
                            @foreach ($commandes as $key => $item)
                                <!-- Modal -->
                                <div class="modal fade" id="modalScrollable" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLongTitle">Liste des produits commandé</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="p-0 m-0">
                                                    @foreach ($item->commandeproduits as $items)
                                                        <li class="d-flex mb-4 pb-1">
                                                            <div class="me-3">
                                                                @foreach (explode(';', $items->produit->image) as $k => $imageName)
                                                                    @if ($k < 2)
                                                                        <img src="{{ asset('produit-images/' . $imageName) }}" alt="User" class="rounded" width="46">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">{{ $items->produit->libelle }}</h6>
                                                                <small style="font-size: 12px" class="text-muted d-block">Prix unitaire: {{ $items->produit->price }} {{ $devise->devise }}</small>
                                                                <small class="text-muted d-block">Quantité: {{ $items->quantite}}</small>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <p class="mb-0 fw-semibold">{{ number_format($items->montant, 2, ',', ' ') }} {{ $devise->devise }}</p>
                                                            </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->no_commande }}</td>
                                    <td>{{ number_format($item->total_achat, 2, ',', ' ') }} {{ $devise->devise }}</td>
                                    <td> {{ $item->mobile }} </td>
                                    <td>{{ $item->adresse }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalScrollable"
                                                class="text-body">
                                                <i class="ti ti-eye ti-sm me-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@include('layouts.footer')

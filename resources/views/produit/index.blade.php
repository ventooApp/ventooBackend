@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')


<div class="row cntnt-produit-dash">
    @if (session()->has('message'))
        <div class="alert {{ session()->get('type') }}">{{ session()->get('message') }}</div>
    @endif
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold"> {{ $title ?? 'Dashboard' }}</h4>
        </div>
        <div class="col-md-6" style="text-align:right">
            <a href="{{ route('produit.create') }}" class="btn btn-dark waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span>Ajouter un produit
            </a>
            <a class="btn btn-dark waves-effect waves-light" href="{{ route('categorieproduit.create') }}">
                <span class="ti-xs ti ti-plus me-1"></span>Créer une catégorie
            </a>
        </div>
    </div>
    <div class="col-xl-12 previews">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Produits
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                        tabindex="-1">
                        Catégories
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false"
                        tabindex="-1">
                        Stock de produits
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <div class="row content-produit-dash-table">
                        <div class="col-xl-12">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-pills mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-pills-top-home"
                                            aria-controls="navs-pills-top-home" aria-selected="true">
                                            Tout
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-profile"
                                            aria-controls="navs-pills-top-profile" aria-selected="false" tabindex="-1">
                                            Actif
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-messages"
                                            aria-controls="navs-pills-top-messages" aria-selected="false"
                                            tabindex="-1">
                                            Brouillon
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                                        <!-- Bootstrap Table with Header - Light -->
                                        <div class="card">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Images</th>
                                                            <th>Noms</th>
                                                            <th>Prix</th>
                                                            <th>Quantités</th>
                                                            <th>Catégories</th>
                                                            <th>Disponibilités</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @if ($produits->isNotempty())

                                                            @foreach ($produits as $key => $produit)
                                                                <tr>
                                                                    <td>
                                                                        @if ($produit->image)
                                                                            <div class="images">
                                                                                <ul
                                                                                    class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                                    @foreach (explode(';', $produit->image) as $imageName)
                                                                                        <li data-bs-toggle="tooltip"
                                                                                            data-popup="tooltip-custom"
                                                                                            data-bs-placement="top"
                                                                                            class="avatar avatar-xl pull-up">
                                                                                            <img src="{{ asset('produit-images/' . $imageName) }}"
                                                                                                alt="Avatar"
                                                                                                class="rounded-circle" />
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <b>{{ $produit->libelle }}</b>
                                                                    </td>
                                                                    <td> {{ number_format($produit->price , 2, ',', ' ') }} {{ $devise->devise }}</td>
                                                                    <td> {{ $produit->qte }} </td>
                                                                    <td>{{ $produit->categorieproduit->libelle }}</td>
                                                                    <td class="action-edit">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                id="flexSwitchCheckChecked"
                                                                                {{ $produit->status == '1' ? 'checked' : '' }}>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="{{ route('produit.show', ['id' => $produit->id]) }}" class="text-body">
                                                                                <i class="ti ti-eye ti-sm me-2"></i>
                                                                            </a>
                                                                            
                                                                            <a href="{{ route('produit.edit', ['id' => $produit->id]) }}" class="text-body">
                                                                                <i class="ti ti-edit ti-sm me-2"></i>
                                                                            </a>
                                                                            <a href="{{ route('produit.destroy', ['id' => $produit->id]) }}" class="delete-link text-body delete-record">
                                                                                <i class="ti ti-trash ti-sm mx-2"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @else
                                                            <p>Pas de produit pour le moment</p>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Bootstrap Table with Header - Light -->
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                        <!-- Bootstrap Table with Header - Light -->
                                        <div class="card">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Images</th>
                                                            <th>Noms</th>
                                                            <th>Prix</th>
                                                            <th>Quantités</th>
                                                            <th>Catégories</th>
                                                            <th>Disponibilités</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @if ($produitsActives->isNotempty())

                                                            @foreach ($produitsActives as $key => $produit)
                                                                <tr>
                                                                    <td>
                                                                        @if ($produit->image)
                                                                            <div class="images">
                                                                                <ul
                                                                                    class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                                    @foreach (explode(';', $produit->image) as $imageName)
                                                                                        <li data-bs-toggle="tooltip"
                                                                                            data-popup="tooltip-custom"
                                                                                            data-bs-placement="top"
                                                                                            class="avatar avatar-xl pull-up">
                                                                                            <img src="{{ asset('produit-images/' . $imageName) }}"
                                                                                                alt="Avatar"
                                                                                                class="rounded-circle" />
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <b>{{ $produit->libelle }}</b>
                                                                    </td>
                                                                    <td> {{ number_format($produit->price , 2, ',', ' ') }} F</td>
                                                                    <td> {{ $produit->qte }} </td>
                                                                    <td>{{ $produit->categorieproduit->libelle }}</td>
                                                                    <td class="action-edit">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                id="flexSwitchCheckChecked"
                                                                                {{ $produit->status == '1' ? 'checked' : '' }}>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-btn">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('produit.edit', ['id' => $produit->id]) }}"><i
                                                                                            class="ti ti-pencil me-1"></i></a>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('produit.show', ['id' => $produit->id]) }}"><i
                                                                                            class="ti ti-eye me-1"></i></a>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <a style="color:brown" href="{{ route('produit.destroy', ['id' => $produit->id]) }}"
                                                                                        onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')"
                                                                                        class="delete-image-link">
                                                                                        <i class="ti ti-trash me-1"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @else
                                                            <p>Pas de produit actif pour le moment</p>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Bootstrap Table with Header - Light -->
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                                        <!-- Bootstrap Table with Header - Light -->
                                        <div class="card">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Images</th>
                                                            <th>Noms</th>
                                                            <th>Prix</th>
                                                            <th>Quantités</th>
                                                            <th>Catégories</th>
                                                            <th>Disponibilités</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @if ($produitsDesactives->isNotempty())

                                                            @foreach ($produitsDesactives as $key => $produit)
                                                                <tr>
                                                                    <td>
                                                                        @if ($produit->image)
                                                                            <div class="images">
                                                                                <ul
                                                                                    class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                                    @foreach (explode(';', $produit->image) as $imageName)
                                                                                        <li data-bs-toggle="tooltip"
                                                                                            data-popup="tooltip-custom"
                                                                                            data-bs-placement="top"
                                                                                            class="avatar avatar-xl pull-up">
                                                                                            <img src="{{ asset('produit-images/' . $imageName) }}"
                                                                                                alt="Avatar"
                                                                                                class="rounded-circle" />
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <b>{{ $produit->libelle }}</b>
                                                                    </td>
                                                                    <td> {{ number_format($produit->price , 2, ',', ' ') }} F</td>
                                                                    <td> {{ $produit->qte }} </td>
                                                                    <td>{{ $produit->categorieproduit->libelle }}</td>
                                                                    <td class="action-edit">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                id="flexSwitchCheckChecked"
                                                                                {{ $produit->status == '1' ? 'checked' : '' }}>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-btn">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('produit.edit', ['id' => $produit->id]) }}"><i
                                                                                            class="ti ti-pencil me-1"></i></a>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('produit.show', ['id' => $produit->id]) }}"><i
                                                                                            class="ti ti-eye me-1"></i></a>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <a style="color:brown" href="{{ route('produit.destroy', ['id' => $produit->id]) }}"
                                                                                        onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')"
                                                                                        class="delete-image-link">
                                                                                        <i class="ti ti-trash me-1"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @else
                                                            <p>Pas de Brouillon pour le moment</p>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Bootstrap Table with Header - Light -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none;">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Images</th>
                                        <th>Noms</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0 cat-prod">
                                    @if ($categorieproduits->isNotempty())

                                        @foreach ($categorieproduits as $key => $categorieproduit)
                                            <tr>
                                                <td>
                                                    @if ($categorieproduit->image)
                                                        <div class="images">
                                                            <img src="{{ asset('categorie-produit-images/' . $categorieproduit->image) }}" alt="Avatar" class="rounded_circle" />
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <b>{{ $categorieproduit->libelle }}</b>
                                                </td>
                                                <td style="text-align: right">
                                                    <div class="action-btn">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('categorieproduit.edit', ['id' => $categorieproduit->id]) }}"><i
                                                                        class="ti ti-pencil me-1"></i></a>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a style="color:brown" href="{{ route('categorieproduit.destroy', ['id' => $categorieproduit->id]) }}"
                                                                    onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie. tout les produit lié a cette catégorie serons également supprimé ?')"
                                                                    class="delete-image-link">
                                                                    <i class="ti ti-trash me-1"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <p>Pas de catégorie pour le moment</p>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
                <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                    <!-- Bootstrap Table with Header - Light -->
                    <div class="card" style="box-shadow: none;">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Images</th>
                                        <th>Noms</th>
                                        <th>Quantitéq</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0 cat-prod">
                                    @if ($produits->isNotempty())

                                        @foreach ($produits as $key => $produit)
                                            <tr>
                                                <td>
                                                    @if ($produit->image)
                                                        <div class="images">
                                                            <ul
                                                                class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                @foreach (explode(';', $produit->image) as $imageName)
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="top"
                                                                        class="avatar avatar-xl pull-up">
                                                                        <img src="{{ asset('produit-images/' . $imageName) }}"
                                                                            alt="Avatar"
                                                                            class="rounded-circle" />
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <b>{{ $produit->libelle }}</b>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="qte" value="{{$produit->qte}}" min="1" data-id="{{$produit->id}}" />
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <p>Pas de stock pour le moment</p>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')

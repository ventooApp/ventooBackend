@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

<div class="row stats-dashboard">
    <div class="col-md-9">
      <h4 class="fw-bold py-3 mb-4"> {{ $title ?? 'Dashboard'}}</h4>
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-icon">
                            <span class="badge bg-label-dark rounded-pill p-2">
                              <i class="ti ti-shopping-cart"></i>
                            </span>
                        </div>
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ $nombre_de_commande }}</h5>
                            <small>Commandes</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-icon">
                            <span class="badge bg-label-dark rounded-pill p-2">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box-seam" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"></path>
                                <path d="M12 12l8 -4.5"></path>
                                <path d="M8.2 9.8l7.6 -4.6"></path>
                                <path d="M12 12v9"></path>
                                <path d="M12 12l-8 -4.5"></path>
                             </svg>
                            </span>
                        </div>
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">86</h5>
                            <small>Produits vendus</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-icon">
                            <span class="badge bg-label-dark rounded-pill p-2">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-histogram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 3v18h18"></path>
                                <path d="M20 18v3"></path>
                                <path d="M16 16v5"></path>
                                <path d="M12 13v8"></path>
                                <path d="M8 16v5"></path>
                                <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5"></path>
                             </svg>
                            </span>
                        </div>
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">86</h5>
                            <small>Visites du site</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-icon">
                            <span class="badge bg-label-dark rounded-pill p-2">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                             </svg>
                            </span>
                        </div>
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">{{ $nombre_de_client }}</h5>
                            <small>Nouveau clients</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                    <h6 class="m-0 me-2">Chiffres d'affaire et commandes</h6>
                </div>
            </div>
            <div class="card-body pb-0">
                <div id="reportBarChart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card pakg">
            <div class="card-body d-flex  align-items-center">
                <div class="card-icon">
                    <span class="badge bg-label-dark rounded-pill p-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path>
                        <path d="M3 10l18 0"></path>
                        <path d="M7 15l.01 0"></path>
                        <path d="M11 15l2 0"></path>
                     </svg>
                    </span>
                </div>
                <div class="card-title mb-0">
                    <small class="mb-0 me-2">Plan actuel</small>
                    <h3 class="text-uppercase">STARTER</h3>
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <!-- Accordion with Icon -->
            <div class="col-md mb-4 mb-md-2">
                <h6>Configurer votre boutique</h6>
                @if ($guideconfigurations->isNotEmpty())
                <div class="accordion mt-3" id="accordionWithIcon">
                    @foreach ($guideconfigurations->take(3) as $key => $guideconfiguration)
                        <div class="accordion mt-3" id="accordionWithIcon">
                          <div class="accordion-item card">
                              <h2 class="accordion-header d-flex align-items-center">
                                  <button style="font-size: 12px" type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                      data-bs-target="#accordionWithIcon-{{ $guideconfiguration->id }}" aria-expanded="false">
                                      <input style="margin-right: 5px" class="form-check-input" type="checkbox" value="" id="customCheckSuccess" readonly> 
                                      {{ $guideconfiguration->titre }}
                                  </button>
                              </h2>
                              <div id="accordionWithIcon-{{ $guideconfiguration->id }}" class="accordion-collapse collapse">
                                  <div class="accordion-body">
                                    {{ $guideconfiguration->description }}
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
                @else
                    <p>Pas de configuration pour le moment</p>
                @endif
                
            </div>
            <!--/ Accordion with Icon -->
        </div>
        <div class="card mb-4 clipboard-ui">
            <div class="row card-header">
              <div class="col-md-6 text-left"><h6>Parrainage</h6></div>
              <div class="col-md-6 text-right" style="text-align: right"><a href="">Voir plus</a></div>
            </div>
            <div class="card-body">
                <input class="form-control mb-3" id="clipboard-example" type="text" value="Copy Me!" readonly/>
                <button class="clipboard-btn" data-clipboard-action="copy" data-clipboard-target="#clipboard-example">
                    Cliquez pour copiez
                </button>
                <span>
                  Utilisez ce code pour invité des personne a utilisé <b>ventoo</b>
                </span>
            </div>
          </div>
        </div>
    </div>

    <div class="row actualite-dash">
      <h5 class="pb-1 mb-2 mt-4">Actualités</h5>
        @if ($actualites->isNotEmpty())
        @foreach ($actualites as $actualite)
          <div class="col-md-6 col-xl-3">
            <div class="card mb-3">
              <img class="card-img-top" src="../../assets/img/elements/13.jpg" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">
                  {{ $actualite->titre }}
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <p class="card-text text-left">
                      <small class="text-muted">{{ $actualite->created_at }}</small>
                    </p>
                  </div>
                  <div class="col-md-6 text-right" style="text-align: right">
                    <span class="badge bg-label-dark">{{ $actualite->categorieactualite->libelle }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        @else
            <p>Pas d'actualité pour le moment</p>
        @endif

    </div>
</div>

@include('layouts.footer')

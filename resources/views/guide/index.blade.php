@include('layouts.header')
@include('layouts.menu')
@include('layouts.navbar')

<div class="row stats-dashboard">
    <h4 class="fw-bold py-3 mb-4"> {{ $title ?? 'Dashboard' }}</h4>
    <div class="col-md-8">
        <!-- Accordion with Icon -->
        <div class="col-md mb-4 mb-md-2 accordi">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title">Guide de configuration</h5>
                            <span class="card-text">
                                Vous trouverez ici la liste de toutes les actions pour terminé la configuration de votre
                                boutique
                            </span>
                        </div>
                        <div class="col-md-4 text-center accordi-progress">
                            <div>Progression</div>
                            <div style="color: green">0% Terminé</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion mt-3" id="accordionWithIcon">
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-1" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess" {{$user->email ? 'checked' : ''}}>
                                    <div class="lib-title"><a href=""><b>Faites vous verifier</b></a></div>
                                    Ajouter une adresse E-mail
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess" {{$nombre_de_produit > 0 ? 'checked' : ''}}>
                                    <div class="lib-title"><a href=""><b>Ajouter produit</b></a></div>
                                    Ajouter un nouveau produit
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-7" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Rejoindre</b></a></div>
                                    Rejoingner notre communauté Telegram
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-6" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Lier les comptes</b></a></div>
                                    Ajoueter vos compte sociaux
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-5" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Commencer</b></a></div>
                                    Configurer votre theme
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-4" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Activer les paiements</b></a></div>
                                    Ajouter vos moyens de paiement
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Rejoindre</b></a></div>
                                    Rejoignez notre communauté Whatsapp
                                </button>
                            </h2>
                        </div>
                        <hr>
                        <div class="accordion-item card">
                            <h2 class="accordion-header d-flex align-items-center font-wight-light">
                                <button style="font-size: 13px !important" type="button"
                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                                    <input style="margin-right: 5px" class="form-check-input" type="checkbox"
                                        value="" id="customCheckSuccess">
                                    <div class="lib-title"><a href=""><b>Ajouter</b></a></div>
                                    Ajouter votre localisation
                                </button>
                            </h2>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>

            <div class="card mt-4 azerfds">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <hr>
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">
                            <!-- Bootstrap crossfade carousel -->
                            <div class="col-md-12">

                                <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade"
                                    data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active">
                                        </li>
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="../../assets/img/elements/1.jpg"
                                                alt="First slide" />
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4>First slide</h4>
                                                <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue
                                                    pertinacia.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="../../assets/img/elements/5.jpg"
                                                alt="Second slide" />
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4>Second slide</h4>
                                                <p>In numquam omittam sea.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="../../assets/img/elements/3.jpg"
                                                alt="Third slide" />
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4>Third slide</h4>
                                                <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco
                                                    mel no.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample-cf" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExample-cf" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Content -->
                </div>
            </div>


        </div>
        <!--/ Accordion with Icon -->
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">Votre boutique est sur la version gratuite. Selectionnez la plan <b>Premium</b>
                    pour bénéficiez du plein potentiel de <b>Ventoo</b></p>
                <a href="javascript:void(0)" class="btn btn-dark waves-effect waves-light">Passez en premium <i
                        class="ti ti-chevron-right"></i></a>
            </div>
        </div>
        <div class="col-md mb-4 mb-md-2">
            <div class="accordion mt-3 accordi-faq" id="accordionExample">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            Foire aux questions
                        </button>
                    </h2>
                    @if ($faqs->isNotEmpty())
                        <div id="accordionOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample" style="">
                            @foreach ($faqs as $faq)
                                <div class="accordion-body">
                                    {{ $faq->question }}
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    @else
                        <p>Pas de Faq pour le moment</p>
                    @endif

                </div>


            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <b>D'autres question !</b>
                <p class="card-text mt-3">
                    Vous avez des qiestions ? Trouvez des reponses rapidement <br>Nous avons documenté les réponses aux
                    questions que vous pourriez avoir
                    cliquez sur le bouton ci-dessous
                </p>
                <a href="javascript:void(0)" class="btn btn-dark waves-effect waves-light">Trouvez des reponses <i
                        class="ti ti-chevron-right"></i></a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <b>vous ne trouver pas la reponse ?</b>
                <p class="card-text mt-3">
                    Vous avez des qiestions ? Trouvez des reponses rapidement <br>Nous avons documenté les réponses aux
                    questions que vous pourriez avoir
                    cliquez sur le bouton ci-dessous
                </p>
                <a href="javascript:void(0)" class="btn btn-dark waves-effect waves-light">Ecrivez à notre équipe
                    support <i class="ti ti-chevron-right"></i></a>
            </div>
        </div>
    </div>

</div>

@include('layouts.footer')

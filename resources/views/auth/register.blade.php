<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register Cover - Pages | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- Register -->
            <div class="d-flex col-12 col-lg-7 align-items-center p-sm-5 p-4 auth-cover-bg-color">
                <div class="w-px-400 mx-auto ">
                    <div class="card">
                        <div class="card-body">
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <!-- Logo -->
                        <div class="app-brand mb-4">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#313131" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#313131" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h3 class="mb-1 fw-bold">L'aventure commence ici 🚀</h3>
                        <p class="mb-4">Rendez la gestion de votre boutique simple et amusante !</p>
    
                            <form id="formAuthentication" class="mb-3" action="{{ route('registers') }}" method="post">
                                @csrf
                            <div class="mb-3">
                                <label for="store_name" class="form-label">Non de votre boutique</label>
                                <input type="text" class="form-control" id="store_name" name="store_name"
                                    placeholder="Entrez le non de votre boutique" autofocus />
                            </div>
                            <label for="domain_name" class="form-label">Non de domaine</label>
                            <div class="input-group input-group-merge mb-3">
                                <input name="domain_name" type="text" id="domain_name" class="form-control" placeholder="votre boutique"  aria-describedby="basic-default-email2">
                                <span class="input-group-text" id="basic-default-email2">ventoo.io</span>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Non complet</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Entrez tout votre nom" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="phone-number-mask" class="form-label">Numéro de téléphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text">CI (+225)</span>
                                        <input name="mobile" type="text" id="phone-number-mask" class="form-control phone-number-mask">
                                      </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Mot de passe</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Créez un mot de passe" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
    
                            <div class="mb-3">
                                <div class="form-check">
                                    <input name="checkbox" class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label termsconditions" for="terms-conditions"  style="font-size: 12px">
                                        J'accepte 
                                        <a style="font-size: 12px" href="javascript:void(0);">la politique de confidentialité et les conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary">Créez votre compte</button>
                            </div>
                        </form>
    
                        <p class="text-center alreadyhaveanaccount" style="font-size: 12px">
                            <span>Vous avez déjà un compte?</span>
                            <a href="{{ route('login') }}">
                                <span>Connectez-vous</span>
                            </a>
                        </p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Register -->
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-5 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    {{-- <img src="../../assets/img/illustrations/auth-register-illustration-light.png"
                        alt="auth-register-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-register-illustration-light.png"
                        data-app-dark-img="illustrations/auth-register-illustration-dark.png" /> --}}

                    {{-- <img src="../../assets/img/illustrations/bg-shape-image-light.png" alt="auth-register-cover"
                        class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" /> --}}
                        <div class="app-brand mb-4">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#313131" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#313131" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                </div>
            </div>
            <!-- /Left Text -->
                
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>
</body>

</html>

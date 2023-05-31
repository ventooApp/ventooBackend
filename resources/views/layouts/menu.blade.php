            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme"
                style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#313131"></path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616"></path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#313131"></path>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1 ps ps--active-y">
                    <!-- Dashboards -->
                    <li class="menu-header small ">
                        <span class="menu-header-text">Menu principal</span>
                    </li>
                    <li class="menu-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $menu == 'guideconfiguration' ? 'active' : '' }}">
                        <a href="{{ route('guide.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-messages"></i>
                            <div data-i18n="Guide">Guide</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $menu == 'produit' ? 'active' : '' }}">
                        <a href="{{ route('produit.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-calendar"></i>
                            <div data-i18n="Produits">Produits</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $menu == 'commande' ? 'active' : '' }}">
                        <a href="{{ route('commande.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                            <div data-i18n="Commandes">Commandes</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $menu == 'client' ? 'active' : '' }}">
                        <a href="{{ route('client.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="Clients">Clients</div>
                        </a>
                    </li>

                    <!-- Apps & Pages -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Gestion</span>
                    </li>
                    <li class="menu-item {{ $menu == 'marketing' ? 'active' : '' }}">
                        <a href="{{ route('marketing.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-speakerphone"></i>
                            <div data-i18n="Marketing">Marketing</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-chat.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-graph"></i>
                            <div data-i18n="Analytics">Analytics</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-calendar.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-dots-3"></i>
                            <div data-i18n="Canaux de ventes">Canaux de ventes</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="Paramètres">Paramètres</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-truck-delivery"></i>
                            <div data-i18n="Livraison">Livraison</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-wallet"></i>
                            <div data-i18n="Paiement">Paiement</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-packages"></i>
                            <div data-i18n="Entreposage">Entreposage</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                            <div data-i18n="Capital">Capital</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-package-export"></i>
                            <div data-i18n="Approvisionnement">Approvisionnement</div>
                        </a>
                    </li>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 462px; right: 4px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 136px;"></div>
                    </div>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

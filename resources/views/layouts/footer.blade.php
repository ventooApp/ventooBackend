</div>
<!-- / Content -->

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div
            class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by <a href="https://pixinvent.com" target="_blank"
                    class="fw-semibold">Pixinvent</a>
            </div>
            <div>
                <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                    target="_blank">License</a>
                <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                    class="footer-link me-4">More Themes</a>

                <a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/"
                    target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://pixinvent.ticksy.com/" target="_blank"
                    class="footer-link d-none d-sm-inline-block">Support</a>
            </div>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

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
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/clipboard/clipboard.js"></script>
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/dropzone/dropzone.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="../../assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>

    <script src="../../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/bloodhound/bloodhound.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>
    <script src="../../assets/js/dashboards-ecommerce.js"></script>
    <script src="../../assets/js/extended-ui-misc-clipboardjs.js"></script>
    <script src="../../assets/js/ui-carousel.js"></script>
    <script src="../../assets/js/forms-selects.js"></script>
    <script src="../../assets/js/forms-file-upload.js"></script>
    <script src="../../assets/js/forms-pickers.js"></script>
    <script src="../../assets/js/forms-tagify.js"></script>
    <script src="../../assets/js/app-user-list.js"></script>
    <script src="../../assets/js/tables-datatables-basic.js"></script>

    <script src="../../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../assets/js/ui-modals.js"></script>

    <script>
        // Récupération de l'input "images"
    const input = document.querySelector('#images');
    
    // Récupération de la div pour afficher les images prévisualisées
    const preview = document.querySelector('#preview');
    
    // Écouteur d'événement pour détecter un changement dans l'input "images"
    input.addEventListener('change', function() {
      // Suppression des images prévisualisées précédentes
      preview.innerHTML = '';
      
      // Boucle pour parcourir toutes les images sélectionnées
      for (let i = 0; i < input.files.length; i++) {
        // Création d'un élément "img" pour afficher l'image prévisualisée
        const img = document.createElement('img');
        
        // Configuration de l'URL de l'image à afficher
        img.src = URL.createObjectURL(input.files[i]);
        
        // Ajout de l'image à la div pour afficher les images prévisualisées
        preview.appendChild(img);
      }
    });
    
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-image').click(function() {
                var productId = $(this).data('product-id');
                var imageName = $(this).data('image-name');
                var confirmation = confirm('Voulez-vous vraiment supprimer cette image ?');
                if (confirmation) {
                    $.ajax({
                        timeout: 10000, // 10 secondes
                        url: '/produits/' + productId + '/images/' + imageName,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                        if (data.success) {
                            // Supprime l'élément DOM correspondant à l'image supprimée
                            $parent.remove();
                            alert('L\'image a été supprimée avec succès.');
                            window.history.back();
                        } else {
                            alert('Une erreur s\'est produite lors de la suppression de l\'image.');
                        }
                        },
                        error: function() {
                            alert('Une erreur s\'est produite lors de la suppression de l\'image.');
                        }
                    });
                }
            });
        });
    </script>

<script>
    // $(document).ready(function() {
    //     // Lorsque l'utilisateur coche ou décoche la case à cocher
    //     $('.toggle-client-status').change(function() {
    //         var clientId = $(this).data('client-id');
    //         var clientStatus = $(this).prop('checked') ? '1' : '0';
    //         alert(clientId)
    //         alert(clientStatus)
    //         // Envoyer une requête Ajax pour mettre à jour le statut du client
    //         $.ajax({
    //             url: '/clients/' + clientId + '/toggle-status',
    //             method: 'POST',
    //             data: {
    //                 _token: '{{ csrf_token() }}',
    //                 status: clientStatus
    //             },
    //             success: function(response) {
    //                 // Si la requête a réussi, rafraîchir la page
    //                 location.reload();
    //             },
    //             error: function(response) {
    //                 // Si la requête a échoué, afficher un message d'erreur
    //                 alert('Une erreur est survenue : ' + response.statusText);
    //             }
    //         });
    //     });
    // });
    $(document).ready(function() {
        $('.toggle-client-actif').change(function() {
            var id = $(this).data('client-id');
            var client_actif = $(this).prop('checked') ? 1 : 0;
            
            $.ajax({
                url: '/clients/activate-deactivate/' + id,
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'client_actif': client_actif
                },
                success: function(data) {
                    // Faire quelque chose en cas de succès
                    location.reload();
                },
                error: function(xhr) {
                    // Gérer les erreurs ici
                    alert('une erreur est survenue')
                }
            });
        });
    });

    $(document).ready(function() {
        $('.toggle-produit').change(function() {
            var id = $(this).data('produit-id');
            var status = $(this).prop('checked') ? '1' : '0';
            
            $.ajax({
                url: '/produits/activate-deactivate/' + id,
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'status': status
                },
                success: function(data) {
                    // Faire quelque chose en cas de succès
                    location.reload();
                },
                error: function(xhr) {
                    // Gérer les erreurs ici
                    alert('une erreur est survenue')
                }
            });
        });
    });
</script>

<script>
    $('input[type="number"]').on('input', function() {
        var id = $(this).data('id');
        var quantite = $(this).val();
        updateQuantite(id, quantite);
    });

    function updateQuantite(id, quantite) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({
        url: '/update_quantite',
        type: 'POST',
        data: {
            id: id,
            qte: quantite
        },
        success: function(response) {
            console.log(response);
        }
    });
}

</script>

<script>
    var deleteLinks = document.querySelectorAll('.delete-link');
    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            var confirmed = confirm('Êtes-vous sûr de vouloir supprimer ?');
            if (confirmed) {
                window.location.href = this.href;
            }
        });
    }
</script>

<script>
$(document).ready(function () {
    $('#category').change(function () {
        var category_id = $(this).val();

        if (category_id !== '') {
            $.ajax({
                url: '/products/get-by-category',
                type: 'GET',
                data: {category_id: category_id},
                success: function (response) {
                    var products = response;

                    $('#product').empty().append('<option value="">Sélectionnez un produit</option>');

                    $.each(products, function (index, product) {
                        $('#product').append('<option value="' + product.id + '" data-price="' + product.price + '">' + product.libelle + '</option>');
                    });
                }
            });
        } else {
            $('#product').empty().append('<option value="">Sélectionnez une catégorie en premier</option>');
        }
    });

    $('#product').change(function() {
        var price = $('option:selected', this).data('price');
        $('#price').val(price);
    });
});

</script>

<script>
    $(document).ready(function () {
    $('#percentage').change(function () {
        var price = $('#price').val();
        var percentage = $(this).val();

        if (percentage !== '') {
            $.ajax({
                url: '/calculate-discount-value',
                type: 'GET',
                data: {price: price, percentage: percentage},
                success: function (response) {
                    var discount_value = response.discount_value;

                    $('#discount_value').val(discount_value);
                }
            });
        } else {
            $('#discount_value').val('');
        }
    });
});

$(document).ready(function () {
    $('#percentage').on('input', function () {
        var percentage = parseFloat($(this).val());
        var price = parseFloat($('#price').val());

        if (!isNaN(percentage) && !isNaN(price)) {
            var discountValue = price * (percentage / 100);
            $('#discount_value').val(discountValue.toFixed(2));
        } else {
            $('#discount_value').val('');
        }
    });
});

</script>

<script>
    $(document).ready(function() {
        $('#date_filter').on('change', function() {
            var date_filter = $(this).val();
            window.location.href = "{{ route('marketing.reduction-sur-les-produit') }}?date_filter=" + date_filter;
        });
    });

    $(document).ready(function() {
        $('#date_filter_rpm').on('change', function() {
            var date_filter_rpm = $(this).val();
            window.location.href = "{{ route('marketing.reduction-sur-le-panier-moyen') }}?date_filter_rpm=" + date_filter_rpm;
        });
    });

</script>
    
    
</body>

</html>

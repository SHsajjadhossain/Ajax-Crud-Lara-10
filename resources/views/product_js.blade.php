<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click','.save_product', function (e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            // console.log(name+price);
            $.ajax({
                type: "POST",
                url: "{{ route('product.create') }}",
                data: {name:name, price:price},
                success: function (response) {
                    if (response.status == 'success') {
                        $('#addProductModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["success"]("Product added successfully !!")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },error:function(err){
                    let error = err.responseJSON;
                        $('.all_errors').removeClass('d-none');
                        $.each(error.errors, function (index, value) {
                            $('.all_errors').append('<span class="text-danger">'+value+'</span>'+'</br>');
                        });
                }
            });
        });

        // show product value in edit form

        $(document).on('click','.update_product_form', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);
        });

        // update product data

        $(document).on('click','.update_product', function (e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_price = $('#up_price').val();
            // console.log(name+price);
            $.ajax({
                type: "POST",
                url: "{{ route('product.update') }}",
                data: {up_id:up_id, up_name:up_name, up_price:up_price},
                success: function (response) {
                    if (response.status == 'success') {
                        $('#updateProductModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["info"]("Product updated successfully!")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },error:function(err){
                    let error = err.responseJSON;
                        $('.all_errors').removeClass('d-none');
                        $.each(error.errors, function (index, value) {
                            $('.all_errors').append('<span class="text-danger">'+value+'</span>'+'</br>');
                        });
                }
            });
        });

        // delete product

        $(document).on('click','.delete_product', function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');

            if (confirm('Are you sure to delete product??')) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.delete') }}",
                    data: {product_id:product_id},
                    success: function (response) {
                        if (response.status == 'success') {
                            $('.table').load(location.href+' .table');
                            Command: toastr["error"]("Product deleted successfully !!")

                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            }
        });

        // pagination

        $(document).on('click','.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            product(page)
        });

        function product(page){
            $.ajax({
                url: "/pagination/paginate-data?page="+page,
                success:function(response){
                    $('.table-data').html(response);
                }
            });
        }

        // search product

        $(document).on('keyup', function (e) {
            e.preventDefault();
            let search_string = $('#search').val();

            $.ajax({
                url: "{{ route('product.search') }}",
                method: 'GET',
                data: {search_string:search_string},
                success:function(response){
                    $('.table-data').html(response);
                    if (response.status == 'nothing_found') {
                        $('.table-data').html('<div class= "alert alert-danger text-center text-danger">'+'Nothing found'+'</div>');
                    }
                    // +'<span class="text-danger">'+'</span>'
                }
            });
        });
    });
</script>

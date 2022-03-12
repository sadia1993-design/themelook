<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Product') }}
            </h2>
            <div class="add">
                <a href="{{route('product.create')}}" class="btn btn-info">Add Product</a>
            </div>
        </div>
    </x-slot>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Total Variants</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>

                     <tbody>
                        @forelse($all_products as $all_product)
                            <tr>
                                <td>
                                    <span> {{$all_product->product_name}} </span>
                                    <input
                                        type="text"
                                        class="form-control product-name-{{$all_product->id}}"
                                        value="{{$all_product->product_name}}"
                                        style="display: none;"
                                    />
                                </td>
                                <td>{{count($all_product->variants)}}</td>

                                <td width="100px">
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-primary edit-product"
                                        data-id="{{$all_product->id}}"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-primary update-product"
                                        data-id="{{$all_product->id}}"
                                        title="Update"
                                        style="display: none;"
                                    >
                                        <i class="fas fa-save"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-info reset-product-edit"
                                        data-id="{{$all_product->id}}"
                                        title="Reset"
                                        style="display: none;"
                                    >
                                        <i class="fas fa-refresh"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-danger delete-product"
                                        data-id="{{$all_product->id}}"
                                        title="Delete"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a
                                        href="{{ route('product.variants', $all_product->id) }}"
                                        class="btn btn-sm btn-primary "
                                        title="Variance"
                                    >
                                        <i class="fa-solid fa-toolbox"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // alert()
            $(".edit-product").on('click', function() {
                var productId = $(this).data('id');
                var product_name = $(".product-name-"+productId)
                product_name.show();
                product_name.prev().hide();
                $(this).hide().next().show().next().show();
            });

            $(".reset-product-edit").on('click', function() {
                var productId = $(this).data('id');
                var product_name = $(".product-name-"+productId)
                product_name.hide();
                product_name.prev().show();
                $(this).hide().prev().hide().prev().show();

            });

            $(".update-product").on('click', function() {
                var thisAttr = $(this);
                var productId = thisAttr.data('id');
                var product_name = $(".product-name-"+productId)

                var url = "{{route('product.update', ':id')}}"
                url = url.replace(':id', productId);

                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'product_name': product_name.val(),
                        '_method' : 'put'
                    },
                    success: function(response) {
                        // console.log(response)
                        if (response.success == true) {
                            thisAttr.next().hide();
                            thisAttr.hide().prev().show();
                            product_name.hide().prev().show().html(product_name.val())
                        } else {

                        }
                    },
                    error: function(error) {

                    }
                })
            });

            $(".delete-product").on('click', function() {
                if (!confirm("Do you want to delete ?")) {
                    return false;
                }
                var thisAttr = $(this);
                var productId = thisAttr.data('id');

                var url = "{{route('product.destroy', ':id')}}"
                url = url.replace(':id', productId);

                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_method' : 'delete'
                    },
                    success: function(response) {
                        // console.log(response)
                        if (response.success == true) {
                            thisAttr.parent().parent().remove();
                        } else {

                        }
                    },
                    error: function(error) {

                    }
                })
            });
        })
    </script>
</x-app-layout>



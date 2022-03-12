<x-app-layout>
    <x-slot name="header">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($product->product_name) }}
            </h2>

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

                            <th>Gender</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($product->variants as $variant)
                            <tr>

                                <td>
                                    <span>{{$variant->gender}}</span>
                                    <input
                                        type="text"
                                        class="form-control gender-{{$variant->id}}"
                                        value="{{$variant->gender}}"
                                        style="display: none;"
                                    />
                                </td>
                                <td>
                                    <span>{{$variant->color}}</span>
                                    <input
                                        type="text"
                                        class="form-control color-{{$variant->id}}"
                                        value="{{$variant->color}}"
                                        style="display: none;"
                                    />
                                </td>
                                <td>
                                    <span>{{$variant->size}}</span>
                                    <input
                                        type="text"
                                        class="form-control size-{{$variant->id}}"
                                        value="{{$variant->size}}"
                                        style="display: none;"
                                    />
                                </td>
                                <td>
                                    <span>{{$variant->price}}</span>
                                    <input
                                        type="text"
                                        class="form-control price-{{$variant->id}}"
                                        value="{{$variant->price}}"
                                        style="display: none;"
                                    />
                                </td>

                                <td width="100px">
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-primary edit-product"
                                        data-id="{{$variant->id}}"
                                        title="Edit"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-primary update-product"
                                        data-id="{{$variant->id}}"
                                        title="Update"
                                        style="display: none;"
                                    >
                                        <i class="fas fa-save"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-info reset-product-edit"
                                        data-id="{{$variant->id}}"
                                        title="Reset"
                                        style="display: none;"
                                    >
                                        <i class="fas fa-refresh"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-danger delete-product"
                                        title="Delete"
                                        data-id="{{$variant->id}}"
                                    >
                                        <i class="fas fa-trash"></i>
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
        $(document).ready( function (){

            $(".delete-product").on('click', function (){
                if( !confirm('Do You Want to delete this record?')){
                   return false;
                }

                var thisAttr = $(this);
                var varianceId = thisAttr.data('id');

                var url = "{{route('productVariant.destroy', ':id')}}";
                var url = url.replace(':id', varianceId);
                console.log(url);

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
                        console.log(response.success)
                        if (response.success == true) {
                            thisAttr.parent().parent().remove();
                        } else {

                        }
                    },
                })

            });



            //edit button appear
            $('.edit-product').on('click', function (){
                var productId = $(this).data('id');

                var gender = $(".gender-"+productId);
                var color = $(".color-"+productId);
                var size = $(".size-"+productId);
                var price = $(".price-"+productId);
                // console.log(size)

                gender.show();
                color.show();
                size.show();
                price.show();

                gender.prev().hide();
                color.prev().hide();
                size.prev().hide();
                price.prev().hide();

                $(this).hide().next().show().next().show();
            })


            //reset button
            $('.reset-product-edit').on('click', function (){
                var variantId = $(this).data('id');

                var gender = $(".gender-"+variantId);
                var color = $(".color-"+variantId);
                var size = $(".size-"+variantId);
                var price = $(".price-"+variantId);

                gender.hide();
                color.hide();
                size.hide();
                price.hide();

                gender.prev().show();
                color.prev().show();
                size.prev().show();
                price.prev().show();

                $(this).hide().prev().hide().prev().show();
            })

            //update field
            $('.update-product').on('click', function (){
                var thisAttr = $(this);
                var variantId = $(this).data('id');

                var gender = $(".gender-"+variantId);
                var color = $(".color-"+variantId);
                var size = $(".size-"+variantId);
                var price = $(".price-"+variantId);

                var url = "{{route('productVariant.update', ':id')}}"
                url = url.replace(':id', variantId);

                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'gender': gender.val(),
                        'color': color.val(),
                        'size': size.val(),
                        'price': price.val(),
                        '_method' : 'put'
                    },
                    success: function(response) {
                        console.log(response.success)
                        if (response.success == true) {
                            thisAttr.next().hide();
                            thisAttr.hide().prev().show();
                            gender.hide().prev().show().html(gender.val())
                            color.hide().prev().show().html(color.val())
                            size.hide().prev().show().html(size.val())
                            price.hide().prev().show().html(price.val())
                        }
                    },
                    error: function(error) {

                    }
                })

            })

        })
    </script>
</x-app-layout>



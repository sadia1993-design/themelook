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

                                <td>{{$variant->gender}}</td>
                                <td>{{$variant->color}}</td>
                                <td>{{$variant->size}}</td>
                                <td>{{$variant->price}}</td>

                                <td width="100px">
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-primary edit-product"
                                        data-id="{{$variant->id}}"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-danger delete-product"
                                        data-id="{{$variant->id}}"
                                        title="Delete"
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

            //delete variance
            $(".delete-product").on('click', function() {
                if (!confirm("Do you want to delete ?")) {
                    return false;
                }
                var thisAttr = $(this);
                var varianceId = thisAttr.data('id');

                var url = "{{route('product.destroy', ':id')}}"
                url = url.replace(':id', varianceId);
                // console.log(url);

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
                        console.log(response)
                        // if (response.success == true) {
                        //     thisAttr.parent().parent().remove();
                        // } else {
                        //
                        // }
                    },
                    error: function(error) {

                    }
                })
            });
        })
    </script>
</x-app-layout>



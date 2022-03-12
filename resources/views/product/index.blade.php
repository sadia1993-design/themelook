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
                            <th>Gender</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>

                     <tbody>
                        @forelse($all_products as $all_product)




                                @foreach ($all_product->variants as $all_product_variant)

                                    <tr>
                                        <td>{{$all_product->product_name}}</td>
                                        <td>{{$all_product_variant->gender}}</td>
                                        <td>{{$all_product_variant->color}}</td>
                                        <td>{{$all_product_variant->size}}</td>
                                        <td>{{$all_product_variant->price}}</td>

                                        <td width="100px">
                                            <form action="{{route('product.destroy',$all_product_variant->id)}}" method="post">

                                                <a href="{{route('product.edit',$all_product_variant->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are You Sure?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach






                        @empty
                        @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



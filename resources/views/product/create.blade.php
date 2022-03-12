<x-app-layout>
    <x-slot name="header">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Product') }}
            </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />


                    <form method="POST" action="{{route('product.store')}}">

                        @csrf


                        <div class="flex w-full">
                            <!-- product name -->
                            <div class="product_id flex-initial w-50">
                                <x-label  for="name" :value="__('Product Name')" />
                                <select class="w-full" name="product_id" id="pr_name" autofocus>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" >{{ $product->product_name }} </option>
                                    @endforeach
                                </select>

                            </div>

                            <!--gender -->
                            <div class="gender ml-3 flex-initial w-50">
                                <x-label  for="gender" :value="__('Gender')" />
                                <select class="w-full" name="gender" id="gender" autofocus>
                                    <option value="man" >Man</option>
                                    <option value="woman" >Woman</option>
                                </select>
                            </div>


                        </div>


                        <div class="flex w-full mt-4">
                            <!-- size -->
                            <div class="size flex-initial w-50">
                                <x-label  for="size" :value="__('Product Size')" />
                                <select class="w-full" name="size" id="size" autofocus>
                                    <option value="s" >S</option>
                                    <option value="m" >M</option>
                                    <option value="l" >L</option>
                                    <option value="xl" >XL</option>
                                    <option value="xxl" >XXL</option>
                                </select>

                            </div>

                            <!--color -->
                            <div class="color ml-3 flex-initial w-50">
                                <x-label  for="color" :value="__('Color')" />
                                <select class="w-full" name="color" id="color" autofocus>
                                    <option value="black" >Black </option>
                                    <option value="white" >White</option>
                                </select>
                            </div>


                        </div>



                        <div class="flex w-full mt-4">
                            <!-- price -->
                            <div class="price flex-initial w-100">
                                <x-label  for="price" :value="__('Product Price')" />
                                <x-input id="price" class="block mt-1 w-full"
                                         type="text"
                                         name="price"  />
                            </div>

                        </div>

                        <x-button class="mt-4 w-full block text-center ">
                            {{ __('Add') }}
                        </x-button>

                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>

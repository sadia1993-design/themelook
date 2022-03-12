<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $variant->product->product_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="">

                    @csrf

                        <div class="flex w-full">
                            <!-- product aname -->
                            <div class="product_id flex-initial w-50">
                                <x-label  for="name" :value="__('Product Name')" />
                                <select class="w-full" name="pr_name" id="pr_name" autofocus>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $product->id == $variant->product_id ? 'selected' : '' }}>{{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- gender--->
                            <div class="gender flex-initial w-50">
                                <x-label class="ml-3" for="gender" :value="__('Gender')"> </x-label>
                                <x-input id="gender" class=" mt-1 ml-3 w-full" type="gender" name="gender" :value="$variant->gender"  autofocus />
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ $variant->product->product_name }}--}}
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
                                <input type="text" class="form-control" value="{!! $product->product_name !!}" />
                            </div>

                            <!-- gender--->
                            <div class="gender ml-3 flex-initial w-50">
                                <x-label  for="gender" :value="__('Gender')"> </x-label>

                            </div>

                        </div>

                        <x-button class="mt-4 w-full block text-center ">
                            {{ __('Update') }}
                        </x-button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

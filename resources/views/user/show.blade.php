<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Edit User ' . $user->username)  }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('user.update', $user->id)}}">
                    @csrf
                        {{method_field('put')}}


                         <div class="flex w-full">
                            <!-- UserName -->
                                <div class="username flex-initial w-50">
                                    <x-label  for="name" :value="__('Username')" />

                                    <x-input id="name" class=" mt-1 w-full " type="text" name="username" :value="$user->username"  autofocus />
                                </div>

                            <!-- email--->
                                <div class="email flex-initial w-50">
                                    <x-label class="ml-3" for="email" :value="__('Email')"> </x-label>
                                    <x-input id="email" class=" mt-1 ml-3 w-full" type="email" name="email" :value="$user->email"  autofocus />
                                </div>

                         </div>

                        <div class="flex w-full mt-4">
                            <!-- pwd -->
                            <div class="password  w-50">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class=" mt-1 w-full " type="password" name="password"   autofocus />
                            </div>

                            <!-- Date Of Birth--->
                            <div class="dob  w-50">
                                <x-label class="ml-3" for="date" :value="__('Date Of Birth')"> </x-label>
                                <x-input id="date" class=" mt-1 ml-3 w-full" type="date" name="date" :value="$user->date_of_birth"  autofocus />
                            </div>

                        </div>


                        <div class="flex w-full mt-4">
                            <!-- city -->
                            <div class="city  w-50">
                                <x-label for="city" :value="__('City')" />

                                <x-input id="city" class=" mt-1 w-full " :value="$user->city" type="text" name="city"   autofocus />
                            </div>

                            <!-- country--->
                            <div class="country  w-50">
                                <x-label class="ml-3" for="country" :value="__('Country')"> </x-label>
                                <x-input id="country" class=" mt-1 ml-3 w-full" :value="$user->country" type="text" name="country"   autofocus />
                            </div>

                        </div>


                        <!-- status--->
                        <div class="status mt-4">
                            <x-label  for="status" :value="__('Status')"> </x-label>
                            <input type="radio"  id="active" name="status" value="active"  {{ ($user->status=="active")? "checked" : "" }} >Active</label>
                            <input type="radio" id="inactive" name="status" value="inactive" {{ ($user->status=="inactive")? "checked" : "" }} >Inactive</label>
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





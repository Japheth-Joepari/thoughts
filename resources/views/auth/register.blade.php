@extends('layouts.component')

@section('content')
    <!-- component -->
    <div class="cont">
        <!-- Container -->
        <div class="container ctt1 mx-auto ">
            <a href="{{ route('home') }}" class="logo2">
                <img src="{{ asset('images/thotlogo.png') }}" alt="">
            </a>
            <div class="flex justify-center px-6 my-12 ">
                <!-- Row -->
                <div class="w-full xl:w-3/4 lg:w-11/12 flex shadow-2xl">
                    <!-- Col -->
                    <div class="w-full h-auto  hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                        style="background-image: url(' {{ asset('images/graphics.jpg') }}'); background-size:cover ">
                    </div>
                    <!-- Col -->
                    <div class="w-full lg:w-7/12  p-5 rounded-lg bg-white lg:rounded-l-none">
                        @if (request()->routeIs('admin.register'))
                            <h3 class="pt-4 text-2xl text-center">Register as Admin✅</h3>
                        @else
                            <h3 class="pt-4 text-2xl text-center">Register ✅</h3>
                        @endif

                        <form class="px-8 pt-6 pb-8 mb-4  bg-white rounded" method="POST"
                            action="{{ request()->routeIs('admin.register') ? route('admin.store') : route('register') }}">
                            @csrf

                            <div class=" flex-col">
                                <div class="rounded-t mb-0 ">
                                    <div class="btn-wrapper text-center">
                                        <a class=" bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                                            href="{{ url('/auth/github') }}">
                                            <img alt="..." class="w-5 mr-1"
                                                src="https://demos.creative-tim.com/notus-js/assets/img/github.svg">Github
                                        </a>
                                        <a class="bg-white active:bg-blueGray-50 text-blueGray-700 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                                            href="{{ url('/auth/google') }}">
                                            <img alt="..." class="w-5 mr-1"
                                                src="https://demos.creative-tim.com/notus-js/assets/img/google.svg">Google</a>

                                    </div>
                                </div>

                                <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                    Fullname
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border-gray-300 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="name" type="text" placeholder="Fullname" name="name"
                                    value="{{ old('name') }}" />

                                @error('name')
                                    <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2 flex-col">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="Email">
                                    Email
                                </label>
                                <input name="email"
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border-gray-300 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="email" type="email" placeholder="email" value="{{ old('email') }}" />

                                @error('email')
                                    <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                        Password
                                    </label>
                                    <input name="password"
                                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border-gray-300 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="password" type="password" placeholder="******************" />
                                    @error('password')
                                        <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>


                                <div class="md:ml-2 mb-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                                        Confirm Password
                                    </label>
                                    <input name="password_confirmation"
                                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border-gray-300 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="password_confirmation" type="password" placeholder="******************" required
                                        autocomplete="new-password" />
                                </div>
                            </div>

                            {{-- @if (request()->routeIs('admin.register'))
                                <input id="role" value="admin" name="role" type="text" class="hidden" />
                            @else
                                <input id="role" value="admin" name="role" type="text" class="hidden" />
                            @endif --}}

                            <div class="mb-6 text-center">
                                <button
                                    class="w-full px-4 py-2 font-bold text-white rounded hover:bg-indigo-700 bg-indigo-700 focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Register Account
                                </button>
                            </div>


                            <hr class=" border-t" />
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                        href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                    href="{{ route('login') }}">
                                    Already have an account? Login!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

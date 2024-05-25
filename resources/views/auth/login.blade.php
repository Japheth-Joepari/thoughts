@extends('layouts.component')

@section('content')
    <div class="container ctt2 mx-auto ">

        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/thotlogo.png') }}" alt="">
        </a>
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex shadow-2xl bg-white">
                <!-- Col -->
                <div class="w-full h-auto  hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url(' {{ asset('/images/graphics.jpg') }} ')"></div>
                <!-- Col -->
                <div class="w-full lg:w-1/2  p-5 rounded-lg lg:rounded-l-none">
                    <h3 class=" text-2xl text-center">✅ Welcome Back!</h3>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class=" text-center">
                            @if (session('success'))
                                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-geen-700 rounded-md">
                                    😩 {{ session('success') }} 🙏
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mt-1 px-4 py-2 bg-red-500 text-white rounded-md">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

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
                            <div class="mb-4 flex-col">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                    Email
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border-gray-300 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    name="email" id="email" type="text" placeholder="email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                                </label>
                                <input name="password"
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border-gray-300  rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password" type="password" placeholder="******************" />
                                @error('password')
                                    <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-4">
                                <input class="mr-2 leading-tight" type="checkbox" id="checkbox_id" />
                                <label class="text-sm" for="checkbox_id">
                                    Remember Me
                                </label>
                            </div>
                            <div class=" text-center">
                                <button
                                    class="w-full px-4 py-2 font-bold text-white bg-indigo-700 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Sign In
                                </button>
                            </div>
                            <hr class="mb-6 border-t" />
                            <div class="text-center">
                                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                    href="{{ route('register') }}">
                                    Create an Account!
                                </a>
                            </div>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                        href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                    <a href="{{ route('home') }}" class="text-green-900 logobotton hidden text-center">
                                        🙏 Back to home
                                    </a>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Support Me 🥰 -->
@endsection

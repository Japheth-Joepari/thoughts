@extends('layouts.component')

@section('content')
    <div class="container ct3 mx-auto ">
        <a href="{{ route('home') }}" class="logom">
            <img src="{{ asset('images/thotlogo.png') }}" alt="">
        </a>
        <div class="flex justify-center align-content-center px-6 my-12 ">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex ">
                <!-- Col -->
                <div class="w-full h-auto  hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url('{{ asset('/images/reddog.jpeg') }}')"></div>
                <!-- Col -->
                <div class="w-full lg:w-1/2  p-5 rounded-lg lg:rounded-l-none shadow-2xl ">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="px-8 mb-4 text-center">

                        <h3 class="pt-4 mb-2 text-2xl">Forgot Your Password?</h3>
                        <p class="mb-4 text-sm text-gray-700">
                            We get it, stuff happens. Just enter your email address below and we'll send you a
                            link to reset your password!
                        </p>
                    </div>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST"
                        action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                placeholder="Enter Email Address..." type="email" name="email"
                                :value="{{ old('email') }}" required autofocus autocomplete="username" />
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline"
                                type="submit">
                                Reset Password
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
                            <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="{{ route('register') }}">
                                Already have an account? Login!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

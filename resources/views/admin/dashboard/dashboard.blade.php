@extends('layouts.dashboard')
@section('content')
    {{-- <div class="bg-cover h-112">
    <img src="https://yt3.ggpht.com/HR5bTyedjHyoOd9h2zty2OAqZ3MFM6T7_R48jhdd2rQE2aSPHOD2B-ibdv-yLSTy4_AAF6XdoCk=w2560-fcrop64=1,00005a57ffffa5a8-nd-c0xffffffff-rj-k-no"
    alt="banner">
</div> --}}
    <div class="-mt-1 bg-grey-lighter">
        <div class="container mx-auto">
            <div class="flex justify-between items-center py-4 px-16">
                <div class="flex items-center">
                    @if (Auth::user()->profile_photo == null)
                        <img class="w-24 h-24 rounded-full" src="{{ asset('/images/avartar.png') }}" alt=""
                            srcset="" style="object-fit: cover">
                    @else
                        <img class="w-24 h-24 rounded-full" src=" {{ asset('/images/' . Auth::user()->profile_photo) }} ">
                    @endif
                    <div class="ml-6">
                        <div class="text-2xl font-normal flex items-center">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <span
                                class="w-3 h-3 text-green-500 inline-block text-center rounded-full  text-2xs">&#10003;</span>
                        </div>
                        <p class="mt-2 font-hairline text-sm">{{ $usersCount }} users active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <main class="p-6 sm:p-10 space-y-6">

        <section class="grid md:grid-cols-2 xl:grid-cols-2 gap-8">
            <div class="flex items-center p-8 bg-white shadow-2xl rounded-lg">
                <a href="{{ route('users.index') }}"
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </a>
                <div>
                    <span class="block text-2xl font-bold">{{ $usersCount }}</span>
                    <span class="block text-gray-500">Users</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow-2xl rounded-lg">
                <a href="{{ route('posts.index') }}"
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </a>
                <div>
                    <span class="block text-2xl font-bold">{{ $postsCount }}</span>
                    <span class="block text-gray-500">Posts</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow-2xl rounded-lg">
                <a href="{{ route('tags.index') }}"
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                </a>
                <div>
                    <span class="inline-block text-2xl font-bold">{{ $tagsCount }}</span>
                    <span class="block text-gray-500">Tags</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow-2xl rounded-lg">
                <a href="{{ route('categories.index') }}"
                    class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </a>
                <div>
                    <span class="block text-2xl font-bold">{{ $categoriesCount }}</span>
                    <span class="block text-gray-500">Categories</span>
                </div>
            </div>
        </section>
        <canvas id="myChart" height="100px"></canvas>
    </main>
@endsection

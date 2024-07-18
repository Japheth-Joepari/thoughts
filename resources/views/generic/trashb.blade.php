 <div class=" cntn lg:w-1/4 md:w-2/4 sm:w-full">

     <!-- ✅ Form Starts Here 👇 -->
     <div class="p-10 shadow-xl ">
         {{-- <img src="{{ asset('/images/logo1.png') }}" alt="" srcset="" class="hidden sm:block"> --}}

         <h3 class="font-bold text-3xl mb-7 text-center">✅ Sign Up</h3>

         <form class="" method="POST" action="{{ route('register') }}">
             @csrf

             <div class=" gap-10">
                 <div class="flex-col  w-full  mb-5">
                     <input type="text" name="name" id="name"
                         class=" w-full py-2 pl-2 @error('name') is-invalid @enderror" placeholder="Full Name"
                         value="{{ old('name') }}" />
                     @error('name')
                         <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                             <strong>{{ $message }}</strong>
                         </div>
                     @enderror
                 </div>

                 <div class="flex-col  mb-5">
                     <input type="text" name="email" id="email"
                         class=" py-2 pl-2  w-full  @error('email') is-invalid @enderror" placeholder="Email"
                         value="{{ old('email') }}" />
                     @error('email')
                         <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                             <strong>{{ $message }}</strong>
                         </div>
                     @enderror
                 </div>

                 <div class="flex-col mb-5 ">
                     <input type="password" name="password" id="password"
                         class=" py-2 pl-2 w-full  @error('Password') is-invalid @enderror" placeholder="password" />
                     @error('password')
                         <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                             <strong>{{ $message }}</strong>
                         </div>
                     @enderror
                 </div>

                 <div class="flex-col  mb-5">
                     <input type="password" name="password_confirmation" id="password-confirm" class=" py-2 pl-2 w-full"
                         placeholder="Confirm Password" required autocomplete="new-password" />
                 </div>
             </div>

             <div class="flex-col justify-center mt-4">
                 <p class="text-center mb-2">Or Register with</p>
                 <div class="flex justify-center">
                     <a href="#" class="bg-red-500 p-3  m-2 rounded hover:bg-blue-700 text-white text-sm">
                         <i class="fab fa-google"></i>
                     </a>
                     <a href="#" class="bg-blue-600 p-3 m-2 rounded hover:bg-blue-800 text-white text-sm">
                         <i class="fab fa-facebook-f m-1"></i>
                     </a>
                     <a href="#" class="bg-black p-3 m-2 rounded hover:bg-gray-700 text-white text-sm">
                         <i class="fab fa-github"></i>
                     </a>
                 </div>
                 </p>
                 <div class="">
                     <a href="{{ route('login') }}" class="underline m-2 p-2">Already Have an account ?</a> <a
                         {{-- href="{{ route('login') }}" class="underline">Back to Home</a> --}} </div>
                 </div>
                 <button
                     class="text-lg font-semibold text-white w-full sm:w-3/4 sm:col-span-2 py-2 mt-2 hover:bg-teal-700">Create
                     account</button>
         </form>
     </div>
 </div>
 <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
 <script>
     kofiWidgetOverlay.draw('mohamedghulam', {
         'type': 'floating-chat',
         'floating-chat.donateButton.text': 'Buy me coffee',
         'floating-chat.donateButton.background-color': '#323842',
         'floating-chat.donateButton.text-color': '#fff'
     });
 </script>







 {{-- login --}}
 <div class=" cntn lg:w-1/4 md:w-2/4">

     <!-- ✅ Form Starts Here  👇 -->
     <div class="p-10 shadow-xl bg-white">
         {{-- <img src="{{ asset('/images/logo1.png') }}" alt="" srcset="" class="hidden sm:block"> --}}
         <h3 class="font-bold text-3xl mb-7"> ✅ Sign In</h3>

         <form class="bg-white w-full" method="POST" action="{{ route('login') }}">
             @csrf

             <div class=" gap-10 ">
                 <div class="flex-col mb-5 ">
                     <input type="text" name="email" id="email"
                         class="border-b border-gray-300 py-2 pl-2 @error('email') is-invalid @enderror md:w-full lg:w-full"
                         placeholder="Email" value="{{ old('email') }}" />
                     @error('email')
                         <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                             <strong>{{ $message }}</strong>
                         </div>
                     @enderror
                 </div>

                 <div class="flex-col mb-5">
                     <input type="password" name="password" id="password"
                         class="border-b border-gray-300 py-2 pl-2 md:w-full lg:w-full  @error('password') is-invalid @enderror"
                         placeholder="Password" />
                     @error('password')
                         <div class="mt-2 text-red-500 text-xs font-medium mt-2 block">
                             <strong>{{ $message }}</strong>
                         </div>
                     @enderror
                 </div>
             </div>

             <div class="flex-col justify-center mt-4">
                 <p class="text-center mb-2">Or Login using</p>
                 <div class="flex justify-center">
                     <a href="#" class="bg-red-500 p-3  m-2 rounded hover:bg-blue-700 text-white text-sm">
                         <i class="fab fa-google m-1"></i>
                     </a>
                     <a href="#" class="bg-blue-600 p-3 m-2 rounded hover:bg-blue-800 text-white text-sm">
                         <i class="fab fa-facebook-f m-1 "></i>
                     </a>
                     <a href="#" class="bg-black p-3 m-2 rounded hover:bg-gray-700 text-white text-sm">
                         <i class="fab fa-github m-1"></i>
                     </a>
                 </div>

             </div>
             <a href="{{ route('register') }}" class="underline">Don't have an account ?</a>
             <button
                 class="text-lg font-semibold text-white w-full sm:w-3/4 sm:col-span-2 py-2 mt-5 hover:bg-teal-700">Login
             </button>

         </form>
     </div>

     <!--   🛑 Form Ends Here  -->

 </div>

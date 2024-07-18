@extends('layouts.pageTemplate')
@section('content')
@section('connect-active', 'active')

<!-- site wrapper -->
<div class="site-wrapper">
    <div class="main-overlay"></div>



    <!-- page header -->
    <section class="single-cover2  data-bg-image" data-bg-image="{{ asset('images/contact.jpg') }}">

        <div class="container-xl">

            <div class="cover-content post">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">contact</a>
                        </li>

                    </ol>
                </nav>

                <!-- post header -->
                <div class="post-header">
                    <h1 class="title mt-0 mb-3">Contact Us </h1>
                    <button id="scroll-button" class="btn btn-light mt-2 scroll-button">Scroll down</button>
                </div>
            </div>

        </div>

    </section>


    <livewire:contact-us-form />


    <!-- footer -->
    <footer>
        <div class="container-xl" style="position: fixed">
            <div class="footer-inner">
                <div class="row d-flex align-items-center gy-4">
                    <!-- copyright text -->
                    <div class="col-md-4">
                        <span class="copyright">© 2023 Thoughts. Made with &#x1F493; by Japheth Joepari.</span>
                    </div>

                    <!-- social icons -->
                    <div class="col-md-4 text-center">
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/japhethjoepari/"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="https://twitter.com/Joepari_Codes"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/japheth_joepari/"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="https://medium.com/@jeffevurulobi"><i
                                        class="fab fa-medium"></i></a></li>
                            {{-- <li class="list-inline-item"><a href="index.html#"><i class="fab fa-youtube"></i></a> --}}
                            </li>
                        </ul>
                    </div>

                    <!-- go to top button -->
                    <div class="col-md-4">
                        <a href="index.html#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back
                            to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end site wrapper -->
@endsection

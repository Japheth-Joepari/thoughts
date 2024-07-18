<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" media="all">

    {{-- @vite(['public', 'public/js/app.js']) --}}

</head>

<body class="" style="background: #fff">
    <div id="particles-js"> </div>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script> --}}
    <script src="{{ asset('js/particles.js/particles.min.js') }}"></script>
    <div></div>
    <script type="text/javascript">
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: ["#2EB67D", "#ECB22E", "#E01E5B", "#36C5F0"]
                },
                shape: {
                    type: ["circle"],
                    stroke: {
                        width: 0,
                        color: "#fff"
                    },
                    polygon: {
                        nb_sides: 5
                    },
                    image: {
                        src: "https://cdn.freebiesupply.com/logos/large/2x/slack-logo-icon.png",
                        width: 100,
                        height: 100
                    }
                },
                opacity: {
                    value: 1,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 8,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 10,
                        size_min: 10,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#808080",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 5,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "grab"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 140,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    bubble: {
                        distance: 400,
                        size: 40,
                        duration: 2,
                        opacity: 8,
                        speed: 3
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 4
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });
    </script>

    <script defer src="{{ asset('js/app.js') }}"></script>

    @yield('content')
</body>

</html>

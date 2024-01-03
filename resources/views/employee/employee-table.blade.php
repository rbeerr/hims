<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Select Table</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.0.0/dist/full.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    {{-- Pusher --}}
    {{-- <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script> --}}
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>

<body class="flex flex-col items-center min-h-screen bg-gray-300 font-tahoma">
    {{-- Navigation Section --}}

    <div id="navbar" class="bg-green-800 navbar">
        <div class="flex-1">
            <img src="{{ asset('assets/header.png') }}" alt="Header" class="img-fluid" style="max-height: 80px;">
        </div>
        <div class="flex-none">

            <div class="dropdown dropdown-hover">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="rounded-full w-15">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="User Profile Picture"/>
                        @else
                            <img src="/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Default Image" />
                        @endif
                    </div>
                </label>
                <ul tabindex="0"
                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-15">
                    <li>
                        <button onclick="initializeClientDashboard()"
                        class="block w-full px-4 py-2 text-left text-black hover:bg-green-200 focus:outline-none">
                        Client Dashboard&#9656;
                    </button>
                    </li>
                    <li>
                        <button onclick="location.href='{{ route('employee.report') }}';"
                            class="block w-full px-4 py-2 text-left text-black hover:bg-green-200 focus:outline-none">
                            Reports&#9656;
                        </button>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 hover:bg-green-200">
                            @csrf
                            <button type="submit"
                                class="w-full text-left text-black focus:outline-none">Logout&#9656;</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="mr-20">
                <label tabindex="0"
                class="mr-2 text-xl text-white">{{ Auth::user()->name }}</label>
            </div>

        </div>
    </div>

    {{-- <nav id="navbar" class="absolute top-0 flex items-center justify-between w-full px-4 py-2 bg-green-800">
        <img src="{{ asset('assets/header.png') }}" alt="Header" class="img-fluid" style="max-height: 80px;">
        <div class="items-center mr-20 dropdown dropdown-hover">
            <label tabindex="0"
                class="mr-2 text-lg text-white underline cursor-pointer">{{ Auth::user()->name }}</label>
            <span class="text-white cursor-pointer">&#9662;</span>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-15">
                <li>
                    <button onclick="window.open('{{ route('client.dashboard') }}', '_blank');"
                            class="block w-full px-4 py-2 text-left text-black hover:bg-green-200 focus:outline-none">
                        Client Dashboard&#9656;
                    </button>
                </li>
                <li>
                    <button onclick="location.href='{{ route('employee.report') }}';"
                        class="block w-full px-4 py-2 text-left text-black hover:bg-green-200 focus:outline-none">
                        Reports&#9656;
                    </button>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 hover:bg-green-200">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-black focus:outline-none">Logout&#9656;</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav> --}}
    {{-- End of Navigation Section --}}


    <div id="contentDiv" class="flex flex-col items-center w-full mt-4">
        <div class="my-8">
            <p class="mb-4 text-4xl font-bold text-black ">Please select your table</p>
        </div>
        <div class="flex items-center justify-center">
            <div id="box1"
                class="mx-4 my-8 text-3xl text-green-700 transition duration-300 bg-white border border-gray-400 rounded-lg cursor-pointer box hover:bg-green-600 hover:text-white px-14 py-14">
                1
            </div>
            <div id="box2"
                class="mx-4 my-8 text-3xl text-green-700 transition duration-300 bg-white border border-gray-400 rounded-lg cursor-pointer box hover:bg-green-600 hover:text-white px-14 py-14">
                2
            </div>
            <div id="box3"
                class="mx-4 my-8 text-3xl text-green-700 transition duration-300 bg-white border border-gray-400 rounded-lg cursor-pointer box hover:bg-green-600 hover:text-white px-14 py-14">
                3
            </div>
            <div id="box4"
                class="mx-4 my-8 text-3xl text-green-700 transition duration-300 bg-white border border-gray-400 rounded-lg cursor-pointer box hover:bg-green-600 hover:text-white px-14 py-14">
                4
            </div>
        </div>
    </div>

    <script>
        // Nav Bar
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById('navbar');
            const contentDiv = document.getElementById('contentDiv');

            const navbarHeight = navbar.offsetHeight;
            contentDiv.style.marginTop = `${navbarHeight + 20}px`; // 20 is an additional margin for spacing
        });

        function initializeClientDashboard() {
            window.open('{{ route('client.dashboard') }}', '_blank');
        }

        const boxes = document.querySelectorAll('.box');

        boxes.forEach(box => {
            box.addEventListener('click', (event) => {
                const tableNumber = event.currentTarget.textContent.trim();

                switch (tableNumber) {
                    case "1":
                        window.location.href = `/employee-dashboard?table=${tableNumber}`;
                        break;
                    case "2":
                        window.location.href = `/employee-dashboard-2?table=${tableNumber}`;
                        break;
                    case "3":
                        window.location.href = `/employee-dashboard-3?table=${tableNumber}`;
                        break;
                    case "4":
                        window.location.href = `/employee-dashboard-4?table=${tableNumber}`;
                        break;
                    default:
                        // Handle other boxes if needed
                        break;
                }
            });
        });

    </script>

</body>

</html>

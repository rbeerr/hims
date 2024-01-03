<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Page</title>

    {{-- Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.0.0/dist/full.css" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    <style>
        .custom-hover:hover {
            background-color: #c7f3c0 !important;
            /* This is approximately the color for bg-green-200 */
        }
    </style>

    {{-- Pusher --}}
    {{-- <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script> --}}
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


</head>

<body class="flex items-center justify-center min-h-screen font-sans bg-gray-300">

    {{-- Navigation Section --}}
    <nav id="navbar" class="absolute top-0 flex items-center justify-between w-full px-4 py-2 bg-green-800">
        <img src="{{ asset('assets/header.png') }}" alt="Header" class="img-fluid" style="max-height: 80px;">
        <div class="mr-20 dropdown dropdown-hover">
            <label tabindex="0" class="text-xl text-white cursor-pointer">{{ Auth::user()->name }}</label>
            <span class="text-white cursor-pointer">&#9662;</span>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-15">
                <li>
                    <button onclick="location.href='{{ route('employee.table-selection') }}';"
                        class="block w-full px-4 py-2 text-left text-black hover:bg-green-200 focus:outline-none">
                        Back&#9656;
                    </button>
                </li>
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
    </nav>
    {{-- End of Navigation Section --}}

    {{-- Content Section --}}
    <div id="contentDiv" class="w-3/4 p-10 mt-4 bg-white shadow-lg rounded-xl">
        <h1 class="mb-6 text-2xl font-extrabold text-green-700 text-start">Table 1</h1>
        <form method="POST" action="{{ route('store.service.type') }}">
            @csrf
            {{-- Select type of operation --}}
            <table class="w-full text-center border-green-700 table-fixed">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-green-700 border-b-2 border-green-700">Service Type</th>
                        <th class="px-6 py-3 text-green-700 border-b-2 border-green-700">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4">
                            <select name="service_type"
                                class="w-full text-center border-green-500 input input-bordered input-success select select-success">
                                <option disabled selected>-- Select --</option>
                                <option>Certificate of Live Birth</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xl font-bold">
                                <button class="btn btn-base btn-success">Submit</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        {{-- end of operation --}}


        <table class="w-full text-center bg-gray-300 table-fixed">
            {{-- Get Next Number --}}
            <tbody>
                <tr>
                    <td class="flex items-center justify-center px-6 py-4 border-b border-gray-500">
                        <div
                            class="flex items-center justify-center w-32 h-32 text-xl font-bold bg-white border-2 border-green-500 rounded-lg">
                            {{ session('current_number', 1) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-500">
                        <form method="POST" action="{{ route('get-number') }}" class="inline-block">
                            @csrf
                            <button type="submit" class="btn btn-base btn-success">Place Number</button>
                        </form>
                        <form method="POST" action="{{ route('reset-number') }}" class="inline-block ml-2">
                            @csrf
                            <button type="submit" class="btn btn-base btn-error">Reset Number</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            {{-- end get next number --}}

            {{-- Recall Number --}}
            <tbody>
                <tr>
                    <td class="p-12 px-6">
                        <form method="POST" action="{{ route('recall-number') }}" class="inline-block">
                            @csrf
                            <div class="text-xl font-bold">
                                <input type="number" min="1" max="25" name="recalled_number"
                                    placeholder="-- Type here --"
                                    class="w-full max-w-xs text-center input input-bordered input-success" />
                                <button type="submit" class="mt-4 btn btn-base btn-success">Recall Number</button>
                            </div>
                        </form>
                    </td>
                    <td class="px-6">
                        <form method="POST" action="{{ route('reset-recall-number') }}" class="inline-block ml-2">
                            @csrf
                            <button type="submit" class="btn btn-base btn-error">Reset Number</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            {{-- end recall number --}}
        </table>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById('navbar');
            const contentDiv = document.getElementById('contentDiv');

            const navbarHeight = navbar.offsetHeight;
            contentDiv.style.marginTop = `${navbarHeight + 20}px`; // 20 is an additional margin for spacing
        });

        function initializeClientDashboard() {
            window.open('{{ route('client.dashboard') }}', '_blank');
        }
    </script>
</body>

</html>

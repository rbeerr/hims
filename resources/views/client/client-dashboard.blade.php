<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Client Dashboard</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    <style>
    </style>

    {{-- Pusher --}}
    {{-- <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script> --}}
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</head>

<body class="min-h-screen font-sans bg-gray-300">
    <!-- Nav part -->
    <nav class="px-4 py-2 bg-green-800 shadow-sm navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="items-start navbar-brand d-block">
                <img src="{{ asset('assets/header.png') }}" alt="Header" class="img-fluid" style="max-height: 80px;">
            </a>
            <div class="ml-auto text-gray-300 mt-9">
                <small class="block">Credits: Gutera R. and Menor A.</small>
            </div>
        </div>
    </nav>
    

    <div class="text-black">
        <table class="w-full mx-auto border-collapse">
            <!-- row 1 -->
            <tr>
                <!-- Table 1 -->
                <td class="p-0">
                    <div class="flex flex-row items-start justify-between bg-green-500 border shadow-lg">
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Current Number Card -->
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 300px; height: 323px;">
                                <h3
                                    class="flex items-center mb-12 text-4xl font-extrabold text-center text-green-800 mt">
                                    Now Serving <br> Please come inside.</h3>
                                <span id="current-number"
                                    class="font-bold text-green-800 text-9xl">{{ $initialNumber ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center w-1/2 p-0">
                            <!-- Recall Number Card -->
                            <h3 class="mt-1 mb-2 text-5xl font-semibold text-white">Table 1</h3>
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 200px; height: 200px; padding: 16px;">
                                <marquee behavior="alternate">
                                    <h3 class="mb-2 text-xl font-semibold text-red-500">Recall Number</h3>
                                </marquee>

                                <span id="recalled-number"
                                    class="font-bold text-red-500 text-7xl">{{ $initialRecallNumber ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- Table 2 -->
                <td class="p-0">
                    <div class="flex flex-row items-start justify-between bg-blue-500 border shadow-lg">
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Current Number Card -->
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 300px; height: 323px;">
                                <h3 class="flex items-center mb-12 text-4xl font-extrabold text-center text-blue-800">
                                    Now Serving <br> Please come inside.</h3>
                                <span id="current-number-2"
                                    class="font-bold text-blue-800 text-9xl">{{ $initialNumber2 ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Recall Number Card -->
                            <h3 class="mb-2 text-5xl font-semibold text-white">Table 2</h3>
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 200px; height: 200px; padding: 16px;">
                                <marquee behavior="alternate">
                                    <h3 class="mb-2 text-xl font-semibold text-red-500">Recall Number</h3>
                                </marquee>
                                <span id="recalled-number-2"
                                    class="font-bold text-red-500 text-7xl">{{ $initialRecallNumber2 ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <!-- row 2 -->
            <tr>
                <!-- Courtesy/Priority Lane -->
                <td class="p-0">
                    <div class="flex flex-row items-start justify-between bg-yellow-500 border shadow-lg">
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Current Number Card -->
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 300px; height: 323px;">
                                <h3 class="flex items-center mb-12 text-4xl font-extrabold text-center text-yellow-800">
                                    Now Serving <br> Please come inside.</h3>
                                <span id="current-number-4"
                                    class="font-bold text-yellow-800 text-9xl">{{ $initialNumber3 ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Recall Number Card -->
                            <h3 class="mt-1 mb-2 text-5xl font-semibold text-white">Priority Lane</h3>
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 200px; height: 200px; padding: 16px;">
                                <marquee behavior="alternate">
                                    <h3 class="mb-2 text-xl font-semibold text-red-500">Recall Number</h3>
                                </marquee>
                                <span id="recalled-number-4"
                                    class="font-bold text-red-500 text-7xl">{{ $initialRecallNumber3 ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- Table 3 -->
                <td class="p-0">
                    <div class="flex flex-row items-start justify-between bg-pink-500 border shadow-lg">
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Current Number Card -->
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 300px; height: 323px;">
                                <h3 class="flex items-center mb-12 text-4xl font-extrabold text-center text-pink-800">
                                    Now Serving <br> Please come inside.</h3>
                                <span id="current-number-3"
                                    class="font-bold text-pink-800 text-9xl">{{ $initialNumber4 ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center w-1/2 p-1">
                            <!-- Recall Number Card -->
                            <h3 class="mb-2 text-5xl font-semibold text-white">Table 3</h3>
                            <div class="flex flex-col items-center justify-center bg-white border"
                                style="width: 200px; height: 200px; padding: 16px;">
                                <marquee behavior="alternate">
                                    <h3 class="mb-2 text-xl font-semibold text-red-500">Recall Number</h3>
                                </marquee>
                                <span id="recalled-number-3"
                                    class="font-bold text-red-500 text-7xl">{{ $initialRecallNumber4 ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    
            </tr>
        </table>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get Number Sound
            function playNumberChangeSound() {
                const sound = document.getElementById('numberChangeSound');
                sound.play();
            }

            function playNumberChangeSound_2() {
                const sound_2 = document.getElementById('numberChangeSound_2');
                sound_2.play();
            }

            function playNumberChangeSound_3() {
                const sound_3 = document.getElementById('numberChangeSound_3');
                sound_3.play();
            }

            function playNumberChangeSound_4() {
                const sound_4 = document.getElementById('numberChangeSound_4');
                sound_4.play();
            }

            // Recall Number Sound
            function playRecallChangeSound() {
                const sound = document.getElementById('recallChangeSound');
                sound.play();
            }

            function playRecallChangeSound_2() {
                const sound_2 = document.getElementById('recallChangeSound_2');
                sound_2.play();
            }

            function playRecallChangeSound_3() {
                const sound_3 = document.getElementById('recallChangeSound_3');
                sound_3.play();
            }

            function playRecallChangeSound_4() {
                const sound_4 = document.getElementById('recallChangeSound_4');
                sound_4.play();
            }

            // Listener for Queue 1
            window.Echo.channel("number-updated").listen(".App\\Events\\NumberUpdated", (e) => {
                document.getElementById('current-number').innerText = e.queueNumber;
                playNumberChangeSound(); // Play the sound
            });

            // Listener for Recall Number for Queue 1
            window.Echo.channel("number-recalled").listen(".App\\Events\\NumberRecalled", (e) => {
                document.getElementById('recalled-number').innerText = e.recalledNumber;
                playRecallChangeSound();
            });

            // Listener for Queue 2
            window.Echo.channel("number-updated-2").listen(".App\\Events\\NumberUpdated2", (e) => {
                document.getElementById('current-number-2').innerText = e.queueNumber2;
                playNumberChangeSound_2(); // Play the sound
            });

            // Listener for Recall Number for Queue 2
            window.Echo.channel("number-recalled-2").listen(".App\\Events\\NumberRecalled2", (e) => {
                document.getElementById('recalled-number-2').innerText = e.recalledNumber2;
                playRecallChangeSound_2();
            });

            // Listener for Queue 3
            window.Echo.channel("number-updated-3").listen(".App\\Events\\NumberUpdated3", (e) => {
                document.getElementById('current-number-3').innerText = e.queueNumber3;
                playNumberChangeSound_3(); // Play the sound
            });

            // Listener for Recall Number for Queue 3
            window.Echo.channel("number-recalled-3").listen(".App\\Events\\NumberRecalled3", (e) => {
                document.getElementById('recalled-number-3').innerText = e.recalledNumber3;
                playRecallChangeSound_3();
            });

            // Listener for Queue 4
            window.Echo.channel("number-updated-4").listen(".App\\Events\\NumberUpdated4", (e) => {
                document.getElementById('current-number-4').innerText = e.queueNumber4;
                playNumberChangeSound_4(); // Play the sound
            });

            // Listener for Recall Number for Queue 4
            window.Echo.channel("number-recalled-4").listen(".App\\Events\\NumberRecalled4", (e) => {
                document.getElementById('recalled-number-4').innerText = e.recalledNumber4;
                playRecallChangeSound_4();
            });
        });
    </script>

    <audio id="numberChangeSound" src="{{ asset('assets/click-sound.mp3') }}" preload="auto"></audio>
    <audio id="numberChangeSound_2" src="{{ asset('assets/click-sound.mp3') }}" preload="auto"></audio>
    <audio id="numberChangeSound_3" src="{{ asset('assets/click-sound.mp3') }}" preload="auto"></audio>
    <audio id="numberChangeSound_4" src="{{ asset('assets/click-sound.mp3') }}" preload="auto"></audio>

    <audio id="recallChangeSound" src="{{ asset('assets/recall-sound.mp3') }}" preload="auto"></audio>
    <audio id="recallChangeSound_2" src="{{ asset('assets/recall-sound.mp3') }}" preload="auto"></audio>
    <audio id="recallChangeSound_3" src="{{ asset('assets/recall-sound.mp3') }}" preload="auto"></audio>
    <audio id="recallChangeSound_4" src="{{ asset('assets/recall-sound.mp3') }}" preload="auto"></audio>
</body>

</html>

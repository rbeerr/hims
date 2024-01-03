<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Report Page</title>

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

    {{-- Contents --}}
    <div id="contentDiv" class="container w-full p-4 mx-auto mt-4 bg-gray-200 rounded shadow-lg">

        <div class="flex justify-between mt-4">
            <h2 class="items-start mb-4 text-2xl font-bold text-green-500">REPORTS</h2>
            <button class="btn btn-outline btn-error btn-sm" id="clearFilter">Clear Form</button>
        </div>

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <!-- Start of the form -->
        {{-- Filter --}}
        <form method="POST" action="{{ route('generate-report') }}">
            @csrf
            <div class="flex flex-wrap items-center justify-center mb-2 space-x-4">
                <h2 class="ml-2 font-semibold text-md">Filter:</h2>
                <select name="recordDisplayType" id="recordDisplayType"
                    class="w-full max-w-xs px-2 py-2 text-center border border-green-500 rounded outline-none focus:border-green-500">
                    <option disabled selected>--Select--</option>
                    <option value="breakdown">Break Down of Records</option>
                    <option value="total">Total of Records (By services)</option>
                </select>

                <h2 class="font-semibold text-md">Table:</h2>
                <select name="table" id="tableSelect"
                    class="w-full max-w-xs px-2 py-2 text-center border border-green-500 rounded outline-none focus:border-green-500">
                    <option disabled selected>--Select--</option>
                    <option value="Table 1">Table 1</option>
                    <option value="Table 2">Table 2</option>
                    <option value="Table 3">Table 3</option>
                    <option value="Courtesy/Priority Lane">Courtesy/Priority Lane</option>
                </select>

                <h2 class="font-semibold text-md">Type of Service:</h2>
                <select name="service_type" id="serviceSelect"
                    class="w-full max-w-xs px-2 py-2 text-center border border-green-500 rounded outline-none focus:border-green-500">
                    <option disabled selected>--Select--</option>
                </select>
            </div>

            <div class="flex flex-wrap items-center justify-center mt-4 space-x-4">
                <h2 class="font-semibold text-md">Date Range:</h2>
                <h2 class="font-semibold text-md">From:</h2>
                <input type="date" name="startDate" id="startDate"
                    class="max-w-xs px-2 py-2 border border-green-500 rounded outline-none w-md focus:border-green-500">

                <h2 class="font-semibold text-md">To:</h2>
                <input type="date" name="endDate" id="endDate"
                    class="max-w-xs px-2 py-2 border border-green-500 rounded outline-none w-md focus:border-green-500">
                <button type="submit" id="submitBtn" disabled class="btn btn-success btn-sm">Submit</button>

            </div>
        </form>
        {{-- End of the form --}}

        {{-- Display Reports --}}
        @if ($reports->count())
            {{-- Generated Reports Table --}}
            <div class="mt-8 overflow-x-auto">
                <table class="w-full text-center border-collapse table-fixed">
                    <thead class="bg-green-800">
                        <tr>
                            <th class="px-6 py-3 text-white border-b-2 border-r border-green-700">
                                Service Type</th>
                            @if ($recordDisplayType === 'total')
                                <th class="px-6 py-3 text-white border-b-2 border-green-700">Total</th>
                            @else
                                <th
                                    class="px-6 py-3 text-white border-b-2 border-r border-green-700">
                                    Table Number</th>
                                <th class="px-6 py-3 text-white border-b-2 border-green-700">Operation Timestamp
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-200' : 'bg-white' }}">
                                <td class="px-6 py-4 border-r border-gray-400">{{ $report->service_type }}</td>
                                @if ($recordDisplayType === 'total')
                                    <td class="px-6 py-4">{{ $report->total }}</td>
                                @else
                                    <td class="px-6 py-4 border-r border-gray-400">{{ $report->table_number }}</td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($report->operation_timestamp)->format('F j, Y | g:i A') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- End Generate Reports --}}


            <!-- Pagination -->
            <div class="mt-8 text-center">
                {{ $reports->links() }}
            </div>
        @endif
    </div>

    <script>
        // Nagivation
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById('navbar');
            const contentDiv = document.getElementById('contentDiv');

            const navbarHeight = navbar.offsetHeight;
            contentDiv.style.marginTop = `${navbarHeight + 20}px`; // 20 is an additional margin for spacing
        });

        // Reset the form fields
        document.getElementById('clearFilter').addEventListener('click', function() {
            document.getElementById('tableSelect').value = '--Select--';
            document.getElementById('serviceSelect').value = '';
            document.getElementById('serviceSelect').disabled = true;
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';

            // Refresh the page to remove the filters
            window.location.href =
                "{{ route('employee.report.index') }}";
        });

        // Disable the button when Filter is not selected
        document.addEventListener("DOMContentLoaded", function() {
            const recordDisplayType = document.getElementById('recordDisplayType');
            const submitBtn = document.getElementById('submitBtn');

            recordDisplayType.addEventListener('change', function() {
                if (this.value === 'breakdown' || this.value === 'total') {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            });
        });

        // Service Type
        document.addEventListener("DOMContentLoaded", function() {
            const tableSelect = document.getElementById('tableSelect');
            const serviceSelect = document.getElementById('serviceSelect');

            // Initially disable the serviceSelect dropdown
            serviceSelect.disabled = true;

            tableSelect.addEventListener('change', function() {
                const services = {
                    'Table 1': ['Certificate of Live Birth'],
                    'Table 2': ['Death Certificate', 'Medico-Legal Certificate', 'WCPU',
                        'ECG/EEG/EMG Result', 'Others'
                    ],
                    'Table 3': ['Medical Certificate', 'Medical Abstract',
                        'Certificate of On-going Treatment (PCSO)', 'Certification',
                        'X-ray, 2-D Echo, CT Scan, Ultrasound, Lab. Result', 'Insurance Claim',
                        'Certified True Copy (CTC)'
                    ],
                    'Courtesy/Priority Lane': ['Senior Citizen', 'Person with Disability (PWD)',
                        'Pregnant Women', 'Certificate of Live Birth'
                    ]
                };

                serviceSelect.innerHTML = '<option disabled selected>--Select--</option>';
                let options = services[tableSelect.value];
                if (options) {
                    options.forEach(function(option) {
                        let optElem = document.createElement('option');
                        optElem.textContent = option;
                        optElem.value = option;
                        serviceSelect.appendChild(optElem);
                    });
                    // Enable the serviceSelect dropdown when a table is selected
                    serviceSelect.disabled = false;
                } else {
                    // Disable the serviceSelect dropdown when no table is selected
                    serviceSelect.disabled = true;
                }
            });
        });
        // End Service Type
    </script>
</body>

</html>

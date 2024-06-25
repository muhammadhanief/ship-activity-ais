{{-- <button wire:click='testDispatch' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Red</button>
    <button wire:click='dd' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">dd</button> --}}
<x-card class="w-full">
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900 ">Kapal Masuk-Keluar Pelabuhan
                Indonesia</span>
            {{-- <h3 class="text-base font-normal text-gray-500">Sales this week</h3> --}}
        </div>
        <div class="flex flex-wrap items-center justify-start flex-1 gap-2 text-base font-bold text-green-500">
            {{-- dropdown kapal --}}
            <div class="relative dropdown-kapal">
                <button id="dropdownSearchButtonKapal" data-dropdown-toggle="dropdownSearchKapal"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchKapal');">
                    Kapal
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchKapal"
                    class="absolute right-0 z-20 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200">
                        @foreach ($kapalOptions as $kapalOption)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedKapal' id="kapal-{{ $loop->index }}"
                                        type="checkbox" value="{{ $kapalOption }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="kapal-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $kapalOption }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end kapal --}}
            {{-- Dropdown selectedPendekatan --}}
            <div class="relative dropdown-pendekatan">
                <button id="dropdownSearchButtonPendekatan" data-dropdown-toggle="dropdownSearchPendekatan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPendekatan');">
                    Pendekatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPendekatan"
                    class="absolute right-0 z-20 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200">
                        @foreach ($pendekatanOptions as $pendekatanOption)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live="selectedPendekatan" id="pendekatan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $pendekatanOption }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pendekatan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $pendekatanOption }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- End Dropdown selectedPendekatan --}}
            {{-- dropdown pelabuhan --}}
            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPelabuhan');">
                    Pelabuhan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPelabuhan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li>
                            <div
                                class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input wire:model.live='selectAllPelabuhan' id="selectAllPelabuhan" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="selectAllPelabuhan"
                                    class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                    semua</label>
                            </div>
                        </li>
                        @foreach ($pelabuhanOptions as $pelabuhanOption)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectedPelabuhan' id="pelabuhan-{{ $loop->index }}"
                                        type="checkbox" value="{{ $pelabuhanOption }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="pelabuhan-{{ $loop->index }}"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $pelabuhanOption }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end pelabuhan --}}
        </div>
    </div>
    <div wire:ignore>
        <div id="fig-chart311"></div>
    </div>
    @script
        <script>
            // dropdown aja
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
                dropdownButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const dropdownId = button.getAttribute('data-dropdown-toggle');
                        const dropdown = document.getElementById(dropdownId);

                        // Tutup semua dropdown yang sedang terbuka
                        const allDropdowns = document.querySelectorAll('[data-dropdown]');
                        allDropdowns.forEach(dropdown => {
                            if (dropdown !== document.getElementById(dropdownId)) {
                                dropdown.classList.add('hidden');
                            }
                        });

                        // Toggle dropdown yang saat ini diklik
                        dropdown.classList.toggle('hidden');
                    });
                });
            });

            // Declare chart2 in the global scope
            window.chart311 = null;

            const options = {
                chart: {
                    height: 420,
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    foreColor: "#6B7280",
                    toolbar: {
                        show: true,
                    },
                },
                stroke: {
                    curve: 'straight',
                },
                fill: {
                    type: "solid",
                    opacity: 0,
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    style: {
                        fontSize: "14px",
                        fontFamily: "Inter, sans-serif",
                    },
                },
                grid: {
                    show: false,
                },
                series: [{
                    name: "Revenue",
                    data: [6356, 6218, 6156, 6526, 6356, 6256, 6056],
                    color: "#0694a2",
                }, ],
                xaxis: {
                    categories: [
                        "01 Feb",
                        "02 Feb",
                        "03 Feb",
                        "04 Feb",
                        "05 Feb",
                        "06 Feb",
                        "07 Feb",
                    ],
                    labels: {
                        style: {
                            colors: ["#6B7280"],
                            fontSize: "14px",
                            fontWeight: 500,
                        },
                    },
                    axisBorder: {
                        color: "#F3F4F6",
                    },
                    axisTicks: {
                        color: "#F3F4F6",
                    },
                    title: { // Menambahkan title pada sumbu X
                        text: "Bulan",
                        style: {
                            // color: "Black",
                            // fontSize: "16px",
                            fontWeight: 400,
                        },
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: ["#6B7280"],
                            fontSize: "14px",
                            fontWeight: 500,
                        },
                        formatter: function(value) {
                            return value;
                        },
                    },
                    title: { // Menambahkan title pada sumbu X
                        text: "Jumlah Kapal",
                        style: {
                            // color: "Black",
                            // fontSize: "16px",
                            fontWeight: 400,
                        },
                    },
                },
                responsive: [{
                    breakpoint: 1024,
                    options: {
                        xaxis: {
                            labels: {
                                show: false,
                            },
                        },
                    },
                }, ],
            };

            if (
                document.getElementById("fig-chart311") &&
                typeof ApexCharts !== "undefined"
            ) {
                window.chart311 = new ApexCharts(
                    document.getElementById("fig-chart311"),
                    options
                );
                window.chart311.render();
            }


            $wire.on('chart311Update', (dataPie) => {
                const monthsOrder = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ];

                // Sort function to order by months
                const sortByMonth = (a, b) => {
                    return monthsOrder.indexOf(a.x.trim()) - monthsOrder.indexOf(b.x.trim());
                };

                // Combine kapal_masuk and kapal_keluar with their respective categories
                let combinedData = dataPie[0].original.kapal_masuk.map((item, index) => ({
                    x: item.x.trim(),
                    kapal_masuk: item.y,
                    kapal_keluar: dataPie[0].original.kapal_keluar[index].y
                }));

                // Sort combined data by month
                combinedData.sort(sortByMonth);

                // Separate sorted data
                let kapalMasuk = combinedData.map(item => item.kapal_masuk);
                let kapalKeluar = combinedData.map(item => item.kapal_keluar);
                let categories = combinedData.map(item => item.x);

                // console.log(categories);

                if (window.chart311) {
                    window.chart311.updateSeries([{
                            name: 'Kapal Masuk',
                            data: kapalMasuk,
                            color: '#45C8FF'
                        },
                        {
                            name: 'Kapal Keluar',
                            data: kapalKeluar,
                            color: '#544FC5'
                        }
                    ]);
                    window.chart311.updateOptions({
                        xaxis: {
                            categories: categories
                        }
                    });
                }
            });
        </script>
    @endscript
</x-card>

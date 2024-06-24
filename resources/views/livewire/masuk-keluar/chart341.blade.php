<x-card class="w-full">
    {{-- <button wire:click='testDispatch' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Red</button>
    <button wire:click='dd' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">dd</button> --}}
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900 ">Kapal Masuk-Keluar Pelabuhan Indonesia Menurut
                Tipe Kapal</span>
            {{-- <h3 class="text-base font-normal text-gray-500">Sales this week</h3> --}}
        </div>
        <div class="flex items-center justify-start flex-1 text-base font-bold text-green-500 gap-x-2">
            {{-- dropdown kapal --}}
            <div class="relative dropdown-kapal">
                <button id="dropdownSearchButtonKapal6" data-dropdown-toggle="dropdownSearchKapal6"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchKapal6');">
                    Kapal
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchKapal6"
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
                <button id="dropdownSearchButtonPendekatan6" data-dropdown-toggle="dropdownSearchPendekatan6"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPendekatan6');">
                    Pendekatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPendekatan6"
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
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan6"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPelabuhan6');">
                    Pelabuhan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPelabuhan6"
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
        <div id="fig-chart341"></div>
    </div>
    @script
        <script>
            window.chart341 = null;
            chart341 = Highcharts.chart('fig-chart341', {
                chart: {
                    type: 'column'
                },
                exporting: { // Menambahkan opsi export
                    enabled: true, // Aktifkan tombol export
                    buttons: {
                        contextButton: {
                            text: 'Unduh' // Text tombol export
                        }
                    }
                },
                title: {
                    text: null,
                    // align: 'left'
                },
                xAxis: {
                    categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    },
                    title: {
                        text: 'Negara'
                    }
                },

                yAxis: {
                    min: 0,
                    title: {
                        text: 'Banyak Kapal'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Corn',
                        data: [406292, 260000, 107000, 68300, 27500, 14500]
                    },
                    {
                        name: 'Wheat',
                        data: [51086, 136000, 5500, 141000, 107180, 77000]
                    },
                    {
                        name: 'Rice',
                        data: [20100, 20000, 10000, 10000, 10000, 10000]
                    }
                ]
            });

            $wire.on('chart341Update', (data) => {
                const monthsOrder = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ];

                // Sort function to order by months
                const sortByMonth = (a, b) => {
                    return monthsOrder.indexOf(a.x.trim()) - monthsOrder.indexOf(b.x.trim());
                };

                // Combine data_bps, prediksi, and selisih with their respective categories
                let combinedData = data[0].categories.map((item, index) => ({
                    x: item.trim(),
                    data_bps: data[0].series[0].data[index],
                    prediksi: data[0].series[1].data[index],
                    selisih: data[0].series[2].data[index]
                }));

                // Sort combined data by month
                combinedData.sort(sortByMonth);

                // Separate sorted data
                let categories = combinedData.map(item => item.x);
                let dataBps = combinedData.map(item => item.data_bps);
                let prediksi = combinedData.map(item => item.prediksi);
                let selisih = combinedData.map(item => item.selisih);

                const chart = window.chart341; // Mengakses grafik yang ada
                if (chart) {
                    chart.update({
                        title: {
                            text: 'Interpretasi Selisih dari Dua Line Chart'
                        },
                        xAxis: {
                            categories: categories
                        },
                        yAxis: {
                            title: {
                                text: 'Banyak Kapal'
                            }
                        },
                        series: [{
                            name: 'Selisih',
                            type: 'column',
                            data: selisih
                        }, {
                            name: 'Data BPS',
                            type: 'line',
                            data: dataBps
                        }, {
                            name: 'Prediksi',
                            type: 'line',
                            data: prediksi
                        }]
                    });
                }
            });
        </script>
    @endscript
</x-card>

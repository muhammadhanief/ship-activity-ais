<x-card class="w-ful">
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
            {{-- Dropdown selectedPendekatan --}}
            <div class="relative dropdown-pendekatan">
                <button id="dropdownSearchButtonPendekatan5" data-dropdown-toggle="dropdownSearchPendekatan5"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPendekatan5');">
                    Pendekatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPendekatan5"
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
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan5"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPelabuhan5');">
                    Pelabuhan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPelabuhan5"
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
        <div id="fig-chart331"></div>
    </div>
    @script
        <script>
            window.chart331 = null;
            chart331 = Highcharts.chart('fig-chart331', {
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
                    }
                ]
            });

            $wire.on('chart331Update', (data) => {
                // console.log(data); // Memastikan data yang diterima sesuai
                const chart = window.chart331; // Mengakses grafik yang ada
                if (chart) {
                    const chartData = data[0]; // Mengambil data pertama dari array data

                    // Memperbarui grafik dengan kategori dan data series baru
                    chart.update({
                        xAxis: {
                            categories: chartData.categories // Mengupdate kategori pada sumbu x
                        },
                        series: chartData.series // Mengupdate data series
                    }, true, true);
                }
            });
        </script>
    @endscript
</x-card>

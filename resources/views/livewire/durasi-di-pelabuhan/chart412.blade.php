<x-card class="w-full">
    {{-- <button wire:click='testDispatch' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Red</button>
    <button wire:click='dd' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">dd</button> --}}
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900 ">Mean Durasi Kapal di Pelabuhan
                Indonesia Negara Asal</span>
            {{-- <h3 class="text-base font-normal text-gray-500">Sales this week</h3> --}}
        </div>
        <div class="flex flex-wrap items-center justify-start flex-1 gap-2 text-base font-bold text-green-500">
            {{-- Dropdown selectedPendekatan --}}
            <div>
                <div class="relative dropdown-pendekatan">
                    <button id="dropdownSearchButtonPendekatan2" data-dropdown-toggle="dropdownSearchPendekatan2"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchPendekatan2');">
                        Pendekatan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div wire:ignore id="dropdownSearchPendekatan2"
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
            </div>
            {{-- End Dropdown selectedPendekatan --}}

            {{-- dropdown satuan --}}
            <div>
                <div class="relative dropdown-satuan">
                    <button id="dropdownSearchButtonSatuan2" data-dropdown-toggle="dropdownSearchSatuan2"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchSatuan2');">
                        Satuan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div wire:ignore id="dropdownSearchSatuan2"
                        class="absolute right-0 z-20 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownSearchButtonSatuan2">
                            @foreach ($satuanOptions as $satuanOption)
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input wire:model.live='selectedSatuan' id="satuan-{{ $loop->index }}"
                                            type="checkbox" value="{{ $satuanOption }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="satuan-{{ $loop->index }}"
                                            class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $satuanOption }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- end satuan --}}


            {{-- dropdown pelabuhan --}}
            <div>
                <div class="relative dropdown-pelabuhan">
                    <button id="dropdownSearchButtonPelabuhan2" data-dropdown-toggle="dropdownSearchPelabuhan2"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchPelabuhan2');">
                        Pelabuhan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div wire:ignore id="dropdownSearchPelabuhan2"
                        class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownSearchButtonPelabuhan2">
                            <li>
                                <div
                                    class="flex items-center p-2 font-bold rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input wire:model.live='selectAllPelabuhan' id="selectAllPelabuhan2" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="selectAllPelabuhan2"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                        semua</label>
                                </div>
                            </li>
                            @foreach ($pelabuhanOptions as $pelabuhanOption)
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input wire:model.live='selectedPelabuhan' id="pelabuhan-{{ $loop->index }}2"
                                            type="checkbox" value="{{ $pelabuhanOption }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="pelabuhan-{{ $loop->index }}2"
                                            class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $pelabuhanOption }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- end pelabuhan --}}
        </div>
    </div>
    <div wire:ignore>
        <div id="fig-chart412"></div>
    </div>
    @script
        <script>
            window.chart412 = Highcharts.chart('fig-chart412', {
                chart: {
                    type: 'column' // Mengubah tipe chart menjadi column untuk diagram batang
                },
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            text: 'Unduh'
                        }
                    }
                },
                title: {
                    text: null // Judul diagram batang
                },
                xAxis: {
                    categories: ['A', 'B', 'C', 'D', 'E', 'F'], // Kategori untuk sumbu X
                    title: {
                        text: 'Kategori' // Label sumbu X
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nilai' // Label sumbu Y
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: { // Menggunakan plotOptions column untuk diagram batang
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Series 1', // Nama series pertama
                        data: [500, 700, 600, 800, 900, 700] // Data dummy untuk series pertama
                    },
                    {
                        name: 'Series 2', // Nama series kedua
                        data: [300, 400, 350, 500, 600, 450] // Data dummy untuk series kedua
                    }
                ]
            });
            $wire.on('chart412Update', (data) => {
                const categories = data[0].categories.map(item => item.trim());
                const medianDurasi = data[0].series[0].data.map(value => parseFloat(value).toFixed(2));
                const rataRataDurasi = data[0].series[1].data.map(value => parseFloat(value).toFixed(2));

                console.log(categories, medianDurasi, rataRataDurasi);

                const chart = window.chart412;
                if (chart) {
                    chart.update({
                        chart: {
                            type: 'column' // Mengubah tipe chart menjadi column
                        },
                        xAxis: {
                            categories: categories,
                            title: {
                                text: 'Negara' // Mengubah label sumbu X menjadi 'Negara'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Durasi' // Mengubah label sumbu Y menjadi 'Durasi'
                            }
                        },
                        series: [{
                            name: 'Median Durasi',
                            data: medianDurasi.map(val => parseFloat(val))
                        }, {
                            name: 'Rata-rata Durasi',
                            data: rataRataDurasi.map(val => parseFloat(val))
                        }]
                    }, true, true);
                }
            });
        </script>
    @endscript
</x-card>

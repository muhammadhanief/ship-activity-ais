<x-card class="w-full">
    {{-- <button wire:click='testDispatch' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Red</button>
    <button wire:click='dd' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">dd</button> --}}
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900 ">Mean & Median Durasi Kapal di Pelabuhan
                Indonesia</span>
            {{-- <h3 class="text-base font-normal text-gray-500">Sales this week</h3> --}}
        </div>
        <div class="flex flex-wrap items-center justify-start flex-1 gap-2 text-base font-bold text-green-500">
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

            {{-- dropdown satuan --}}
            <div class="relative dropdown-satuan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchSatuan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchSatuan');">
                    Satuan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchSatuan"
                    class="absolute right-0 z-50 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
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
            {{-- end satuan --}}

            {{-- dropdown pelabuhan --}}
            <div class="relative dropdown-pelabuhan">
                <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearchPelabuhan"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPelabuhan');">
                    Pelabuhan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 10">
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
        <div id="fig-chart411"></div>
    </div>
    @script
        <script>
            window.chart411 = null;
            chart411 = Highcharts.chart('fig-chart411', {
                chart: {
                    type: 'line' // Mengubah tipe chart menjadi line
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
                    text: null
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    crosshair: true,
                    accessibility: {
                        description: 'Months'
                    },
                    title: {
                        text: 'Bulan'
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
                    line: { // Mengubah plotOptions menjadi line
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Median Durasi', // Nama series pertama
                    data: [13571502, 12321645, 12605465, 12249744, 11007645, 11452866, 11139403, 12432799,
                        14435080, 12290764, 10471374, 12173490
                    ]
                }, {
                    name: 'Rata-rata Durasi', // Nama series kedua
                    data: [18078539, 16298260, 16528768, 16612998, 15203363, 15458641, 14771299, 16650381,
                        18346638, 16895679, 14647044, 16250160
                    ]
                }]
            });
            $wire.on('chart411Update', (data) => {


                // Mapping data categories ke bulan
                const monthOrder = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                // Mengurutkan data berdasarkan kategori bulan
                const sortedData = data[0].categories.map((month, index) => {
                    return {
                        month: month,
                        medianDurasi: data[0].medianDurasi[index],
                        rataRataDurasi: data[0].rataRataDurasi[index]
                    };
                }).sort((a, b) => monthOrder.indexOf(a.month) - monthOrder.indexOf(b.month));

                // Mendapatkan kembali kategori, medianDurasi, dan rataRataDurasi yang sudah diurutkan
                const categories = sortedData.map(item => item.month);
                const medianDurasi = sortedData.map(item => item.medianDurasi);
                const rataRataDurasi = sortedData.map(item => item.rataRataDurasi);

                // console.log(categories, medianDurasi, rataRataDurasi);
                const chart = window.chart411;
                if (chart) {
                    chart.update({
                        xAxis: {
                            categories: categories
                        },
                        series: [{
                            name: 'Median Durasi',
                            type: 'line',
                            data: medianDurasi
                        }, {
                            name: 'Rata-rata Durasi',
                            type: 'line',
                            data: rataRataDurasi
                        }],
                        tooltip: {
                            shared: true, // Mengaktifkan shared tooltip agar semua label ditampilkan
                            formatter: function() {
                                let tooltip = '<b>' + this.x +
                                    '</b><br/>'; // Menampilkan kategori saat dihover
                                this.points.forEach(function(point) {
                                    tooltip += point.series.name + ': ' + Highcharts.numberFormat(
                                            point.y, 0, ' ', ' ') +
                                        '<br>'; // Menampilkan nama series dan nilai dengan separator ribuan spasi
                                });
                                return tooltip;
                            }
                        }
                    });
                }
            });
        </script>
    @endscript
</x-card>

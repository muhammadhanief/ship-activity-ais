<x-card class="w-full">
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900">Kunjungan ke Luar Negeri Menurut Pelabuhan</span>
        </div>
        <div class="flex flex-wrap items-center justify-start flex-1 gap-2 text-base font-bold text-green-500">
            {{-- Dropdown selectedPendekatan --}}
            <div class="relative dropdown-pendekatan">
                <button id="dropdownSearchButtonPendekatan3" data-dropdown-toggle="dropdownSearchPendekatan3"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button" aria-haspopup="true" aria-expanded="false"
                    onclick="toggleDropdown('dropdownSearchPendekatan3');">
                    Pendekatan
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div wire:ignore id="dropdownSearchPendekatan3"
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
        </div>
    </div>
    <div wire:ignore>
        <div id="fig-chart522"></div>
    </div>
    @script
        <script>
            window.chart522 = Highcharts.chart('fig-chart522', {
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
                }, {
                    name: 'Series 2', // Nama series kedua
                    data: [300, 400, 350, 500, 600, 450] // Data dummy untuk series kedua
                }]
            });
            $wire.on('chart522Update', (data) => {
                const categories = data[0].categories.map(item => item.trim());

                const seriesData = data[0].series.map(series => ({
                    name: series.name,
                    type: series.type,
                    data: series.data.map(value => parseFloat(value)) // Mengubah nilai data menjadi float
                }));

                const chart = window.chart522;
                if (chart) {
                    chart.update({
                        chart: {
                            type: 'column' // Mengubah tipe chart menjadi column
                        },
                        xAxis: {
                            categories: categories,
                            title: {
                                text: 'Pelabuhan' // Mengubah label sumbu X menjadi 'Tipe Kapal'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Jumlah Kapal' // Mengubah label sumbu Y menjadi 'Durasi'
                            }
                        },
                        series: seriesData,
                        tooltip: {
                            shared: true // Menampilkan tooltip untuk kedua series saat dihover
                        }
                    });
                }
            });
        </script>
    @endscript
</x-card>

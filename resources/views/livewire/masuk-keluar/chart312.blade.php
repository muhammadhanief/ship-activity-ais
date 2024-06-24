<x-card class="w-full">
    {{-- <button wire:click='testDispatch' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Red</button>
    <button wire:click='dd' type="button"
        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">dd</button> --}}
    <div class="flex flex-col mb-4">
        <div class="flex-shrink-0 pb-2">
            <span class="text-xl font-bold leading-none text-gray-900 ">Kapal {{ $selectedMasukOrKeluar }} Pelabuhan
                Indonesia</span>
            {{-- <h3 class="text-base font-normal text-gray-500">Sales this week</h3> --}}
        </div>
        <div class="flex flex-wrap items-center justify-start flex-1 text-base font-bold text-green-500 gap-x-2 gap-y-2">
            {{-- dropdown masuk keluar --}}
            <div>
                <button id="dropdownDelayButton" data-dropdown-toggle="dropdownDelay" data-dropdown-delay="500"
                    data-dropdown-trigger="hover"
                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Arah Kapal <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownDelay"
                    class="absolute right-0 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-xs text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
                        @foreach ($masukOrKeluarOptions as $masukOrKeluarOption)
                            <li>
                                <a href="#" wire:click.prevent="selectMasukOrKeluar('{{ $masukOrKeluarOption }}')"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $masukOrKeluarOption }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- end dropdown masuk keluar --}}
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

            {{-- dropdown bulan --}}
            <div>
                <div class="relative dropdown-bulan">
                    <button id="dropdownSearchButtonBulan2" data-dropdown-toggle="dropdownSearchBulan2"
                        class="inline-flex items-center px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" aria-haspopup="true" aria-expanded="false"
                        onclick="toggleDropdown('dropdownSearchBulan2');">
                        Bulan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div wire:ignore id="dropdownSearchBulan2"
                        class="absolute right-0 z-20 hidden mt-2 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-xs text-gray-700 dark:text-gray-200">
                            @foreach ($bulanOptions as $bulanOption)
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input wire:model.live='selectedBulan' id="bulan-{{ $loop->index }}"
                                            type="checkbox" value="{{ $bulanOption }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="bulan-{{ $loop->index }}2"
                                            class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">{{ $bulanOption }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- end bulan --}}

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
                                    <input wire:model.live='selectAllPelabuhan' id="selectAllPelabuhan2"
                                        type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="selectAllPelabuhan2"
                                        class="w-full text-xs font-medium text-gray-900 rounded ms-2 dark:text-gray-300">Pilih
                                        semua</label>
                                </div>
                            </li>
                            @foreach ($pelabuhanOptions as $pelabuhanOption)
                                <li>
                                    <div
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input wire:model.live='selectedPelabuhan'
                                            id="pelabuhan-{{ $loop->index }}2" type="checkbox"
                                            value="{{ $pelabuhanOption }}"
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
        <div id="fig-chart312"></div>
    </div>
    @script
        <script>
            // dropdown aja
            // document.addEventListener('DOMContentLoaded', function() {
            //     const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
            //     dropdownButtons.forEach(button => {
            //         button.addEventListener('click', function() {
            //             const dropdownId = button.getAttribute('data-dropdown-toggle');
            //             const dropdown = document.getElementById(dropdownId);

            //             // Tutup semua dropdown yang sedang terbuka
            //             const allDropdowns = document.querySelectorAll('[data-dropdown]');
            //             allDropdowns.forEach(dropdown => {
            //                 if (dropdown !== document.getElementById(dropdownId)) {
            //                     dropdown.classList.add('hidden');
            //                 }
            //             });

            //             // Toggle dropdown yang saat ini diklik
            //             dropdown.classList.toggle('hidden');
            //         });
            //     });
            // });

            // Declare chart2 in the global scope
            window.chart312 = null;

            chart312 = Highcharts.chart('fig-chart312', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: null
                },
                tooltip: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '15px' // Ukuran font label
                            },
                            format: '<b>{point.name}</b>: {point.y:.2f}%'
                        }
                    }
                },
                exporting: { // Menambahkan opsi export
                    enabled: true, // Aktifkan tombol export
                    buttons: {
                        contextButton: {
                            text: 'Unduh' // Text tombol export
                        }
                    }
                },
                series: [{
                    name: 'Persentase',
                    data: [
                        ['Chrome', 30.0],
                        ['Firefox', 25.0],
                        ['Edge', 15.0],
                        ['Safari', 10.0],
                        ['Others', 20.0]
                    ]
                }]
            });


            $wire.on('chart312Update', (dataPie) => {
                // Mengakses objek chart
                // console.log(dataPie)
                var chart = window.chart312;

                // Mengambil data baru dari Livewire
                var newData = dataPie[0].chartData;

                // Memperbarui data pada series pertama
                chart.series[0].setData(newData);

            });
        </script>
    @endscript
</x-card>

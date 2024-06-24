<div class="px-4 pt-6">
    <x-slot:title>Perairan Indonesia</x-slot:title>
    <div class="flex flex-row justify-between gap-4">
        {{-- <div class="grid grid-cols-2 gap-4"> --}}
        {{-- <livewire:page1.chart12 /> --}}
        <!-- Contoh penggunaan di dalam Blade template -->
        <iframe src="{{ asset('components/visualization_movement_indo.html') }}" width="100%" height="600px"
            frameborder="0"></iframe>
    </div>
</div>

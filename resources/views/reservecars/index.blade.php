<x-main-layout title="ToloCars | See All Cars">
  <h2 class="text-3xl font-bold mb-10 text-center text-gray-900">Available Cars</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
    @foreach($reservecars as $reservecar)
      <div class="bg-white border border-black/10 shadow-sm hover:shadow-xl transition duration-300 ease-in-out flex flex-col">

        <div class="relative w-full h-56">
          <img 
            src="{{ Str::startsWith($reservecar->image, 'http') ? $reservecar->image : asset('storage/' . $reservecar->image) }}" 
            alt="{{ $reservecar->make }}" 
            class="w-full h-full object-cover"
          />

          @if(strtolower($reservecar->transmission) === 'manual')
            <span class="absolute top-3 right-3 bg-amber-700 text-white text-xs font-semibold px-3 py-1 uppercase tracking-wide shadow-md">
              Manual
            </span>
          @else
            <span class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 uppercase tracking-wide shadow-md">
              Automatic
            </span>
          @endif
        </div>

        <div class="p-5 flex flex-col flex-grow">

          <h3 class="text-lg font-semibold text-gray-900 mb-1">
            {{ $reservecar->make }} {{ $reservecar->model }}
          </h3>

          <div class="mb-3">
            <p class="text-[10px] uppercase tracking-wide text-gray-500 font-medium">Location</p>
            <p class="text-[#B4DD4E] text-sm">{{ $reservecar->location }}</p>
          </div>
          <div class="border-b border-gray-300 mb-3"></div>

          <div class="mb-3">
            <p class="text-[10px] uppercase tracking-wide text-gray-500 font-medium">Capacity</p>
            <p class="text-[#B4DD4E] text-sm">{{ $reservecar->capacity }} seats</p>
          </div>
          <div class="border-b border-gray-300 mb-3"></div>

          <div class="mb-3">
            <p class="text-[10px] uppercase tracking-wide text-gray-500 font-medium">Price per day</p>
            <p class="text-[#B4DD4E] font-semibold text-base">${{ $reservecar->price_per_day }}</p>
          </div>
          <div class="border-b border-gray-300 mb-4"></div>

          <a href="/reservecars/{{ $reservecar->id }}" 
             class="mt-auto w-full text-center bg-[#B4DD4E] text-white font-semibold py-2.5 hover:opacity-90 transition">
            See Availability
          </a>
        </div>

      </div>
    @endforeach
  </div>
</x-main-layout>
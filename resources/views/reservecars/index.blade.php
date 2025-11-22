<x-main-layout title="ToloCars | See All Cars">
    <h2 class="text-3xl font-bold mb-6 text-center">Available Cars</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6">
    @foreach($reservecars as $reservecar)
      <div class="bg-white shadow-md rounded-2xl p-5 hover:shadow-lg transition duration-300 ease-in-out">
        <h3 class="text-xl font-semibold mb-1 text-gray-900">
          {{ $reservecar->make }} {{ $reservecar->model }}
        </h3>
        <p class="text-gray-500 mb-3 text-sm">
          {{ $reservecar->year }} • {{ ucfirst($reservecar->transmission) }}
        </p>

        <div class="space-y-1 text-gray-700">
          <p><span class="font-semibold">Capacity:</span> {{ $reservecar->capacity }} seats</p>
          <p><span class="font-semibold">Location:</span> {{ $reservecar->location }}</p>
          <p><span class="font-semibold">Price per day:</span> 
            <span class="text-[#39FF14] font-semibold">${{ $reservecar->price_per_day }}</span>
          </p>
        </div>

        <div class="mt-4">
          <a href="/reservecars/{{ $reservecar->id }}" 
             class="inline-block bg-[#39FF14] text-black font-semibold px-4 py-2 rounded-lg hover:opacity-90 transition">
            View Details
          </a>
        </div>
      </div>
    @endforeach
  </div>
</x-main-layout>
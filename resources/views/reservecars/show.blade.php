<x-main-layout>
  <div class="max-w-7xl mx-auto my-10 bg-white p-10 shadow border border-gray-300">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

      <div>
        @if($reservecar->image)
          <div class="relative border border-black">
            @if($reservecar->transmission === 'Manual')
              <span class="absolute top-3 left-3 bg-amber-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Manual</span>
            @else
              <span class="absolute top-3 left-3 bg-blue-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Automatic</span>
            @endif

            <img 
              src="{{ Str::startsWith($reservecar->image, 'http') ? $reservecar->image : asset('storage/' . $reservecar->image) }}" 
              alt="{{ $reservecar->make }}"
              class="w-full h-96 object-cover"
            />
          </div>
        @endif

        <div class="mt-6 border-t border-gray-300 pt-5">
          <h2 class="text-3xl font-semibold text-gray-900 mb-4 tracking-tight">
            {{ $reservecar->make }} {{ $reservecar->model }}
          </h2>

          <div class="space-y-5 text-gray-800">
            <div>
              <p class="text-xs uppercase tracking-widest text-gray-500">Year</p>
              <p class="text-[#B4DD4E] font-semibold text-base">{{ $reservecar->year }}</p>
            </div>

            <div>
              <p class="text-xs uppercase tracking-widest text-gray-500">Capacity</p>
              <p class="text-[#B4DD4E] font-semibold text-base">{{ $reservecar->capacity }} seats</p>
            </div>

            <div>
              <p class="text-xs uppercase tracking-widest text-gray-500">Location</p>
              <p class="text-[#B4DD4E] font-semibold text-base">{{ $reservecar->location }}</p>
            </div>

            <div>
              <p class="text-xs uppercase tracking-widest text-gray-500">Price per Day</p>
              <p class="text-[#B4DD4E] font-semibold text-base">${{ $reservecar->price_per_day }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="border border-gray-200 p-6 bg-gray-50">
        <h3 class="text-2xl font-semibold text-gray-900 mb-5 border-b border-gray-300 pb-2">Reserve This Car</h3>

        <div class="bg-white border border-gray-300 h-64 flex items-center justify-center mb-6 text-gray-500 text-sm">
          Calendar (availability view)
        </div>

        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded">
            <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @auth
          <form action="{{ route('reservations.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="car_id" value="{{ $reservecar->id }}">

            <div>
              <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
              <input type="date" name="start_date" id="start_date"
                     class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]" required>
            </div>

            <div>
              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
              <input type="date" name="end_date" id="end_date"
                     class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]" required>
            </div>

            <button type="submit"
                    class="w-full bg-[#B4DD4E] text-black font-semibold py-2 border border-black hover:opacity-90 transition">
              Book Now
            </button>
          </form>
          
        <script>
        document.addEventListener('DOMContentLoaded', () => {
          const startInput = document.getElementById('start_date');
          const endInput = document.getElementById('end_date');
          
          startInput.addEventListener('change', () => {endInput.min = startInput.value;});
        });
        </script>

        
        @else
          <div class="mt-6 bg-white border border-gray-300 p-4 text-center text-gray-700">
            <p>
              You must 
              <a href="/login" class="text-[#B4DD4E] font-semibold hover:underline">log in</a>
              to reserve this car.
            </p>
          </div>
        @endauth
      </div>
    </div>

    <hr class="my-12 border-gray-400">

    <div>
      <h3 class="text-2xl font-semibold text-gray-900 mb-6">Reviews</h3>

      @forelse($reviews as $review)
        <div class="border border-gray-300 bg-gray-50 p-5 mb-5">
          <div class="flex items-center justify-between mb-2">
            <div>
              <p class="font-semibold text-gray-900">{{ $review->user->full_name ?? 'Anonymous' }}</p>
              <p class="text-xs text-gray-500">{{ $review->created_at->format('F j, Y') }}</p>
            </div>
            <div class="text-[#B4DD4E] font-semibold text-sm">
              {{ $review->rating }} / 5
            </div>
          </div>

          <p class="text-gray-800 leading-relaxed">{{ $review->comment }}</p>
        </div>
      @empty
        <p class="text-gray-600 italic">No reviews yet.</p>
      @endforelse
    </div>

  </div>
</x-main-layout>
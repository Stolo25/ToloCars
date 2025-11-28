<x-main-layout>
  <div class="max-w-6xl mx-auto my-12 px-4">
    <h2 class="text-3xl font-semibold text-gray-900 mb-8 border-b border-gray-300 pb-3">
      My Bookings
    </h2>

    @if(session('Congratulations'))
      <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 mb-8">
        <strong>Success:</strong> {{ session('Congratulations') }}
      </div>

      <div class="bg-red-50 border border-red-400 text-red-800 px-4 py-3 mb-8">
        <strong>Error:</strong> {{ session('error') }}
      </div>
    @endif

    @forelse($reservations as $reservation)
      <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition mb-8 p-5">

        <div class="flex justify-between items-start mb-4">
          <h3 class="text-2xl font-semibold text-gray-900">
            {{ $reservation->car->make }} {{ $reservation->car->model }}
          </h3>

          @if($reservation->status === 'approved')
            <span class="bg-green-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Approved</span>
          @elseif($reservation->status === 'pending')
            <span class="bg-yellow-500 text-white text-xs px-3 py-1 uppercase tracking-wider">Pending</span>
          @elseif($reservation->status === 'rejected')
            <span class="bg-red-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Rejected</span>
          @elseif($reservation->status === 'cancelled')
            <span class="bg-gray-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Cancelled</span>
          @endif
        </div>

        @if($reservation->car->image)
          <img 
            src="{{ Str::startsWith($reservation->car->image, 'http') ? $reservation->car->image : asset('storage/' . $reservation->car->image) }}" 
            alt="{{ $reservation->car->make }}"
            class="w-full h-64 object-cover border border-black mb-4"
          />
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 text-sm">
          <div>
            <p class="text-xs uppercase text-gray-500">Year</p>
            <p class="text-gray-800 font-medium">{{ $reservation->car->year }}</p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">Transmission</p>
            <p class="text-gray-800 font-medium">{{ $reservation->car->transmission }}</p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">Location</p>
            <p class="text-gray-800 font-medium">{{ $reservation->car->location }}</p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">From</p>
            <p class="text-gray-800 font-medium">{{ $reservation->start_date }}</p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">To</p>
            <p class="text-gray-800 font-medium">{{ $reservation->end_date }}</p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">Total Price</p>
            <p class="text-[#B4DD4E] font-bold text-2xl">${{ number_format($reservation->total_price, 2) }}</p>
          </div>
        </div>

        @if(in_array($reservation->status, ['pending', 'approved']))
          <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="mt-5">
            @csrf
            @method('PATCH')
            <button type="submit"
              class="text-red-700 border border-red-700 px-4 py-1 text-sm font-semibold hover:bg-red-700 hover:text-white transition">
              Cancel Reservation
            </button>
          </form>
        @endif
        
        
        @if($reservation->status === 'approved')
        <form action="{{ route('reservations.review') }}" method="POST" class="mt-4 border-t border-gray-200 pt-4">
          @csrf
          <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
          <input type="hidden" name="car_id" value="{{ $reservation->car->id }}">
          
          
          <div class="flex flex-col sm:flex-row gap-3 items-center">
            <input type="number" name="rating" min="1" max="5" placeholder="Rating (1–5)" 
            class="w-full sm:w-24 border border-gray-400 p-2 text-sm text-gray-800 focus:border-[#B4DD4E] focus:ring-0" required>
            
            <input type="text" name="comment" placeholder="Write your review..." 
            class="flex-1 border border-gray-400 p-2 text-sm text-gray-800 focus:border-[#B4DD4E] focus:ring-0" required>
            
            <button type="submit" class="bg-[#B4DD4E] text-black border border-black font-semibold px-4 py-2 text-sm hover:opacity-90 transition">
              Submit
            </button>
          </div>
        </form>
        @endif
      
      </div>
    @empty
      <p class="text-gray-600 text-center mt-10 text-lg">You haven’t booked any cars yet.</p>
    @endforelse
  </div>
</x-main-layout>
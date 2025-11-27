<x-main-layout title="Reservation Requests">
  <div class="max-w-6xl mx-auto my-12 px-4">
    <h2 class="text-3xl font-semibold text-gray-900 mb-8 border-b border-gray-300 pb-3">
      Reservation Requests
    </h2>

    @php
      $pending = $reservations->where('status', 'pending');
      $approved = $reservations->where('status', 'approved');
      $rejected = $reservations->where('status', 'rejected');
      $cancelled = $reservations->where('status', 'cancelled');
      $old = $reservations->filter(fn($r) => $r->end_date < now());
    @endphp

    @if ($reservations->isEmpty())
      <p class="text-gray-600 text-center mt-10 text-lg">No reservation requests for your cars yet.</p>
    @else
      @if($pending->count())
        <h3 class="text-2xl font-semibold text-yellow-600 mb-4 mt-10 border-b border-gray-200 pb-1">
          Pending Requests
        </h3>
        @foreach ($pending as $reservation)
          <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold text-gray-900">
                {{ $reservation->car->make }} {{ $reservation->car->model }}
              </h3>
              <span class="bg-yellow-500 text-white text-xs px-3 py-1 uppercase tracking-wider">Pending</span>
            </div>

            @if($reservation->car->image)
              <img
                src="{{ Str::startsWith($reservation->car->image, 'http') ? $reservation->car->image : asset('storage/' . $reservation->car->image) }}"
                alt="{{ $reservation->car->make }}"
                class="w-full h-64 object-cover border border-black mb-4"
              />
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 text-sm text-gray-800">
              <div>
                <p class="text-xs uppercase text-gray-500">From</p>
                <p class="font-medium">{{ $reservation->start_date }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">To</p>
                <p class="font-medium">{{ $reservation->end_date }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Requested By</p>
                <p class="font-medium">{{ $reservation->user->name ?? 'Unknown User' }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Location</p>
                <p class="font-medium">{{ $reservation->car->location }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Price per Day</p>
                <p class="text-[#B4DD4E] font-semibold">${{ $reservation->car->price_per_day }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Total Price</p>
                <p class="text-[#B4DD4E] font-bold text-lg">${{ number_format($reservation->total_price, 2) }}</p>
              </div>
            </div>

            <div class="mt-6 flex gap-3">
              <form method="POST" action="{{ route('requests.approve', $reservation->id) }}">
                @csrf
                <button type="submit"
                  class="px-5 py-1.5 border border-black bg-[#B4DD4E] text-black font-semibold text-sm hover:opacity-90 transition">
                  Approve
                </button>
              </form>

              <form method="POST" action="{{ route('requests.reject', $reservation->id) }}">
                @csrf
                <button type="submit"
                  class="px-5 py-1.5 border border-red-700 text-red-700 font-semibold text-sm hover:bg-red-700 hover:text-white transition">
                  Reject
                </button>
              </form>
            </div>
          </div>
        @endforeach
      @endif



      @if($approved->count())
        <h3 class="text-2xl font-semibold text-green-700 mb-4 mt-12 border-b border-gray-200 pb-1">
          Approved Reservations
        </h3>
        @foreach ($approved as $reservation)
          <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold text-gray-900">
                {{ $reservation->car->make }} {{ $reservation->car->model }}
              </h3>
              <span class="bg-green-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Approved</span>
            </div>

            @if($reservation->car->image)
              <img
                src="{{ Str::startsWith($reservation->car->image, 'http') ? $reservation->car->image : asset('storage/' . $reservation->car->image) }}"
                alt="{{ $reservation->car->make }}"
                class="w-full h-64 object-cover border border-black mb-4"
              />
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 text-sm text-gray-800">
              <div>
                <p class="text-xs uppercase text-gray-500">From</p>
                <p class="font-medium">{{ $reservation->start_date }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">To</p>
                <p class="font-medium">{{ $reservation->end_date }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Requested By</p>
                <p class="font-medium">{{ $reservation->user->name ?? 'Unknown User' }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Location</</p>
                <p class="font-medium">{{ $reservation->car->location }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Price per Day</p>
                <p class="text-[#B4DD4E] font-semibold">${{ $reservation->car->price_per_day }}</p>
              </div>
              <div>
                <p class="text-xs uppercase text-gray-500">Total Price</p>
                <p class="text-[#B4DD4E] font-bold text-lg">${{ number_format($reservation->total_price, 2) }}</p>
              </div>
            </div>
          </div>
        @endforeach
      @endif

      @if($rejected->count())
        <h3 class="text-2xl font-semibold text-red-700 mb-4 mt-12 border-b border-gray-200 pb-1">
          Rejected Requests
        </h3>
        @foreach ($rejected as $reservation)
          <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold text-gray-900">
                {{ $reservation->car->make }} {{ $reservation->car->model }}
              </h3>
              <span class="bg-red-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Rejected</span>
            </div>

            <p class="text-gray-700 text-sm">
              From {{ $reservation->start_date }} to {{ $reservation->end_date }} —
              Requested by <span class="font-medium">{{ $reservation->user->name ?? 'Unknown User' }}</span>
            </p>
          </div>
        @endforeach
      @endif

      @if($cancelled->count())
        <h3 class="text-2xl font-semibold text-gray-700 mb-4 mt-12 border-b border-gray-200 pb-1">
          Cancelled Reservations
        </h3>
        @foreach ($cancelled as $reservation)
          <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold text-gray-900">
                {{ $reservation->car->make }} {{ $reservation->car->model }}
              </h3>
              <span class="bg-gray-700 text-white text-xs px-3 py-1 uppercase tracking-wider">Cancelled</span>
            </div>
          </div>
        @endforeach
      @endif


      @if($old->count())
        <h3 class="text-2xl font-semibold text-gray-500 mb-4 mt-12 border-b border-gray-200 pb-1">
          Past Reservations
        </h3>
        @foreach ($old as $reservation)
          <div class="bg-white border border-gray-300 shadow-sm hover:shadow-md transition p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold text-gray-900">
                {{ $reservation->car->make }} {{ $reservation->car->model }}
              </h3>
              <span class="bg-gray-500 text-white text-xs px-3 py-1 uppercase tracking-wider">Expired</span>
            </div>
            <p class="text-gray-700 text-sm">
              From {{ $reservation->start_date }} to {{ $reservation->end_date }}
            </p>
          </div>
        @endforeach
      @endif

    @endif
  </div>
</x-main-layout>
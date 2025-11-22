<x-main-layout>
    <div class="max-w-4xl mx-auto my-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ $reservecar->make }} {{ $reservecar->model }}</h2>

        <div class="space-y-2 text-gray-600 mb-6">
            <p><strong>Year:</strong> {{ $reservecar->year }}</p>
            <p><strong>Transmission:</strong> {{ $reservecar->transmission }}</p>
            <p><strong>Capacity:</strong> {{ $reservecar->capacity }}</p>
            <p><strong>Price per day:</strong> ${{ $reservecar->price_per_day }}</p>
            <p><strong>Location:</strong> {{ $reservecar->location }}</p>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Reviews</h3>

        @foreach($reviews as $review)
            <div class="bg-gray-100 p-4 rounded-lg mb-3">
                <p class="text-yellow-500 font-medium">Rating: {{ $review->rating }}★</p>
                <p class="text-gray-700">{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>
</x-main-layout>
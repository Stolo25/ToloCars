<x-main-layout>
  <div class="max-w-7xl mx-auto my-10 grid grid-cols-1 md:grid-cols-2 gap-10">
    
    <div>
      <h2 class="text-2xl font-semibold mb-6 text-gray-900">My Cars</h2>

      @if($cars->isEmpty())
        <p class="text-gray-600 italic">You haven’t uploaded any cars yet.</p>
      @endif

      @foreach($cars as $c)
        <div class="border border-gray-300 bg-white mb-5 hover:shadow-lg transition p-4 flex gap-4">
          
          <div class="w-36 h-28 flex-shrink-0 border border-black overflow-hidden">
            @if($c->image)
              <img 
                src="{{ Str::startsWith($c->image, 'http') ? $c->image : asset('storage/' . $c->image) }}" 
                alt="{{ $c->make }}" 
                class="w-full h-full object-cover"
              />
            @else
              <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                No Image
              </div>
            @endif
          </div>


          <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900">{{ $c->make }} {{ $c->model }}</h3>
            <p class="text-gray-600 text-sm">Year: {{ $c->year }} | {{ $c->transmission }}</p>
            <p class="text-gray-600 text-sm">Capacity: {{ $c->capacity }} | ${{ $c->price_per_day }}/day</p>
            <p class="text-gray-600 text-sm">{{ $c->location }}</p>


            <div class="flex gap-2 mt-3">
              <a href="{{ route('cars.edit', $c->id) }}"
                 class="px-3 py-1.5 bg-[#B4DD4E] text-black font-medium border border-black hover:opacity-90 transition">
                Edit
              </a>
              <form method="POST" action="{{ route('cars.destroy', $c->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1.5 bg-red-500 text-white hover:bg-red-600 transition">
                  Delete
                </button>
              </form>
            </div>
          </div>

        </div>
      @endforeach
    </div>

    <div class="bg-white p-6 border border-gray-300 shadow">
      <h2 class="text-2xl font-semibold mb-6 text-gray-900">
        {{ isset($car) ? 'Edit Car' : 'Upload a Car' }}
      </h2>

      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 mb-4">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4">
          <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form 
        action="{{ isset($car) ? route('cars.update', $car->id) : route('cars.store') }}" 
        method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if(isset($car))
          @method('PUT')
        @endif

        <div>
          <label class="block text-gray-700 font-medium mb-1">Make</label>
          <input type="text" name="make" value="{{ old('make', $car->make ?? '') }}"
                 class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
        </div>

  
        <div>
          <label class="block text-gray-700 font-medium mb-1">Model</label>
          <input type="text" name="model" value="{{ old('model', $car->model ?? '') }}"
                 class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-medium mb-1">Year</label>
            <input type="number" name="year" value="{{ old('year', $car->year ?? '') }}"
                   min="1990" max="2025"
                   class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
          </div>
          <div>
            <label class="block text-gray-700 font-medium mb-1">Transmission</label>
            <select name="transmission"
                    class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
              <option value="">Select</option>
              <option value="Automatic" {{ old('transmission', $car->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
              <option value="Manual" {{ old('transmission', $car->transmission ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-medium mb-1">Capacity (2–8)</label>
            <input type="number" name="capacity" value="{{ old('capacity', $car->capacity ?? '') }}"
                   min="2" max="8"
                   class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
          </div>
          <div>
            <label class="block text-gray-700 font-medium mb-1">Price per Day ($)</label>
            <input type="number" step="0.01" name="price_per_day" 
                   value="{{ old('price_per_day', $car->price_per_day ?? '') }}"
                   class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
          </div>
        </div>

        <div>
          <label class="block text-gray-700 font-medium mb-1">Location</label>
          <input type="text" name="location" value="{{ old('location', $car->location ?? '') }}"
                 class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" required>
        </div>


        <div>
          <label class="block text-gray-700 font-medium mb-1">Car Image</label>
          <input type="file" name="image" accept="image/*"
                 class="w-full border border-gray-400 p-2 bg-gray-50 focus:border-[#B4DD4E]" 
                 {{ isset($car) ? '' : 'required' }}>
          @if(isset($car) && $car->image)
            <div class="mt-2">
              <p class="text-xs text-gray-500">Current Image:</p>
              <img src="{{ asset('storage/' . $car->image) }}" class="w-40 h-28 object-cover border border-gray-300">
            </div>
          @endif
        </div>

        <button type="submit"
                class="w-full bg-[#B4DD4E] text-black font-semibold py-2 border border-black hover:opacity-90 transition">
          {{ isset($car) ? 'Update Car' : 'Upload Car' }}
        </button>

      </form>
    </div>

  </div>
</x-main-layout>
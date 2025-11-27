<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $title }}</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

  <header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">
      <div class="flex items-center gap-2">
        <img src="/favicon.png" alt="ToloCars Logo" class="w-8 h-8">
        <h1 class="text-xl font-bold text-gray-900">ToloCars</h1>
      </div>

      <nav class="hidden md:flex gap-8 font-medium text-gray-700">
        <a href="/" class="hover:text-[#B4DD4E] transition">Home</a>
        <a href="/reservecars" class="hover:text-[#B4DD4E] transition">Reserve Car</a>

        @auth
          <a href="/mybookings" class="hover:text-[#B4DD4E] transition">My Bookings</a>
          <a href="/requests" class="hover:text-[#B4DD4E] transition">Requests</a>
          <a href="/uploadcar" class="hover:text-[#B4DD4E] transition">My Cars</a>
        @endauth

        <a href="/contact" class="hover:text-[#B4DD4E] transition">Contact</a>
      </nav>

      <div>
        @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
          @auth
          <a href="{{ url('/profile') }}" class="inline-block px-5 py-1.5 border border-gray-300 hover:border-gray-400 rounded text-sm text-gray-800">
            Profile 
          </a>
            
            
            @else
          <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 border border-transparent hover:border-gray-300 rounded text-sm text-gray-800">
              Log in
          </a>
            
            @if (Route::has('register'))
          <a href="{{ route('register') }}"
            class="inline-block px-5 py-1.5 bg-[#B4DD4E] text-black font-medium rounded-full hover:opacity-90 transition text-sm shadow-sm">
            Get a Car
          </a>
          
      @endif

      @endauth 
    </nav> 
    @endif
      </div>
    </div>
  </header>


  <main class="flex-grow max-w-7xl mx-auto w-full px-8 py-12">
    {{ $slot }}
  </main>

  <footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-10 gap-y-8">

      <div class="space-y-3">
        <img src="/favicon.png" alt="ToloCars Logo" class="w-12 h-12">
        <h3 class="text-lg font-semibold text-white">ToloCars</h3>
        <p class="text-sm text-gray-400 leading-relaxed">
          Smart car rentals made simple. Book online and drive your dream car — fast, affordable, and hassle-free.
        </p>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-3">Pages</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="/" class="hover:text-[#B4DD4E]">Home</a></li>
          <li><a href="/reservecars" class="hover:text-[#B4DD4E]">Reserve Car</a></li>
          <li><a href="/mybookings" class="hover:text-[#B4DD4E]">My Bookings</a></li>
          <li><a href="/requests" class="hover:text-[#B4DD4E]">Requests</a></li>
          <li><a href="/uploadcar" class="hover:text-[#B4DD4E]">My Cars</a></li>
          <li><a href="/contact" class="hover:text-[#B4DD4E]">Contact</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-3">Partner Car Providers</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="https://www.bmw.com" target="_blank" class="hover:text-[#B4DD4E]">BMW</a></li>
          <li><a href="https://www.mercedes-benz.com" target="_blank" class="hover:text-[#B4DD4E]">Mercedes-Benz</a></li>
          <li><a href="https://www.audi.com" target="_blank" class="hover:text-[#B4DD4E]">Audi</a></li>
          <li><a href="https://www.porsche.com" target="_blank" class="hover:text-[#B4DD4E]">Porsche</a></li>
          <li><a href="https://www.tesla.com" target="_blank" class="hover:text-[#B4DD4E]">Tesla</a></li>
        </ul>
      </div>

    </div>

    <div class="border-t border-gray-700 text-center py-5 text-xs text-gray-500">
      © 2025 ToloCars. All rights reserved.
    </div>
  </footer>

</body>
</html>
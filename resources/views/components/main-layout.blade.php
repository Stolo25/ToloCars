<!DOCTYPE html>

<head>
  <title>ToloCars | Rent Cars Easily</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>



<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center gap-2">
        <img src="/logo.png" alt="ToloCars Logo" class="w-8 h-8">
        <h1 class="text-xl font-bold text-gray-900">ToloCars</h1>
      </div>

      <nav class="hidden md:flex gap-8 font-medium text-gray-700">
        <a href="/" class="hover:text-[#39FF14] transition">Home</a>
        <a href="/cars" class="hover:text-[#39FF14] transition">Browse Cars</a>
        <a href="/rent" class="hover:text-[#39FF14] transition">How It Works</a>
        <a href="/contact" class="hover:text-[#39FF14] transition">Contact</a>
      </nav>

      <div>
        <a href="/login" class="text-sm font-semibold text-[#39FF14] hover:underline">Sign In</a>
      </div>
    </div>
  </header>
  
  
 <main>
  {{$slot}}
</main>




  <footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
      
      <div>
        <h3 class="text-lg font-semibold text-white mb-2">ToloCars</h3>
        <p class="text-sm text-gray-400">
          Smart car rentals made simple. Book online and drive your dream car — fast, affordable, and hassle-free.
        </p>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-3">More Information</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="/contact" class="hover:text-[#39FF14]">Contact Us</a></li>
          <li><a href="/locations" class="hover:text-[#39FF14]">Find a Rental Location</a></li>
          <li><a href="/accessibility" class="hover:text-[#39FF14]">Accessibility</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-3">Stay Updated</h4>
        <p class="text-sm text-gray-400 mb-3">
          Subscribe for exclusive rental deals and updates.
        </p>
        <form class="flex">
          <input type="email" placeholder="Your email" class="w-full px-3 py-2 rounded-l-md bg-gray-800 border border-gray-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#39FF14]">
          <button type="submit" class="bg-[#39FF14] text-black px-4 py-2 rounded-r-md hover:opacity-90 transition">→</button>
        </form>
      </div>

    </div>

    <div class="border-t border-gray-700 text-center py-4 text-xs text-gray-500">
      © 2025 ToloCars. All rights reserved.
    </div>
  </footer>

</body>
</html>
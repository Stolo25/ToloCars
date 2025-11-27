<x-main-layout title="Contact Us | ToloCars">
  <div class="max-w-6xl mx-auto my-16 px-6">

    <div class="text-center mb-16">
      <h1 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch</h1>
      <p class="text-gray-700 text-lg max-w-2xl mx-auto">
        Have a question or need help? Fill out the form below and we’ll get back to you as soon as possible.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      <div class="w-full">
        <img src="https://static0.hotcarsimages.com/wordpress/wp-content/uploads/2023/09/bugatti-chiron-super-sport.jpg"
             alt="Bugatti Chiron Super Sport"
             class="w-full h-[550px] object-cover border border-gray-300 shadow-sm">
      </div>

      <div>
        <form method="POST" action="#" class="space-y-6 border border-gray-300 p-8 bg-gray-50 shadow-sm">
          @csrf

          <div>
            <label for="name" class="block text-gray-800 font-medium mb-2">Your Name</label>
            <input type="text" id="name" name="name" required
                   class="w-full border border-gray-400 px-4 py-2 focus:border-[#B4DD4E] focus:ring-0 text-gray-900 bg-white">
          </div>

          <div>
            <label for="email" class="block text-gray-800 font-medium mb-2">Your Email</label>
            <input type="email" id="email" name="email" required
                   class="w-full border border-gray-400 px-4 py-2 focus:border-[#B4DD4E] focus:ring-0 text-gray-900 bg-white">
          </div>


          <div>
            <label for="message" class="block text-gray-800 font-medium mb-2">Message</label>
            <textarea id="message" name="message" rows="6" required
                      class="w-full border border-gray-400 px-4 py-2 focus:border-[#B4DD4E] focus:ring-0 text-gray-900 bg-white resize-none"></textarea>
          </div>

          <div class="text-center">
            <button type="submit"
                    class="bg-[#B4DD4E] text-black font-semibold px-8 py-3 border border-black hover:opacity-90 transition">
              Send Message
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-main-layout>
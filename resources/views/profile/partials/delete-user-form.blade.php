<section>
  <header class="mb-4 border-b border-gray-300 pb-3">
    <h2 class="text-2xl font-semibold text-gray-900">
      Delete Account
    </h2>
    <p class="mt-1 text-gray-700 text-sm">
      Once your account is deleted, all of your cars, bookings, and personal data will be permanently removed.
      Please make sure you’ve saved any important information before continuing.
    </p>
  </header>

  {{-- Delete account trigger button --}}
  <button
    x-data
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    class="px-5 py-2 bg-red-600 text-white font-semibold hover:bg-red-700 transition"
  >
    Delete Account
  </button>

  {{-- Confirmation modal --}}
  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white border border-gray-300">
      @csrf
      @method('delete')

      <h2 class="text-xl font-semibold text-gray-900 mb-2">Are you sure?</h2>
      <p class="text-gray-700 mb-6 text-sm leading-relaxed">
        Once your account is deleted, all of your cars, bookings, and personal data will be permanently removed.
        Please confirm your password to continue.
      </p>

      {{-- Password input --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          placeholder="Enter your password"
          class="w-full border border-gray-500 p-2 focus:border-[#B4DD4E] focus:ring-0"
        />
        <x-input-error :messages="$errors->userDeletion->get('password')" class="text-red-600 text-sm mt-1" />
      </div>

      {{-- Action buttons --}}
      <div class="mt-8 flex justify-end gap-3">
        <button
          type="button"
          x-on:click="$dispatch('close')"
          class="px-4 py-2 border border-gray-400 text-gray-700 font-medium hover:bg-gray-100 transition"
        >
          Cancel
        </button>

        <button
          type="submit"
          class="px-5 py-2 bg-[#B4DD4E] border border-black text-black font-semibold hover:opacity-90 transition"
        >
          Confirm Delete
        </button>
      </div>
    </form>
  </x-modal>
</section>
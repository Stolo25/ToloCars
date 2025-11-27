<section class="max-w-3xl mx-auto bg-white border border-gray-300 p-8 my-10">
  <header class="mb-6 border-b border-gray-300 pb-4">
    <h2 class="text-2xl font-semibold text-gray-900">Update Password</h2>
    <p class="mt-2 text-gray-700 text-sm">
      Ensure your account is using a long, random password to stay secure.
    </p>
  </header>

  {{-- Update Password Form --}}
  <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    {{-- Current Password --}}
    <div>
      <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1">
        Current Password
      </label>
      <input 
        id="update_password_current_password" 
        name="current_password" 
        type="password" 
        autocomplete="current-password"
        class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]"
        required
      >
      <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-red-600 text-sm mt-1" />
    </div>

    {{-- New Password --}}
    <div>
      <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">
        New Password
      </label>
      <input 
        id="update_password_password" 
        name="password" 
        type="password" 
        autocomplete="new-password"
        class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]"
        required
      >
      <x-input-error :messages="$errors->updatePassword->get('password')" class="text-red-600 text-sm mt-1" />
    </div>

    {{-- Confirm Password --}}
    <div>
      <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
        Confirm Password
      </label>
      <input 
        id="update_password_password_confirmation" 
        name="password_confirmation" 
        type="password" 
        autocomplete="new-password"
        class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]"
        required
      >
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-red-600 text-sm mt-1" />
    </div>

    {{-- Submit Section --}}
    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 mt-6">
      <button 
        type="submit" 
        class="px-5 py-2 border border-black bg-[#B4DD4E] text-black font-semibold hover:opacity-90 transition">
        Save Changes
      </button>

      @if (session('status') === 'password-updated')
        <p class="text-sm text-gray-600">Password updated successfully.</p>
      @endif
    </div>
  </form>
</section>
<section class="max-w-3xl mx-auto bg-white border border-gray-300 p-8 my-10">
  <header class="mb-6 border-b border-gray-300 pb-4">
    <h2 class="text-2xl font-semibold text-gray-900">Profile Information</h2>
    <p class="mt-2 text-gray-700 text-sm">
      Update your account's profile information and email address.
    </p>
  </header>

  {{-- Email verification form --}}
  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  {{-- Profile Update Form --}}
  <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    {{-- Name --}}
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
      <input 
        id="name" 
        name="name" 
        type="text" 
        value="{{ old('name', $user->name) }}" 
        required 
        autofocus 
        autocomplete="name"
        class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]"
      >
      <x-input-error :messages="$errors->get('name')" class="text-red-600 text-sm mt-1" />
    </div>

    {{-- Email --}}
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
      <input 
        id="email" 
        name="email" 
        type="email" 
        value="{{ old('email', $user->email) }}" 
        required 
        autocomplete="username"
        class="w-full border border-gray-500 p-2 focus:ring-0 focus:border-[#B4DD4E]"
      >
      <x-input-error :messages="$errors->get('email')" class="text-red-600 text-sm mt-1" />

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-3">
          <p class="text-sm text-gray-800">
            Your email address is <span class="font-semibold text-red-600">unverified</span>.
            <button 
              form="send-verification" 
              class="underline text-sm text-gray-700 hover:text-black focus:outline-none transition">
              Click here to re-send the verification email.
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-sm text-green-700 font-medium">
              A new verification link has been sent to your email address.
            </p>
          @endif
        </div>
      @endif
    </div>

    {{-- Save button --}}
    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 mt-6">
      <button 
        type="submit" 
        class="px-5 py-2 border border-black bg-[#B4DD4E] text-black font-semibold hover:opacity-90 transition">
        Save Changes
      </button>

      @if (session('status') === 'profile-updated')
        <p class="text-sm text-gray-600">Profile updated successfully.</p>
      @endif
    </div>
  </form>
</section>
<x-main-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">
      Profile Settings
    </h2>
  </x-slot>

  <div class="max-w-5xl mx-auto my-12 space-y-10">
    
    {{-- Profile Information --}}
    <div class="bg-white border border-gray-300 p-8">
      @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Update Password --}}
    <div class="bg-white border border-gray-300 p-8">
      @include('profile.partials.update-password-form')
    </div>

    {{-- Delete Account --}}
    <div class="bg-white border border-gray-300 p-8">
      @include('profile.partials.delete-user-form')
    </div>

  </div>
</x-main-layout>
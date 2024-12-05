<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a class="navbar-brand" href="/{{ app()->getLocale() }}/home">
                <img src="{{ asset('images/MoMs-LOGO.png') }}" class="img-fluid" style="max-height: 50px; max-width: 50px;"
                    alt="MoMs Logo">
            </a>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-light" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

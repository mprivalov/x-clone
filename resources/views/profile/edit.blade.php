<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
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
                    @include('profile.partials.update-avatar-form')
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
    <div class="fixed right-4 bottom-4 z-10">
        @if (session('delete'))
            <div id="alert" class="w-auto text-red-400 bg-white p-4 rounded-md shadow-sm border">
                {{ session('delete') }}
            </div>
        @endif

        @if (session('success'))
            <div id="alert" class="w-auto text-green-400 bg-white p-4 rounded-md shadow-sm border">
                {{ session('success') }}
            </div>
        @endif

        @if (session('updated'))
            <div id="alert" class="w-auto text-green-400 bg-white p-4 rounded-md shadow-sm border">
                {{ session('updated') }}
            </div>
        @endif
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Post Create') }}
            </h2>
        </div>
    </x-slot>

    <div class="h-screen py-2 sm:py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 sm:p-6 text-gray-900">
                    <form id='postForm' action="/create-post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2 mb-1"
                            type="text" name="title" id="title" placeholder="Title of your post..." required>
                        <x-input-error :messages="$errors->get('title')" class="mt-1 mb-2" />
                        <textarea
                            class="w-full resize-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                            rows="5" type="text" name="body" id="body" placeholder="Content of your post..." required></textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-1 mb-2" />
                        <p class="my-2 text-sm text-gray-600">
                            {{ __('Upload your image. Max - 2MB. JPEG, JPG, PNG, GIF.') }}
                        </p>
                        <x-input-error :messages="$errors->get('image')" class="mt-1 mb-2" />
                        <div class="flex flex-row justify-between">
                            <input type="file" id="image" name="image">
                            <x-primary-button>{{ __('Post') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

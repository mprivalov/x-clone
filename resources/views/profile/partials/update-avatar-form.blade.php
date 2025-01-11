<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile image.") }}
        </p>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Upload your image. Max - 2MB. JPEG, JPG, PNG, GIF.') }}
        </p>
    </header>

    <form action="/profile" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="my-3">
            <input type="file" name="avatar"
                class="block w-full h-full text-sm text-gray-900 border-none cursor-pointer bg-transparent focus:outline-none">
            <x-input-error :messages="$errors->get('avatar')" class="mt-1 mb-2" />
        </div>
        <x-secondary-button type="submit">{{ __('Upload Image') }}</x-secondary-button>
    </form>
</section>

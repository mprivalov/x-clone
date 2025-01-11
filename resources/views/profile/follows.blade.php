<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Follows' }}
            </h2>
            <div class="flex flex-row gap-2 text-gray-500 text-sm">
                <h2>Followers: {{ $followersCount }}</h2>
                <h2>Following: {{ $followingCount }}</h2>
                <h2>Posts: {{ $postsCount }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="h-screen py-2 sm:py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col sm:flex-row justify-around gap-6">
                        <div class="flex flex-col w-full mb-6">
                            <h2 class="text-2xl font-bold pb-1 mb-2 border-b-2 border-indigo-400">My
                                Followers:</h2>
                            <ul class="flex flex-col justify-between">
                                @if ($followers->isEmpty())
                                    <p class="self-center p-2">You still don't have any followers.</p>
                                @else
                                    @foreach ($followers as $follower)
                                        <li class="flex flex-row gap-2 items-center py-2 border-b border-gray-400">
                                            @if ($follower->avatar)
                                                <img src="{{ asset('storage/' . $follower->avatar) }}" alt="Avatar"
                                                    class="w-10 h-10 object-contain object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @else
                                                <img src="/storage/images/empty-avatar.png" alt="Avatar"
                                                    class="w-10 h-10 object-contain object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @endif
                                            <div class="flex flex-col">
                                                <a href="{{ route('profile.user-posts', $follow->id) }}"
                                                    class="text-xl font-weight-bold hover:text-indigo-600">{{ $follower->name }}</a>
                                                <p class="text-sm text-gray-500">{{ $follower->email }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="flex flex-col w-full mb-6">
                            <h2 class="text-2xl font-bold pb-1 mb-2 border-b-2 border-indigo-400">Following:</h2>
                            <ul class="flex flex-col justify-between gap-2">
                                @if ($following->isEmpty())
                                    <p>You still don't have any followers.</p>
                                @else
                                    @foreach ($following as $follow)
                                        <li class="flex flex-row gap-2 items-center p-2 bg-gray-200 rounded-lg">
                                            @if ($follow->avatar)
                                                <img src="{{ asset('storage/' . $follow->avatar) }}" alt="Avatar"
                                                    class="w-20 h-20 object-cover object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @else
                                                <img src="/storage/images/empty-avatar.png" alt="Avatar"
                                                    class="w-20 h-20 object-contain object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @endif
                                            <div class="flex flex-col">
                                                <a href="{{ route('profile.user-posts', $follow->id) }}"
                                                    class="text-xl font-weight-bold hover:text-indigo-600">{{ $follow->name }}</a>
                                                <p class="text-sm text-gray-500">{{ $follow->email }}</p>
                                            </div>
                                            @if ($user->id !== Auth::user()->id)
                                                <div>
                                                    @if ($user->alreadyFollowing())
                                                        <x-secondary-button>
                                                            <a href="/follower/{{ $user->id }}">
                                                                {{ __('Unfollow') }}
                                                            </a>
                                                        </x-secondary-button>
                                                    @else
                                                        <x-primary-button>
                                                            <a href="/follower/{{ $user->id }}">
                                                                {{ __('Follow') }}
                                                            </a>
                                                        </x-primary-button>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

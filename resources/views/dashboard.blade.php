<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Dashboard' }}
            </h2>
            <x-primary-button>
                <a href="/create-post">{{ __('Create Post') }}</a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2 sm:py-4 flex justify-end">
        <form action="{{ route('dashboard.filter') }}" method="GET" class="flex flex-row justify-between gap-3">
            <select name="filter" id="filter" class="p-1 pl-2 pr-8 border-none rounded-md bg-transparent">
                <option value="recent">Most Recent</option>
                <option value="liked">Most Liked</option>
            </select>
            <x-secondary-button type="submit">Apply</x-secondary-button>
        </form>
    </div>
    <div id="Modal" class="modal">
        <svg id='close' class='close' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
        </svg>
        <img id="img01" class="modal-content">
    </div>
    @if ($data->isEmpty())
        <div class="h-auto pb-2 sm:pb-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p class="text-center m-6">There are no posts yet.</p>
                </div>
            </div>
        </div>
    @else
        @foreach ($data as $post)
            <div class="h-auto pb-2 sm:pb-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <?php
                            $user = auth()->user();
                            $author = $post->user;
                            $userId = $user->id;
                            $postLikes = $post->likesCount;
                            $postIsLiked = $postLikes->where('user_id', $userId)->first();
                            $authorName = $author->name;
                            ?>
                            <div class="flex flex-row justify-between">
                                <a class="hover:cursor-pointer" href="/user/{{ $post->user->id }}/posts">
                                    <div class="flex flex-row items-center">
                                        <button
                                            class="inline-flex items-center py-2 gap-2 border border-transparent text-md leading-4 font-medium rounded-md text-black bg-white hover:underline focus:outline-none transition ease-in-out duration-150">
                                            @if ($post->user->avatar)
                                                <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Avatar"
                                                    class="w-6 h-6 object-cover object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @else
                                                <img src="/storage/images/empty-avatar.png" alt="Avatar"
                                                    class="w-6 h-6 object-contain object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                            @endif
                                            <p>{{ $authorName }}</p>
                                        </button>
                                    </div>
                                </a>

                                @if ($post->user_id === auth()->id())
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none transition ease-in-out duration-150">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link href="/posts/{{ $post->id }}/edit" :active="request()->routeIs('post.edit')"
                                                class="dropdown-link">
                                                <svg class="w-3 h-3 mr-1 fill-gray-700"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                                                </svg>{{ __('Edit') }}</x-dropdown-link>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-link flex items-center w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:text-indigo-700 hover:bg-gray-50 focus:outline-none focus:text-indigo-800 focus:bg-gray-100 transition duration-300 ease-in-out">
                                                    <svg class="w-3 h-3 mr-1 fill-gray-700"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path
                                                            d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                                    </svg>{{ __('Delete') }}</button>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <h1 class="font-semibold">{{ $post->title }}</h1>
                            <p>{{ $post->body }}</p>
                            @if ($post->image)
                                <div>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image"
                                        class="imageZoom max-w-72 max-h-72 rounded-md">
                                </div>
                            @endif
                            <div class="flex flex-row justify-between py-1 sm:py-2">
                                <div class="flex flex-row gap-2">
                                    <form action="/like-post/{{ $post->id }}" method="POST">
                                        @csrf
                                        <button class="flex flex-row items-center">
                                            @if ($postIsLiked)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="red"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>
                                            @endif
                                            <p class="text-red-500">{{ $post->likes }}</p>
                                        </button>
                                    </form>
                                </div>
                                <p class="text-neutral-500 text-sm">{{ $post->created_at }}</p>
                            </div>
                            <hr class="mb-2">
                            <form action="/comment-post/{{ $post->id }}" method="POST"
                                class="flex flex-row gap-2">
                                @csrf
                                <textarea
                                    class="w-full resize-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                                    rows="1" id="comment" name="comment" placeholder="Comment this post..." required></textarea>
                                <x-primary-button>
                                    Comment
                                </x-primary-button>
                            </form>
                            <?php
                            $postComments = $post->comments;
                            ?>
                            @if ($postComments->isEmpty())
                                <div class="h-auto pb-2 sm:pb-3">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <p class="text-center text-sm m-6 text-gray-600">There are no comments yet.
                                                Be the first to add a comment!</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-auto h-auto max-h-28 overflow-y-scroll touch-auto my-3 px-2 bg-gray-50 rounded-sm">
                                    @foreach ($postComments as $comment)
                                        <button
                                            class="inline-flex items-center py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black bg-gray-50 hover:text-black hover:underline focus:outline-none transition ease-in-out duration-150">
                                            <div class="flex flex-row gap-2 items-center">
                                                @if ($comment->user->avatar)
                                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}"
                                                        alt="Avatar"
                                                        class="w-6 h-6 object-cover object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                                @else
                                                    <img src="/storage/images/empty-avatar.png" alt="Avatar"
                                                        class="w-6 h-6 object-contain object-center rounded-full border border-gray-500 hover:border-2 hover:border-indigo-500">
                                                @endif
                                                <a href="/user/{{ $comment->user->id }}/posts">
                                                    {{ $comment->user->name }}</a>
                                            </div>
                                        </button>
                                        <p class="p-1">{{ $comment->body }}</p>
                                        <?php
                                        $commentLikes = $comment->likesCount;
                                        $commentIsLiked = $commentLikes->where('user_id', $userId)->first();
                                        ?>
                                        <div class="flex flex-row justify-between py-1 sm:py-2 border-b">
                                            <form action="/like-comment/{{ $comment->id }}" method="POST">
                                                @csrf
                                                <button class="flex flex-row">
                                                    @if ($commentIsLiked)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                        </svg>
                                                    @endif
                                                    <p class="text-red-500">{{ $comment->likes }}</p>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
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

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:to-red-500 active:bg-red-700 focus:outline-none focus:to-red-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

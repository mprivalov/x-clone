<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center p-2 bg-gradient-to-r from-indigo-500 to-indigo-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:to-indigo-500 focus:to-indigo-900 active:bg-indigo-800 focus:outline-none focus:to-indigo-900 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>

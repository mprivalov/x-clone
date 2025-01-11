<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-white to-gray-400 border border-gray-100 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:to-gray-200 hover:border-gray-400 focus:outline-none focus:to-gray-700 disabled:opacity-25 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>

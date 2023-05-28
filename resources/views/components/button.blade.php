<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-orange-400 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-orange-500 focus:bg-orange-300 active:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-bnhs-blue border border-transparent rounded-lg font-semibold text-sm text-white tracking-wide hover:bg-bnhs-blue-600 focus:bg-bnhs-blue-600 active:bg-bnhs-blue-700 focus:outline-none focus:ring-2 focus:ring-bnhs-blue focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg']) }}>
    {{ $slot }}
</button>

@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-bnhs-blue focus:ring-bnhs-blue rounded-lg shadow-sm px-4 py-2.5 transition']) }}>

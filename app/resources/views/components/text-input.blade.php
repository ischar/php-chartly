@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-light-bg-input dark:bg-dark-bg-input text-light-fg-input dark:text-dark-fg-input border-0 focus:outline-none focus:ring-0 rounded-xl']) }}>

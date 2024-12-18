@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-light-bg-primary dark:bg-dark-bg-primary text-light-fg-input dark:text-dark-fg-input rounded-md']) }}>

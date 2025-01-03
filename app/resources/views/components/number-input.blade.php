@props(['disabled' => false, 'placeholder' => ''])

<input
  type="number"
  min="0"
  step="1"
  @disabled($disabled)
  placeholder="{{ $placeholder }}"
  {{ $attributes->merge(['class' => 'block w-64 bg-light-bg-input dark:bg-dark-bg-input text-light-fg-input dark:text-dark-fg-input border-0 focus:outline-none focus:ring-0 rounded-xl']) }}>
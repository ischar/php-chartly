@props(['stock'])

<div class="card p-6 bg-light-bg-card dark:bg-dark-bg-card rounded-xl shadow-sm sm:rounded-lg">
  <div class="card-content">
    <div class="flex flex-row items-center justify-between">
      <h2 class="card-title font-semibold text-xl text-light-fg-primary dark:text-dark-fg-primary"> {{ \Illuminate\Support\Str::limit($stock->stock_name, 25) }} </h2>
      <button
        class="delete-button"
        data-stock-id="{{ $stock->id }}"
        data-csrf-token="{{ csrf_token() }}"
        onclick="handleDelete(this)">
        <img class="flex w-4 h-4 fill-current text-red-500" src="{{ asset('images/icons/delete.svg') }}" alt="delete" />
      </button>
    </div>
    <p class="card-description inline px-2 py-1 rounded-lg text-[12px] font-bold bg-light-fg-button">{{ $stock->ticker }} </p>
    <p class="text-end text-lg font-semibold"> {{$stock->current_price}} USD
      @if (!is_null($stock->change))
      @php
      $change = number_format($stock->change, 2);
      @endphp
      <span class="{{ $change >= 0 ? 'text-blue-400 dark:text-blue-500' : 'text-red-400 dark:text-red-500' }}">
        {{ $change > 0 ? '+' : '' }}{{ $change }}%
      </span>
      @else
      N/A
      @endif
    </p>
  </div>
</div>

@vite(['resources/js/watchlist.js'])
<x-app-layout>
  <x-slot name="header">
    <x-search-bar />
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class=" dark:bg-gray-800 overflow-hidden">
        <div id="watch-list" class="grid grid-cols-4 gap-6">
          @forelse ($watchlists as $watchlist)
          <x-stock-card :stock="$watchlist" />
          @empty
          <div class="text-center font-regular text-xl text-light-fg-input dark:text-dark-fg-input">
            <p>You have not added any favorites. Add them through search.</p>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  
</x-app-layout>
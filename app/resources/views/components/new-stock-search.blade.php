<div class="flex flex-col w-full px-20 pb-4">
  <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
  <div class="relative w-full">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18.5a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path>
      </svg>
    </div>
    <input
      type="search"
      id="new-stock-search"
      class="block w-full p-4 pl-10 text-sm text-gray-900 border border-none rounded-xl bg-light-bg-input dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
      placeholder="Please enter the stock ticker."
      autocomplete="off"
      aria-controls="suggestions-list"
      aria-autocomplete="list"
      required />
    <button
      type="button"
      class="absolute right-2.5 bottom-2.5 bg-blue-500 text-white font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:outline-none">
      Search
    </button>
    <div class="w-full relative">
      <ul id="new-stock-suggestions" class="absolute w-full bg-white rounded-b-lg text-sm text-black font-medium" aria-live="polite">
      </ul>
    </div>
  </div>
</div>

@vite(['resources/js/new-stocks.js'])
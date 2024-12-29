<form class="max-w-full mx-auto g">
  <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">
    Search
  </label>
  <div class="relative">
    <!-- Search Icon -->
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <!-- SVG 코드 -->
      <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18.5a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"></path>
      </svg>
    </div>

    <!-- Search Input -->
    <input
      type="search"
      id="default-search"
      class="block w-full p-4 pl-10 text-sm text-gray-900 border border-none rounded-xl  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
      placeholder="Please enter the stock ticker."
      autocomplete="off"
      aria-controls="suggestions-list"
      aria-autocomplete="list"
      required />

    <!-- Search Button -->
    <button
      type="submit"
      class="absolute right-2.5 bottom-2.5 bg-blue-500 text-white font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:outline-none">
      Search
    </button>
  </div>

  <!-- Suggestions Dropdown -->
  <div class="w-full relative">
    <ul id="suggestions-list" class="absolute w-full bg-white rounded-b-lg text-sm text-black font-medium" aria-live="polite">
  
    </ul>
  </div>
</form>

@vite(['resources/js/nasdaq-stocks.js'])

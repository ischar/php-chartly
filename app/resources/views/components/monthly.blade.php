<div class="h-full grid grid-cols-3 px-10 mt-12 space-x-16">
  <div class="flex flex-col col-span-1">
    <h3 class="text-xl text-center text-light-fg-primary dark:text-dark-fg-primary">Stocks</h3>
    <table class="mt-6 border-y text-base text-center text-light-fg-primary dark:text-dark-fg-primary">
      <thead>
        <tr class="bg-light-bg-tr">
          <th class="p-2">Ticker</th>
          <th class="p-2">Price</th>
          <th class="p-2">Quantity</th>
          <th class="p-2">Profit</th>
          <th class="p-2">Delete</th>
          <th class="p-2">Edit</th>
        </tr>
      </thead>
      <tbody id="monthly-stocks">
      </tbody>
    </table>
  </div>
  <div class="flex flex-col col-span-2">
    <h3 class="text-xl text-center text-light-fg-primary dark:text-dark-fg-primary">Chart</h3>
    <div class="mb-4">
      <div class="mt-40 flex-grow flex items-center justify-center">
        <canvas id="monthly-chart" />
      </div>
    </div>
  </div>
</div>

@vite(['resources/js/portfolio/monthly-chart.js', ])
<div class="grid grid-cols-2 px-20 mt-36 space-x-16">
  <div>
    <h3 class="text-2xl text-center text-light-fg-primary dark:text-dark-fg-primary">Summary</h3>
    <div class="mb-4">
      <div class="mt-12">
        <canvas id="summary-chart" width="45" height="34" />
      </div>
      <div class="w-full text-lg px-32 mt-4">
        <div class="grid grid-cols-2 gap-x-2">
          <p>Amount: </p>
          <p id="summary-amount"></p>
        </div>
        <div class="grid grid-cols-2 gap-x-2">
          <p>Current: </p>
          <p id="summary-current" class="whitespace-nowrap"></p>
        </div>
        <div class="grid grid-cols-2 gap-x-2">
          <p>Total: </p>
          <p id="summary-total"></p>
        </div>
      </div>
    </div>
  </div>
  <div>
    <h3 class="text-2xl text-center text-light-fg-primary dark:text-dark-fg-primary">Distribution</h3>
    <div class="mb-4">
      <div class="mt-12">
        <canvas id="distribution-chart" />
      </div>
    </div>
  </div>
</div>


@vite(['resources/js/portfolio/portfolio-chart.js'])
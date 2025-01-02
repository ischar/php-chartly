<div class="w-full h-full dark:bg-dark-bg-card rounded-xl sm:rounded-lg">

  <div class="flex flex-col mt-24 justify-center items-center ">
    <form class="flex flex-col w-[512px] h-[512px] items-center pt-32 border rounded-2xl space-y-4 ">
      <x-new-stock-search></x-new-stock-search>
      <div class="flex w-full px-20 justify-start items-center space-x-10">
        <label class="select-none">Name</label>
        <x-text-input id="new-stock-name" class="w-full" placeholder="Search Stock Name" disabled></x-text-input>
      </div>
      <div class="flex w-full px-20 justify-between items-center">
        <label class="select-none">Price</label>
        <x-number-input id="new-stock-price" placeholder="Please input the price."></x-number-input>
      </div>
      <div class="flex w-full px-20 justify-between items-center">
        <label class="select-none">Quantity</label>
        <x-number-input id="new-stock-quantity" placeholder="Please input the quantities."></x-number-input>
      </div>
      <div class="pt-8" class="select-none">
        <x-primary-button id="new-stock-button">submit</x-primary-button>
      </div>
    </form>
  </div>
</div>

@vite(['resources/js/new-portfolio.js']);
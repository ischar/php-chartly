<x-app-layout>
    <x-slot name="header">
        <div id="nasdaq-data" class="flex justify-center">
            <p>Loading Nasdaq Data...</p>
        </div>
    </x-slot>
    <div class="grid grid-cols-5 justify-between mx-56 my-auto ">
        <div id="watch-list" class="justify-center flex flex-col col-span-1 mr-5 items-center space-y-5">
        </div>
        <div class="col-span-4 bg-light-bg-card dark:bg-dark-bg-card rounded-2xl">
            <x-overview />
        </div>
    </div>

    @vite(['resources/js/nasdaq.js','resources/js/dashboard-watchlist.js'])
</x-app-layout>
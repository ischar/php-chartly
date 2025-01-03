<x-app-layout>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ activeTab: 'Monthly'}">
            <div class="grid grid-rows-6 grid-cols-10 text-xl text-light-fg-primary dark:text-dark-fg-primary overflow-hidden">
                <div class="select-none bg-light-bg-card dark:bg-dark-bg-card rounded-l-2xl">
                    <h3 class="py-2 pl-3 hover:bg-gray-300 rounded-tl-2xl transition-colors duration-300"
                        :class="activeTab === 'Overview' ? 'bg-gray-300 text-black' : ''"
                        @click="activeTab = 'Overview'">Overview</h3>
                    <h3 class="py-2 pl-3 hover:bg-gray-300 transition-colors duration-300"
                        :class=" activeTab==='New Stock' ? 'bg-gray-300 text-black' : ''"
                        @click="activeTab = 'New Stock'">New Stock</h3>
                    <h3 class="py-2 pl-3 hover:bg-gray-300 rounded-bl-2xl transition-colors duration-300"
                        :class=" activeTab==='Monthly' ? 'bg-gray-300 text-black' : ''"
                        @click=" activeTab='Monthly'">Monthly</h3>
                </div>
                <div class="row-span-6 col-span-9 rounded-b-2xl rounded-r-2xl bg-light-bg-card w-full overflow-hidden">
                    <div x-show="activeTab === 'Overview'"
                        class="w-full h-full">
                        <x-overview />
                    </div>
                    <div x-show="activeTab === 'New Stock'" x-cloak
                        class="w-full h-full">
                        <x-new-stock />
                    </div>
                    <div x-show="activeTab === 'Monthly'" x-cloak
                        class="w-full h-full">
                        <x-monthly />
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
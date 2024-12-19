<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-dark-bg-button dark:bg-dark-bg-button text-light-fg-button dark:text-dark-fg-button border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:filter hover:brightness-90
    dark:hover:filter dark:hover:brightness-75  focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

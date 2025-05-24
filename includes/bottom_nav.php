<div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 rounded-full bottom-4 left-1/2 shadow-lg">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
        <!-- Home Button -->
        <a href="/index.php" data-tooltip-target="tooltip-home" class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50 group">
            <svg class="w-5 h-5 mb-1 text-gray-500 group-hover:text-blue-600 <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-blue-600' : '' ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            <span class="sr-only">Home</span>
        </a>
        <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            Home
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <!-- Contacts Button -->
        <a href="/pages/contacts/list.php" data-tooltip-target="tooltip-contacts" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
            <svg class="w-5 h-5 mb-1 text-gray-500 group-hover:text-blue-600 <?= strpos(basename($_SERVER['PHP_SELF']), 'contacts') !== false ? 'text-blue-600' : '' ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
            </svg>
            <span class="sr-only">Contacts</span>
        </a>
        <div id="tooltip-contacts" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            Contacts
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <!-- Add Contact Button -->
        <div class="flex items-center justify-center">
            <a href="/pages/contacts/add.php" data-tooltip-target="tooltip-new" class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                <span class="sr-only">Add contact</span>
            </a>
        </div>
        <div id="tooltip-new" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            Add Contact
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        
        <!-- Favorites Button -->
        <a href="/pages/favorites.php" data-tooltip-target="tooltip-favorites" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
            <svg class="w-5 h-5 mb-1 text-gray-500 group-hover:text-blue-600 <?= strpos(basename($_SERVER['PHP_SELF']), 'favorites') !== false ? 'text-blue-600' : '' ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3.172 5.172a4 4 0 0 1 5.656 0L10 6.343l1.172-1.171a4 4 0 1 1 5.656 5.656L10 17.657l-6.828-6.829a4 4 0 0 1 0-5.656z"/>
            </svg>
            <span class="sr-only">Favorites</span>
        </a>
        <div id="tooltip-favorites" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            Favorites
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <!-- Birthdays Button -->
        <a href="/pages/birthdays.php" data-tooltip-target="tooltip-birthdays" class="inline-flex flex-col items-center justify-center px-5 rounded-e-full hover:bg-gray-50 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-1 text-gray-500 group-hover:text-blue-600 <?= strpos(basename($_SERVER['PHP_SELF']), 'birthdays') !== false ? 'text-blue-600' : '' ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2s1.5 2 1.5 3.5S12 7 12 7s-1.5-.5-1.5-1.5S12 2 12 2z"/>  
                <path d="M18 7H6v6h12V7z"/>  
                <path d="M4 13h16v6H4z"/>  
                <path d="M6 19h12"/>  
            </svg>
            <span class="sr-only">Birthdays</span>
        </a>
        <div id="tooltip-birthdays" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
            Birthdays
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</div>

<!-- Initialize tooltips -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip-target]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        const targetId = tooltipTriggerEl.getAttribute('data-tooltip-target');
        const tooltipEl = document.getElementById(targetId);
        
        return new Popper(tooltipTriggerEl, tooltipEl, {
            placement: 'top',
            modifiers: [
                {
                    name: 'arrow',
                    options: {
                        element: tooltipEl.querySelector('.tooltip-arrow'),
                    },
                },
            ],
        });
    });
});
</script>
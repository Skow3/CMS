// Global functions
function confirmDelete() {
    return confirm('Are you sure you want to delete this contact?');
}

// Toggling favorite status
function toggleFavorite(contactId, button) {
    fetch('process/contact_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=toggle_favorite&contact_id=${contactId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            button.classList.toggle('text-yellow-500');
            button.classList.toggle('text-gray-400');
        }
    });
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any tooltips or other UI elements
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Close alert messages
    document.querySelectorAll('[data-dismiss="alert"]').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.alert').remove();
        });
    });
});
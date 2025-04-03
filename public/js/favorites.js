// public/js/favorites.js
document.addEventListener('DOMContentLoaded', function () {
    function confirmRemove(button) {
        Swal.fire({
            title: 'Remove from Favorites?',
            text: 'Are you sure you want to remove this service from your favorites?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8A4FFF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate removing the service from favorites
                const serviceCard = button.closest('.bg-white');
                serviceCard.remove();

                // Check if there are any favorites left
                const favoritesList = document.getElementById('favorites-list');
                if (favoritesList.children.length === 0) {
                    favoritesList.classList.add('hidden');
                    document.getElementById('empty-state').classList.remove('hidden');
                }

                Swal.fire(
                    'Removed!',
                    'The service has been removed from your favorites.',
                    'success'
                );
            }
        });
    }

    // Expose the confirmRemove function to the global scope so it can be called from the onclick attribute
    window.confirmRemove = confirmRemove;
});
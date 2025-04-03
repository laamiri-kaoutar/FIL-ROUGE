// public/js/reviews.js
document.addEventListener('DOMContentLoaded', function () {
    // Open new review modal
    document.getElementById('openNewReviewBtn').addEventListener('click', function () {
        document.getElementById('newReviewModal').classList.remove('hidden');
    });

    // Close new review modal
    window.closeNewReviewModal = function () {
        document.getElementById('newReviewModal').classList.add('hidden');
    };

    // Open edit review modal
    window.openEditReviewModal = function (reviewId) {
        document.getElementById('editReviewId').value = reviewId;

        // Pre-fill form fields based on the review (static example)
        if (reviewId == 1) {
            document.getElementById('editStar5').checked = true;
            document.getElementById('editReviewComment').value = "Excellent work! Delivered ahead of schedule and exceeded my expectations. The developer was very responsive and implemented all my feedback promptly.";
        } else if (reviewId == 2) {
            document.getElementById('editStar4').checked = true;
            document.getElementById('editReviewComment').value = "Great design work overall. Clean, modern interface with good attention to user experience. Would recommend for future projects.";
        }

        document.getElementById('editReviewModal').classList.remove('hidden');
    };

    // Close edit review modal
    window.closeEditReviewModal = function () {
        document.getElementById('editReviewModal').classList.add('hidden');
    };

    // Confirm delete review
    window.confirmDeleteReview = function (reviewId) {
        Swal.fire({
            title: 'Delete Review',
            text: "Are you sure you want to delete this review? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate deleting the review from the DOM
                const reviewItem = document.querySelector(`.review-item[data-review-id="${reviewId}"]`);
                reviewItem.remove();

                // Check if there are any reviews left
                const reviewsList = document.getElementById('reviewsList');
                if (reviewsList.children.length === 0) {
                    reviewsList.classList.add('hidden');
                    document.getElementById('emptyState').classList.remove('hidden');
                }

                Swal.fire(
                    'Deleted!',
                    'Your review has been deleted.',
                    'success'
                );
            }
        });
    };

    // Form submissions (simulated for frontend)
    document.getElementById('newReviewForm').addEventListener('submit', function (e) {
        e.preventDefault();
        closeNewReviewModal();
        Swal.fire(
            'Submitted!',
            'Your review has been submitted.',
            'success'
        );
    });

    document.getElementById('editReviewForm').addEventListener('submit', function (e) {
        e.preventDefault();
        closeEditReviewModal();
        Swal.fire(
            'Updated!',
            'Your review has been updated.',
            'success'
        );
    });
}); 
document.addEventListener('DOMContentLoaded', function () {
    // Show delete confirmation with SweetAlert
    window.showDeleteConfirmation = function (reviewId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/client/services/reviews/${reviewId}`;
                form.innerHTML = `
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    };

    // Open edit review modal and pre-fill the form
    window.openEditReviewModal = function (reviewId, rating, comment) {
        const modal = document.getElementById('editReviewModal');
        const form = document.getElementById('editReviewForm');
        const reviewIdInput = document.getElementById('editReviewId');
        const commentTextarea = document.getElementById('editReviewComment');

        // Set the form action dynamically
        form.action = `/client/services/reviews/${reviewId}`;

        // Set the review ID
        reviewIdInput.value = reviewId;

        // Set the comment
        commentTextarea.value = comment;

        // Set the rating by checking the appropriate radio button
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        ratingInputs.forEach(input => {
            if (parseInt(input.value) === rating) {
                input.checked = true;
            }
        });

        // Show the modal
        modal.classList.remove('hidden');
    };

    // Close edit review modal
    window.closeEditReviewModal = function () {
        const modal = document.getElementById('editReviewModal');
        modal.classList.add('hidden');
        // Reset the form
        document.getElementById('editReviewForm').reset();
    };
});
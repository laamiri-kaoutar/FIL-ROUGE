document.addEventListener('DOMContentLoaded', function () {
    // Store initial values
    const initialValues = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
    };
    const initialImage = document.getElementById('profileImagePreview').src;
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // Check for changes to enable/disable save button
    document.querySelectorAll('#firstName, #lastName, #email, #profileImage').forEach(input => {
        input.addEventListener('input', () => {
            const changed = input.type === 'file' ? input.files.length > 0 :
                input.value !== initialValues[input.id] ||
                document.getElementById('profileImagePreview').src !== initialImage;
            saveBtn.disabled = !changed;
        });
    });

    // Cancel resets form
    cancelBtn.addEventListener('click', () => {
        document.getElementById('firstName').value = initialValues.firstName;
        document.getElementById('lastName').value = initialValues.lastName;
        document.getElementById('email').value = initialValues.email;
        document.getElementById('profileImagePreview').src = initialImage;
        document.getElementById('profileImage').value = '';
        saveBtn.disabled = true;
    });

    // Image preview
    document.getElementById('profileImage').addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('profileImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
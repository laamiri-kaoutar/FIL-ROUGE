// public/js/profile.js
document.addEventListener('DOMContentLoaded', function () {
    // Store initial values
    const initialValues = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        companyName: document.getElementById('companyName').value
    };
    const initialImage = document.getElementById('profileImagePreview').src;
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // Check for changes
    document.querySelectorAll('input, textarea').forEach(input => {
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
        document.getElementById('companyName').value = initialValues.companyName;
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

    // Password change
    document.getElementById('changePasswordBtn').addEventListener('click', () => {
        alert('Password change initiated—check your email for further instructions.');
    });

    // Form submission
    document.getElementById('profileForm').addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent form submission since there's no backend yet
        saveBtn.disabled = true;
        alert('Profile updated successfully!'); // Placeholder for frontend testing
    });
});
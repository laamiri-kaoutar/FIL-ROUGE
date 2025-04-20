// resources/js/payment.js
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Stripe with your publishable key
    const stripe = Stripe('pk_test_51QygIvHXDjlnm4V7I5GjcjzfDZidwPTzIxN1kVxhUnORwzsvCGmq5uHYWSEceCgL7wGUlNp4Y7K2euhKt8ymE4qJ00W1sgvz8u'); // Replace with your key
    const elements = stripe.elements();

    // Create and mount the card element
    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#1F2937',
                '::placeholder': { color: '#9CA3AF' },
            },
            invalid: { color: '#EF4444' },
        },
    });
    card.mount('#card-element');

    // Handle form submission
    const form = document.getElementById('payment-form');
    const paymentButton = document.getElementById('payment-button');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        paymentButton.disabled = true;
        cardErrors.textContent = '';

        // Create payment token
        const { token, error } = await stripe.createToken(card);

        if (error) {
            // Display error
            console.log(error);
            
            cardErrors.textContent = error.message;
            paymentButton.disabled = false;
        } else {
            // Add token to form and submit
            document.getElementById('stripeToken').value = token.id;
            form.submit();
        }
    });

    // Real-time validation
    card.on('change', function (event) {
        cardErrors.textContent = event.error ? event.error.message : '';
    });
});
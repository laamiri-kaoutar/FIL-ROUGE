// public/js/payment.js
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Stripe with your test publishable key
    // Replace 'pk_test_your_key' with your actual Stripe test publishable key
    const stripe = Stripe('pk_test_your_key');
    
    // Create an instance of Elements
    const elements = stripe.elements();
    
    // Create and mount the Card Element
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    
    // Handle real-time validation errors from the card Element
    cardElement.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    // Handle form submission
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const paymentButton = document.getElementById('payment-button');
        paymentButton.innerHTML = 'Processing...';
        paymentButton.disabled = true;
        
        const cardName = document.getElementById('card-name').value;
        
        // Create a token
        stripe.createToken(cardElement, {
            name: cardName
        }).then(function(result) {
            if (result.error) {
                // Display error to the user
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                
                // Re-enable the submit button
                paymentButton.innerHTML = 'Complete Payment';
                paymentButton.disabled = false;
            } else {
                // Send the token to your server
                const tokenInput = document.getElementById('stripeToken');
                tokenInput.value = result.token.id;
                
                // Submit the form
                form.submit();
                
                // Note: Since there's no backend yet, you can simulate a redirect
                // setTimeout(() => {
                //     window.location.href = '/client/orders';
                // }, 1500);
            }
        });
    });
});
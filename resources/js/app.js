import './bootstrap';

console.log('Fiorella');

$(document).ready(function() {
    $('.select2').select2();
});

let stripe = Stripe(import.meta.env.VITE_STRIPE_KEY);
let cardElement = stripe.elements().create('card', { hidePostalCode: true });

if (document.querySelector('#card-element')) {
    cardElement.mount('#card-element');
}

let cardButton = document.querySelector('#card-button');
cardButton.addEventListener('click', (event) => {
    event.preventDefault();

    stripe.createPaymentMethod('card', cardElement, {}).then((payment) => {
        if (payment.error) {
            document.querySelector('#card-error').innerHTML = payment.error.message;
        } else {
            document.querySelector('[name="payment_method"]').value = payment.paymentMethod.id;
            document.querySelector('#payment-form').submit();
        }
    });
});

<div class="container">
    <form method="post" action="{{ route('clients.client_registration_post') }}" id="signUpForm" class="signUpForm" enctype="multipart/form-data">
        @csrf
        <div class="form-row row card-related">
            <label for="card-element">Credit or debit card</label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Move card-errors outside of card-element -->
            <div id="card-errors" role="alert"></div>
            <div id="empty-element"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    var stripe, elements, card;

    function initializeStripe() {
        console.log("Initializing Stripe...");
        if (!stripe) {
            stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}"); // Replace with your Stripe publishable key
        }
        if (!elements) {
            elements = stripe.elements();
        }
        if (!card) {
            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            card = elements.create('card', {
                style: style
            });
            card.mount('#card-element'); // Mount the card Element in the div
            card.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                displayError.textContent = event.error ? event.error.message : '';
            });
        }
    }

    $(document).ready(function() {
        initializeStripe();
    });



    $('#signUpForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        console.log('form submitted');

        if (card) {
            // Use Stripe.js to create a token
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Handle any errors from Stripe.js
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Token successfully created, insert token ID into the form
                    const form = document.getElementById('signUpForm');
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Include last 4 digits, expiration month, and year of the card from the token object
                    const hiddenInputLast4 = document.createElement('input');
                    hiddenInputLast4.setAttribute('type', 'hidden');
                    hiddenInputLast4.setAttribute('name', 'last4');
                    hiddenInputLast4.setAttribute('value', result.token.card.last4);
                    form.appendChild(hiddenInputLast4);

                    const hiddenInputExpMonth = document.createElement('input');
                    hiddenInputExpMonth.setAttribute('type', 'hidden');
                    hiddenInputExpMonth.setAttribute('name', 'exp_month');
                    hiddenInputExpMonth.setAttribute('value', result.token.card.exp_month);
                    form.appendChild(hiddenInputExpMonth);

                    const hiddenInputExpYear = document.createElement('input');
                    hiddenInputExpYear.setAttribute('type', 'hidden');
                    hiddenInputExpYear.setAttribute('name', 'exp_year');
                    hiddenInputExpYear.setAttribute('value', result.token.card.exp_year);
                    form.appendChild(hiddenInputExpYear);

                    // Submit the form
                    form.submit();
                }
            });
        } else {
            // No Stripe card required, submit the form directly
            document.getElementById('signUpForm').submit();
        }
    });
</script>

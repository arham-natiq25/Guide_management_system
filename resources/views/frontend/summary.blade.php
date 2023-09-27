@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make a Payment</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('stripe.payment') }}" method="post" id="payment-form">
                        @csrf

                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" id="card-number" class="form-control" data-stripe="number" placeholder="Card Number">
                        </div>

                        <div class="form-group">
                            <label for="card-expiry">Expiration Date (MM/YY)</label>
                            <input type="text" id="card-expiry" class="form-control" data-stripe="exp" placeholder="MM/YY">
                        </div>

                        <div class="form-group">
                            <label for="card-cvc">CVC</label>
                            <input type="text" id="card-cvc" class="form-control" data-stripe="cvc" placeholder="CVC">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include Stripe.js -->
@endsection
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Create a Stripe client.
    var stripe = Stripe('{{ env("STRIPE_PK") }}');

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent multiple submissions.
        document.querySelector('button').disabled = true;

        stripe.createToken('card', {
            number: document.getElementById('card-number').value,
            exp_month: document.getElementById('card-expiry').value.split('/')[0],
            exp_year: document.getElementById('card-expiry').value.split('/')[1],
            cvc: document.getElementById('card-cvc').value
        }).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                // Re-enable the submit button.
                document.querySelector('button').disabled = false;
            } else {
                // Token successfully created, submit the form with token to your server.
                var tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', result.token.id);
                form.appendChild(tokenInput);
                console.log(result.token);
                console.log(tokenInput);

                // Submit the form.
                form.submit();
                // return false;
            }
        });
    });
</script>

@endpush

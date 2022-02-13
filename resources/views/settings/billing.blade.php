@extends('app')

@section('title', 'Profile Setting')

@section('content')

    <div class="bg-gray-200 min-h-screen pb-24">

        @include('partials.dashboard-header');

        <div class="container mx-auto max-w-3xl mt-8">
        
            <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">Billing Settings</h1>

            @include('settings.nav')

            @if(auth()->user()->subscribed('default'))
                <div id="switch-plans-modal" class="fixed w-full h-full inset-0 z-50">
                    <div class="fixed opacity-50 bg-black inset-0 w-full h-full"></div>
                    <form method="POST" action="{{ route('billing.switch_plan') }}" class="absolute bg-white rounded-lg p-5" id="switch-plans">
                        @csrf
                        
                        <div id="switch-plan-close" class="absolute right-0 top-0 -mt-4 -ml-4 h-8 w-8 rounded-full shadow bg-white text-xl flex justify-center align-center cursor-pointer">&times;</div>
                        <p class="text-sm text-gray-600 mb-4">Switch Plan</p>
                        @include('partials.plans');
                        <button type="submit" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer">
                            Switch Plans
                        </button>
                    </form>
                </div>
            @endif


            <form action="{{ route('billing.save') }}" id="billing-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                    <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                        <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Billing Settings</h2>
                        <p class="text-xs text-gray-500">Update your Billing info.</p>
                    </div>
                    <div class="md:w-2/3 w-full">
                        @if(auth()->user()->subscribed('default'))
                            <div class="py-8 px-16">
                                <div class="flex">
                                    <img src="/img/plans/{{ auth()->user()->plan->name }}.png" alt="{{ auth()->user()->plan->name }}" class="w-16 h-16 mr-3"/>
                                    <div>
                                        <span>Subscribed to {{ ucfirst(auth()->user()->plan->name) }} Plan</span>
                                        <span class="text-xs text-gray-700 block">{{ auth()->user()->plan->description }}</span>
                                    </div>
                                </div>

                                @if (auth()->user()->subscription('default')->onGracePeriod())
                                    <div class="bg-orange-500 px-5 rounded-lg mt-4 text-xs py-2 text-white">You have cancelled your account and your account is still active until {{ auth()->user()->subscription('default')->ends_at->toFormattedDateString() }}</div>
                                    <div class="flex justify-end items-end">
                                        <p class="text-sm text-gray-600 mr-2">Or,You Can </p>
                                        <a href="{{ route('resume') }}" class="text-green-500 font-medium text-sm underline">Resume Subscription</a>
                                    </div>
                                @else
                                <div class="flex justify-between items-center mt-4">
                                    <div id="switch-plan-btn" class="bg-gray-500 text-white text-sm font-medium px-6 py-2 rounded uppercase cursor-pointer inline-block">
                                        Switch My Plan
                                    </div>
                                    <a href="{{ route('cancel') }}" class="text-red-500 text-sm underline">Cancel Subscription</a>
                                </div>
                                @endif
                            </div>

                            <hr class="border-gray-300">

                            <div class="py-8 px-16">
                                <div class="text-xs text-blue-600">Your default payment method ends in {{ auth()->user()->card_last_four }}</div>
                                <div class="text-xs text-gray-500">To update your default payment method add a new card below</div>
                            </div>
                            <hr class="border-gray-200">
                        @endif   

                        @if(auth()->user()->onTrial())
                            <div class="py-8 px-16">

                                @include('partials.trial_notification')
                                <p class="text-sm text-gray-500 mt-2">Subscribe to a Plan Below:</p>
                            </div>
                            <hr class="border-gray-200">
                        @endif

                        <div class="py-8 px-16">
                            <label for="card-holder-name" class="text-sm text-gray-600">Name on Card</label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" id="card-holder-name" value="" name="name-on-card">
                        </div>
            
                        <hr class="border-gray-200">
            
                        <div class="py-8 px-16">
                            <label for="cc" class="text-sm text-gray-600">Creadit Card</label>
                            <div id="card-element"  class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"></div>
                            <div id="card-errors" class="text-red-400 text-bold mt-2 text-sm font-medium"></div>
                        </div>
                        @if(!auth()->user()->subscribed('default'))
                            <hr class="border-gray-200">
                            <div class="py-8 px-16">
                                <p class="text-sm text-gray-600 mb-4">Select a Plan</p>
                                @include('partials.plans')
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                    <p class="float-left text-xs text-gray-500 tracking-tight mt-2">Click on Save to update your Billing Info</p>
                    <button id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer">
                        Update Payment Method
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        const cardError = document.getElementById('card-errors');

        cardElement.addEventListener('change', function(event) {
            if (event.error) {
                cardError.textContent = event.error.message;
            } else {
                cardError.textContent = '';
            }
        });

        var form = document.getElementById('billing-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const { setupIntent, error } = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );
            if (error) {
                // Display "error.message" to the user...
                cardError.textContent = error.message;
            } else {
                // The card has been verified successfully...
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        });
    </script>

@endsection
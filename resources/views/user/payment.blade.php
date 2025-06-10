@extends('layouts.dashboard')

@section('content')
<div class="bg-gray-900 min-h-screen pt-16">
    <div class="container mx-auto px-4 py-8">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 my-6 bg-gray-800 border border-cyan-500/30 rounded-md text-cyan-400 hover:bg-cyan-500/10 hover:text-cyan-300 transition-colors">
            <i class="fas fa-arrow-left mr-2 transition-all"></i>
            <span>Kembali</span>
        </a>
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold font-orbitron mb-2 text-cyan-400">
                COMPLETE YOUR PURCHASE
            </h1>
            <p class="text-gray-400">Own "{{ $movie->title }}" permanently in your collection</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <!-- Movie Summary -->
            <div class="bg-gray-800/50 border border-pink-500/30 rounded-xl p-6 mb-8">
                <div class="flex items-center gap-4 mb-4">
                    @if($movie->poster)
                    <img src="{{ asset('storage/' . $movie->poster) }}"
                         alt="{{ $movie->title }}"
                         class="w-20 h-20 object-cover rounded-lg border border-cyan-500/30">
                    @endif
                    <div>
                        <h3 class="font-bold text-lg">{{ $movie->title }}</h3>
                        <div class="flex items-center text-sm text-gray-400">
                            <span>{{ $movie->genre }}</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span>{{ $movie->review_rating }}</span>
                        </div>
                    </div>
                </div>
                <div class="border-t border-cyan-500/20 pt-4 flex justify-between items-center">
                    <span class="text-gray-400">Total Amount:</span>
                    <span class="text-2xl font-bold text-pink-500">{{ number_format($movie->price, 2) }} CR</span>
                </div>
            </div>

            <!-- Payment Form -->
            <form method="POST" action="{{ route('checkout-process', $movie->id) }}" class="bg-gray-800/50 border border-cyan-500/30 rounded-xl p-6">
                @csrf

                <h2 class="text-xl font-bold font-orbitron mb-6 text-white">
                    PAYMENT METHOD
                </h2>

                <!-- Payment Method Selection -->
                <div class="grid grid-cols-1 gap-4 mb-8">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="credit_card" class="hidden peer" checked required>
                        <div class="p-4 border border-cyan-500/30 rounded-lg peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-credit-card text-cyan-400 text-xl mr-4"></i>
                                <div>
                                    <h4 class="font-bold">Credit/Debit Card</h4>
                                    <p class="text-sm text-gray-400">Visa, Mastercard, JCB</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="ewallet" class="hidden peer">
                        <div class="p-4 border border-cyan-500/30 rounded-lg peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-wallet text-pink-500 text-xl mr-4"></i>
                                <div>
                                    <h4 class="font-bold">E-Wallet</h4>
                                    <p class="text-sm text-gray-400">Gopay, OVO, DANA</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer" class="hidden peer">
                        <div class="p-4 border border-cyan-500/30 rounded-lg peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-university text-purple-400 text-xl mr-4"></i>
                                <div>
                                    <h4 class="font-bold">Bank Transfer</h4>
                                    <p class="text-sm text-gray-400">BCA, Mandiri, BRI</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Credit Card Details (shown when selected) -->
                <div id="credit-card-details" class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="card_number" class="block text-sm font-medium text-gray-400 mb-1">Card Number</label>
                            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456"
                                   class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        </div>
                        <div>
                            <label for="card_name" class="block text-sm font-medium text-gray-400 mb-1">Name on Card</label>
                            <input type="text" id="card_name" name="card_name" placeholder="JOHN DOE"
                                   class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label for="expiry" class="block text-sm font-medium text-gray-400 mb-1">Expiry Date</label>
                            <input type="text" id="expiry" name="expiry" placeholder="MM/YY"
                                   class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        </div>
                        <div>
                            <label for="cvv" class="block text-sm font-medium text-gray-400 mb-1">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123"
                                   class="w-full px-4 py-2 bg-gray-700 border border-cyan-500/30 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-start mb-8">
                    <input id="terms" name="terms" type="checkbox"
                           class="mt-1 h-4 w-4 bg-gray-700 border-cyan-500/30 rounded focus:ring-cyan-500 text-cyan-500" required>
                    <label for="terms" class="ml-2 block text-sm text-gray-400">
                        I agree to the <a href="#" class="text-cyan-400 hover:text-pink-500">Terms of Service</a> and <a href="#" class="text-cyan-400 hover:text-pink-500">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300">
                    CONFIRM PAYMENT
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const creditCardDetails = document.getElementById('credit-card-details');

    function toggleCreditCardFields() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
        creditCardDetails.style.display = selectedMethod === 'credit_card' ? 'block' : 'none';
    }

    paymentMethods.forEach(method => {
        method.addEventListener('change', toggleCreditCardFields);
    });

    // Initialize
    toggleCreditCardFields();
});
</script>
@endsection

@extends('layouts.dashboard')

@section('content')
<div class="bg-gray-900 min-h-screen flex items-center">
    <div class="container mx-auto px-4 py-8 text-center">
        <div class="max-w-md mx-auto bg-gray-800/50 border border-cyan-500/30 rounded-xl p-8">
            <div class="w-20 h-20 mx-auto mb-6 bg-cyan-500/10 rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-cyan-400 text-4xl"></i>
            </div>
            <h2 class="text-2xl font-bold font-orbitron mb-2 text-cyan-400">
                PAYMENT SUCCESSFUL!
            </h2>
            <p class="text-gray-300 mb-6">
                "{{ $movie->title }}" has been added to your library
            </p>
            <div class="mb-6">
                <img src="{{ asset('storage/'.$movie->poster) }}"
                     class="w-32 mx-auto rounded-lg border border-cyan-500/20">
            </div>
            <a href="{{ $redirect_url }}"
               class="inline-block px-6 py-3 bg-gradient-to-r from-cyan-500 to-pink-500 rounded-md text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
               VIEW MY LIBRARY
            </a>
        </div>
    </div>
</div>

<script>

setTimeout(function(){
    window.location.href = "{{ $redirect_url }}";
}, 5000);
</script>
@endsection

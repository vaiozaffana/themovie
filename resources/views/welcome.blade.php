<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Movies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Daftar Film</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($movies as $movie)
                <div class="bg-white p-4 shadow rounded">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-auto object-cover rounded">
                    <h2 class="text-lg font-semibold mt-2">{{ $movie->title }}</h2>
                    <p class="text-gray-600">{{ $movie->description }}</p>
                    <p class="text-gray-600">{{ $movie->genre }}</p>
                    <p class="text-gray-800 font-bold">Rp {{ number_format($movie->price, 0, ',', '.') }}</p>
                    <a href="#" class="block mt-3 text-center bg-blue-500 text-white py-2 rounded">Beli Sekarang</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

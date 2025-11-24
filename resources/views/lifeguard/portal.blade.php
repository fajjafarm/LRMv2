{{-- 002 resources/views/lifeguard/portal.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifeguard Clock-In – {{ $facility->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4f46e5">
</head>
<body class="bg-indigo-900 min-h-screen flex items-center justify-center p-8">
    <div class="bg-white rounded-3xl shadow-2xl p-20 text-center max-w-lg w-full">
        <h1 class="text-5xl font-black text-indigo-900 mb-12">LRM Lifeguard Portal</h1>
        <h2 class="text-4xl font-bold text-purple-700 mb-8">{{ $facility->name }}</h2>

        @if($currentShift)
            <div class="bg-green-100 border-8 border-green-600 rounded-3xl p-16 mb-12">
                <p class="text-5xl font-black text-green-800">CLOCKED IN</p>
                <p class="text-4xl text-gray-700 mt-8">
                    Since {{ $currentShift->clock_in_at->format('H:i') }}
                </p>
            </div>
            <form method="POST" action="{{ route('lifeguard.clockout', $facility) }}">
                @csrf
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white w-full py-12 rounded-3xl text-5xl font-black shadow-2xl">
                    CLOCK OUT NOW
                </button>
            </form>
        @else
            <div class="bg-gray-100 rounded-3xl p-16 mb-12">
                <p class="text-5xl font-black text-gray-600">NOT CLOCKED IN</p>
            </div>
            <form method="POST" action="{{ route('lifeguard.clockin', $facility) }}">
                @csrf
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white w-full py-12 rounded-3xl text-5xl font-black shadow-2xl">
                    CLOCK IN NOW
                </button>
            </form>
        @endif

        <div class="mt-16 text-gray-600">
            <p class="text-2xl">Your hours are automatically added to training records</p>
        </div>
    </div>
</body>
</html>
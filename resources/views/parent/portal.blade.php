{{-- 001 resources/views/parent/portal.blade.php --}}
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $booking->child_name }} – Swim Portal – {{ $booking->lesson->facility->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>
<body class="h-full bg-gradient-to-br from-cyan-50 via-blue-50 to-indigo-100 font-sans">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Hero -->
            <div class="bg-white rounded-3xl shadow-2xl p-16 text-center mb-12">
                <h1 class="text-6xl font-black text-indigo-900 mb-8">
                    Welcome, {{ $booking->parent_name }}!
                </h1>
                <div class="text-5xl font-bold text-purple-700 mb-4">
                    {{ $booking->child_name }}
                </div>
                <div class="text-4xl text-indigo-700">
                    {{ $booking->lesson->name }}
                </div>
                <div class="text-3xl text-gray-700 mt-6">
                    Every {{ $booking->lesson->day_of_week }} • {{ $booking->lesson->start_time->format('H:i') }}
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-12 text-center shadow-xl">
                    <div class="text-9xl mb-8">💧</div>
                    <h3 class="text-4xl font-black text-green-800 mb-4">Perfect Water Quality</h3>
                    <p class="text-7xl font-black text-green-600">{{ $latestTest->ph }}</p>
                    <p class="text-3xl text-gray-700 mt-4">Free Chlorine: {{ $latestTest->free_chlorine }} ppm</p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-12 text-center shadow-xl">
                    <div class="text-9xl mb-8">🛡️</div>
                    <h3 class="text-4xl font-black text-indigo-800 mb-4">All Lifeguards Qualified</h3>
                    <p class="text-7xl font-black text-indigo-600">100%</p>
                    <p class="text-3xl text-gray-700 mt-4">NPLQ In-Date</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-12 text-center shadow-xl">
                    <div class="text-9xl mb-8">📋</div>
                    <h3 class="text-4xl font-black text-purple-800 mb-4">Compliance Score</h3>
                    <p class="text-8xl font-black text-purple-600">{{ $complianceScore }}/100</p>
                </div>
            </div>

            <!-- Latest Test Details -->
            <div class="bg-white rounded-3xl shadow-2xl p-16">
                <h2 class="text-5xl font-black text-indigo-900 text-center mb-12">Today’s Pool Test Results</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                    <div class="text-center">
                        <p class="text-3xl text-gray-600">Temperature</p>
                        <p class="text-7xl font-black text-blue-600 mt-4">{{ $latestTest->temperature }}°C</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl text-gray-600">Free Chlorine</p>
                        <p class="text-7xl font-black text-green-600 mt-4">{{ $latestTest->free_chlorine }} ppm</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl text-gray-600">pH Level</p>
                        <p class="text-7xl font-black text-purple-600 mt-4">{{ $latestTest->ph }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl text-gray-600">Tested</p>
                        <p class="text-5xl font-bold text-gray-700 mt-4">{{ $latestTest->tested_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-20 text-gray-600">
                <p class="text-3xl font-bold">Powered by</p>
                <p class="text-5xl font-black text-indigo-700 mt-4">LRM</p>
                <p class="text-3xl mt-6">The UK’s Most Trusted Leisure Compliance Platform</p>
                <p class="text-xl mt-12 opacity-70">© {{ date('Y') }} LRM – Keeping Britain’s swimmers safe</p>
            </div>
        </div>
    </div>
</body>
</html>
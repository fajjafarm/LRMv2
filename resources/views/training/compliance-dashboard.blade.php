{{-- 010 resources/views/livewire/training/compliance-dashboard.blade.php --}}
<div class="p-8">
    <h1 class="text-3xl font-bold mb-8">Training Compliance Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-green-50 p-6 rounded-xl">
            <h3 class="font-bold">Compliant</h3>
            <p class="text-4xl font-bold text-green-600">{{ $compliantCount }}</p>
        </div>
        <div class="bg-yellow-50 p-6 rounded-xl">
            <h3 class="font-bold">Warning</h3>
            <p class="text-4xl font-bold text-yellow-600">{{ $warningCount }}</p>
        </div>
        <div class="bg-red-50 p-6 rounded-xl">
            <h3 class="font-bold">Critical</h3>
            <p class="text-4xl font-bold text-red-600">{{ $criticalCount }}</p>
        </div>
    </div>

    <table class="w-full bg-white rounded-xl shadow">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left">Staff Member</th>
                <th class="p-4 text-left">Qualification</th>
                <th class="p-4 text-left">Hours This Month</th>
                <th class="p-4 text-left">Required</th>
                <th class="p-4 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $user)
                <tr class="border-t">
                    <td class="p-4">{{ $user->name }}</td>
                    <td class="p-4">NPLQ</td>
                    <td class="p-4">{{ $user->monthlyHours() }}</td>
                    <td class="p-4">2</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-white {{ $user->isCompliant() ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ $user->isCompliant() ? 'Compliant' : 'Deficient' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
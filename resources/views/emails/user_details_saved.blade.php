<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md space-y-6">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800">🎉 User Details Saved</h1>
        <p class="mt-2 text-gray-600">The profile for <span class="font-semibold text-blue-600">{{ $user->fullName }}</span> has been updated successfully.</p>
    </div>

    <div class="border-t pt-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">📋 Updated Details</h2>
        <ul class="space-y-3">
            @foreach($details as $detail)
                <li class="flex justify-between items-center border-b pb-2">
                    <span class="font-medium text-gray-600">{{ $detail->key }}:</span>
                    <span class="text-gray-800">{{ $detail->value }}</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>

@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">User Details</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                        <div class="space-y-2">
                            <p><strong>Full Name:</strong> {{ $user->fullName }}</p>
                            <p><strong>Middle Initial:</strong> {{ $user->middleInitial }}</p>
                            <p><strong>Gender:</strong> {{ $user->prefixname }}</p>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Type:</strong> {{ $user->type }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Additional Details</h2>
                        <div class="space-y-2">
                            @foreach($user->details as $detail)
                                <p><strong>{{ $detail->key }}:</strong> {{ $detail->value }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('assessment1.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
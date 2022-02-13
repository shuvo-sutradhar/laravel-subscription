@extends('app')

@section('title', {{ $announcement->title }})

@section('content')

    <div class="bg-gray-200 min-h-screen">
        @include('partials.dashboard-header');
        <div class="max-w-3xl mx-auto pt-8">
            <h1 class="text-2xl font-medium mb-2 text-indigo-500">{{ $announcement->title }}</h1>
            <a href="{{ route('announcements') }}" class="underline text-sm text-blue-600">< Go back to all announcements</a>
            
            <div class="rounded-lg w-full p-8 bg-white mt-4">
                <p>{!! $announcement->body !!}</p>
            </div>
        </div>
    </div>
@endsection
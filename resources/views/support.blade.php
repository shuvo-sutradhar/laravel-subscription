@extends('app')

@section('title', 'Dashboard')

@section('content')

    <div class="bg-gray-200 min-h-screen">
        @include('partials.dashboard-header');
        <div class="max-w-3xl bg-white rounded-lg mx-auto my-16 px-16 py-12">
            <h1 class="text-2xl font-medium mb-2">Have a Support Question?</h1>
            <p>Please Leave a detailed description of your support inquiry.</p>
            
            <form action="{{ route('support.send') }}" method="POST" class="clearfix">
                @csrf
                <input class="wt-input" type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}"/>
                <textarea class="wt-input" name="message" cols="30" rows="10" placeholder="Your Support Message">{{ old('message') }}</textarea>
                <button class="wt-btn mt-4 ">Send Message</button>
            </form>
        </div>
    </div>
@endsection
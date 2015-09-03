@extends('app')
@section('body')
    <header class="welcome">
        @include('components.navigation')
        <p>User profile</p>

        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->email }}</li>
            <li>{{ $user->level }}</li>
            <li>{{ $user->points }}</li>
        </ul>

        <p>Latest reviews</p>

        @foreach($reviews as $review)
            Title : {{ $review->node->name }}<br>
            Score : {{ $review->score }}<br>
            Thumbs : {{ $review->thumbs }}<br>
            Created at : {{ $review->created_at }}
        @endforeach

@endsection

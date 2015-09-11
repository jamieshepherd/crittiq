@extends('app')
@section('body')
    <header class="dark profile">
        @include('components.navigation')
    </header>
    <div class="stats-bar">
        <div class="content">
            <ul class="stats">
                <li>Level 10</li>
                <li>+10,000 points</li>
                <li>33</li>
                <li>3 Crittiq's</li>
            </ul>
        </div>
    </div>
    <div class="full-wrapper">
        <div class="profile-bio">
            IMAGE
            <h3>{{ $user->name }}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quisquam, repudiandae!</p>
            <a class="btn">Follow</a>
        </div>
        <div class="profile-feed">
            <ul>
            @foreach($reviews as $review)
                <li class="review">
                    <h4>{{ $review->node['title'] }}</h4>
                    <div class="review-content">
                        <p>{{ $review->review }}</p>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    @include('components.footer')
@endsection

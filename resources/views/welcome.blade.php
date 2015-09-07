@extends('app')
@section('body')
    <header class="dark welcome">
        @include('components.navigation')
        <div id="search">
            <script>
                React.render(React.createElement(MainSearch), document.getElementById('search'));
            </script>
        </div>
        <span class="instruction"><a class="showLogin">Login</a> or <a href='/auth/register'>join crittiq</a> now to start making micro reviews about films you love.</span>
    </header>
    <div class="previews">
        <div class="preview">
            <span class="category">Films</span>
            <img src="/images/features/preview-child44.jpg">
            <div class="content">
                <div class="reaction-bar">
                    <div class="part negative"></div>
                    <div class="part mixed"></div>
                    <div class="part positive"></div>
                </div>
                <h3>Child 44</h3>
                <p><strong>2010</strong> directed by <strong>Christopher Nolan</strong></p>
            </div>
            <span class="sublink">Discover and crittiq <a href="/films">films</a></span>
        </div>
        <div class="preview">
            <span class="category">TV</span>
            <img src="/images/features/preview-gameofthrones.jpg">
            <div class="content">
                <div class="reaction-bar">
                    <div class="part negative"></div>
                    <div class="part mixed"></div>
                    <div class="part positive"></div>
                </div>
                <h3>Game of Thrones</h3>
                <p><strong>2011</strong> produced by <strong>HBO</strong></p>
            </div>
            <span class="sublink">Discover and crittiq <a href="/films">TV</a></span>
        </div>
        <div class="preview">
            <span class="category">Games</span>
            <img src="/images/features/preview-bioshock.jpg">
            <div class="content">
                <div class="reaction-bar">
                    <div class="part negative"></div>
                    <div class="part mixed"></div>
                    <div class="part positive"></div>
                </div>
                <h3>BioShock Infinite</h3>
                <p><strong>2013</strong> developed by <strong>Irrational Games</strong></p>
            </div>
            <span class="sublink">Discover and crittiq <a href="/films">games</a></span>
        </div>
    </div>
    <div class="feature">
        <h2>The pulse of the people.</h2>
        <p><em>Tap into the mood of the people or add your voice to the conversation.</em></p>
        <img src="/images/misc/example-review.jpg" class="example">
    </div>
    @include('components.footer')
@endsection

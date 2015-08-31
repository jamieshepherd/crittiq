@extends('app')
@section('body')
    <header class="dark welcome">
        @include('components.navigation')
        <div id="search">
            <div class="main-search">
                <h1>TESTFind or create micro reviews</h1>
                <div class="search-box">
                    <div class="selector">Film <i class="fa fa-caret-down"></i></div>
                    <input type="text"
                           v-model="query"
                           v-on="keyup: search($event)"
                           placeholder="Search..."
                           autofocus>
                    <div id="search-results">
                        <ul class="list-group">
                            <a v-repeat="nodes" href='/@{{ category }}/@{{ slug }}'>
                                <li>
                                    <img src="/images/uploads/@{{ category }}/poster/@{{ poster }}" class='thumbnail'>
                                        <h3>@{{ title }}</h3>
                                    <p>@{{ release_date }} directed by @{{ director }}</p>
                                    <span class='tag'><i class="fa fa-line-chart"></i> @{{ avg }}</span>
                                    <span class='tag'><i class="fa fa-comments-o"></i> @{{ reviewCount }}</span>
                                </li>
                            </a>

                            <div class="create-it" v-show='minResults'>
                                <i class="fa fa-cog fa-spin loading"></i>
                                <span>Can't find what you're looking for? <a href='/films/create/@{{ query }}    ' >Click to create it!</a></span>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <span class="instruction"><a v-on="click:showLogin">Login</a> or <a href='/auth/register'>join crittiq</a> now to start making micro reviews about films you love.</span>
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


    <script src="/js/app/components/main-search.js"></script>
@endsection

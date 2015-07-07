@extends('app')
@section('body')
    <div id="loading">
    </div>
    <section class="cover">
    <div class="gradient">
        <nav>
            <img class="logo" src="/images/logo.svg">
        </nav>
        <div class="details">
            <div class="score">
                8.9
            </div>
            <h1>Inception</h1>
            <h6><strong>Film (2010)</strong> directed by <strong>Christopher Nolan</strong></h6>
            <p>A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.</p>
            <div class="stats">
                <span><img class="tempgraph" src="/images/graph.png"></span>
                <span class="tag"><i class="fa fa-comments-o"></i> 51</span>
                <span class="tag"><i class="fa fa-eye"></i> 12,010</span>
                <span class="tag"><i class="fa fa-check"></i> Reviewed</span>
            </div>
        </div>
    </div>
    </section>
    <section class="information">
        <div id="search">
            <span class="category">FILM <i class="fa fa-caret-down"></i></span>
            <input type="text" id="search-input" placeholder="Start typing to search...">
            <div id="search-results"></div>
        </div>
        <div class="mini-nav">
            <div class="user-info">
                @if(Auth::check())
                <span class="avatar">
                    <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=22" >
                </span>{{ Auth::user()->name }}<span class="level">{{ Auth::user()->level }}</span><span class="points">+{{ Auth::user()->points }} points</span>
                @else
                    <a href="/auth/register">Create account</a> -
                    <a href="/auth/login">Sign in</a>
                @endif
            </div>
            <div class="search-button">
                <span>Search</span>
            </div>
        </div>
        <div class="content">
            <div class="user-review">
                <h2>What did you think about Inception?</h2>
                <textarea id="user-review"
                          v-model="review"
                          v-on="keyup: update"
                          placeholder="Enter your micro review here..."
                          maxlength="250"></textarea>
                <span class="character-count">@{{ count }}</span>
                <div class="sort">
                    <ul>
                        <li><a href="#" class="current">Latest</a></li>
                        <li><a href="#">Popular</a></li>
                        <li><a href="#">Highest rated</a></li>
                        <li><a href="#">Lowest rated</a></li>
                    </ul>
                </div>
            </div>
            <div class="feed">
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    <div class="details">
                        <span class="user"><i class="fa fa-user"></i><a href="#">PAUL MESSENGER</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/app/components/user-review.js"></script>
    <script src="/js/app/components/search.js"></script>
@endsection

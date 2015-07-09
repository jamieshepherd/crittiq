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
            <h1>{{ $node->title }}</h1>
            <h6><strong>Film ({{ $node->year }})</strong> directed by <strong>{{ $node->director }}</strong></h6>
            <p>{{ $node->synopsis }}</p>
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
                    <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=44" >
                </span>
                <span class="user-name" v-on="click:dropdown">
                    {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                </span>
                <div class="account-menu">
                    <span class="account-menu-name">{{ Auth::user()->name }}</span>
                    <span class="account-menu-email">{{ Auth::user()->email }}</span>
                    <div class="progress-outer">
                        <div class="progress-inner"></div>
                        <div class="progress-text">75% to next level</div>
                    </div>
                    <ul>
                        <li><a href="">My profile</a></li>
                        <li><a href="">History</a></li>
                        <li><a href="">Settings</a></li>
                        <li><a href="/auth/logout">Sign out</a></li>
                    </ul>
                </div>
                <span class="level"><i class="fa fa-trophy"></i> {{ Auth::user()->level }}</span>
                <span class="points"><i class="fa fa-diamond"></i> {{ Auth::user()->points }} </span>
                @else
                    <a href="/auth/register">Create account</a> -
                    <a href="/auth/login">Sign in</a>
                @endif
            </div>
            <div class="search-button">
                <span>Search</span>
            </div>
        </div>
        <div id="review-content">
            <div class="user-review">
                <h2>What did you think about {{ $node->title }}?</h2>
                <textarea id="user-review"
                          v-model="review"
                          v-on="keyup: update, focus: open"
                          placeholder="Enter your micro review here..."
                          maxlength="250"></textarea>
                <div class="user-review-actions">
                    <div class="user-review-actions-left">
                        <input type="submit" value="Post review">
                    </div>
                    <div class="user-review-actions-right">
                        <span class="character-count">@{{ count }}</span>
                    </div>
                </div>
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
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 day ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 day ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">2 days ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">2 days ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">3 days ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 week ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 week ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 week ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 month ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
                <div class="review">
                    <span class="score">8.9</span>
                    <div class="review-content">
                        <p>“Really fun film, Chris Pratt was great, and it really exceeded my expectations. Funny, action packed, and thoroughly enjoyable. Looking forward to a sequel!”</p>
                    </div>
                    <div class="details">
                        <span class="date"><i class="fa fa-clock-o"></i><a href="#">1 month ago</a></span>
                        <span class="user"><i class="fa fa-user"></i><a href="#">Paul Messenger</a></span>
                        <span class="thumbs"><i class="fa fa-thumbs-up"></i> 15</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/app/components/user-info.js"></script>
    <script src="/js/app/components/user-review.js"></script>
    <script src="/js/app/components/search.js"></script>
@endsection

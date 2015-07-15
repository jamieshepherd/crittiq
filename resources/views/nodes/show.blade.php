@extends('app')
@section('body')
    <div id="loading"></div>
    <div id="page">
        <section class="cover" style="background-image: url('/images/uploads/cover/{{ $node->cover }}')">
        <div class="gradient">
            <nav>
                <a href="/">
                    <img class="logo" src="/images/logo.svg">
                </a>
            </nav>
            <div class="details">
                <div class="score">
                    {{ $avg }}
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
                <input type="text"
                       id="search-input"
                       v-on="keyup: search"
                       v-model="query"
                       placeholder="Start typing to search...">
                <div id="search-results">
                    <ul class="list-group">
                        <li v-repeat="nodes">
                            <img src='http://placehold.it/125x125' class='thumbnail'>
                            <a href='/@{{ category }}/@{{ slug }}'>
                                <h3>@{{ title }}</h3>
                            </a>
                            <p><strong>@{{ year }}</strong> directed by <strong>@{{ director }}</strong></p>
                        </li>
                        <li class='' v-if='noResults'>Search for <strong>'@{{ query }}'</strong> on IMDB</li>
                    </ul>
                </div>
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
                        <div class="padding">
                            <div class="account-details">
                                <img class="avatar" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=120">
                                <span class="account-menu-name">{{ Auth::user()->name }}</span>
                                <span class="account-menu-email">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="progress-outer">
                                <div class="progress-inner"></div>
                                <div class="progress-text">75% to next level</div>
                            </div>
                            <ul>
                                <li><a href="/users/{{ Auth::user()->_id }}">My profile</a></li>
                                <li><a href="/users/{{ Auth::user()->_id }}/history">History</a></li>
                                <li><a href="/users/{{ Auth::user()->_id }}/settings">Settings</a></li>
                            </ul>
                        </div>
                        <a class="sign-out" href="/auth/logout">Sign out</a>
                    </div>
                    <span class="level"><i class="fa fa-trophy"></i> {{ Auth::user()->level }}</span>
                    <span class="points"><i class="fa fa-diamond"></i> {{ Auth::user()->points }} </span>
                    @else
                    <a class="btn outlined" href="/auth/register">Sign up</a>
                    <a class="btn green" href="/auth/login" class="login">Log in</a>
                    @endif
                </div>
                <div class="search-button">
                    <span>Search</span>
                </div>
            </div>
            <div id="review-content">
                <div class="user-review">
                    @if(!$userReview)
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <h2>What did you think about {{ $node->title }}?</h2>
                        <textarea name="review"
                                  id="user-review"
                                  v-model="review"
                                  v-on="keyup: updateCounter, focus: showActions"
                                  placeholder="Enter your micro review here..."
                                  maxlength="250"></textarea>
                        <span class="character-count">@{{ count }} characters remaining</span>
                        <div class="user-review-actions">
                            <input name="score" type="range" min="0" max="10" step="0.5" value="5" v-model="rangeCount">
                            <div class="user-review-actions-left">
                                <input type="checkbox"><label>My review contains spoilers</label>
                            </div>
                            <div class="user-review-actions-right">
                                <span class="rangeCount">@{{ rangeCount }}/10</span>
                                <input class="btn green" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                    @else
                        <h2>You said...</h2>
                        <span class='user-review-content'>&ldquo;{{ $userReview->review }}&rdquo;</span>
                    @endif
                    <div class="sort">
                        <ul>
                            <li><a href="#" class="current">Latest</a></li>
                            <li><a href="#">Popular</a></li>
                            <li><a href="#">Highest rated</a></li>
                            <li><a href="#">Lowest rated</a></li>
                        </ul>
                    </div>
                </div>
                <div id="review-feed">
                    <div class="review" v-repeat="reviews">
                        <span class="score">@{{ score }}</span>
                        <div class="review-content">
                            <p>@{{ review }}</p>
                        </div>
                        <div class="details">
                            <span class="date"><i class="fa fa-clock-o"></i><a href="review/@{{ _id }}">@{{ created_at.toString() }}</a></span>
                            <span class="user"><i class="fa fa-user"></i><a href="#">@{{ author }}</a></span>
                            <span class="thumbs"><i class="fa fa-thumbs-up"></i> @{{ thumbs }}</span>
                        </div>
                    </div>
                </div>
                <span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
            </div>
        </section>
    </div>
    <script src="/js/app/components/review.js"></script>
    <script src="/js/app/components/user-info.js"></script>
    <script src="/js/app/components/search.js"></script>
@endsection

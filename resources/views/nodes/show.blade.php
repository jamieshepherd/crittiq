@extends('app')
@section('body')
    <section class="cover background" style="background-image: url('/images/uploads/{{ $node->category }}/cover/{{ $node->cover }}')">
    <div class="gradient">
        {{-- Top left logo, not really navigation --}}
        <nav class='small'>
            <a href="/" class="logo"></a>
        </nav>
        {{-- Bottom left cover details --}}
        <div class="details">
            <div class="score">{{ $node->avg or '&mdash;' }}</div>
            <h1>{{ $node->title }}</h1>
            <h6><strong>{{ $node->year }}</strong> film @if(!empty($node->director)) directed by <strong>{{ $node->director }}</strong>@endif</h6>
            <p>{{ $node->synopsis }}</p>
            <div class="stats">

                <span class="tag" title="Number of comments"><i class="fa fa-comments-o"></i> {{ $node->reviewCount or '0' }} REVIEWS</span>
                <!--span class="tag" title="Number of views"><i class="fa fa-eye"></i> 12,010</span-->
                @if($node->themoviedb_id)
                    <a class="tag" href="http://themoviedb.org/movie/{{ $node->themoviedb_id }}" target="_blank" title="The Movie DB link"><i class="fa fa-external-link"></i> TMDB</a>
                @endif
                @if($node->imdb_id)
                    <a class="tag" href="http://imdb.com/title/{{ $node->imdb_id }}" target="_blank" title="IMDB link"><i class="fa fa-external-link"></i> IMDB</a>
                @endif

            </div>
        </div>
    </div>
    </section>
    {{-- Right hand side --}}
    <section class="information">
        {{-- Entire search element --}}
        <div id="search">
            <span class="category">FILM <i class="fa fa-caret-down"></i></span>
            <input type="text"
                   id="search-input"
                   v-model="query"
                   v-on="keyup: search($event)"
                   placeholder="Start typing to search..."
                   debounce="500">

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
                        <span>Can't find what you're looking for? <a href='/films/create/@{{ query }}    ' >Click to create it!</a></span>
                    </div>
                </ul>
            </div>
        </div>
        {{-- Top right navigation bar --}}
        <div class="mini-nav">
            <div class="user-info">
                @if(Auth::check())
                <span class="avatar">
                    <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=44" >
                </span>
                <span class="user-name" v-on="click:showAccountPanel">
                    {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                </span>

                @include('components.accountMenu')

                <span class="level"><i class="fa fa-trophy"></i> {{ Auth::user()->level }}</span>
                <span class="points"><i class="fa fa-diamond"></i> {{ Auth::user()->points }} </span>
                @else
                <a class="btn outlined" href="/auth/register">Sign up</a>
                <a class="btn green" class="login" v-on="click:showLogin">Log in</a>
                @endif
            </div>
            <div class="search-button">
                <span>Search</span>
            </div>
        </div>
        {{-- Review content, including user review and feed --}}
        <div id="review-content">

            @if(true)
            {{-- User review --}}
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
                        <li>
                            <a v-on="click: sortBy('latest')"
                               v-class="current: filter == 'latest'"
                               href="#">Latest</a>
                        </li>
                        <li>
                            <a v-on="click: sortBy('oldest')"
                               v-class="current: filter == 'oldest'"
                               href="#">Oldest</a>
                        </li>
                        <li>
                            <a v-on="click: sortBy('highest')"
                               v-class="current: filter == 'highest'"
                               href="#">Highest rated</a>
                        </li>
                        <li>
                            <a v-on="click: sortBy('lowest')"
                               v-class="current: filter == 'lowest'
                               "href="#">Lowest rated</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Review feed --}}
            <div id="review-feed">
                <div class="review" v-repeat="reviews">
                    <!--span class="score">@{{ score.toFixed(1); }}</span-->
                    <div class="avatar">
                        <img src="http://www.gravatar.com/avatar/072bce9a71fc97034cf16c99e821f93d?s=150" >
                        <span class="username"><a>Jamie</a></span>
                    </div>

                    <div class="review-content">
                        <p>@{{ review }}</p>
                    </div>
                    <div class="details">
                        <span class="score"><strong>@{{ score }}</strong> / 10</span>
                        <span class="date">3 days ago</span>
                        <span class="hearts"><i class="fa fa-heart"></i> 0</span>
                        <span class="comment"><i class="fa fa-comment"></i> 1</span>
                        <span class="more"><i class="fa fa-ellipsis-h"></i></span>

                        <!--span class="thumbs" v-on="click: thumbsUp(id)">@{{_id}}<i class="fa fa-thumbs-up"></i> @{{ thumbs }}</span-->
                    </div>
                </div>
                <a class="more-reviews" v-on="click: getMoreReviews"><i class="fa fa-arrow-circle-o-down"></i> Show more reviews</a>
            </div>
            <span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
            @else
                <div class="user-review">
                    <h2>3d 14h 13m 11s</h2>
                    <p>Sorry, this film hasn't been released yet so you can't review it. Why not search for another?</p>
                </div>
            @endif
        </div>
    </section>
    <script src="/js/app/components/cover.js"></script>
    <script src="/js/app/components/review.js"></script>
    <script src="/js/app/components/search.js"></script>
@endsection

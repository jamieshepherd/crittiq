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
            @if($node->avg)
            <div id="myStat" data-dimension="80" data-text="{{ $node->avg }}" data-width="1" data-fontsize="26" data-percent="{{ ($node->avg*10) }}" data-fgcolor="#54d0bf" data-bgcolor="#1f2527" class='score'></div>
            <script> $('#myStat').circliful(); </script>
            @endif

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
            <script>React.render(React.createElement(SideSearch), document.getElementById('search'));</script>
        </div>
        {{-- Top right navigation bar --}}

        <div class="mini-nav">
            @if(Auth::check())
                <div id="user-info">
                    <script>React.render(React.createElement(UserInfo, {"name": "{{ Auth::user()->name }}", "email": "{{ Auth::user()->email }}", "gravatar": "{{ md5(strtolower(trim( Auth::user()->email ))) }}","rank": 5, "points": 10}), document.getElementById('user-info'));</script>
                </div>
            @else
                <span class="logged-out">
                    <a class="showLogin">Login</a> or
                    <a href="/auth/register">join crittiq</a> now
                </span>
            @endif
            <span class="search-button" onClick="showSideNav()"></span>
        </div>

        {{-- Review content, including user review and feed --}}
        @if($node->release_date < date("Y-m-d"))

            <div id="review-content">

            <script>React.render(React.createElement(NodeReview, {"totalReviews": "{{ $node->reviewCount or 0 }}", "_token":"{{ csrf_token() }}", "nodeName":"{!! $node->title !!}"}), document.getElementById('review-content'));</script>
        </div>
        @else
        <div id="review-content">
            <div class="user-review">
                <script src="/js/vendor/jquery.countdown.min.js"></script>
                <h2 class='countdown'></h2>
                <script type="text/javascript">
                    $(".countdown").countdown("{{ $node->release_date }}", function(event) {
                        $(this).html(event.strftime(''
                            + '<span>%w</span> weeks&nbsp;&nbsp;&nbsp;'
                            + '<span>%d</span> days&nbsp;&nbsp;&nbsp;'
                            + '<span>%H</span> hr&nbsp;&nbsp;&nbsp;'
                            + '<span>%M</span> min&nbsp;&nbsp;&nbsp;'
                            + '<span>%S</span> sec'));
                    });
                </script>
                <p>Sorry, this film hasn't been released yet so you can't review it. Why not search for another?</p>
            </div>
        </div>
        @endif
    </section>
    <script>
        BackgroundCheck.init({
            targets: '.logo',
            images: '.background',
            threshold: 75
        });
    </script>
@endsection

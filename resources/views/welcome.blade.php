<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>

    <link media="all" type="text/css" rel="stylesheet" href="{{ elixir("css/app.css") }}">
    <link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/js/vendor/vue-0.12.6.js"></script>
    <script src="/js/vendor/jquery-2.1.4.js"></script>
</head>
<body>
    <section class="cover">
    <div class="gradient">
        <div class="details">
            <div class="score">
                8.9
            </div>
            <h1>Inception</h1>
            <h6><strong>2010</strong> directed by <strong>Christopher Nolan</strong></h6>
            <p>A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.</p>
            <div class="stats">
                <span><img class="tempgraph" src="/images/graph.png"></span>
                <span class="tag"><i class="fa fa-thumbs-up"></i> 151</span>
                <span class="tag"><i class="fa fa-eye"></i> 12,010</span>
            </div>
        </div>
    </div>
    </section>
    <section class="information">
        <div class="mini-nav">
            <div class="user-info">
                @if(Auth::check())
                <span class="avatar"><img src="/images/avatar.png"></span>{{ Auth::user()->name }}<span class="level">{{ Auth::user()->level }}</span><span class="points">+{{ Auth::user()->points }} points</span>
                @else
                    <a href="/auth/register">Create account</a> -
                    <a href="/auth/login">Sign in</a>
                @endif
            </div>
            <div class="search">
                SEARCH
            </div>
        </div>
        <div class="content">
            <div class="user-review">
                <h2>What did you think about Inception?</h2>
                <textarea placeholder="Enter your review now..."></textarea>
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
            </div>
        </div>
    </section>
</body>
</html>

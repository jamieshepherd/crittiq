@extends('app')
@section('body')
    <header class="welcome">
        <nav>
            <a href="/" class="logo"></a>
        </nav>
        <div class="main-search">
            <h1>Find or create micro reviews</h1>
            <div class="search-box">
                <div class="selector">Film</div>
                <input type="text" placeholder="Search...">
            </div>
            <span><a v-on="click:showLogin">Login</a> or <a href='/auth/register'>join crittiq</a> now to start making micro reviews about films you love.</span>
        </div>
    </header>
    <div class="previews">
        <div class="preview">
            <span class='category'>Films</span>
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
        </div>
        <div class="preview">
            <span class='category'>TV</span>
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
        </div>
        <div class="preview">
            <span class='category'>Games</span>
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
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>


    <script src="/js/app/components/search.js"></script>
@endsection

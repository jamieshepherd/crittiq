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
    <div class="">

    </div>



    <script src="/js/app/components/search.js"></script>
@endsection

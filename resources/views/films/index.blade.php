@extends('app')
@section('body')
    <section class="category-search">
        <nav>
            <a href="/" class="logo"></a>
        </nav>
        <div class="search">
            <h1>Find or create micro reviews</h1>
            <input type="text" placeholder="Film title...">
            <span><a v-on="click:showLogin">Login</a> or <a href='/auth/register'>join crittiq</a> now to start making micro reviews about films you love.</span>
        </div>
    </div>
    <script src="/js/app/components/search.js"></script>
@endsection

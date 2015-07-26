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
        <div class="previews">
            <div class="row">
                <div class="cell background" style="background: url(/images/cover-bg.jpg)">
                    <span>Jackie Brown</span>
                </div>
                <div class="cell review">
                    <span>“Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”</span>
                </div>
                <div class="cell background" style="background: url(/images/cover-bg.jpg)">
                    <span>Jackie Brown</span>
                </div>
                <div class="cell review">
                    <span>“Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..” </span>
                </div>
            </div>
            <div class="row">
                <div class="cell review">
                    <span>“Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”</span>
                </div>
                <div class="cell background" style="background: url(/images/cover-bg.jpg)">
                    <span>Jackie Brown</span>
                </div>
                <div class="cell review">
                    <span>“Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”</span>
                </div>
                <div class="cell background" style="background: url(/images/cover-bg.jpg)">
                    <span>Jackie Brown</span>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app/components/search.js"></script>
@endsection

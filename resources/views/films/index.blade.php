@extends('app')
@section('body')
    <nav>
        <a href="/" class="logo"></a>
    </nav>
    <div class="category-search">
        <h1>Find or create micro reviews</h1>
        <input type="text" placeholder="Film title...">
        <span><a v-on="click:showLogin">Login</a> or <a href='/auth/register'>join crittiq</a> now to start making micro reviews about films you love.</span>
    </div>
    <table class="previews">
        <tr>
            <td class="background" style="background: url(/images/cover-bg.jpg)">
                <div class="content">
                    <span class="title">Jackie Brown</span>
                    <span class="author">Crittiq by Jamie Shepherd</span>
                </div>
            </td>
            <td class="review">
                <div class="content">
                    “Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”
                </div>
            </td>
            <td class="background" style="background: url(/images/cover-bg.jpg)">
                <div class="content">
                    <span class="title">Jackie Brown</span>
                    <span class="author">Crittiq by Jamie Shepherd</span>
                </div>
            </td>
            <td class="review">
                <div class="content">
                    “Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”
                </div>
            </td>
        </tr>
        <tr>
            <td class="review">
                <div class="content">
                    “Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”
                </div>
            </td>
            <td class="background" style="background: url(/images/cover-bg.jpg)">
                <div class="content">
                    <span class="title">Jackie Brown</span>
                    <span class="author">Crittiq by Jamie Shepherd</span>
                </div>
            </td>
            <td class="review">
                <div class="content">
                    “Enjoyed the film. Interesting concept and a somewhat unique approach to the idea of AI. Handful of plot holes, but forgiving considering how much was crammed into 1hr 50m. Didn’t think Oscar Isaac was cast right, made too many mistakes for a genius..”
                </div>
            </td>
            <td class="background" style="background: url(/images/cover-bg.jpg)">
                <div class="content">
                    <span class="title">Jackie Brown</span>
                    <span class="author">Crittiq by Jamie Shepherd</span>
                </div>
            </td>
        </tr>
    </table>

    <script src="/js/app/components/search.js"></script>
@endsection

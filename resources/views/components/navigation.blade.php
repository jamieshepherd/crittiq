<nav>
    <a href="/" class="logo"></a>
    <div class="nav-account">
        @if(Auth::check())
        @include('components.user-info')
        @else
        <a v-on="click:showLogin" class="btn outlined login">Log in</a>
        <a href="/auth/register" class="btn outlined signup">Sign up</a>
        @endif
    </div>
</nav>

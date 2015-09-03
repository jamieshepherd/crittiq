<nav>
    <a href="/" class="logo"></a>
    <div class="nav-account">
        @if(Auth::check())
            @include('components.user-info')
        @else
        <a class="btn outlined login showLogin">Log in</a>
        <a href="/auth/register" class="btn outlined signup">Sign up</a>
        @endif
    </div>
</nav>

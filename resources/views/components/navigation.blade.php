<nav>
    <a href="/" class="logo"></a>
    <div class="nav-account">
        @if(Auth::check())
            <div id="user-info">
                <script>React.render(React.createElement(UserInfo, {"rank": 5, "points": 10}), document.getElementById('user-info'));</script>
            </div>
        @else
        <a class="btn outlined login showLogin">Log in</a>
        <a href="/auth/register" class="btn outlined signup">Sign up</a>
        @endif
    </div>
</nav>

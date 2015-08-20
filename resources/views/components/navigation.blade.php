<nav>
    <a href="/" class="logo"></a>
    <div class="nav-account">
        @if(Auth::check())
        <div class="user-info">
            <span class="avatar">
                <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=44" >
            </span>
            <span class="user-name" v-on="click:showAccountPanel">
                {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
            </span>

            @include('components.accountMenu')

            <span class="level"><i class="fa fa-trophy"></i> {{ Auth::user()->level }}</span>
            <span class="points"><i class="fa fa-diamond"></i> {{ Auth::user()->points }} </span>
        </div>
        @else
        <a v-on="click:showLogin" class="btn outlined login">Log in</a>
        <a href="/auth/register" class="btn outlined signup">Sign up</a>
        @endif
    </div>
</nav>

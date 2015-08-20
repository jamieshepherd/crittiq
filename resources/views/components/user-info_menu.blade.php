<div class="account-menu">
    <div class="padding">
        <div class="account-details">
            <img class="avatar" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?s=120">
            <span class="account-menu-name">{{ Auth::user()->name }}</span>
            <span class="account-menu-email">{{ Auth::user()->email }}</span>
        </div>
        <div class="progress-outer">
            <div class="progress-inner"></div>
            <div class="progress-text">75% to next level</div>
        </div>
        <ul>
            <li><a href="/users/{{ Auth::user()->_id }}">My profile</a></li>
            <li><a href="/users/{{ Auth::user()->_id }}/history">History</a></li>
            <li><a href="/users/{{ Auth::user()->_id }}/settings">Settings</a></li>
        </ul>
    </div>
    <a class="sign-out" href="/auth/logout">Sign out</a>
</div>

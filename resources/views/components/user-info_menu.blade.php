<div class="account-menu">
    <div class="padding">
        <div class="account-details">
            <img class="avatar" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=120">
            <span class="account-menu-name">{{ Auth::user()->name }}</span>
            <span class="account-menu-email">{{ Auth::user()->email }}</span>
        </div>
        <div class="progress-outer">
            <div class="progress-inner"></div>
            <div class="progress-text">75% to next level</div>
        </div>
        <ul>
            <li><a href="/account/profile">My profile</a></li>
            <li><a href="/account/history">History</a></li>
            <li><a href="/account/settings">Settings</a></li>
        </ul>
    </div>
    <a class="sign-out" href="/auth/logout">Sign out</a>
</div>

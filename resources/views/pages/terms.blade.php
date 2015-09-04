@extends('app')
@section('body')
    <header class="dark document">
        @include('components.navigation')
        <div class="title">
            <h2>Terms and Conditions.</h2>
            <p><em>Boring but necessary, the terms you agree to when using our service</em></p>
        </div>
    </header>
    <article>
        <menu class="quick-nav">
            <h3>Quick menu</h3>
            <ul>
                <li><a href="#"># Basic Terms</a></li>
                <li><a href="#"># Basic Terms</a></li>
                <li><a href="#"># Basic Terms</a></li>
                <li><a href="#"># Basic Terms</a></li>
            </ul>
        </menu>
        <div class="content">
            <h3>Something</h3>
            <p>These Terms of Service (“Terms”) govern your access to and use of our Services, including our various websites, SMS, APIs, email notifications, applications, buttons, widgets, ads, commerce services (the “Twitter Services”), and our other covered services that link to these Terms (collectively, the “Services”), and any information, text, graphics, photos or other materials uploaded, downloaded or appearing on the Services (collectively referred to as “Content”). Your access to and use of the Services are conditioned on your acceptance of and compliance with these Terms. By accessing or using the Services you agree to be bound by these Terms.</p>
        </div>
    </article>
@endsection

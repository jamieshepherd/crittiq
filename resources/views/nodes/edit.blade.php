@extends('app')
@section('body')
    <section class="cover background" style="background: no-repeat {{ $node->backgroundPosition."%" }} center url('/images/uploads/{{ $node->category }}/cover/{{ $node->cover }}')">
        <div class="gradient">
            {{-- Top left logo, not really navigation --}}
            <nav class='small'>
                <a href="/" class="logo"></a>
            </nav>
        </div>
    </section>
    {{-- Right hand side --}}
    <section class="information">
        {{-- Entire search element --}}
        <div id="search">
            <script>React.render(React.createElement(SideSearch), document.getElementById('search'));</script>
        </div>
        {{-- Top right navigation bar --}}

        <div class="mini-nav">
            @if(Auth::check())
                <div id="user-info">
                    <script>React.render(React.createElement(UserInfo, {"name": "{{ Auth::user()->name }}", "email": "{{ Auth::user()->email }}", "gravatar": "{{ md5(strtolower(trim( Auth::user()->email ))) }}","rank": 5, "points": 10}), document.getElementById('user-info'));</script>
                </div>
            @else
                <span class="logged-out">
                    <a class="showLogin">Login</a> or
                    <a href="/auth/register">join crittiq</a> now
                </span>
            @endif
            <span class="search-button" onClick="showSideNav()"></span>
        </div>

        {{-- Review content, including user review and feed --}}
        <div id="review-content">
            <div class="user-review">
                <h2>Image settings</h2>
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <label>Horizontal position</label>
                    <div className="slider">
                        <input id="position-slider" max="100" min="0" name="position" step="10" type="range" value="{{ $node->backgroundPosition }}"/>
                        <script>
                            $('input[type="range"]').rangeslider({ polyfill: false });
                            $('#position-slider').change(function() {
                                console.log('change: '+$('#position-slider').val());
                                $('.cover').css({
                                    'backgroundPosition': $('#position-slider').val()+'% top'
                                });
                                BackgroundCheck.refresh();
                            });
                        </script>
                    </div>
                    <br>
                    <input type="submit" value="Save changes">
                </form>
            </div>
        </div>
    </section>
    <script>
        BackgroundCheck.init({
            targets: '.logo',
            images: '.background',
            threshold: 75
        });
    </script>
@endsection

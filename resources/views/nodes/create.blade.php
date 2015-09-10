@extends('app')
@section('body')
    <header class="dark document">
        @include('components.navigation')
        <div class="title">
            <h2>Create an entry in /films</h2>
            <p><em>Data courtesy of <a href="http://themoviedb.org" target="_blank">The Movie DB</a></em></p>
        </div>
    </header>
    <article class="create">
        <ul>
            @foreach($results as $result)
                <li>
                    <div class="wrapper">
                        <img class="poster" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}">
                        <div class="description">
                            <h3>{{ $result['title'] }} ({{ date('Y',strtotime($result['release_date'])) }})</h3>
                            <a class="btn green" href='/films/create/confirm/{{ $result['id'] }}'>Add this movie</a>
                            <p>{{ $result['overview'] }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </article>
    @include('components.footer')
@endsection


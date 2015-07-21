@extends('app')
@section('body')

    <h2>Create an entry in films</h2>
    <p>Data courtesy of The Movie DB</p>
    <hr>
    <ul>
        @foreach($results as $result)
        <li>
            <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}">
            <h4>{{ $result['title'] }}</h4> ({{ date('Y',strtotime($result['release_date'])) }})
            <p>{{ $result['overview'] }}</p><br><br>
            <a class="btn green" href='/films/create/confirm/{{ $result['id'] }}'>Add this movie</a>
        </li>
        @endforeach
    </ul>

@endsection

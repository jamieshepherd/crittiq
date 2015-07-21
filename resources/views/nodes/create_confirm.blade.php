@extends('app')
@section('body')

    <h2>Add a new entry</h2>
    <p>Perfect, you just need to choose a unique address for this film. This will look something like <strong>the-shawshank-redemption</strong>, and must be unique.</p>
    <form action="" method="POST">
        {{ csrf_field() }}
        <label>Unique address</label>
        <input name="slug" type="text" value='{{ strtolower(preg_replace("![^a-z0-9]+!i", "-", $response['title'])) }}' placeholder="Unique address here">
        <input type="submit" class="btn">
    </form>

@endsection

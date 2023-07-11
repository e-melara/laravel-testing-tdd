@extends('layouts.app')

@section('content')
    <form action="{{route('statuses.store')}}" method="POST">
        @csrf
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
        <button id="create-status">Publicar estado</button>
    </form>
@endsection

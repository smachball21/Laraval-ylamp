@extends('front._layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center">
        @foreach($posts as $post)
            {{$post->description}}
        @endforeach
    </div>
@endsection

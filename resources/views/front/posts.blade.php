@extends('front._layouts.app')

@push('styles')
    <link href="{{ mix('css/front/posts.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="d-flex justify-content-between flex-wrap">
                    @foreach($posts as $post)
                        <a href="{{ route('comments.get', ['post' => $post->id])}} " class="no-underline">
                            <div class="card my-3">
                                <div class="card-title text-center mt-2 mb-0 text-muted small">
                                    {{ucfirst($post->created_at->isoFormat('dddd Do MMMM YYYY')) . ' à ' . $post->created_at->format('H:i')}}
                                </div>
                                <div class="card-body text-break mt-0">
                                    {{$post->description}}
                                </div>
                            </div>
                        </a>

                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

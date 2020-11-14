@extends('front._layouts.app')

@push('styles')
    <link href="{{ mix('css/front/posts.css') }}" rel="stylesheet">
@endpush
@section('content')

{{--    <section id="addPost" class="addPost my-5">--}}
{{--        <div class="container">--}}
{{--            <div class="text-center">--}}
{{--                <form action=" {{route('posts.add')}} " method="POST" id="add">--}}
{{--                    @csrf--}}
{{--                    <div class="row justify-content-center">--}}
{{--                        <div class="form-group col-10">--}}
{{--                            @form('textarea', [--}}
{{--                            'label' => ['text' => 'Ajouter un nouveau post'],--}}
{{--                            'input' => ['name' => 'description',--}}
{{--                            'placeholder' => 'Veuillez ajouter votre contenu ici',--}}
{{--                            'rows' => 4,--}}
{{--                            'value' => old('description')],--}}
{{--                            ])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button type="submit" form="add" class="btn btn-dark btn-padded ">--}}
{{--                        <i class="far fa-plus mr-2"></i> Ajouter un post--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="m-5">
        <div class="container d-flex justify-content-center">
            <div class="text-center">
                <form action="{{route('posts.add')}}" method="POST" id="add">
                    @csrf
                    @form('textarea', [
                    'label' => ['text' => 'Ajouter un nouveau post'],
                    'input' => ['name' => 'description',
                    'placeholder' => 'Veuillez ajouter votre contenu ici',
                    'rows' => 4,
                    'class' => 'description',
                    'value' => old('description')],
                    ])
                    <button type="submit" form="add" class="btn btn-dark btn-padded mt-2">
                        <i class="far fa-plus mr-2"></i> Ajouter un post
                    </button>
                </form>
            </div>
        </div>

    </section>

    <hr class="col-8">

    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="d-flex justify-content-between flex-wrap">
                    @foreach($posts as $post)
                        <div class="no-underline w-100 my-3">
                            <div class="card mb-0">
                                <div class="card-title card-header text-center text-light bblue">
                                    {{ucfirst($post->created_at->isoFormat('dddd Do MMMM YYYY')) . ' à ' . $post->created_at->format('H:i')}}
                                </div>
                                <div class="card-body text-break mt-0">
                                    {!!$post->description!!}
                                </div>
                                <div class="card-footer text-light bblue">
                                    <div class="d-flex">
                                        @if (count($post->comments) >= 1)
                                            <div class="col text-left">
                                                <button type="button" class="btn btn-info" data-toggle="collapse"
                                                        data-target="#collapse{{$post->id}}" aria-expanded="false"
                                                        aria-controls="collapse{{$post->id}}">Commentaire(s)
                                                </button>
                                            </div>
                                        @else
                                            <div class="col text-left">
                                                Aucun commentaire
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-end align-self-center">
                                            <u>Auteur: </u>&#160; {{$post->user->getFullName()}}
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="collapse{{$post->id}}">
                                <div class="card card-body small">
                                    @foreach ($post->comments as $comment)
                                        <div class="row mb-2">
                                            <div class="col col-md-2">
                                                {{ucfirst($comment->created_at->isoFormat('Do-MM-YYYY')) . $post->created_at->format(' H:i')}}
                                            </div>
                                            <div class="col">
                                                {{$comment->user->getFullName()}}
                                            </div>
                                            <div class="col col-md-8    ">
                                                {{$comment->comment}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea.description',
                width: 900,
                height: 300,
                statusbar: false,
                plugins: "emoticons hr image link lists charmap table code",
                toolbar: "formatgroup paragraphgroup insertgroup code | undo redo | cut copy paste",
                toolbar_groups: {
                    formatgroup: {
                        icon: 'format',
                        tooltip: 'Formatting',
                        items: 'bold italic underline strikethrough | forecolor backcolor | superscript subscript | removeformat'
                    },
                    paragraphgroup: {
                        icon: 'paragraph',
                        tooltip: 'Paragraph format',
                        items: 'h1 h2 h3 | bullist numlist | alignleft aligncenter alignright | indent outdent'
                    },
                    insertgroup: {
                        icon: 'plus',
                        tooltip: 'Insert',
                        items: 'link image emoticons charmap hr'
                    }
                },
            });
        </script>
    @endpush

@endsection


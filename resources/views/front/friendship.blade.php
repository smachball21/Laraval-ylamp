@extends('front._layouts.app')

@section('title', __('FriendShip'))

@push('styles')
    <link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main class="text-center my-5 full-height">
        <h1 class="display-3 mb-5">Trouvez, invitez, supprimez vos amis en 1 clic</h1>
        <div class="container m-0 w-100 h-100">
            <div class="d-flex row align-items-start">
                <div class="d-flex justify-content-start col-md-8 align-self-center text-center ">
                    <ul class="list-group list-group-flush text-decoration-none">
                        <a href="{{ route('friendship.search') }}">
                            <li class="list-group-item">Trouvez des amis</li>
                        </a>
                        <a href="{{ route('friendship.friends') }}">
                            <li class="list-group-item">Mes amis</li>
                        </a>
                        <a href="{{ route('friendship.request') }}">
                            <li class="list-group-item">Mes demande</li>
                        </a>
                    </ul>
                </div>
                <div class="col-sm align-self-center">
                    <div class="row align-items-center ">
                        <div class="content w-100">
                            <div class="card">
                                <table class="table table-striped m-0">
                                    @include('front.friendship._partials.'.$partial, ['friends' => $friends])
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

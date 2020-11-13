@extends('front._layouts.app')

@section('title', __('FriendShip'))

@push('styles')
    <link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main class="text-center my-5">
        <h1 class="display-3">Trouvez, invitez, supprimez vos amis en 1 clic</h1>
    </main>
    <div class="row align-items-center">
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush text-decoration-none">
                <a href="{{ route('friendship.search') }}"><li class="list-group-item">Trouvez des amis</li></a>
                <a href="{{ route('friendship.friends') }}"><li class="list-group-item">Mes amis</li></a>
                <a href="{{ route('friendship.request') }}"><li class="list-group-item">Mes demande</li></a>
            </ul>
        </div>

        <div class="container d-flex justify-content-center">
            <div class="content w-50">
                <div class="card">
                    <table class="table table-striped">
                       @include('front.friendship._partials.'.$partial, ['friends' => $friends])
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

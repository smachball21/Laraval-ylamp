@extends('front._layouts.app')

@section('title', __('FriendShip'))

@push('styles')
    <link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main class="text-center my-5">
        <h1 class="display-3">Trouvez, invitez, supprimer vos amis en 1 clic</h1>
    </main>
    <div class="container d-flex justify-content-center">
        <div class="content w-50">
            <div class="card">
                <table class="table table-striped">
                    @include('front.friendship._partials.list_table', ['users' => $users])
                </table>

                @if ($users->lastPage() > 1)
                    <div class="card-body">
                        <nav class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

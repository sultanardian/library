@extends('layouts.app')

@section('not-authorized')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Library Home') }}</div>

                    <div class="card-body">
                        <h1>Welcome to the Library!</h1>
                        <p>Explore our vast collection of books and resources.</p>
                        <p>Join our community, borrow books, and expand your knowledge.</p>
                        <p>Happy reading!</p>

                        @auth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.home')

@section('content')
    &nbsp;
    <h1 class="text-center">Buy Avatars - You have {{ Auth::user()->coins }} Coins</h1>
    <p class="lead text-center mb-4">You can use coin to buy avatars for your profile image</p>

    @if (session('success'))
        <div class="alert alert-success dismissable w-50 m-auto mb-5 text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger dismissable w-50 m-auto mb-5 text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @forelse ($avatars as $avatar)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-4">

                    <img class="card-img-top" src="{{ asset($avatar->path) }}" alt="Unsplash" height="168">

                    <div class="card-header px-4 pt-4" style="height: 130px">
                        <h5 class="card-title mb-0">{{ $avatar->name }}</h5>
                        <div class="badge bg-success my-2">{{ $avatar->price }} Coins</div>
                    </div>
                    <div class="card-body px-4 pt-2">
                        <form action="{{ route('avatars.buy', $avatar->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-2">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <h2>You already have all the avatars we have.</h2>
                <p>Thank you for your support!</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $avatars->links() }}
    </div>
@endsection

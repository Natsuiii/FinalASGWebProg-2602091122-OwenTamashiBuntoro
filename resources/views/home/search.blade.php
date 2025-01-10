@extends('layouts.home')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- Header End -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Friend Search</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Friend Search</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" style="padding: 35px;">
        <div class="container">
            <form action="{{ route('filter.search') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0" placeholder="Name" id="name"
                                    name="name" value="{{ request('name') }}" />
                            </div>

                            <div class="col-md-6">
                                <select class="form-select border-0" name="gender" id="gender">
                                    <option selected disabled>Gender</option>
                                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <select class="form-select" id="multi-select" name="hobby[]" multiple="multiple"
                                    aria-placeholder="Hobby" style="width: 100%">
                                    @foreach ($hobbies as $hobby)
                                        <option value="{{ $hobby->id }}"
                                            @if (in_array($hobby->id, request('hobby', []))) selected @endif>
                                            {{ $hobby->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100" type="submit">Search</button>
                        <a class="btn btn-dark border-0 w-100 mt-2" href="{{ route('home.filter') }}">Reset Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Friends Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Friend List</h1>
            @forelse ($friendSuggestions as $friend)
                <div class="job-item p-2 mb-2">
                    <div class="row g-4">
                        <!-- Bagian Kiri (Gambar dan Nama Pekerjaan) -->
                        <div class="col d-flex align-items-center">
                            <img class="flex-shrink-0 img-fluid border rounded"
                                src="{{ $friend->account_visible === 0 ? asset($friend->bear_image) : ($friend->profile_image ? asset('storage/' . $friend->profile_image) : asset('img/default-admin.jpeg')) }}"
                                alt="" style="width: 30px; height: 30px;">
                            <div class="text-start ps-4">
                                <div>{{ $friend->name }}</div>
                            </div>
                        </div>

                        <!-- Bagian Tengah (Hobi) -->
                        <div class="col d-flex align-items-center justify-content-center">
                            <div class="hobby-list text-center text-light">
                                @foreach ($friend->hobbies->take(3) as $hobby)
                                    <form action="{{ route('filter.search') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="hobby[]" value="{{ $hobby->id }}">
                                        <button type="submit" class="badge bg-primary me-1 border-0"
                                            style="cursor: pointer;">
                                            {{ $hobby->name }}
                                        </button>
                                    </form>
                                @endforeach

                                @if ($friend->hobbies->count() > 3)
                                    <form action="{{ route('filter.search') }}" method="POST" class="d-inline">
                                        @csrf
                                        @foreach ($friend->hobbies as $hobby)
                                            <input type="hidden" name="hobby[]" value="{{ $hobby->id }}">
                                        @endforeach
                                        <button type="submit" class="badge bg-primary me-1 border-0"
                                            style="cursor: pointer;">
                                            +{{ $friend->hobbies->count() - 3 }} More
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Bagian Kanan (Tombol Detail dan Heart) -->
                        <div class="col d-flex flex-column align-items-end justify-content-center">
                            <div class="d-flex">
                                <button class="btn btn-light btn-square me-3"
                                    onclick="sendRequest({{ $friend->id }}, {{ Auth::user()->id }})">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"
                                        id="spinner-{{ $friend->id }}" style="display: none">
                                    </div>
                                    <i class="fa-regular fa-heart text-primary" id="like-{{ $friend->id }}"></i>
                                </button>
                                <a class="btn btn-primary" href="{{ route('home.detail', $friend->id) }}">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <p>No friend suggestions found.</p>
                </div>
            @endforelse
            <div class="d-flex justify-content-center mt-4">
                {{ $friendSuggestions->links() }}
            </div>
        </div>
    </div>
    <!-- Friends End -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const baseUrl = `{{ route('friend.sendRequest', ['friend' => ':friendId', 'user' => ':userId']) }}`;

        $(document).ready(function() {
            $('#multi-select').select2();
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        async function sendRequest(friendId, userId) {
            try {
                // Tampilkan spinner loading
                $('#like-' + friendId).hide();
                $('#spinner-' + friendId).show();

                const url = baseUrl.replace(':friendId', friendId).replace(':userId', userId);
                // Kirim permintaan ke backend menggunakan Fetch API
                const response = await fetch(url);
                const data = await response.json(); // Parsing response JSON

                // Tampilkan pesan dari backend menggunakan SweetAlert2 Toast
                if (response.ok) {
                    Toast.fire({
                        icon: "success",
                        title: data.message
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.message
                    });
                }
                $('#like-' + friendId).show();
                $('#spinner-' + friendId).hide();
            } catch (error) {
                console.log(error);

                Toast.fire({
                    icon: "error",
                    title: 'An error occurred. Please try again later.'
                });
                $('#like-' + friendId).show();
                $('#spinner-' + friendId).hide();
            }
        }
    </script>
@endpush

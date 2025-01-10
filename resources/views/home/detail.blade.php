@extends('layouts.home')

@section('content')
    <div class="container p-0 pt-5">

        <h1 class="h3 mb-3">{{ $user->name }} Profile</h1>

        @if ($user->account_visible === 0)
            <h1 class="text-center">This Account is set to private</h1>
        @else
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Details</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $user->account_visible === 0 ? asset($user->bear_image) : (str_contains($user->profile_image, 'avatar') ? asset($user->profile_image) : ($user->profile_image ? asset('storage/' . $user->profile_image) : asset('img/default-admin.jpeg'))) }}"
                                alt="Christina Mason" class="rounded-circle mb-2" width="128" height="128">
                            <h5 class="card-title mb-0">{{ $user->name }}</h5>

                            @if ($isFriend)
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger btn-sm me-2 mt-2"
                                        onclick="unFriend({{ $user->id }}, {{ Auth::user()->id }})">Unfriend</button>
                                </div>
                            @else
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm me-2 mt-2"
                                        onclick="sendRequest({{ $user->id }}, {{ Auth::user()->id }})"
                                        id="add-friend-btn">Add</button>
                                </div>
                            @endif
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">Hobby</h5>
                            @foreach ($user->hobbies as $hobby)
                                <form action="{{ route('filter.search') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="hobby[]" value="{{ $hobby->id }}">
                                    <button type="submit" class="badge bg-primary me-1 border-0" style="cursor: pointer;">
                                        {{ $hobby->name }}
                                    </button>
                                </form>
                            @endforeach
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">About Me</h5>
                            <p>{{ $user->description ? $user->description : 'No description' }}</p>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">Elsewhere</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a
                                        href="https://instagram.com/{{ $user->instagram }} " target="_blank">Instagram</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="container">
                        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">{{ $user->name }} Friend List
                        </h1>
                        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                                <li class="nav-item">
                                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active"
                                        data-bs-toggle="pill" href="#tab-1">
                                        <h6 class="mt-n1 mb-0">Friends</h6>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane fade show p-0 active">
                                    @forelse ($friends as $friend)
                                        @if (Auth::user()->id === $friend->id)
                                            <div class="job-item p-2 mb-2">
                                                <div class="row g-4">
                                                    <!-- Bagian Kiri (Gambar dan Nama Pekerjaan) -->
                                                    <div class="col d-flex align-items-center">
                                                        <img class="flex-shrink-0 img-fluid border rounded"
                                                            src="{{ $friend->account_visible === 0 ? asset($friend->bear_image) : (str_contains($friend->profile_image, 'avatar') ? asset($friend->profile_image) : ($friend->profile_image ? asset('storage/' . $friend->profile_image) : asset('img/default-admin.jpeg'))) }}"
                                                            alt="" style="width: 30px; height: 30px;">
                                                        <div class="text-start ps-4">
                                                            <div>You</div>
                                                        </div>
                                                    </div>

                                                    <!-- Bagian Tengah (Hobi) -->
                                                    <div class="col d-flex align-items-center justify-content-center">
                                                        <div class="hobby-list text-center text-light">
                                                            @foreach ($friend->hobbies->take(3) as $hobby)
                                                                <form action="{{ route('filter.search') }}" method="POST"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="hobby[]"
                                                                        value="{{ $hobby->id }}">
                                                                    <button type="submit"
                                                                        class="badge bg-primary me-1 border-0"
                                                                        style="cursor: pointer;">
                                                                        {{ $hobby->name }}
                                                                    </button>
                                                                </form>
                                                            @endforeach

                                                            @if ($friend->hobbies->count() > 3)
                                                                <form action="{{ route('filter.search') }}" method="POST"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @foreach ($friend->hobbies as $hobby)
                                                                        <input type="hidden" name="hobby[]"
                                                                            value="{{ $hobby->id }}">
                                                                    @endforeach
                                                                    <button type="submit"
                                                                        class="badge bg-primary me-1 border-0"
                                                                        style="cursor: pointer;">
                                                                        +{{ $friend->hobbies->count() - 3 }} More
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Bagian Kanan (Tombol Detail dan Heart) -->
                                                    <div
                                                        class="col d-flex flex-column align-items-end justify-content-center">
                                                        <div class="d-flex">
                                                            <a class="btn btn-primary"
                                                                href="{{ route('home.detail', $friend->id) }}">Detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="job-item p-2 mb-2">
                                                <div class="row g-4">
                                                    <!-- Bagian Kiri (Gambar dan Nama Pekerjaan) -->
                                                    <div class="col d-flex align-items-center">
                                                        <img class="flex-shrink-0 img-fluid border rounded"
                                                            src="{{ $friend->account_visible === 0 ? asset($friend->bear_image) : (str_contains($friend->profile_image, 'avatar') ? asset($friend->profile_image) : ($friend->profile_image ? asset('storage/' . $friend->profile_image) : asset('img/default-admin.jpeg'))) }}"
                                                            alt="" style="width: 30px; height: 30px;">
                                                        <div class="text-start ps-4">
                                                            <div>{{ $friend->name }}</div>
                                                        </div>
                                                    </div>

                                                    <!-- Bagian Tengah (Hobi) -->
                                                    <div class="col d-flex align-items-center justify-content-center">
                                                        <div class="hobby-list text-center text-light">
                                                            @foreach ($friend->hobbies->take(3) as $hobby)
                                                                <form action="{{ route('filter.search') }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="hobby[]"
                                                                        value="{{ $hobby->id }}">
                                                                    <button type="submit"
                                                                        class="badge bg-primary me-1 border-0"
                                                                        style="cursor: pointer;">
                                                                        {{ $hobby->name }}
                                                                    </button>
                                                                </form>
                                                            @endforeach

                                                            @if ($friend->hobbies->count() > 3)
                                                                <form action="{{ route('filter.search') }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @foreach ($friend->hobbies as $hobby)
                                                                        <input type="hidden" name="hobby[]"
                                                                            value="{{ $hobby->id }}">
                                                                    @endforeach
                                                                    <button type="submit"
                                                                        class="badge bg-primary me-1 border-0"
                                                                        style="cursor: pointer;">
                                                                        +{{ $friend->hobbies->count() - 3 }} More
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Bagian Kanan (Tombol Detail dan Heart) -->
                                                    <div
                                                        class="col d-flex flex-column align-items-end justify-content-center">
                                                        <div class="d-flex">
                                                            @if ($friend->friends->contains(Auth::user()->id))
                                                                <button class="btn btn-light btn-square me-3"
                                                                    onclick="sendRequest({{ $friend->id }}, {{ $user->id }})">
                                                                    <div class="spinner-border spinner-border-sm text-primary"
                                                                        role="status" id="spinner-{{ $friend->id }}"
                                                                        style="display: none">
                                                                    </div>
                                                                    <i class="fa-solid fa-heart-crack text-danger"
                                                                        id="like-{{ $friend->id }}"></i>
                                                                </button>
                                                            @else
                                                                <button class="btn btn-light btn-square me-3"
                                                                    onclick="sendRequest({{ $friend->id }}, {{ Auth::user()->id }})">
                                                                    <div class="spinner-border spinner-border-sm text-primary"
                                                                        role="status" id="spinner-{{ $friend->id }}"
                                                                        style="display: none">
                                                                    </div>
                                                                    <i class="fa-regular fa-heart text-primary"
                                                                        id="like-{{ $friend->id }}"></i>
                                                                </button>
                                                            @endif

                                                            <a class="btn btn-primary"
                                                                href="{{ route('home.detail', $friend->id) }}">Detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div class="text-center">No friends found</div>
                                        <p>This individual has no friends. Add them first by clicking <a
                                                class="text-primary" id="add-friend" style="cursor: pointer">here</a>.
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        const sendRequestBaseUrl = `{{ route('friend.sendRequest', ['friend' => ':friendId', 'user' => ':userId']) }}`;

        const removeFriendBaseUrl = `{{ route('friend.removeFriend', ['friend' => ':friendId', 'user' => ':userId']) }}`;

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

        $(document).ready(function() {
            $('#add-friend').on('click', function() {
                $('#add-friend-btn').click();
            });
        });

        async function sendRequest(friendId, userId) {
            try {
                // Tampilkan spinner loading
                $('#like-' + friendId).hide();
                $('#spinner-' + friendId).show();

                const url = sendRequestBaseUrl.replace(':friendId', friendId).replace(':userId', userId);
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

        async function unFriend(friendId, userId) {
            try {
                // Tampilkan spinner loading
                $('#like-' + friendId).hide();
                $('#spinner-' + friendId).show();

                const url = removeFriendBaseUrl.replace(':friendId', friendId).replace(':userId', userId);
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

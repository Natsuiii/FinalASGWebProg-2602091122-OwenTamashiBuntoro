@extends('layouts.home')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @error('hobby')
        <style>
            .select2-selection--multiple {
                border-color: #dc3545 !important;
            }
        </style>
    @enderror
@endpush

@section('content')
    <div class="container p-0 pt-5">

        <h1 class="h3 mb-3">Settings</h1>

        @if (session('success'))
            <div class="alert alert-success dismissible" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger dismissible" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account"
                            role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password"
                            role="tab">
                            Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#privacy"
                            role="tab">
                            Privacy
                        </a>
                    </div>
                </div>
                <a href="{{ route('home.profile') }}" class="d-flex btn btn-primary mt-4">Go Back</a>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Public info</h5>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', Auth::user()->name) }}">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="desc">About Your Self</label>
                                                <textarea rows="2" class="form-control" id="desc" name="description"
                                                    placeholder="Tell something about yourself">{{ old('description', Auth::user()->description) }}</textarea>
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="instagram">Instagram</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">@</span>
                                                    <input type="text" class="form-control" id="instagram"
                                                        name="instagram"
                                                        value="{{ old('instagram', Auth::user()->instagram) }}">
                                                    @error('instagram')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hobby" class="form-label">Hobby (Min. 3)</label>
                                                <select class="form-select @error('hobby') is-invalid @enderror"
                                                    id="multi-select" name="hobby[]" multiple="multiple">
                                                    @foreach ($hobbies as $hobby)
                                                        <option value="{{ $hobby->id }}"
                                                            {{ in_array($hobby->id, $userHobbies) ? 'selected' : '' }}>
                                                            {{ $hobby->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('hobby')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Profile Image"
                                                    src="{{ Auth::user()->account_visible === 0 ? asset(Auth::user()->bear_image) : (Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/default-admin.jpeg')) }}"
                                                    class="rounded-circle img-responsive mt-2" width="128"
                                                    height="128">
                                                <div class="mt-2">
                                                    <input type="file" name="profile_image" id="avatar-input"
                                                        accept="image/*" style="display: none;">
                                                    <label for="avatar-input" class="btn btn-primary"><i
                                                            class="fas fa-upload"></i> Upload</label>
                                                    @error('profile_image')
                                                        <small class="text-danger d-block">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg
                                                    format</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Private info</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" value="{{ Auth::user()->email }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6 ">
                                            <label class="form-label" for="inputLastName">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+62</span>
                                                <input class="form-control" value="{{ Auth::user()->phone_number }}"
                                                    type="text" name="phone" inputmode="numeric" id="phone"
                                                    placeholder="Enter phone number">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent"
                                            name="current_password">
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <small><a href="#">Forgot your password?</a></small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew"
                                            name="password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew2"
                                            name="password_confirmation">
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="privacy" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Account Visibility</h5>

                                <div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; Warning! This action have
                                    consequences. Setting your account to private will hide your profile from other users
                                    and <strong>you will not appear in search results</strong>. Your coins also will be
                                    deducted by<strong> 50</strong>. You will need to pay <strong>5 coins</strong> to make
                                    it public again.
                                </div>

                                <form action="{{ route('settings.visible') }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="visibility"
                                            {{ Auth::user()->account_visible === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Private
                                            Account</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#multi-select').select2();
        });

        $(document).ready(function() {
            // Trigger the hidden file input when the span is clicked
            $('#upload-btn').on('click', function() {
                $('#avatar-input').click();
            });
        });

        $('#phone').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, '')); // Hanya izinkan angka
        });
    </script>
@endpush

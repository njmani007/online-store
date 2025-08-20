@extends('layouts.frontend')
@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-lg mt-5 border-0 rounded-4">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Create Account</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control rounded-pill" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-pill" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill">Register</button>

                        <div class="text-center mt-3">
                            <small>Already have an account? <a href="{{ route('login') }}">Login here</a></small>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

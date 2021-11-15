@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-arrow-left"></i>
                        </a> {{ __('Change Password') }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.reset', ['user' => $id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputPassword">
                                            Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{ old('password') }}" id="inputPassword"
                                               name="password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordConfirm">
                                            Re-Type Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               value="{{ old('password_confirmation') }}"
                                               id="inputPasswordConfirm"
                                               name="password_confirmation" required>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary text-white float-right">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection

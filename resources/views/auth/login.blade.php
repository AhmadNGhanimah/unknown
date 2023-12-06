@extends('layouts.custom-app')

@section('styles')

@endsection

@section('body')

    <body class="ltr login-img">

    @endsection

    @section('content')

        <!-- PAGE -->
        <div class="page">
            <div>
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto text-center">
                    <a href="{{url('index')}}" class="text-center">
                        <img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img" alt="">
                    </a>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            <form class="login100-form" action="{{route('login')}}" method="POST">
                                @csrf
                                <span class="login100-form-title">
										Login
									</span>
                                <div class="wrap-input100 validate-input" data-bs-validate = "Valid email is required: ex@abc.xyz">
                                    <input id="email" type="email" placeholder="Email" class="input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
											<i class="zmdi zmdi-email" aria-hidden="true"></i>
										</span>
                                </div>
                                @error('email')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                                    <input id="password" type="password" placeholder="Password" class="input100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
											<i class="zmdi zmdi-lock" aria-hidden="true"></i>
										</span>
                                </div>
                                @error('password')
                                <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

@endsection

@section('scripts')

@endsection

@extends('layouts.app')
@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo--><a class="brand-logo" href="index.html">
            <img class="img-fluid" src="{{ asset('app-assets/images/logo/bm.png') }}"  width="250px;" alt="svg3"/>
        </a>
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                    src="{{ asset('app-assets/images/pages/login-v3.png') }}" alt="svg3"/></div>
        </div>
        <!-- /Left Text-->
        <!-- Login-->
        <div class="d-lg-flex col-sm-12 col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="card col-lg-12">
                <div class="card-body">
                    <h2 class="card-title fw-bold mb-1">Welcome to galaxy ERP </h2>
                    <p class="card-text">Please fill-in required information</p>
                    @if(\Session::has('message'))
                    <p class="alert alert-info">
                        {{ \Session::get('message') }}
                    </p>
                    @endif
                </div>
                <div class="card-footer">
                    <form class="auth-login-form mt-2" action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="mb-1">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="username" type="text" name="name" autocomplete="off"
                                placeholder="{{ trans('global.name') }}" aria-describedby="username" value="{{ old('username', null) }}" autofocus="" tabindex="1" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="name">Email</label>
                            <input class="form-control" id="email" type="email" name="email" autocomplete="off"
                                placeholder="{{ trans('global.login_email') }}" aria-describedby="email" value="{{ old('email', null) }}" autofocus="" tabindex="1" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password"
                                    name="password" placeholder="" aria-describedby="password" tabindex="2" required/>
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye" class="font-medium-3"></i></span>

                            </div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="password">Confirm Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="confirm-password" type="password"
                                    name="confirm-password" placeholder="" aria-describedby="confirm-password" tabindex="2" required/>
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye" class="font-medium-3"></i></span>

                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit" tabindex="4">{{ trans('global.register') }}</button>
                        <a class="" href="{{ route('login') }}">
                            {{ trans('global.signin') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Login-->
    </div>
</div>
@endsection

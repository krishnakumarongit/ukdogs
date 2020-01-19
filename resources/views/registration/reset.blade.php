@extends('layouts.master')

@section('title')
Reset Password
@endsection

@section('content')
 <section class="content">
            <section class="block">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
@if($errors->any())
    <div class="alert alert-danger" role="alert">
    <p><b>Error</b></p>
    @foreach ($errors->all() as $error)
    {{ $error }}<br/>
    @endforeach
    </div>
@endif
<div id="ajax_error" style="display:none;" class="alert alert-danger" role="alert">
      <p><b>Please correct the errors in your form before submitting</b></p>
      <span id="error_messages"></span>
</div>
                            <form class="form clearfix" action="{{ route('reset-password-page-check') }}" method="POST">
                                 @csrf
                                  <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email" class="col-form-label required">Email</label>
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
 <span class="invalid-feedback" role="alert" id="email_error" style="display: none;">
                                 </span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="password" class="col-form-label required">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                 <div class="form-group">
                                    <label for="password" class="col-form-label required">Confirm Password</label>
                                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <!--end form-group-->
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <hr>
                            <p>
                                    <a class="link" href="{{ route('password-forgot') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            </p>
                        </div>
                        <!--end col-md-6-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--end block-->
        </section>
        <!--end content-->
@endsection
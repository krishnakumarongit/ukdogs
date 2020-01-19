@extends('layouts.master')
@section('title')
{{ __('Reset Password') }}
@endsection

@section('content')

  <section class="content">
            <section class="block">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
@if($errors->any())
    <div class="alert alert-danger" role="alert">
    <p><b>Please correct the errors in your form before submitting</b></p>
    @foreach ($errors->all() as $error)
    {{ $error }}<br/>
    @endforeach
    </div>
@endif
<div id="ajax_error" style="display:none;" class="alert alert-danger" role="alert">
      <p><b>Please correct the errors in your form before submitting</b></p>
      <span id="error_messages"></span>
</div>
                           <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email" class="col-form-label required">Email</label>
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="password" class="col-form-label required">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <!--end form-group-->

                                 <!--end form-group-->
                                <div class="form-group">
                                    <label for="password" class="col-form-label required">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <!--end form-group-->


                                <div class="d-flex justify-content-between align-items-baseline">
                                      <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                                </div>
                            </form>
                           
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
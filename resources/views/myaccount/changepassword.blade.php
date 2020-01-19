@extends('layouts.master')

@section('title')
Change Password
@endsection

@section('meta_title')
Change Password
@endsection

@section('meta_description')
<meta name="description" content= "My Account area - change password" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Change Password</li>
</ol>
@endsection


@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                           @include('myaccount.nav',['password' => 1])
                        </div>
                        <!--end col-md-3-->
                        <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8">
                                        @if($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                        <p><b>Please correct the errors in your form before submitting</b></p>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br/>
                                        @endforeach
                                        </div>
                                        @endif
  

@if(Session::has('myaccount_message'))
<div class="alert alert-success" role="alert">
 {{ Session::get('myaccount_message') }}
</div>
@endif
                                        <h2>Change Password</h2>
                                        <section>
                                                    <form class="form clearfix" id="regForm" method="POST" action="{{ route('my-account-change-password-confirm') }}">
                        @csrf                                       
                                            <div class="form-group">
                                                <label for="location" class="col-form-label required">Current Password</label>
                                                <input name="current_password" type="password" class="form-control  @error('current_password') is-invalid @enderror" id="input-location2"  value="{{ old('current_password') }}" >
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror                                               
                                             </div>

                                             <div class="form-group">
                                                <label for="location" class="col-form-label required">New Password</label>
                                                <input name="new_password" type="password" class="form-control  @error('new_password') is-invalid @enderror" id="input-location23"  value="{{ old('new_password') }}" >
                                                 @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>

                                             <div class="form-group">
                                                <label for="location" class="col-form-label required">Confirm New Password</label>
                                                <input name="new_password_confirmation" type="password" class="form-control  @error('new_password_confirmation') is-invalid @enderror" id="input-location24"  value="{{ old('new_password_confirmation') }}" >
                                                 @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>
                                            <div class="form-group">
                                                   <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            <!--end form-group-->
                                           </form>
                                            <!--end form-group-->
                                        </section>

                                    </div>
                                    <!--end col-md-8-->
                                   
                                    <!--end col-md-3-->
                                </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--end block-->
        </section>
@endsection

@section('dynamic-js')

</script>
@endsection
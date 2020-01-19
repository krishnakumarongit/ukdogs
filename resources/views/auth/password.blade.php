@extends('layouts.master')

@section('title')
Forgot Password
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Forgot Password</li>
</ol>
@endsection

@section('meta_title')
Forgot Password
@endsection

@section('meta_description')
<meta name="description" content="Forgot Password page, used to reset your password at {{ env('APP_NAME') }}">
@endsection

@section('short_desc')
A password reset mail will be sent your email address after submitting the form. If you don't receive the  email with in 5 minutes, please check your spam and junk folders of your email provider to see if the email got delivered there.
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
                            <form class="form clearfix" onsubmit="return formValidate();" action="{{ route('post-password') }}" method="POST">
                                 @csrf

                               
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
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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


@section('dynamic-js')
<script>

    function formValidate() {
          $('#error_messages').html('');
    $('#ajax_error').hide();


   
    $('#email').removeClass("is-invalid");
    $('#password').removeClass("is-invalid");
  

   
    $('#email_error').hide();
    $('#password_error').hide();
   

   
    var email = $('#email').val();
    var password = $('#password').val();
  
    var error = '';
   

    if (email =='') {
        $("#email").addClass("is-invalid");
        error = error + 'Email field is required. <br />';
        $('#email_error').show();
        $('#email_error').html('Email field is required');

    }

    if (password.length =="") {
        $("#password").addClass("is-invalid");
        error = error + 'Password id required. <br />';
        $('#password_error').show();
        $('#password_error').html('Password is required');
    }

  
    if (email !="" &&  !ValidateEmail(email)) {
        $("#email").addClass("is-invalid");
        error = error + 'Email is invalid. <br />';
        $('#email_error').show();
        $('#email_error').html('Email is invalid');
    }

    if ( error != "") {
        $('#error_messages').html(error);
        $('#ajax_error').show();
        $(window).scrollTop(0); 
        return false;
    } else {
        return true;    
    }
    }


    function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}
</script>
@endsection
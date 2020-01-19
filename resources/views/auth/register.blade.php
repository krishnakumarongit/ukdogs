@extends('layouts.master')

@section('title')
Register
@endsection

@section('meta_title')
Register
@endsection

@section('meta_description')
<meta name="description" content= "Register Page, used to create new account at {{ env('APP_NAME') }}" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Register</li>
</ol>
@endsection

@section('meta_title')
Sign In to your Account
@endsection


@section('content')

 <section id="reg_container" class="block">
                <div class="container">
                    <form class="form clearfix" id="regForm" method="POST" action="{{ route('do-sign-in') }}">
                        @csrf
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">

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

                                <div class="form-group">
                                    <label for="name" class="col-form-label required">Your Name</label>
                                   
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                 <span class="invalid-feedback" role="alert" id="name_error" style="display: none;">
                                 </span>

                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="email" class="col-form-label required">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
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
                                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                   <span class="invalid-feedback" role="alert" id="password_error" style="display: none;">
                                 </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="repeat_password" class="col-form-label required">Confirmation Password</label>
                                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                     <span class="invalid-feedback" role="alert" id="password-confirm_error" style="display: none;">
                                     </span>
                                </div>
                                <!--end form-group-->
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                            <hr>
                            <p>
                                By clicking "Register" button, you agree with our <a href="#" class="link">Terms & Conditions.</a>
                            </p>
                        </div>
                        <!--end col-md-6-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </form>
            </section>
            <!--end block-->
@endsection

@section('dynamic-js')
<script src="{{ asset('assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('assets/js/jquery.block.js') }}"></script>
<script>
    // prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
    }; 
    // bind form using 'ajaxForm' 
    $('#regForm').ajaxForm(options); 
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    $('#error_messages').html('');
    $('#ajax_error').hide();


    $('#name').removeClass("is-invalid");
    $('#email').removeClass("is-invalid");
    $('#password').removeClass("is-invalid");
    $('#password-confirm').removeClass("is-invalid");

    $('#name_error').hide();
    $('#email_error').hide();
    $('#password_error').hide();
    $('#password-confirm_error').hide();

    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_confirm = $('#password-confirm').val();
    var error = '';
    if (name =='') {
        $("#name").addClass("is-invalid");
        error = error + 'Name field is required. <br />';
        $('#name_error').show();
        $('#name_error').html('Name field is required');
    }

    if (email =='') {
        $("#email").addClass("is-invalid");
        error = error + 'Email field is required. <br />';
        $('#email_error').show();
        $('#email_error').html('Email field is required');

    }

    if (password.length < 5) {
        $("#password").addClass("is-invalid");
        error = error + 'Password must be of minimum 5 characters length. <br />';
        $('#password_error').show();
        $('#password_error').html('Password must be of minimum 5 characters length');
    }

    if (password_confirm =='') {
        $("#password-confirm").addClass("is-invalid");
        error = error + 'Confirmation password field is required. <br />';
        $('#password-confirm_error').show();
        $('#password-confirm_error').html('Confirmation password field is required');
    }

    if (password != password_confirm) {
        $("#password-confirm").addClass("is-invalid");
        $("#password").addClass("is-invalid");
        error = error + 'Password field is not matching with Confirmation password field. <br />';
        $('#password_error').show();
        $('#password_error').html('Password field is not matching with Confirmation password field');
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
        $('#reg_container').block({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
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
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    $('#reg_container').unblock();
    if (responseText.status == 'yes') {
        window.location.href = '{{ route("my-account") }}';
    } else {
        var json_error = responseText.errors;
        var json_error_user = '';
        for (var key in json_error) {
            if (json_error.hasOwnProperty(key)) {
                let val = json_error[key];
                json_error_user = json_error_user + val + '<br />';
            }
        }
        $('#error_messages').html(json_error_user);
        $('#ajax_error').show();
        $(window).scrollTop(0); 
    }
} 


</script>
@endsection
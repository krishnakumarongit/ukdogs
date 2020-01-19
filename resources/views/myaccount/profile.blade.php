@extends('layouts.master')

@section('title')
Personal Details
@endsection

@section('meta_title')
Personal Details
@endsection

@section('meta_description')
<meta name="description" content= "My Account area - Personal Details" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Personal Details</li>
</ol>
@endsection

@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                           @include('myaccount.nav',['personal' => 1])
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
                                        <h2>Personal Details</h2>
                                        <div class="alert">Note: Profiles with About Me description and images gets higher response to their adverts.</div>
                                        <section>
                                                    <form class="form clearfix" id="regForm" method="POST" action="{{ route('my-profile-confirm') }}">
                        @csrf                                       
                                            <div class="form-group">
                                                <label for="location" class="col-form-label required">Name</label>
                                                <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" id="name"  value="{{ old('name',$user->name) }}" >
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror                                               
                                             </div>


                                             <div class="form-group">
                                                <label for="location" class="col-form-label ">About Me</label>
                                                <textarea name="about_me"  class="form-control  @error('about_me') is-invalid @enderror" id="description" >{{ old('about_me',$user->about_me) }}</textarea>
                                                @error('about_me')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror                                               
                                             </div>


                                              <div class="form-group">
                                                <label for="location" class="col-form-label required">Location</label>
                                                <select name="location" type="text" class=" selectized @error('location') is-invalid @enderror" id="location" search  value="{{ old('location') }}" >
                                                    <option value="">Select Location</option>
                                                    @foreach($location as $row)
                                                        @if(trim($row->name) != "")
                                                            <option  @if(old('location',$user->location) == $row->name ) {{ 'selected' }} @endif  value="{{ $row->name }}">{{ $row->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                 @error('website_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>



                                             <div class="form-group">
                                                <label for="location" class="col-form-label ">Website Address</label>
                                                <input name="website_address" type="text" class="form-control  @error('website_address') is-invalid @enderror" id="website_address"  value="{{ old('website_address',$user->website_address) }}" >
                                                 @error('website_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>

                                             <div class="form-group">
                                                <label for="location" class="col-form-label">Main Telephone Number</label>
                                                <input name="main_telephone_number" type="text" class="form-control  @error('main_telephone_number') is-invalid @enderror" id="main_telephone_number"  value="{{ old('main_telephone_number', $user->main_telephone_number ) }}" >
                                                 @error('main_telephone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="location" class="col-form-label">Secondary Telephone Number</label>
                                                <input name="secondary_telephone_number" type="text" class="form-control  @error('secondary_telephone_number') is-invalid @enderror" id="secondary_telephone_number"  value="{{ old('secondary_telephone_number',$user->secondary_telephone_number) }}" >
                                                 @error('secondary_telephone_number')
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

                                         <section>
                                            <h2>Profile Image</h2>

                                            <div class="alert alert-danger" role="alert" id="image_error" style="display:none;"></div>
                                                 <div class="alert alert-success" role="alert" id="image_success" style="display:none;">
</div>
                    <form class="form clearfix" id="image_form" method="POST" action="{{ route('my-image') }}" enctype="multipart/form-data">
                        @csrf                                       
                                            <div class="form-group">
                                                <label for="location" class="col-form-label "></label>
                                                <span id="propic" style="padding-bottom:10px;">
                                                    @if(Auth::user()->photo !="" && file_exists( public_path().'/images/'.Auth::user()->photo))
                                                        <img height="100" width="100" src="{{asset('images/'.Auth::user()->photo)}}">
                                                    @endif
                                                </span>
                                                <input type="file" accept='image/*' style="height:30px;" class="form-control" name="image" id="image">     
                                             </div>
                                              <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Upload Image</button>
                                            </div>

                                         </form>
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
    $('#image_form').ajaxForm(options); 
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 

    $('#image_success').html('');
    $('#image_success').hide();
    $('#image_error').html('');
    $('#image_error').hide();
    $('#image').removeClass("is-invalid");
  
    var image = $('#image').val();
    var error = '';
    if (image =='') {
        $("#image").addClass("is-invalid");
        error = error + 'Please select your profile image. <br />';
        $('#image_error').html(error);
        $('#image_error').show();
    }

    if ( error != "") {
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


// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    $('#reg_container').unblock();
    if (responseText.status == 'yes') {
        $('#image_success').html('Profile image uploaded successfully.');
        $('#image_success').show();
        $('#propic').html(responseText.message);
    } else {
        var json_error = responseText.errors;
        var json_error_user = '';
        for (var key in json_error) {
            if (json_error.hasOwnProperty(key)) {
                let val = json_error[key];
                json_error_user = json_error_user + val + '<br />';
            }
        }
        $('#image_error').html(json_error_user);
        $('#image_error').show();
    }
} 


</script>
@endsection
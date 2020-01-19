@extends('layouts.master')

@section('title')
My Account
@endsection

@section('meta_title')
My Account
@endsection

@section('meta_description')
<meta name="description" content= "My Account area" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">My Account</li>
</ol>
@endsection


@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                           @include('myaccount.nav', ['profile' => 1])
                        </div>
                        <!--end col-md-3-->
                        <div class="col-md-9">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-8">
                                        @if(Auth::user()->email_verified==0)
<div class="alert alert-danger" role="alert">
    We now need to verify your email address.</p><p> We have sent an email to your registered email account. Please click the link in that email to continue.
</div>
                                        @endif
                                        <h2>Personal Information</h2>
                                        <section>
                                           
                                            <!--end row-->
                                            <div class="form-group">
                                                <label for="location" class="col-form-label required">Name</label>
                                                <input name="location" type="text" class="form-control" id="input-location2" placeholder="Your Location" value="Manhattan, NY" required>
                                            </div>
                                        </section>

                                        <section>
                                            <h2>Contact</h2>
                                            <div class="form-group">
                                                <label for="phone" class="col-form-label">Phone</label>
                                                <input name="phone" type="text" class="form-control" id="phone" placeholder="Your Phone" value="312-238-3329">
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">Email</label>
                                                <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="jane.doe@example.com">
                                            </div>
                                            <!--end form-group-->
                                        </section>

                                        <section>
                                            <h2>Location</h2>
                                            <div class="form-group">
                                                <label for="twitter" class="col-form-label">Twitter</label>
                                                <input name="twitter" type="text" class="form-control" id="twitter" placeholder="http://" value="http://www.twitter.com/jane.doe">
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group">
                                                <label for="facebook" class="col-form-label">Facebook</label>
                                                <input name="facebook" type="text" class="form-control" id="facebook" placeholder="http://" value="http://www.facebook.com/jane.doe">
                                            </div>

                                             <div class="form-group">
                                                <label for="facebook" class="col-form-label">Facebook</label>
                                                <input name="facebook" type="text" class="form-control" id="facebook" placeholder="http://" value="http://www.facebook.com/jane.doe">
                                            </div>

                                            <!--end form-group-->
                                        </section>

                                        <section class="clearfix">
                                            <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                                        </section>
                                    </div>
                                    <!--end col-md-8-->
                                  
                                    <!--end col-md-3-->
                                </div>
                            </form>
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
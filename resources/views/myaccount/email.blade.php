@extends('layouts.master')

@section('title')
Change Login Email Address
@endsection

@section('meta_title')
Change Login Email Address
@endsection

@section('meta_description')
<meta name="description" content= "My Account area - change password" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Change Login Email Address</li>
</ol>
@endsection


@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                           @include('myaccount.nav',['email' => 1])
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
                                        <h2>Change Login Email Address</h2>
                                        <section>
                                                    <form class="form clearfix" id="regForm" method="POST" action="{{ route('my-account-email-confirm') }}">
                        @csrf                                       
                                            <div class="form-group">
                                                <label for="location" class="col-form-label required">Email Address</label>
                                                <input name="email" type="text" class="form-control  @error('email') is-invalid @enderror" id="email"  value="{{ old('email',$email) }}" >
                                                @error('email')
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
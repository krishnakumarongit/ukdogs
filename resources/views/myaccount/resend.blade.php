@extends('layouts.master')

@section('title')
Resend Verify Email
@endsection

@section('meta_title')
Resend Verify Email
@endsection

@section('meta_description')
<meta name="description" content= "Resend Verify Email" />
@endsection

@section('bc')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Resend Verify Email</li>
</ol>
@endsection


@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                           @include('myaccount.nav',['resend' => 1])
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
@else
  <h2>Send Verification Email Link</h2>
                                        <section>
                                                    <form class="form clearfix" id="regForm" method="POST" action="{{ route('resent-mail-confirm') }}">
                        @csrf                                       
                                           
                                            <div class="form-group">
                                                   <button type="submit" class="btn btn-primary">Send Verification Link</button>
                                            </div>
                                            <!--end form-group-->
                                           </form>
                                            <!--end form-group-->
                                        </section>
@endif
                                      

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
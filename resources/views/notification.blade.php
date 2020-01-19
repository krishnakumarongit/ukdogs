@extends('layouts.master')

@section('title')
{{$title}}
@endsection
@section('content')
<section class="content">
            <section class="block">
                <div class="container">
                    <section>
                        <h3>
                        <p>{{ $message }}</p></h3>
                    </section>
                </div>
                <!--end container-->
            </section>
            <!--end block-->
        </section>
@endsection
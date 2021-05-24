@extends('common.common_layout')
@section('title','Forbidden')
@section('pageCss')
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="not-found text-center justify-content-center d-flex">
        <div class="container">
            <div class="warning-msg-box">
            	<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
				<div class="warning-inr-box">
                    @if(auth()->user()->isAdmin())
            		<b>We noticed that you have exceeded your {{$message}} limit for this month,
                        <a href="{{route('subscriptions.index')}}">upgrade your subscription now</a>.</b>
                    @else
                        <b>We noticed that you have exceeded your {{$message}} limit for this month.</b>
                    @endif
            	</div>
            </div>
        </div>
    </div>
@endsection

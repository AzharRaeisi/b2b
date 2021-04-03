@extends('layouts.admin')

@section('content')

    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Website Contents') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('General Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-gs-contents') }}">{{ __('Website Contents') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                            <form action="{{ route('admin-gs-update') }}" id="yiwuform" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @include('includes.admin.form-both')



                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Website Title') }} *
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="input-field" placeholder="{{ __('Write Your Site Title Here') }}" name="title" value="{{ $gs->title }}" required="">
                                    </div>
                                </div>


                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Whole Sale Max Quantity') }} *
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="input-field" placeholder="{{ __('Whole Sale Max Quantity') }}" name="wholesell" value="{{ $gs->wholesell }}" required="" min="0">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Use HTTPS') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="action-list">
                                            <select class="process select droplinks {{ $gs->is_secure == 1 ? 'drop-success' : 'drop-danger' }}">
                                                <option data-val="1" value="{{route('admin-gs-secure',1)}}" {{ $gs->is_secure == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                                <option data-val="0" value="{{route('admin-gs-secure',0)}}" {{ $gs->is_secure == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Capcha') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="action-list">
                                            <select class="process select droplinks {{ $gs->is_capcha== 1 ? 'drop-success' : 'drop-danger' }}">
                                                <option data-val="1" value="{{route('admin-gs-iscapcha',1)}}" {{ $gs->is_capcha == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                                <option data-val="0" value="{{route('admin-gs-iscapcha',0)}}" {{ $gs->is_capcha == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Sign Up Verification') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="action-list">
                                            <select class="process select droplinks {{ $gs->is_verification_email == 1 ? 'drop-success' : 'drop-danger' }}">
                                                <option data-val="1" value="{{route('admin-gs-is-email-verify',1)}}" {{ $gs->is_verification_email == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                                <option data-val="0" value="{{route('admin-gs-is-email-verify',0)}}" {{ $gs->is_verification_email == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Tawk.to') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="action-list">
                                            <select class="process select droplinks {{ $gs->is_talkto == 1 ? 'drop-success' : 'drop-danger' }}">
                                                <option data-val="1" value="{{route('admin-gs-talkto',1)}}" {{ $gs->is_talkto == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                                <option data-val="0" value="{{route('admin-gs-talkto',0)}}" {{ $gs->is_talkto == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Tawk.to Widget Code') }} *
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea  name="talkto">{{$gs->talkto}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Cronjob URL') }} *
                                            </h4>
                                            <p class="sub-heading">{{ __('(Copy This URL and paste this to cron job.)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div >
                                            <textarea class="input-field"  readonly="">{{ url('/vendor/subscription/check') }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

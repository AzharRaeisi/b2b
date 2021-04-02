@extends('layouts.vendor')
@section('title', $langg->lang445)
@section('content')

  <div class="content-area">
    <div class="mr-breadcrumb">
      <div class="row">
        <div class="col-lg-12">
          <h4 class="heading">{{ $langg->lang445 }}</h4>
          <ul class="links">
            <li>
              <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }}</a>
            </li>
            <li>
              <a href="javascript:void(0);">{{ $langg->lang444 }} </a>
            </li>
            <li>
              <a href="{{ route('vendor-prod-index') }}">{{ $langg->lang446 }}</a>
            </li>
            <li>
              <a href="{{ route('vendor-prod-types') }}">{{ $langg->lang445 }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="add-product-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="product-description">
            <div class="heading-area">
              <h2 class="title">
                {{ $langg->lang625 }}
              </h2>
            </div>
          </div>
        </div>
      </div>
      <div class="ap-product-categories">
        <div class="row">
          <div class="col-lg-6">
            <a href="{{ route('vendor-prod-physical-create') }}">
              <div class="cat-box box2">
                <div class="icon">
                  <i class="fas fa-camera-retro"></i>
                </div>
                <h5 class="title">{{ __("Product") }} </h5>
              </div>
            </a>
          </div>

          <div class="col-lg-6">
            <a href="{{ route('vendor-prod-digital-create') }}">
              <div class="cat-box box1">
                <div class="icon">
                  <i class="fas fa-tshirt"></i>
                </div>
                <h5 class="title">{{ __("Service") }} </h5>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
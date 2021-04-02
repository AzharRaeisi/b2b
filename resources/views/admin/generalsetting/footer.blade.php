@extends('layouts.admin')

@section('content')

    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Website Footer') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('General Settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-gs-footer') }}">{{ __('Footer') }}</a>
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
                            <form id="yiwuform" action="{{ route('admin-gs-update') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @include('includes.admin.form-both')

                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Footer Text') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
<!--
                                            <textarea class="nic-edit"  name="footer" required=""> {{ $gs->footer }} </textarea>
-->
                                            <textarea class="form-control" id="summernote" name="footer"> {{ $gs->footer }} </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Copyright Text') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
											<textarea class="form-control" id="summernote" name="copyright"> {{ $gs->copyright }} </textarea>
<!--
                                            <textarea class="nic-edit"  name="copyright" required=""> {{ $gs->copyright }} </textarea>
-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Subscriber text') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
											<textarea class="form-control" id="summernote" name="below_subscriber"> {{ $gs->below_subscriber }} </textarea>
<!--
                                            <textarea class="nic-edit"  name="below_subscriber" required=""> {{ $gs->below_subscriber }} </textarea>
-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Menu 1 Heading') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
											<textarea class="form-control" id="summernote" name="menu_1_heading"> {{ $gs->menu_1_heading }} </textarea>
<!--
                                            <textarea class="nic-edit"  name="menu_1_heading" required=""> {{ $gs->menu_1_heading }} </textarea>
-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Menu 2 Heading') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
											<textarea class="form-control" id="summernote" name="menu_2_heading"> {{ $gs->menu_2_heading }} </textarea>
<!--
                                            <textarea class="nic-edit"  name="menu_2_heading" required=""> {{ $gs->menu_2_heading }} </textarea>
-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                {{ __('Menu 3 Heading') }} *
                                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tawk-area">
                                            <textarea class="form-control" id="summernote" name="menu_3_heading"> {{ $gs->menu_3_heading }} </textarea>
<!--
                                            <textarea class="nic-edit"  name="menu_3_heading" required=""> {{ $gs->menu_3_heading }} </textarea>
-->
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>
  $('textarea#summernote').summernote({
	placeholder: '',
	tabsize: 2,
	height: 500,
	toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
		['fontname', ['fontname']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['style','ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],
		['insert', ['link', 'picture', 'hr']],
		['view', ['fullscreen', 'codeview']],
		['help', ['help']]
	],
  });
  $('.dropdown-toggle').dropdown();
</script>
@endsection


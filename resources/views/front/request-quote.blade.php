@extends('layouts.front')
@section('title','Request a quote')
@section('content')
    <section class="login-signup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-area signup-area">
                        <div class="header-area">
                            <h4 class="title">Request A Quote</h4>
                        </div>
                        <div class="login-form signup-form" id="main-form-div">
                            @include('includes.admin.form-login')
                            <form class="quoteform" autocomplete="off" action="" method="POST" id="requestForm" onsubmit="return false" multipart>
                                {{ csrf_field() }}
                                <div class="form-input">
                                    <label>Make a detailed description of the characteristics of the products you are looking for.</label>
                                    <textarea name="details" placeholder="Details"></textarea>
                                    <i class="icofont-list" style="top: 54px;"></i> </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <input type="text" class="User Name" name="name" placeholder="Full Name" required="">
                                            <i class="icofont-user"></i> </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                            <i class="icofont-email"></i> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <input type="text" class="User Name" name="city" placeholder="City" required="">
                                            <i class="icofont-location-pin"></i> </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <input type="text" class="User Name" name="phone" placeholder="Phone Number" required="">
                                            <i class="icofont-phone"></i> </div>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <select name="type" onchange="drawCateDiv(this.value)">
                                        <option value="">What are you looking for?</option>
                                        <option value="Product supplier">Product Supplier</option>
                                        <option value="Services supplier">Service Supplier</option>
                                    </select>
                                    <i class="icofont-building"></i>
                                </div>
                                <div class="form-input" id="select-categories-btn" style="display:none;">
                                    <label>Select a category so we can more accurately match with right suppliers.</label>
                                    <div class="row">
                                        <div class="col-3"> <a href="javascript:void(0)" data-toggle="modal" data-target="#quote-cat" class="cat_main_anker select_product_cat"><i class="fa fa-plus"></i></a> </div>
                                        <div class="col-9">
                                            <div class="quote_catgeory_cont category_main_cont"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <label>Attach images/documents, this will help suppliers to better understand your requirements</label>
                                </div>
                                <input type="file" name="files[]" multiple id="upload_file">
                                <div class="form-input ml-5">
                                    <input class="custom-control-input product-attr" id="make_deal_safe" name="make_deal_safe" type="checkbox">
                                    <label class="custom-control-label" for="make_deal_safe"> Make deals safe & gauranted</label>
                                </div>
                                <div class="form-input ml-5">
                                    <input class="custom-control-input product-attr" id="agree_with_term_condition" name="agree_with_term_condition" type="checkbox">
                                    <label class="custom-control-label" for="agree_with_term_condition"> I agree with <a href="{{url('cms/terms')}}" target="_blank"> term and conditions</a></label>
                                </div>
                                <button type="button" class="submit-btn" onClick="requestQuote(this.id)" id="requestBtn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- quote Cat Modal -->
    <div class="modal fade category_modal" id="quote-cat" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h4">Select a category
                        <div class="modal-count">
                            Selected <span></span>
                            <a href="javascript:void(0)" data-dismiss="modal">OK</a>
                        </div></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal_cat">
                        <ul>
                            @php
                                $i=1;
                            @endphp
                            @foreach($categories as $category)
                                <li class="req-qout-product-cat {{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                                    @if(count($category->subs) > 0)

                                        <div class="link-area">
                                            <a href="javascript:;">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <span><input type="checkbox" autocomplete="off" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
                                            @if(count($category->subs) > 0)

                                            @endif
                                        </div>

                                    @else
                                        <input type="checkbox" autocomplete="off" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;"> {{ $category->name }}</a>

                                    @endif
                                    @if(count($category->subs) > 0)

                                        @php
                                            $ck = 0;
                                            foreach($category->subs as $subcat) {
                                                if(count($subcat->childs) > 0) {
                                                    $ck = 1;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                                            @foreach($category->subs as $subcat)
                                                <li>
                                                    <a href="javascript:void(0)"><input autocomplete="off" type="checkbox" value="sub_cat##{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;">{{$subcat->name}}</a>
                                                    @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                    <li><a href="javascript:void(0)"><input autocomplete="off" type="checkbox" value="child_cat##{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            @foreach($service_categories  as $category)
                                <li class="req-qout-service-cat {{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                                    @if(count($category->subs) > 0)

                                        <div class="link-area">
                                            <a href="javascript:;">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <span><input type="checkbox" autocomplete="off" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
                                            @if(count($category->subs) > 0)

                                            @endif
                                        </div>

                                    @else
                                        <input type="checkbox" autocomplete="off" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;"> {{ $category->name }}</a>

                                    @endif
                                    @if(count($category->subs) > 0)

                                        @php
                                            $ck = 0;
                                            foreach($category->subs as $subcat) {
                                                if(count($subcat->childs) > 0) {
                                                    $ck = 1;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                                            @foreach($category->subs as $subcat)
                                                <li>
                                                    <a href="javascript:void(0)"><input autocomplete="off" type="checkbox" value="sub_cat##{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;">{{$subcat->name}}</a>
                                                    @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                    <li><a href="javascript:void(0)"><input autocomplete="off" type="checkbox" value="child_cat##{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#upload_file").filer({
                limit: 15,
                maxSize: 100,
                extensions: null,
                changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
                showThumbs: true,
                theme: "dragdropbox",
                dragDrop: {
                    dragEnter: null,
                    dragLeave: null,
                    drop: null,
                    dragContainer: null,
                },
                captions: {
                    errors: {
                        filesLimit: "Only @{{fi-limit}} files are allowed to be uploaded.",
                        filesType: "Only Images are allowed to be uploaded.",
                        filesSize: "@{{fi-name}} is too large! Please upload file up to @{{fi-maxSize}} MB.",
                        filesSizeAll: "Files you've choosed are too large! Please upload files up to @{{fi-maxSize}} MB."
                    }
                },
                files: null,
                addMore: true,
                allowDuplicates: false,
                clipBoardPaste: true,
                excludeName: null,
                beforeRender: null,
                afterRender: null,
                beforeShow: null,
                beforeSelect: null,
                onSelect: null,
                afterShow: null,
                onEmpty: null,
                options: null
            });
        });
        function requestQuote(_id){
            if($('#'+_id).is('[disabled=disabled]')){
                return false;
            } else {
                $('html, body').animate({
                    scrollTop: $("#main-form-div").offset().top
                }, 1000)

                $('.alert').hide();
                $('.alert-info p').text('Request initiated please wait...');
                $('.alert-info').show();
                $('#'+_id).attr('disabled','disabled');
                var form_id=$('#'+_id).parents('form').attr('id');
                var formData=new FormData(document.getElementById(form_id));
                $.ajax({
                    type: "POST",
                    url: '{{route('front.requestQuotePost')}}',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(result){
                        $('#'+_id).removeAttr('disabled');
                        try {
                            result = JSON.parse(result);
                        } catch (e) {}
                        if($.trim(result.success) == 'success'){
                            $('.alert').hide();
                            $('.alert-success p').text(result.message);
                            $('.alert-success').show();
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }else{
                            var errorsShow = '';
                            $.each(result.message, function(k, v) {
                                errorsShow += v+'<br>';
                            });
                            $('.alert').hide();
                            $('.alert-danger p').html(errorsShow);
                            $('.alert-danger').show();
                            $('#'+_id).blur();
                        }
                    },
                    error: function (request, status, error) {
                        $('#'+_id).removeAttr('disabled');
                        $('.alert').hide();
                        $('.alert-danger p').text('Something went wrong...');
                        $('.alert-danger').show();
                    }
                });
            }
        }
        function drawCateDiv(_value) {

            if(_value == ''){
                $('#select-categories-btn').hide();
            }else{
                $('#select-categories-btn').show();
                if(_value == 'Product supplier'){
                    $('.req-qout-service-cat').hide();
                    $('.req-qout-product-cat').show();
                }else{
                    $('.req-qout-service-cat').show();
                    $('.req-qout-product-cat').hide();
                }
            }
            $('.category_main_cont').html('');
            $('.modal-count span').text('0');
            $('.cat_checkbox').each(function(){
                if($(this).prop('checked') == true){
                    $(this).attr('checked',false);
                }
            });
        }
    </script>
@endsection
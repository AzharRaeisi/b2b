@extends('layouts.vendor')

@section('content')
    <style>
        .category_main_cont{width: 100%; background: #f3f8fc; padding: 10px; border: 1px solid rgba(0, 0, 0, 0.1); min-height: 50px;}
        .cat_main_anker{width: 100%; display: inline-block; height: 50px; text-align: center;line-height: 48px; color: #fff; background: #af241e; box-shadow:0 2px 4px 0 rgba(65,78,91,.3); border: 2px solid #fff;}
        .login-area .form-input .cat_main_anker i, .login-area .form-input .category_main_cont .form-cat i{color: #fff;position: static;
            -webkit-transform: none; -moz-transform: none;transform: none; line-height: 48px;
        }
        .cat_main_anker:hover{box-shadow: 0 6px 10px 0 rgba(65,78,91,.3); color: #fff;}
        .modal_cat{position: static; display: inline-block; border: none; width: 100%;}
        .modal_cat .categories_mega_menu{position: static;    width: 100%; padding: 10px 30px;
            box-shadow: none;
            display: none; opacity: 1 !important; visibility: visible;}
        .modal_cat .categorie_sub_menu{padding: 10px 30px;}
        .modal_cat .link-area{width: 100%; cursor: pointer;}
        .modal_cat li.dropdown_list{width: 100%; display: inline-block;}
        .modal_cat ul{width: 100%;}
        .modal_cat li a{color: #000;}
        .category_modal .modal-header{padding: 20px !important; border-bottom: 1px solid #d6e0e7 !important;
            display: inline-block;
            position: relative;
        }
        .category_modal .modal-header .h4{font-size: 18px; margin-bottom: 0; position: relative; display: inline-block;}
        .category_modal .modal-count {
            position: absolute;
            top: -7px;
            left: calc(100% + 20px);
            white-space: nowrap;
            font-size: 14px;
            line-height: 28px;
            border: 1px solid #d6e0e7;
            padding: 2px 2px 2px 12px;
            border-radius: 25px;
            display: none;
        }
        .category_modal .modal-count a {    height: 30px;
            line-height: 31px;
            font-size: 11px;
            letter-spacing: 1px;background-color: #81c868!important;
            color: #fff;
            width: 30px;
            margin-left: 10px;
            padding: 0;
            border-radius: 50%;
            box-shadow: 0 2px 6px 0 rgba(65,78,91,.3); display: inline-block; text-align: center;
        }
        .category_main_cont .form-cat {
            position: relative;
            display: inline-block;
            vertical-align: top;
            height: 30px;
            margin: 2px;
            line-height: 30px!important;
            padding: 0 25px 0 10px;
            background-color: #af241e;
            border-radius: 4px;
            font: 14px Lato;
            font-weight: 700;
            color: #fff;
            z-index: 1;
            cursor: default;
            white-space: nowrap;
            overflow: hidden;
            max-width: 100%;
            text-overflow: ellipsis;
        }
        .category_main_cont .form-cat a {
            display: inline-block;
            position: absolute;
            right: 0;
            top: 0;
            padding: 0 7px;
            color: #fff;
        }
        .category_modal .modal-dialog{width: 500px; max-width: 95%;}
    </style>
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ $langg->lang434 }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                        </li>
                        <li>
                            <a href="{{ route('vendor-profile') }}">{{ $langg->lang434 }} </a>
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
                            <form id="yiwuform" autocomplete="off" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @include('includes.vendor.form-both')

                                <div class="upload-img" style="width: 100px;">
                                    @if($data->is_provider == 1)
                                        <div class="img"><img src="{{ $data->photo ? asset($data->photo):asset('assets/images/'.$gs->user_image) }}">
                                        </div>
                                    @else
                                        <div class="img"><img src="{{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/'.$gs->user_image) }}">
                                        </div>
                                    @endif
                                    @if($data->is_provider != 1)
                                        <div class="file-upload-area">
                                            <div class="upload-file">
                                                <input type="file" name="photo" class="upload">
                                                <span>{{ $langg->lang263 }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">Company Name: </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="right-area">
                                            <h6 class="heading"> {{ $data->name }}
                                                {{--@if($data->checkStatus())
                                                    <a class="badge badge-success verify-link" href="javascript:;">{{ $langg->lang783 }}</a>
                                                @else
                                                    <span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ $langg->lang784 }}</a></span>
                                                @endif--}}
                                            </h6>
                                        </div>
                                    </div><div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">Email *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="right-area">
                                            <h6 class="heading"> {{ $data->email }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{$langg->lang185}} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="right-area">
                                            <input type="text" class="input-field" name="address" placeholder="{{ $langg->lang185 }}" required="" value="{{$data->address}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{$langg->lang184}} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="right-area">
                                            <input type="text" class="input-field" name="phone" placeholder="{{ $langg->lang184 }}" required="" value="{{$data->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">
                                                Who are You *
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <div class="form-input">
                                                <select name="who_are_you">
                                                    <option value="">Who are you?</option>
                                                    <option value="Product" {{$data->who_are_you == 'Product'?'selected':''}}> Product supplier</option>
                                                    <option value="Services" {{$data->who_are_you == 'Services'?'selected':''}}>Service supplier</option>
                                                    {{--<option value="both" @if (old('who_are_you') == "both") {{ 'selected' }} @endif>Supplier of products and services</option>--}}
                                                    {{--<option value="product">Product supplier</option>
                                                    <option value="services">Services supplier</option>
                                                    <option value="both">Supplier of products and services</option>--}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{--{{debug($data->getVendorCategories->toArray())}}--}}
                                    <div class="col-lg-3">&nbsp;</div>
                                    <div class="col-lg-4 Product cats" style="display: {{$data->who_are_you == 'Product'?'':'none'}};">
                                        <div class="form-input">
                                            <label>Product Category</label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#product-cat" class="cat_main_anker select_product_cat"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="col-9">
                                                    <div class="product_catgeory_cont category_main_cont">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 Services cats" style="display: {{$data->who_are_you == 'Services'?'':'none'}};">
                                        <div class="form-input">
                                            <label>Service Category</label>
                                            <div class="row">
                                                <div class="col-3">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#services-cat" class="cat_main_anker select_services_cat"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="col-9">
                                                    <div class="services_catgeory_cont category_main_cont">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{ $langg->lang461 }} *</h4>
                                            {{--<p class="sub-heading">{{ $langg->lang462 }}</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <input type="text" class="input-field" name="reg_number" placeholder="{{ $langg->lang461 }}" required="" value="{{$data->reg_number}}">
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ $langg->lang459 }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="shop_number" placeholder="{{ $langg->lang459 }}" required="" value="{{$data->shop_number}}">
                                    </div>
                                </div>--}}

                                {{--<div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ $langg->lang460 }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="shop_address" placeholder="{{ $langg->lang460 }}" required="" value="{{$data->shop_address}}">
                                    </div>
                                </div>--}}
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">{{ $langg->lang463 }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <textarea class="input-field nic-edit" name="shop_details" placeholder="{{ $langg->lang463 }}">{{$data->shop_details}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn" type="submit">{{ $langg->lang464 }}</button>
                                    </div>
                                </div>

                            </form>
                            <div class="row">
                                <div class="col-lg-12 pl-6">
                                    <div class="header-area">
                                        <h4 class="title">
                                            {{ $langg->lang272 }}
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <form id="vendorform" action="{{route('vendor-password-update')}}" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">Current Password * </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <input type="password" name="current_password"  class="input-field" placeholder="{{ $langg->lang273 }}" value="" required="">
                                            @if($errors->has('current_password'))
                                                <div class="error">{{ $errors->first('current_password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">New Password *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <input type="password" name="password"  class="input-field" placeholder="{{ $langg->lang274 }}" value="" required="">
                                            @if($errors->has('password'))
                                                <div class="error">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading">Confirm Password * </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="right-area">
                                            <input type="password" name="password_confirmation"  class="input-field" placeholder="{{ $langg->lang275 }}" value="" required="">
                                            @if($errors->has('password_confirmation'))
                                                <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn" type="submit">{{ $langg->lang276 }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    <div class="modal fade category_modal" id="product-cat" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                <li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                                    @if(count($category->subs) > 0)

                                        <div class="link-area">
                                            <a href="javascript:;">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <span><input autocomplete="off" type="checkbox" value="main_cat##{{ $category->id }}" id="main_cat_{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
                                            @if(count($category->subs) > 0)

                                            @endif
                                        </div>

                                    @else
                                        <input type="checkbox" autocomplete="off" value="main_cat##{{ $category->id }}" id="main_cat_{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;"> {{ $category->name }}</a>

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
                                                    <input autocomplete="off" type="checkbox" value="sub_cat##{{ $subcat->id }}" id="sub_cat_{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;"><a href="javascript:void(0)">{{$subcat->name}}</a>
                                                    @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                    <li><input autocomplete="off" type="checkbox" value="child_cat##{{ $childcat->id }}" id="child_cat_{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</li>
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
    <!-- Vendor Cat Modal -->
    <!-- Services Cat Modal -->
    <div class="modal fade category_modal" id="services-cat" tabindex="-1" role="dialog"  aria-hidden="true">
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
                            @foreach($service_categories as $category)

                                <li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                                    @if(count($category->subs) > 0)

                                        <div class="link-area">
                                            <a href="javascript:;">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <span><input type="checkbox" value="main_cat##{{ $category->id }}" id="main_cat_{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
                                            @if(count($category->subs) > 0)

                                            @endif
                                        </div>

                                    @else
                                        <input type="checkbox" value="main_cat##{{ $category->id }}" id="main_cat_{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;"> {{ $category->name }}</a>

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
                                                    <input type="checkbox" value="sub_cat##{{ $subcat->id }}" id="sub_cat_{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;"><a href="javascript:void(0)">{{$subcat->name}}</a>
                                                    @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                    <li><input type="checkbox" value="sub_cat##{{ $childcat->id }}" id="sub_cat_{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</li>
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
    <!-- Vendor Cat Modal -->
@endsection
@section('scripts')
    <script>
        $('document').ready(function () {
            $('.modal_cat ul li .link-area').click(function(e){
                var container = $(this).find('input');
                if (!container.is(e.target) && container.has(e.target).length === 0)
                {
                    if($(this).next('.categories_mega_menu').is(":visible"))
                    {
                        $(this).next('.categories_mega_menu').slideUp();
                        $(this).find('i').removeClass('fa-angle-down');
                        $(this).find('i').addClass('fa-angle-right');
                    } else{
                        $(this).next('.categories_mega_menu').slideDown();
                        $(this).find('i').addClass('fa-angle-down');
                        $(this).find('i').removeClass('fa-angle-right');

                    }
                }
            });
            $('.cat_checkbox').on('change',function(){
                if($(this).parents('.category_modal').attr('id') == 'product-cat'){
                    var type='product';
                }else if($(this).parents('.category_modal').attr('id') == 'quote-cat'){
                    var type='quote';
                }else{
                    var type='services';
                }

                $('.'+type+'_catgeory_cont').html('');
                var i=0;
                $('.'+type+'_catgeory_cont').parent('div').find('input[type=hidden]').remove();

                $('#'+type+'-cat .cat_checkbox').each(function(){
                    if($(this).prop('checked') == true){
                        $('.'+type+'_catgeory_cont').append('<span class="form-cat" data-id="'+$(this).val()+'">'+$(this).data('name')+'<a href="javascript:void(0)" onClick=removeCat(this,"'+type+'")><i class="fa fa-times"></i></a></span>');
                        $('.'+type+'_catgeory_cont').parent('div').append('<input type="hidden" name="'+type+'_categories[]" value="'+$(this).val()+'">');
                        i++;
                    }
                    $('#'+type+'-cat .modal-count span').text(i);
                    if(i >= 1){
                        $('#'+type+'-cat .modal-count').show();
                    }
                });
            });
            $(".upload").on( "change", function() {
                var imgpath = $(this).parent().parent().prev().find('img');
                var file = $(this);
                readURL(this,imgpath);
            });

            @foreach($data->getVendorCategories->toArray() as $selected_cat)
            @if(trim($selected_cat['category_type']) == 'Main Category')
                $('#main_cat_{{$selected_cat['category_id']}}').trigger('click');
            @endif
            @if(trim($selected_cat['category_type']) == 'Sub Category')
                $('#sub_cat_{{$selected_cat['category_id']}}').trigger('click');
            @endif
            @if(trim($selected_cat['category_type']) == 'Child Category')
                $('#child_cat_{{$selected_cat['category_id']}}').trigger('click');
            @endif
            @endforeach

        });
        $('select[name=who_are_you]').on('change',function(){
            $('.category_main_cont').parent('div').find('input[type=hidden]').remove();
            $('.category_main_cont').find('span').remove();
            $('.cat_checkbox').each(function(){
                $(this).prop('checked',false);
            });
            $('.category_modal .modal-count span').text(0);
            $('.category_modal .modal-count').hide();
            if($(this).val() != 'both'){
                $('.col-lg-4.cats').hide();
                $('.col-lg-4.'+$(this).val()).show();
            }
            else{
                $('.col-lg-4.cats').show();
            }
        });
        function readURL(input,imgpath) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgpath.attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
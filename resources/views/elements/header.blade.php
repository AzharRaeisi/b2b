<div class="topbar">
    {{--
      <div class="container">
        <div class="row">
          <div class="col-md-3 text-center"> <span class="topbar_discount"> 20% </span>
            <div class="topbar_discount_txt"> <span>Discount</span> <span>On FRIST ORDER</span> </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-lg-4 col-md-6 offset-lg-2">
                <div class="topbar_promotion_txt"> <span>Enter Promotion Code</span> Sale </div>
              </div>
              <div class="col-md-6"> <img src="{{url('/front-end/images/prod_img_top.png')}}" alt=""> </div>
            </div>
          </div>
          <div class="col-md-3 text-center"> <a href="#" class="btn btn-topbar">Shop Now</a> </div>
        </div>
      </div>
    --}}
    <a href="{{$bannerTop->link}}"><img src="{{url('/assets/images/banners/'.$bannerTop->photo)}}" alt="{{$bannerTop->link}}"></a> </div>
<header class="header_main">
    <div class="container">
        <div class="header_inner">
            <nav class="navbar navbar-expand-lg navbar-light top_menu">
                <ul class="navbar-nav mr-auto">
                    @if($gs->is_language == 1)
                        {{--<li class="nav-item" style="margin-right: 15px;">
                            <select class="lang_select" name="language" autocomplete="off">
                                @foreach($languages as $language)
                                    <option value="{{route('front.language',$language['id'])}}" {{ $selected_lang == $language['id'] ? 'selected' : '' }} class="option-with-flag" data-icon="{{trim(strtolower($language['language']))}}" >
                                        {{$language['language']}}
                                    </option>
                                @endforeach
                            </select>
                        </li>--}}
                        <li class="nav-item" style="margin-right: 15px;">

                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="font-size: 12px;color: #333333;">Language</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLanguage">
                                    <div id="google_translate_element"></div>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if($gs->is_currency == 1)
                        <li class="nav-item"> {{--{{ $selected_currency_sign }}--}}
                            <select class="selectpicker currency_select" name="currency">
                                @foreach($currencies as $currency)
                                    <option value="{{route('front.currency',$currency['id'])}}" {{ $selected_currency == $currency['id'] ? 'selected' : ''}}>
                                        {{$currency['name']}}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                    @endif
                </ul>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse  ml-auto" id="navbarTogglerDemo01">
                    <ul class="navbar-nav">

                        @if(Auth::guard('web')->check())
                            @if(Auth::guard('web')->user()->IsUser())
                                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="far fa-user"></i> {{ $langg->lang11 }} </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if(Auth::user()->IsVendor())
                                            <a href="{{ route('vendor-dashboard') }}"  class="dropdown-item"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
                                        @endif
                                        @if(Auth::guard('web')->user()->IsUser())
                                            <a href="{{ route('user-dashboard') }}"  class="dropdown-item"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
                                            <a href="{{ route('user-profile') }}"  class="dropdown-item"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
                                        @endif
                                        <a href="{{ route('user-logout') }}"  class="dropdown-item"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
                                    </div>

                                </li>
                            @endif
                        @else
                            <li class="nav-item "> <a class="nav-link" href="{{ route('user.login') }}">{{ $langg->lang12 }} / {{ $langg->lang13 }}</a> </li>
                        @endif
                        {{--@if($gs->reg_vendor == 1)
                            <li class="nav-item">
                                @if(Auth::guard('web')->check() && Auth::user()->IsVendor())
                                    @if(Auth::guard('web')->user()->has_subscription == '0')
                                        <a href="{{ route('user-package') }}" class="nav-link">{{ $langg->lang220 }}</a>
                                    @else
                                        <a href="{{ route('vendor-dashboard') }}" class="nav-link">{{ $langg->lang220 }}</a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#vendor-login" class="nav-link">{{ $langg->lang220 }}</a>
                                @endif

                            </li>
                        @endif--}}

                        <li class="nav-item "> <a class="nav-link" href="{{ route('front.blog') }}">{{ $langg->lang18 }}</a> </li>
                        @if($gs->is_faq == 1)
                            <li class="nav-item "><a class="nav-link" href="{{ route('front.faq') }}">{{ strtoupper($langg->lang19) }}</a></li>
                        @endif
                        @foreach($header_pages as $header_page)
                            <li class="nav-item "><a class="nav-link"  href="{{ route('front.page',$header_page->slug) }}">{{ $header_page->title }}</a></li>
                        @endforeach
                        @if($gs->is_contact == 1)
                            <li class="nav-item "><a  class="nav-link" href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light"> <a class="navbar-brand" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="nav_main">
                    <ul class="navbar-nav mr-auto">
                    <!--
            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{url('/front-end/images/category-icon.png')}}" alt=""> Category </a>
                @php
                        $i=1;
                    @endphp
                    @foreach($categories as $category)
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a> </div>
@endforeach
                            </li>
-->
                        <li>
                            <div class="categories_menu">
                                <div class="categories_title">
                                    <h2 class="categori_toggle"><img src="{{url('/front-end/images/category-icon.png')}}" alt=""> {{ $langg->lang14 }} <i class="fa fa-angle-down arrow-down"></i></h2>
                                </div>
                                <div class="categories_menu_inner">
                                    <ul>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($categories as $category)
                                            <li class="pl-1 {{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 11 ? 'rx-child' : '' }}" style="clear: both;"> @if(count($category->subs) > 0)
                                                    <div class="img"> <img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt=""> </div>
                                                    <div class="link-area"> <span><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></span> @if(count($category->subs) > 0) <a href="javascript:;"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a> @endif </div>
                                                @else <a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a> @endif
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
                                                            <li> <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a> @if(count($subcat->childs) > 0)
                                                                    <div class="categorie_sub_menu">
                                                                        <ul>
                                                                            @foreach($subcat->childs as $childcat)
                                                                                <li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif </li>
                                                        @endforeach
                                                    </ul>
                                                @endif </li>
                                            @php
                                                $i++;
                                            @endphp

                                            @if($i == 11)
                                                <li class="pl-1 dropdown_list all_categories" style="clear: both;"> 
                                                        <div class="img"> <img src="{{url('/front-end/images/category-icon.png')}}" alt=""> </div>
                                                        <div class="link-area"> <span><a href="{{ route('front.categories') }}">{{ $langg->lang15 }}</a></span>  <a href="javascript:;"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a> </div>
                                                   
                                                    
                                                        <ul class=" categories_mega_menu categories_mega_menu column_1">
                                                            @foreach($categories as $category)
                                                            <li> <a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a> </li>
                                                            
                                                            @endforeach           
                                                                     

                                                        </ul>
                                                   
                                                    </li>
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0 mr-auto ml-auto">
                        <form id="searchForm" class="search-form" style="width: 100%" action="{{ route('front.setSearch', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
                            <select name="product_type" class="product_select">
<!--
                                <option value="product">{{$langg->productsearch}}</option>
                                <option value="service">{{$langg->servicesearch}}</option>
                                <option value="suppliers">{{$langg->supplierssearch}}</option>
-->
                                <option value="product" style="font-size: 17px;">Products</option>
                                <option value="suppliers" style="font-size: 17px;">Suppliers</option>
                                <option value="service" style="font-size: 17px;">Services</option>
                                {{--@foreach($categories as $data)
                                    <option style="font-size: 17px;" value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>{{ $data->name }}</option>
                                @endforeach--}}
                            </select>
                            <div class="serach_right_div">

                                @if (!empty(request()->input('sort')))
                                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                                @endif
                                @if (!empty(request()->input('minprice')))
                                    <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                                @endif
                                @if (!empty(request()->input('maxprice')))
                                    <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                                @endif
<!--
                                <input class="form-control" type="text" id="prod_name" name="search" placeholder="{{$langg->searchsomething}}" value="{{ request()->input('search') }}" autocomplete="off">
-->
                                <input class="form-control" type="text" id="prod_name" name="search" value="{{ request()->input('search') }}" autocomplete="off">
                                <button class="btn my-2 my-sm-0" type="submit"><img src="{{url('/front-end/images/search_icon.png')}}" alt="Search"></button>
                            </div>
                        </form>
                        <ul>
                            @foreach($previous_searches as $previous_search)
                                @php
                                    if($previous_search['search_type'] == 'service'){
                                            $search_route = route('front.service').'?search='.$previous_search['search_text'];
                                        }elseif ($previous_search['search_type'] == 'suppliers'){
                                            $search_route = route('front.vendorStores').'?search='.$previous_search['search_text'];
                                        }else{
                                            $search_route = route('front.category').'?search='.$previous_search['search_text'];
                                        }
                                @endphp
                                <li>
                                    <a href="{{$search_route}}">{{$previous_search['search_text']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-auto right_menu">
                        <ul>

                            <li>
                                @if(Auth::guard('web')->check())
                                    @if(Auth::guard('web')->user()->IsVendor())
                                        <a href="{{ route('vendor-dashboard') }}"><i class="fa fa-home"></i> {{$langg->lang200}}</a>
                                    @endif
                                @else
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#vendor-login">{{$langg->supplier}} {{$langg->lang13}} / {{$langg->lang101}}</a>
                                @endif
                            </li>

                            <li> <a href="{{route('front.requestQuote')}}">{{$langg->getquotes}}</a> </li>
                            <li class="my-dropdown">
                                <a href="{{ route('front.cart') }}" class="cart carticon">
                                    <img src="{{url('/front-end/images/cart_icon.png')}}" alt="">
                                    <span id="cart-count">
                                            {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
                                        </span>
                                </a>
                                <div class="my-dropdown-menu" id="cart-items"> @include('load.cart') </div>
                            </li>
                            <li> @if(Auth::guard('web')->check()) <a href="{{ route('user-wishlists') }}"><img src="{{url('/front-end/images/heart_icon.png')}}" alt=""><span>{{ Auth::user()->wishlistCount() }}</span></a> @else <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"><img src="{{url('/front-end/images/heart_icon.png')}}" alt=""><span>0</span></a> @endif </li>
                        </ul>
                        <ul class="collapse navbar-collapse" id="navbarSupportedContent">
                            <li><a href="{{route('front.featuredCatSuppliers')}}">
                                    <div><img src="{{url('/front-end/images/supplier_icon.png')}}" alt=""><img src="{{url('/front-end/images/supplier_icon_hover.png')}}" alt=""></div>
                                    {{$langg->suppliers}}</a></li>
                            <li><a href="{{ route('front.featuredCatproducts') }}">
                                    <div><img src="{{url('/front-end/images/product_icon.png')}}" alt=""><img src="{{url('/front-end/images/product_icon_hover.png')}}" alt=""></div>
                                    {{$langg->products}}</a></li>
                            <li><a href="{{route('front.featuredCatService')}}">
                                    <div><img src="{{url('/front-end/images/services_icon.png')}}" alt=""><img src="{{url('/front-end/images/services_icon_hover.png')}}" alt=""></div>
                                    {{$langg->services}}</a></li>
                            <li><a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">
                                    <div><img src="{{url('/front-end/images/track_order_icon.png')}}" alt=""><img src="{{url('/front-end/images/track_order_icon_hover.png')}}" alt=""></div>
                                    {{$langg->trackorder}}</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

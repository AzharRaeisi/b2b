@extends('layouts.home')
@section('title','The Yiwu B2B Small Commodity Wholesale Market')
@section('content')
    @if($ps->slider == 1)
        @if(count($sliders))
            <div class="hero_container">
                <div class="container">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @php $i=0;
                            @endphp
                            @foreach($sliders as $data)
                                <li data-target="#carouselExampleSlidesOnly" data-slide-to="{{$i}}" {{($i == 0)?'class=active':''}}></li>
                                @php
                                    $i++; @endphp
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @php $i=0;
                            @endphp
                            @foreach($sliders as $data)
                                <div class="carousel-item{{($i == 0)?' active':''}}">
                                    <a href="{{$data->link}}"><img class="d-block w-100" src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="First slide"></a>
                                    <div class="carousel_content {{$data->position}}">
                                        <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
                                        <h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
                                        <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{!! $data->details_text !!}</p>
                                        @if(!empty(!empty($data->btext)))
                                            <a href="{{$data->link}}">{{ $data->btext }}{{--$langg->lang25--}}</a>
                                        @endif
                                    </div>
                                </div>
                                @php
                                    $i++; @endphp
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                </div>
            </div>
        @endif
    @endif
    @if($ps->service == 1)
        <div class="services_cont pt-5">
            <div class="container">
                @foreach($services->chunk(4) as $chunk)
                    <div class="row">
                        @foreach($chunk as $service)
                            <div class="col-md-4">
                                <a href="{{!empty($service->home_page_link) && $service->home_page_link != '#'? url($service->home_page_link):''}}" class="services_iner" style="background-image: url({{ asset('assets/images/services/'.$service->photo) }});background-repeat: no-repeat; background-position: right bottom;"> <img src="{{url('/front-end/images/logo_light.png')}}" alt="">
                                    <div class="services_text">
                                        @php $service_title = strtolower($service->title); @endphp
                                        <h3>{{ $langg->$service_title }}</h3>
                                        <p>{{ $service->details }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="options_cont pt-5 pb-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="for_suppliers">
                        <div class="for_suppliers_head">
                            <h4>{{$langg->forsuppliers}}</h4>
                        </div>
                        <div class="for_supplier_cont">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <a href="#" data-toggle="modal" data-target="#vendor-login" class="for_supplier_main"> <img src="{{url('/front-end/images/comp_icon.png')}}" alt="">
                                        <h4>{{$langg->addcompany}}</h4>
                                        <p>{{$langg->sellyourproducts}}<br>
                                            {{$langg->worldwide}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.allQuotes')}}" class="for_supplier_main"> <img src="{{url('/front-end/images/order_icon.png')}}" alt="">
                                        <h4>{{$langg->orders}}</h4>
                                        <p>{{$langg->checkoutthebuyer}}<br>
                                            {{$langg->requests}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="#" data-toggle="modal" data-target="#vendor-login" class="for_supplier_main"> <img src="{{url('/front-end/images/promotion_icon.png')}}" alt="">
                                        <h4>{{$langg->promotions}}</h4>
                                        <p>{{$langg->promoteyourproducts}}<br>
                                            {{$langg->onywbazar}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.blog')}}" class="for_supplier_main"> <img src="{{url('/front-end/images/blog_icon.png')}}" alt="">
                                        <h4>{{$langg->blog}}</h4>
                                        <p>{{$langg->checkoutthe}}<br>
                                            {{$langg->latestnews}}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="for_suppliers buyers">
                        <div class="for_suppliers_head">
                            <h4>{{$langg->forbuyers}}</h4>
                        </div>
                        <div class="for_supplier_cont">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.featuredCatproducts')}}" class="for_supplier_main"> <img src="{{url('/front-end/images/pro_brown_icon.png')}}" alt="">
                                        <h4>{{$langg->products}}</h4>
                                        <p>{{$langg->checkthelistof5m}}<br>
                                            {{$langg->productsworldwide}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.featuredCatSuppliers')}}" class="for_supplier_main"> <img src="{{url('/front-end/images/supplier_brown_icon.png')}}" alt="">
                                        <h4>{{$langg->suppliers}}</h4>
                                        <p>{{$langg->findthebessupplier}}<br>
                                            {{$langg->fromtheworld}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.featuredCatService')}}" class="for_supplier_main">
                                        <img src="{{url('/front-end/images/services_brown_icon.png')}}" alt="">
                                        <h4>{{$langg->services}}</h4>
                                        <p>{{$langg->findyourrequired}}<br>{{$langg->businessservice}}</p>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{route('front.requestQuote')}}" class="for_supplier_main">
                                        <img src="{{url('/front-end/images/quote_brown_icon.png')}}" alt="">
                                        <h4>{{$langg->getquotes}}</h4>
                                        <p>{{$langg->createarequestandget}}<br>{{$langg->offersfromsuppliers}}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a href="{{ url($marketplace_baner->link) }}">
                        <div class="suppliers_right" style="background: url({{url('/assets/images/banners/'.$marketplace_baner->photo)}}) no-repeat center; background-size: cover;">
                            <div class="suppliers_right_cont">
                                <h4>Yiwu</h4>
                                <p>{{$langg->smallcommoditiesmarketplace}}</p>
                                <span class="link-btn">{{$langg->joinus}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if($ps->flash_deal == 1)
        <div class="flash_deals mt-5 pt-5">
            <div class="container">
                <div class="flash_deal_iner"> <span class="flash_head">{{ $langg->lang244 }}</span>
                    <div class="flash_deal_carousel">
                        @foreach($discount_products as $prod)
                            @php $rating = $prod->rating;@endphp
                            <div>
                                <a href="{{ route('front.product', $prod->slug) }}" class="product_main">
                                    <div class="prod_img">
                                        <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
                                    </div>
                                    <p>{{ $prod->showName() }}</p>
                                    <span>{!! $prod->showPrice() !!} <small style="text-decoration:line-through">{!! $prod->showPreviousPrice() !!}</small></span>
                                    <div class="rating" style="text-align: left;">
                                        @php
                                            $b=5;
                                            $b=(int)$b - (int)$rating;
                                            for($i=1; $i<=$rating;$i++){
                                        @endphp
                                        <img src="{{url('/front-end/images/star_icon.png')}}" alt="{{$i}}">
                                        @php
                                            }
                                            for($c=1; $c<=$b; $c++){
                                        @endphp
                                        <img src="{{url('/front-end/images/star_icon_grey.png')}}" alt="">
                                        @php
                                            }
                                        @endphp
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="category_selection pt-5">
        <div class="container">
            <div class="text-center mb-5"><h2 class="heading_cat">{{$langg->categoryselections}}</h2></div>
            <div class="row">
                @foreach($category_selections as $category)
                    <div class="col-md-6">
                        <div class="caetgory_section_main">
                            <h4>{{$category->name}}</h4>
                            <a href="{{route('front.category',$category->slug)}}">{{$langg->viewall}}</a>
                            <div class="category_section_iner">
                                <div class="category_carousel">
                                    @foreach($category->products as $prod)
                                        <div>
                                            <a href="{{ route('front.product', $prod->slug) }}" class="product_main">
                                                <div class="prod_img"> <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt=""></div>
                                                <p>{{ $prod->showName() }}</p>
                                                <span>{!! $prod->showPrice(false) !!} {!! (!empty($prod->showPreviousPrice()))?'<small style="text-decoration:line-through">'.$prod->showPreviousPrice().'</small>':'' !!}</span>
                                                <div class="rating" style="text-align: left;">
                                                    @php
                                                        $b=5;
                                                        $b=(int)$b - (int)$rating;
                                                        for($i=1; $i<=$rating;$i++){
                                                    @endphp
                                                    <img src="{{url('/front-end/images/star_icon.png')}}" alt="{{$i}}">
                                                    @php
                                                        }
                                                        for($c=1; $c<=$b; $c++){
                                                    @endphp
                                                    <img src="{{url('/front-end/images/star_icon_grey.png')}}" alt="">
                                                    @php
                                                        }
                                                    @endphp
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="product_fetured pt-7">
        <div class="container">

            {{--<div class="product_fetured_iner" style="background: url('{{ $feature_product->thumbnail ? asset('assets/images/thumbnails/'.$feature_product->thumbnail):asset('assets/images/noimage.png') }}') no-repeat 75% top #fafafa;">
              <div class="col-lg-6 col-md-12 offset-lg-1">
                <div class="row">
                  <div class="col-md-8">
                    <h3>{{$feature_product['name']}}</h3>
                    <p>{{$feature_product['deatils']}}</p>
                  </div>
                  <div class="col-md-4"> <span class="featured_price_old">{!! (!empty($feature_product->showPreviousPrice()))?$feature_product->showPreviousPrice():'' !!}</span> <span class="featured_price_new">{{$feature_product->showPrice()}}</span> <a href="{{ route('front.product', $feature_product->slug) }}" class="featured_action_link">Shop Now</a> </div>
                </div>
              </div>
            </div>--}}
            <a href="{{$botom_baner->link}}"><img src="{{url('/assets/images/banners/'.$botom_baner->photo)}}" alt="{{$botom_baner->link}}"></a>
        </div>
    </div>
    <div class="buyers_section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{$langg->buyerrequest}}</h3>
                    <a href="{{route('front.allQuotes')}}" class="view_all">{{$langg->viewall}}</a>
                    <div class="buyer_carousel">
                        @foreach($buyer_requests as $buyer_request)
                            <div>
                                <div class="buyer_main">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p>{!! summary($buyer_request['details'],120) !!}</p>
                                            <div class="buyers_button">
                                                @if(!empty($buyer_request['main_categories']))
                                                    @foreach($buyer_request['main_categories'] as $category)
                                                        @if(isset($main_categories_info[$category['cat_id']]))
                                                            <a href="#">{{$main_categories_info[$category['cat_id']]}}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if(!empty($buyer_request['sub_categories']))
                                                    @foreach($buyer_request['sub_categories'] as $category)
                                                        @if(isset($sub_categories_info[$category['cat_id']]))
                                                            <a href="#">{{$sub_categories_info[$category['cat_id']]}}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if(!empty($buyer_request['child_categories']))
                                                    @foreach($buyer_request['child_categories'] as $category)
                                                        @if(isset($child_categories_info[$category['cat_id']]))
                                                            <a href="#">{{$child_categories_info[$category['cat_id']]}}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <img style="width: 30px;max-height: 100%; box-shadow: 0 0 30px rgba(0,0,0,.05)" class="float-right" src="{{asset('assets/images/countries/'.strtolower($buyer_request['country_code']).'.png')}}">
                                            <span class="float-right" >{{$buyer_request['country_info']['country_name']??''}}</span>
                                            <div class="prod_botm_btn" style="margin-bottom: 0px; margin-top: 14%;"><a class="float-right" href="javascript:void(0);" data-toggle="modal" data-target="#view_more_modal_{{$buyer_request['id']}}">{{$langg->viewmore}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Modal -->
                    @foreach($buyer_requests as $buyer_request)
                        <div class="modal fade" id="view_more_modal_{{$buyer_request['id']}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="buyer_main">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3>{{detaileddescription}}</h3>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>{!! $buyer_request['details'] !!}</p>
                                                        </div>
                                                    </div>
                                                    {{--<div class="row">
                                                        <div class="col-md-7">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <tr>
                                                                        <td colspan="2"><h3>Contact Information</h3></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>{{__("Name")}}</th>
                                                                        <td>{{$buyer_request['name']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>{{__("Email")}}</th>
                                                                        <td>{{$buyer_request['email']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>{{__("City")}}</th>
                                                                        <td>{{$buyer_request['city']}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>{{__("Type")}}</th>
                                                                        <td>{{$buyer_request['type']}}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <th><h3>Files</h3></th>
                                                                    </tr>
                                                                    @php
                                                                        $files = json_decode($buyer_request['files'],1);
                                                                    @endphp
                                                                    @foreach($files as $file)
                                                                        <tr>
                                                                            <td><a href="{{asset('files/quotes/'.$buyer_request['id'].'/'.$file)}}" target="_blank"><i class="fa fa-download"></i> {{ $file }}</a> </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>--}}
                                                    <div class="buyers_button" style="margin-left: 20px;">
                                                        @if(!empty($buyer_request['main_categories']))
                                                            @foreach($buyer_request['main_categories'] as $category)
                                                                @if(isset($main_categories_info[$category['cat_id']]))
                                                                    <a href="#">{{$main_categories_info[$category['cat_id']]}}</a>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if(!empty($buyer_request['sub_categories']))
                                                            @foreach($buyer_request['sub_categories'] as $category)
                                                                @if(isset($sub_categories_info[$category['cat_id']]))
                                                                    <a href="#">{{$sub_categories_info[$category['cat_id']]}}</a>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if(!empty($buyer_request['child_categories']))
                                                            @foreach($buyer_request['child_categories'] as $category)
                                                                @if(isset($child_categories_info[$category['cat_id']]))
                                                                    <a href="#">{{$child_categories_info[$category['cat_id']]}}</a>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <img style="width: 30px;max-height: 100%; box-shadow: 0 0 30px rgba(0,0,0,.05); margin-top: 9%;border: 1px solid #cccccc;" class="float-right" src="{{asset('assets/images/countries/'.strtolower($buyer_request['country_code']).'.png')}}">
                                                    <br><span class="float-right text-right" style="width: 100%" >{{$buyer_request['country_info']['country_name']??''}}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="prod_botm_btn" style="margin-left: 20px;margin-bottom: 0px; margin-top: 30px;"><a class="float-left" href="{{route('front.contact')}}">Contact Buyer Now</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-4">
                    <a href="{{url($getquote_baner->link) }}">
                        <div class="buyer_right" style="background: url({{url('/assets/images/banners/'.$getquote_baner->photo)}}) no-repeat center; background-size: cover;">
                            <div class="buyer_right_cont">
                                <h3>{{$langg->get}} <br>
                                    {{$langg->quotes}}</h3>
                                <p>{{$langg->findsuppliersby}}<br>
                                    {{$langg->creatingonerequest}}</p>
                                <span class="link-btn">{{$langg->create}}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="featured_brands">
        <div class="container">
            <div class="featured_iner text-center">
                <h3>Brand Store</h3>
                <div class="brand_carousel">
                    @foreach($partners as $partner)
                        <div> <a href="{{$partner->link}}"> <img src="{{url('/assets/images/partner/'.$partner->photo)}}" alt="{{$partner->link}}"> </a> </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="blog_section pt-5">
        <div class="container">
            <h3>{{$langg->latestfrom}} <span>{{$langg->blog}}</span></h3>
            <a class="view_all" href="{{ route('front.blog') }}">{{$langg->viewall}}</a>
            <div class="clearfix"></div>
            <div class="row">

                @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)
                    <div class="col-lg-3 col-md-6">
                        <a href="{{route('front.blogshow',$blog->id)}}" class="blog_iner"> <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
                            <div class="blog_cont">
                                <h4>{{mb_strlen($blog->title,'utf-8') > 25 ? mb_substr($blog->title,0,25,'utf-8')." .." : $blog->title}}</h4>
                                <p>{{strip_tags(mb_strlen($blog->details,'utf-8') > 155 ? mb_substr($blog->details,0,155,'utf-8')." .." : $blog->details)}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer_before_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 offset-lg-1">
                    <div class="footer_main">
                        <div class="row">
                            
                            <div class="col-md-12">
                             <img src="{{url('/front-end/images/plane_icon.png')}}" alt="">
                                <h4>High Quality Selection</h4>
                                <p>Total product quality control for peace of mind</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-4">
                    <div class="footer_main">
                        <div class="row">
                            
                        <div class="col-md-12">
                            <img src="{{url('/front-end/images/value_icon.png')}}" alt="">
                                <h4>Affordable Prices</h4>
                                <p>Factory direct prices for maximum savings</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-4">
                    <div class="footer_main">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{url('/front-end/images/payment_icon.png')}}" alt="">                      
                                <h4> Reliable Shipping</h4>
                                <p>Fast, reliable delivery from Yiwu Market</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-4">
                    <div class="footer_main">
                        <div class="row">
                            <div class="col-md-12">
                            <img src="{{url('/front-end/images/payment_icon.png')}}" alt="">
                                <h4>Worry-free After-sales</h4>
                                <p>Instant access to professional support</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-4">
                    <div class="footer_store text-center"> <a href="#"> <img src="{{url('/front-end/images/apple_icon.svg')}}" style="margin-bottom: 6px;" alt=""> </a> <a href="#"> <img src="{{url('/front-end/images/play_icon.svg')}}" style="" alt=""> </a> </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
    <script src="{{url('/front-end/js/slick.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.flash_deal_carousel').slick({
                rows:2,
                slidesPerRow: 7,
                infinite:true,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesPerRow: 5,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesPerRow: 4,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesPerRow: 3,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            slidesPerRow: 2,
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
            $('.category_carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
            $('.brand_carousel').slick({
                slidesToShow: 8,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
            $('.buyer_carousel').slick({
                dots: false,
                vertical: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                verticalSwiping: true,
                autoplay:true,
                autoplaySpeed:1500,
            });


        });
    </script>
@endsection

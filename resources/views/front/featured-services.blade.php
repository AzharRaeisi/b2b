@extends('layouts.home')
@section('title','All Products')
@section('content')
    <div class="all_prod_main">
        <div class="container">
            <div class="all_prod_main_iner">
                <p class="all_prod_top">Supplier directory. Wholesale products <span>Buy and sell in bulk on YIWUBAZAAR</span></p>
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <ul class="all_prod_cats">
                            @php
                                $i=1;
                            @endphp
                            @foreach($service_categories as $category)
                                <li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}"> @if(count($category->subs) > 0)
                                        <div class="img"> <img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt=""> </div>
                                        <div class="link-area">@if(count($category->subs) > 0) <a href="javascript:;"> <i class="fa fa-angle-down" aria-hidden="true"></i> </a> @endif <a href="{{ route('front.service',$category->slug) }}">{{ $category->name }}</a></div>
                                    @else <a href="{{ route('front.service',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a> @endif
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
                                                <li> <a href="{{ route('front.subcat-service',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">@if(count($subcat->childs) > 0) <i class="fa fa-angle-down"></i> @endif{{$subcat->name}}</a> @if(count($subcat->childs) > 0)
                                                        <div class="categorie_sub_menu">
                                                            <ul>
                                                                @foreach($subcat->childs as $childcat)
                                                                    <li><a href="{{ route('front.childcat-service',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
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

                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <a href="{{$page_data->feature_banner_link}}" class="all_prod_ad">
                            <img src="{{url('assets/images/services/'.$page_data->feature_page_banner)}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="all_prod_tab">
                    <div class="all_prod_tab_main">
                        <ul class="nav nav-tabs">
                            <li><a href="{{route('front.featuredCatSuppliers')}}">Suppliers</a></li>
                            <li><a href="{{route('front.featuredCatproducts')}}">Products</a></li>
                            <li><a href="{{route('front.featuredCatService')}}" class="active">Services</a></li>
                            <li><a href="{{route('front.allQuotes')}}">Orders</a></li>
                            <li><a href="{{route('front.requestQuote')}}">Get a Quotes</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="text-center mt-3"><a style="color: #af241e" href="{{route('front.service')}}"><strong>View all Services</strong></a></div>
                        <div id="suppliers" class="tab-pane fade in active show">
                            <div class="all_prod_cats_main">
                                @foreach($category_selections as $cat)
                                    <h3>{{$cat->name}}</h3>
                                    <ul class="all_prod_list">
                                        @foreach($cat->products as $prod)
                                            <li>
                                                <a href="{{ route('front.product', $prod->slug) }}" class="all_prod_img">
                                                    <img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
                                                </a>
                                                <span class="all_prod_name">{{ $prod->showName() }}</span>
                                                <span class="all_prod_price">{!! $prod->showPrice() !!}{!! (!empty($prod->showPreviousPrice()))?'<small style="text-decoration:line-through">'.$prod->showPreviousPrice().'</small>':'' !!}</span>
                                                <div class="all_prod_btn"><a href="{{ route('front.product', $prod->slug) }}">Buy</a></div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="prod_botm_btn"><a href="{{route('front.service',$cat->slug)}}">View more</a></div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function(){
            $('.all_prod_cats li .link-area a').click(function(e){
                e.preventDefault();
                $(this).parents('.link-area').toggleClass('active');
                $(this).parents('.link-area').next('ul').slideToggle();
            });
            $('.categories_mega_menu li a').click(function(e){
                e.preventDefault();
                $(this).toggleClass('active');
                $(this).next('div').find('ul').slideToggle();
            });
        });
    </script>
@endsection
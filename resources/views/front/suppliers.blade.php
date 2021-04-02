@extends('layouts.front')
@section('title',$page_title)
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pages">
                        <li>
                            <a href="{{route('front.index')}}">{{ $langg->lang17 }}</a>
                        </li>
                        @if (!empty($cat))
                            <li>
                                <a href="{{route('front.vendorStores', $cat->slug)}}">{{ $cat->name }}</a>
                            </li>
                        @endif
                        @if (!empty($subcat))
                            <li>
                                <a href="{{route('front.vendorStores', [$cat->slug, $subcat->slug])}}">{{ $subcat->name }}</a>
                            </li>
                        @endif
                        @if (!empty($childcat))
                            <li>
                                <a href="{{route('front.vendorStores', [$cat->slug, $subcat->slug, $childcat->slug])}}">{{ $childcat->name }}</a>
                            </li>
                        @endif
                        @if (empty($childcat) && empty($subcat) && empty($cat))
                            <li>
                                <a href="{{route('front.vendorStores')}}">{{ $langg->lang36 }}</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
    <!-- SubCategori Area Start -->
    <section class="sub-categori">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all_prod_tab">
                        <div class="all_prod_tab_main">
                            <ul class="nav nav-tabs">
                                <li><a href="{{route('front.vendorStores')}}" class="{{$active_tab=='suppliers'?'active':''}}">Suppliers</a></li>
                                <li><a href="{{route('front.category')}}" class="{{$active_tab=='products'?'active':''}}">Products</a></li>
                                <li><a href="{{route('front.service')}}" class="{{$active_tab=='services'?'active':''}}">Services</a></li>
                                <li><a href="{{route('front.allQuotes')}}">Orders</a></li>
                                <li><a href="{{route('front.requestQuote')}}">Get a Quotes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="left-area">
                        <div class="filter-result-area">
                            <div class="header-area">
                                <h4 class="title">
                                    {{$langg->lang61}}
                                </h4>
                            </div>
                            <div class="body-area">
                                <form id="catalogForm" action="{{ route($active_tab=='services'?'front.service':'front.vendorStores', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}" method="GET">
                                    @if (!empty(request()->input('search')))
                                        <input type="hidden" name="search" value="{{ request()->input('search') }}">
                                    @endif
                                    @if (!empty(request()->input('sort')))
                                        <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                                    @endif
                                    <ul class="filter-list">
                                        @foreach ($categories as $element)
                                            <li>
                                                <div class="content">
                                                    <a href="{{route('front.vendorStores', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i> {{$element->name}}</a>
                                                    @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                                                        @foreach ($cat->subs as $key => $subelement)
                                                            <div class="sub-content open">
                                                                <a href="{{route('front.vendorStores', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-angle-right"></i>{{$subelement->name}}</a>
                                                                @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                                                                    @foreach ($subcat->childs as $key => $childcat)
                                                                        <div class="child-content open">
                                                                            <a href="{{route('front.vendorStores', [$cat->slug, $subcat->slug, $childcat->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-caret-right"></i> {{$childcat->name}}</a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        @endforeach

                                                </div>
                                                @endif


                                            </li>
                                        @endforeach
                                    </ul>
                                    {{--<button class="filter-btn" type="submit">{{$langg->lang58}}</button>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 order-first order-lg-last ajax-loader-parent">
                    <div class="right-area" id="app">
                        <div class="item-filter">
                            <ul class="filter-list">
                                <li class="item-short-area">
                                    <p>{{$langg->lang64}} :</p>
                                    <select id="sortby" name="sort" class="short-item">
                                        <option value="a_to_z">A to Z</option>
                                        <option value="z_to_a">Z to a</option>
                                    </select>
                                </li>
                            </ul>
                        </div>

                        <div class="categori-item-area">
                            <div class="row">
                                <ul class="all_prod_list" id="ajaxContent">
                                    @include('includes.vendor.filtered-vendors')
                                </ul>
                            </div>
                            <div id="ajaxLoader" class="ajax-loader">
								<span class="dot"></span>
								  <div class="dots">
									<span></span>
									<span></span>
									<span></span>
								  </div>
							</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SubCategori Area End -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            // when dynamic attribute changes
            $(".attribute-input, #sortby").on('change', function() {
                $("#ajaxLoader").show();
                filter();
            });

            // when price changed & clicked in search button
            $(".filter-btn").on('click', function(e) {
                e.preventDefault();
                $("#ajaxLoader").show();
                filter();
            });
        });

        function filter() {
            let filterlink = '';

            if ($("#prod_name").val() != '') {
                if (filterlink == '') {
                    filterlink += '{{route($active_tab=='services'?'front.service':'front.vendorStores', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
                } else {
                    filterlink += '&search='+$("#prod_name").val();
                }
            }

            $(".attribute-input").each(function() {
                if ($(this).is(':checked')) {
                    if (filterlink == '') {
                        filterlink += '{{route($active_tab=='services'?'front.service':'front.vendorStores', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
                    } else {
                        filterlink += '&'+$(this).attr('name')+'='+$(this).val();
                    }
                }
            });

            if ($("#sortby").val() != '') {
                if (filterlink == '') {
                    filterlink += '{{route($active_tab=='services'?'front.service':'front.vendorStores', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
                } else {
                    filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
                }
            }
            // console.log(filterlink);
            console.log(encodeURI(filterlink));
            $("#ajaxContent").load(encodeURI(filterlink), function(data) {
                // add query string to pagination
                addToPagination();
                $("#ajaxLoader").fadeOut(1000);
            });
        }

        // append parameters to pagination links
        function addToPagination() {
            // add to attributes in pagination links
            $('ul.pagination li a').each(function() {
                let url = $(this).attr('href');
                let queryString = '?' + url.split('?')[1]; // "?page=1234...."

                let urlParams = new URLSearchParams(queryString);
                let page = urlParams.get('page'); // value of 'page' parameter

                let fullUrl = '{{route($active_tab=='services'?'front.service':'front.vendorStores', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

                if ($("#sortby").val() != '') {
                    fullUrl += '&sort='+encodeURI($("#sortby").val());
                }
                $(this).attr('href', fullUrl);
            });
        }

        $(document).on('click', '.categori-item-area .pagination li a', function (event) {
            event.preventDefault();
            if ($(this).attr('href') != '#' && $(this).attr('href')) {
                $('#preloader').show();
                $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
                    if (status == "success") {
                        $('#preloader').fadeOut();
                        $("html,body").animate({
                            scrollTop: 0
                        }, 1);

                        addToPagination();
                    }
                });
            }
        });

    </script>
@endsection

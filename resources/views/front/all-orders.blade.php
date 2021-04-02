@extends('layouts.home')
@section('title','Home')
@section('content')

    <div class="buyers_section mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Buyer Request</h3>
                    <div class="buyer_carousel">
                        @foreach($buyer_requests as $buyer_request)
                            <div class="buyer_main">
                                <div class="row">
                                    <div class="col-md-7">
                                        <p>{!! summary($buyer_request['details'],220) !!}</p>
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
                                        <img style="width: 30px;max-height: 100%; box-shadow: 0 0 30px rgba(0,0,0,.05); margin-top: 9%;" class="float-right" src="{{asset('assets/images/countries/'.strtolower($buyer_request['country_code']).'.png')}}">
                                        <span class="float-right" style="margin-top: 9%" >{{$buyer_request['country_info']['country_name']??''}}</span>
                                    </div>
                                    <div>
                                        <div class="prod_botm_btn" style="margin-bottom: 0px; margin-top: 14%;"><a href="javascript:void(0);" data-toggle="modal" data-target="#view_more_modal_{{$buyer_request['id']}}">View more</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
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
                                                                <h3>Detailed Description</h3>
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
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    {{$buyer_requests_query->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-scripts')
    <script src="{{url('/front-end/js/slick.js')}}"></script>
    <script>
        $(document).ready(function(){
            /*$('.buyer_carousel').slick({
             dots: false,
             vertical: true,
             slidesToShow: 4,
             slidesToScroll: 1,
             verticalSwiping: true,
             autoplay:true,
             autoplaySpeed:1500,
             });*/
        });
    </script>
@endsection
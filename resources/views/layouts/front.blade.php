<!DOCTYPE html>
<html lang="en">


@include('elements.head')

<body>

@if($gs->is_loader == 1)
    <div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif

@if($gs->is_popup== 1)

    @if(isset($visited))
        <div style="display:none">
            <img src="{{asset('assets/images/'.$gs->popup_background)}}">
        </div>

        <!--  Starting of subscribe-pre-loader Area   -->
        <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
            <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
                <span class="preload-close"><i class="fas fa-times"></i></span>
                <div class="subscribePreloader__text text-center">
                    <h1>{{$gs->popup_title}}</h1>
                    <p>{{$gs->popup_text}}</p>
                    <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                            <button id="sub-btn" type="submit">{{ $langg->lang742 }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--  Ending of subscribe-pre-loader Area   -->

    @endif

@endif
@include('elements.header')
@yield('content')

<!-- Footer Area Start -->
@include('elements.footer')
<!-- Footer Area End -->

<!-- Back to Top Start -->
<div class="bottomtotop">
    <i class="fas fa-chevron-right"></i>
</div>
<!-- Back to Top End -->


<script type="text/javascript">
    var mainurl = "{{url('/')}}";
    var gs      = {!! json_encode($gs) !!};
    var langg    = {!! json_encode($langg) !!};
</script>

<!-- jquery -->
{{--<script src="{{asset('assets/front/js/all.js')}}"></script> --}}
{{--<script src="{{asset('assets/front/js/vue.js')}}"></script>--}}
<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- popper -->
<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
<!-- bootstrap -->
{{--<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>--}}
<!-- plugin js-->
<script src="{{asset('assets/front/js/plugin.js')}}"></script>

<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
<script src="{{asset('assets/front/js/setup.js')}}"></script>

<script src="{{asset('assets/front/js/toastr.js')}}"></script>
<!-- main -->
<script src="{{asset('assets/front/js/main.js')}}"></script>
<!-- custom -->
<script src="{{asset('assets/front/js/custom.js?v2')}}"></script>

<script src="{{url('/front-end/plugins/jquery-filer/js/jquery.filer.min.js')}}"></script>
{!! $seo->google_analytics !!}

@if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
    {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
@endif

@yield('scripts')
<script>
    $('document').ready(function () {
        @if (\Session::get('success') && \Session::get('success') != '')
toastr.success('{!!\Session::get('success')!!}');
        @endif
        @if (\Session::get('error') && \Session::get('error') != '')
            toastr.error('{!!\Session::get('error')!!}');
        @endif
    });
</script>

</body>

</html>

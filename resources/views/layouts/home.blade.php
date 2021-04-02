<!doctype html>
<html>
@include('elements.head')
<body>
@include('elements.header')
<div class="body_container"{{-- id="google_translate_element"--}}>
    @yield('content')
</div>
@include('elements.footer')
@yield('page-scripts')
<script type="text/javascript">
    var mainurl = "{{url('/')}}";
    var gs      = {!! json_encode($gs) !!};
    var langg    = {!! json_encode($langg) !!};
</script>

{{--<script src="{{asset('assets/front/js/vue.js')}}"></script>--}}
<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- popper -->
<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
<!-- bootstrap -->
{{-- <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script> --}}
<!-- plugin js-->
<script src="{{asset('assets/front/js/plugin.js')}}"></script>

{{--<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/front/js/setup.js')}}"></script>--}}

<script src="{{asset('assets/front/js/toastr.js')}}"></script>
<!-- main -->
<script src="{{asset('assets/front/js/main.js')}}"></script>
<!-- custom -->
<script src="{{asset('assets/front/js/custom.js?4')}}"></script>

<script src="{{url('/front-end/plugins/jquery-filer/js/jquery.filer.min.js')}}"></script>
{{--<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'zh'}, 'google_translate_element');
    }
</script>--}}
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
        @if($errors && count($errors) > 0)
        @foreach ($errors as $resErrors)
			toastr.error('{!! $resErrors !!}');
        @endforeach
        @endif
    });
</script>
</body>
</html>

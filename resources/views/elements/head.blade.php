<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(\Request::route() && !empty(\Request::route()) && \Request::route()->getName() == 'front.index')
        <title>{{$gs->title}} - @yield('title','')</title>
    @else
        <title>@yield('title','') - {{$gs->title}}</title>
    @endif
    <script>var site_url = '{{url('/')}}';</script>
    <!-- favicon -->
    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
        <title>{{$gs->title}}</title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
        <title>{{$gs->title}}</title>
    @elseif(isset($productt))
        <meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
        <meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
        <meta property="og:title" content="{{$productt->name}}" />
        <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
        <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
        <meta name="author" content="YiwuBazaar">
        <title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
        <meta name="author" content="YiwuBazaar">
        <meta name="description" content="Yiwu Bazaar goal is to develop a wholesale B2B e-commerce site that focuses only on Yiwu market small commodities marketplace, direct connecting wholesalers in Central Asia Countries to Yiwu small commodities market, providing them the best purchasing goods experience.">
        <meta name="msvalidate.01" content="A68DE80F75F41C859CD99ACDD52B209F" />
        <title>{{$gs->title}}</title>
    @endif
    @if($langg->rtl == "1")

    <!-- stylesheet -->
        <link rel="stylesheet" href="{{asset('assets/front/css/rtl/all.css')}}">

        <!--Updated CSS-->
        <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

    @else

    <!-- stylesheet -->
        <link rel="stylesheet" href="{{asset('assets/front/css/all.css?v4')}}">
        <!--Updated CSS-->
        <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

    @endif
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/front-end/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/front-end/css/style.css?v1.1.2')}}">
    <link rel="stylesheet" href="{{url('/front-end/css/bootstrap-select.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('/front-end/css/bootstrap-select-country.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('/front-end/css/slick.css?v2')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('assets/front/css/toastr.css')}}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('/front-end/plugins/jquery-filer/css/jquery.filer.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/front-end/plugins/jquery-filer/css/themes/jquery.filer-dragdropbox-theme.css')}}">
    <style>
        .dropdown-cart-total{
            clear: both;
        }
        .page-item.active .page-link{
            background-color: #af241e;
            border-color: #af241e;
        }
        .page-link{
            color: #af241e;
        }

    </style>
    @yield('page-styles')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KBXKJKT');</script>
    <!-- End Google Tag Manager -->
</head>
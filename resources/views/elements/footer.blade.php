
<div class="footer_icon">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center"><a href="{{ route('front.index') }}" class="footer_logo"><img src="{{asset('assets/images/footer-top-logo.png')}}" alt=""></a></div>   
            <div class="offset-lg-1"> </div>
            <div class="col-lg-4 col-md-6 order-lg-0"> 
                <h4 class="footer_heading">About us</h4>
                <p {{--class="footer_text"--}}>{!! $gs->footer !!}</p>
                <div class="subscriber_form">
                    <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                        {{csrf_field()}}
                        <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                        <input id="sub-btn" type="submit" value="{{ strtolower($langg->lang742) }}">
                    </form>
                </div>
                <p class="footer_phone">{!! $gs->below_subscriber !!}</p>
            </div>

            <div class="col-lg-2 col-md-6 order-lg-1">
                <h4 class="footer_heading">{!! $gs->menu_1_heading !!}</h4>
                <div class="footer_links">
                    @foreach(DB::table('pages')->where('footer_menu_1','=','1')->get() as $data)
                        <a href="{{ route('front.page',$data->slug) }}">
                            {{ $data->title }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-md-6 order-lg-2">
                <h4 class="footer_heading">{!! $gs->menu_2_heading !!}</h4>
                <div class="footer_links">
                    @foreach(DB::table('pages')->where('footer_menu_2','=','1')->get() as $data)
                    @if($data->title == 'Contact Us')
						<a href="{{ route('front.contact') }}">
                            {{ $data->title }}
                        </a>
					@else
                        <a href="{{ route('front.page',$data->slug) }}">
                            {{ $data->title }}
                        </a>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-md-6 order-lg-3">
                <h4 class="footer_heading">{!! $gs->menu_3_heading !!}</h4>
                <div class="footer_links">
                    @foreach(DB::table('pages')->where('footer_menu_3','=','1')->get() as $data)
                        <a href="{{ route('front.page',$data->slug) }}">
                            {{ $data->title }}
                        </a>
                    @endforeach
                </div>
                <ul class="footer_social">
                    @php
                        $social_row = App\Models\Socialsetting::find(1);
                    @endphp
                    @if(!empty($social_row->facebook))
                        <li>
                            <a href="{{ $social_row->facebook }}" class="facebook" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" id="Bold" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/></svg> </a>
                        </li>
                    @endif
                    @if(!empty($social_row->instagram))
                        <li>
                            <a href="{{ $social_row->instagram }}" class="twitter" target="_blank"> <svg id="Bold" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m12.004 5.838c-3.403 0-6.158 2.758-6.158 6.158 0 3.403 2.758 6.158 6.158 6.158 3.403 0 6.158-2.758 6.158-6.158 0-3.403-2.758-6.158-6.158-6.158zm0 10.155c-2.209 0-3.997-1.789-3.997-3.997s1.789-3.997 3.997-3.997 3.997 1.789 3.997 3.997c.001 2.208-1.788 3.997-3.997 3.997z"/><path d="m16.948.076c-2.208-.103-7.677-.098-9.887 0-1.942.091-3.655.56-5.036 1.941-2.308 2.308-2.013 5.418-2.013 9.979 0 4.668-.26 7.706 2.013 9.979 2.317 2.316 5.472 2.013 9.979 2.013 4.624 0 6.22.003 7.855-.63 2.223-.863 3.901-2.85 4.065-6.419.104-2.209.098-7.677 0-9.887-.198-4.213-2.459-6.768-6.976-6.976zm3.495 20.372c-1.513 1.513-3.612 1.378-8.468 1.378-5 0-7.005.074-8.468-1.393-1.685-1.677-1.38-4.37-1.38-8.453 0-5.525-.567-9.504 4.978-9.788 1.274-.045 1.649-.06 4.856-.06l.045.03c5.329 0 9.51-.558 9.761 4.986.057 1.265.07 1.645.07 4.847-.001 4.942.093 6.959-1.394 8.453z"/><circle cx="18.406" cy="5.595" r="1.439"/></svg> </a></li>
                    @endif

                    @if(!empty($social_row->twitter))
                        <li>
                            <a href="{{ $social_row->twitter }}" class="linkedin" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
    <g>
        <path d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016    c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992    c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056    c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152    c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792    c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44    C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568    C480.224,136.96,497.728,118.496,512,97.248z"/>
    </g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg> </a></li>
                   
                    
                    @endif
                    @if(!empty($social_row->linkedin))
                        <li>
                            <a href="{{ $social_row->linkedin }}" class="linkedin" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" id="Bold" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512"><path d="m23.994 24v-.001h.006v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07v-2.185h-4.773v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243v7.801z"/><path d="m.396 7.977h4.976v16.023h-4.976z"/><path d="m2.882 0c-1.591 0-2.882 1.291-2.882 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909c-.001-1.591-1.292-2.882-2.882-2.882z"/></svg> </a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 
<div class="copyright_text ftr-logo"> 
    <div class="container d-flex">  
        <div><img src="{{url('/front-end/images/footer-logo1.png')}}"></div>
        <div class="center"><img src="{{url('/front-end/images/footer-logo2.png')}}"></div>
        <div><img src="{{url('/front-end/images/footer-logo3.png')}}"></div>
    </div>
</div>
-->
<div class="copyright_text"> {!! $gs->copyright !!} </div>


<!-- LOGIN MODAL -->
<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
     aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav class="comment-log-reg-tabmenu">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
                           role="tab" aria-controls="nav-log" aria-selected="true">
                            {{ $langg->lang197 }}
                        </a>
                        <a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
                           aria-controls="nav-reg" aria-selected="false">
                            {{ $langg->lang198 }}
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
                         aria-labelledby="nav-log-tab1">
                        <div class="login-area">
                            <div class="header-area">
                                <h4 class="title">{{ $langg->lang172 }}</h4>
                            </div>
                            <div class="login-form signin-form">
                                @include('includes.admin.form-login')
                                <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-input">
                                        <input type="email" name="email" placeholder="{{ $langg->lang173 }}"
                                               required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" name="password"
                                               placeholder="{{ $langg->lang174 }}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    <div class="form-forgot-pass">
                                        <div class="left">
                                            <input type="checkbox" name="remember" id="mrp"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                            <label for="mrp">{{ $langg->lang175 }}</label>
                                        </div>
                                        <div class="right">
                                            <a href="javascript:;" id="show-forgot">
                                                {{ $langg->lang176 }}
                                            </a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="modal" value="1">
                                    <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                                    <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                                    @if(App\Models\Socialsetting::find(1)->f_check == 1 ||
                                    App\Models\Socialsetting::find(1)->g_check == 1)
                                        <div class="social-area">
                                            <h3 class="title">{{ $langg->lang179 }}</h3>
                                            <p class="text">{{ $langg->lang180 }}</p>
                                            <ul class="social-links">
                                                @if(App\Models\Socialsetting::find(1)->f_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','facebook') }}">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(App\Models\Socialsetting::find(1)->g_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','google') }}">
                                                            <i class="fab fa-google-plus-g"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
                        <div class="login-area signup-area">
                            <div class="header-area">
                                <h4 class="title">{{ $langg->lang181 }}</h4>
                            </div>
                            <div class="login-form signup-form">
                                @include('includes.admin.form-login')
                                <form class="mregisterform" action="{{route('user-register-submit')}}"
                                      method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-input">
                                        <input type="text" class="User Name" name="name"
                                               placeholder="{{ $langg->lang182 }}" required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="email" class="User Name" name="email"
                                               placeholder="{{ $langg->lang183 }}" required="">
                                        <i class="icofont-email"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="text" class="User Name" name="phone"
                                               placeholder="{{ $langg->lang184 }}" required="">
                                        <i class="icofont-phone"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="text" class="User Name" name="address"
                                               placeholder="{{ $langg->lang185 }}" required="">
                                        <i class="icofont-location-pin"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="password" class="Password" name="password"
                                               placeholder="{{ $langg->lang186 }}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="password" class="Password" name="password_confirmation"
                                               placeholder="{{ $langg->lang187 }}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>


                                    @if($gs->is_capcha == 1)

                                        <ul class="captcha-area">
                                            <li>
                                                <p><img class="codeimg1"
                                                        src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
                                                            class="fas fa-sync-alt pointer refresh_code "></i></p>
                                            </li>
                                        </ul>

                                        <div class="form-input">
                                            <input type="text" class="Password" name="codes"
                                                   placeholder="{{ $langg->lang51 }}" required="">
                                            <i class="icofont-refresh"></i>
                                        </div>


                                    @endif

                                    <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
                                    <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN MODAL ENDS -->

<!-- FORGOT MODAL -->
<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
     aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="login-area">
                    <div class="header-area forgot-passwor-area">
                        <h4 class="title">{{ $langg->lang191 }} </h4>
                        <p class="text">{{ $langg->lang192 }} </p>
                    </div>
                    <div class="login-form">
                        @include('includes.admin.form-login')
                        <form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-input">
                                <input type="email" name="email" class="User Name"
                                       placeholder="{{ $langg->lang193 }}" required="">
                                <i class="icofont-user-alt-5"></i>
                            </div>
                            <div class="to-login-page">
                                <a href="javascript:;" id="show-login">
                                    {{ $langg->lang194 }}
                                </a>
                            </div>
                            <input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
                            <button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav class="comment-log-reg-tabmenu">
                    <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                        <a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
                            {{--{{ $langg->lang234 }}--}}
                            Supplier Login
                        </a>
                        <a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
                            {{--{{ $langg->lang235 }}--}}
                            Supplier Registration
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
                        <div class="login-area">
                            <div class="login-form signin-form">
                                @include('includes.admin.form-login')
                                <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-input">
                                        <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    <div class="form-forgot-pass">
                                        <div class="left">
                                            <input type="checkbox" name="remember"  id="mrp1" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="mrp1">{{ $langg->lang175 }}</label>
                                        </div>
                                        <div class="right">
                                            <a href="javascript:;" id="show-forgot1">
                                                {{ $langg->lang176 }}
                                            </a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="modal"  value="1">
                                    <input type="hidden" name="vendor"  value="1">
                                    <input class="mauthdata" type="hidden"  value="{{ $langg->lang177 }}">
                                    <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                                    @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
                                        <div class="social-area">
                                            <h3 class="title">{{ $langg->lang179 }}</h3>
                                            <p class="text">{{ $langg->lang180 }}</p>
                                            <ul class="social-links">
                                                @if(App\Models\Socialsetting::find(1)->f_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','facebook') }}">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(App\Models\Socialsetting::find(1)->g_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','google') }}">
                                                            <i class="fab fa-google-plus-g"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                        <div class="login-area signup-area">
                            <div class="login-form signup-form">
                                @include('includes.admin.form-login')
                                <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="text" class="User Name" name="name" placeholder="Enter your company name" required="">
                                                <i class="icofont-user-alt-5"></i>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                                <i class="icofont-email"></i>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-input">
                                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                                <i class="icofont-location-pin"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                {{Form::select('country',$reg_countries,'',[])}}
                                                <i class="icofont-flag"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                                <i class="icofont-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="text" class="User Name" name="reg_number" placeholder="{{ $langg->lang242 }}" required="">
                                                <i class="icofont-ui-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-input">
                                                <select name="who_are_you">
                                                    <option value="">Who are you?</option>
                                                    <option value="product">Product Supplier</option>
                                                    <option value="services">Service Supplier</option>
                                                    <option value="both">Product and Service Supplier</option>
                                                </select>
                                                <i class="icofont-building"></i>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 product cats" style="display: none;">
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
                                        <div class="col-lg-6 services cats" style="display: none;">
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
                                                </div></div>
                                        </div>
                                        <div class="col-lg-12 visible-lg-block"></div>
                                        <div class="col-lg-12">
                                            <div class="form-input">
                                                <textarea class="User Name" name="shop_message" placeholder="Describe your company in more detail." required=""></textarea>
                                                <i class="icofont-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                                <i class="icofont-ui-password"></i>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                                <i class="icofont-ui-password"></i>
                                            </div>
                                        </div>
                                        @if($gs->is_capcha == 1)
                                            <div class="col-lg-6">


                                                <ul class="captcha-area">
                                                    <li>
                                                        <p>
                                                            <img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code refresh_captcha_vendor "></i>
                                                        </p>

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="form-input">
                                                    <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                                    <i class="icofont-refresh"></i>

                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-12">
                                            <h3>Verification Documents</h3>
                                            <div class="form-input">
                                                <label>Please Upload Your Company Business License.</label>
                                                <p style="margin-left:0;">请上传公司营业执照或注册文件</p>
                                            </div>
                                            <input type="file" name="files[]" multiple id="upload_file_vendor_registration">
                                        </div>
                                        <input type="hidden" name="vendor"  value="1">
                                        <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
                                        <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

<div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
            </div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container quick-view-modal">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Quick View Modal -->


<!-- Order Tracking modal Start-->
<div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="order-tracking-content">
                    <form id="track-form" class="track-form">
                        {{ csrf_field() }}
                        <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                        <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                        <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                    </form>
                </div>

                <div>
                    <div class="submit-loader d-none">
                        <img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
                    </div>
                    <div id="track-order">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Order Tracking modal End -->
<!-- Vendor Cat Modal -->

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
                                        <span><input autocomplete="off" type="checkbox" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
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
                                                <input autocomplete="off" type="checkbox" value="sub_cat##{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;"><a href="javascript:void(0)">{{$subcat->name}}</a>
                                                @if(count($subcat->childs) > 0)
                                                    <div class="categorie_sub_menu">
                                                        <ul>
                                                            @foreach($subcat->childs as $childcat)
                                                                <li><input autocomplete="off" type="checkbox" value="child_cat##{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</li>
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
                                        <span><input type="checkbox" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;">{{ $category->name }}</span>
                                        @if(count($category->subs) > 0)

                                        @endif
                                    </div>

                                @else
                                    <input type="checkbox" value="main_cat##{{ $category->id }}" class="cat_checkbox" data-name="{{ $category->name }}" style="display: inline-block; margin-right: 5px;"> {{ $category->name }}</a>

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
                                                <input type="checkbox" value="sub_cat##{{ $subcat->id }}" class="cat_checkbox" data-name="{{ $subcat->name }}" style="display: inline-block; margin-right: 5px;"><a href="javascript:void(0)">{{$subcat->name}}</a>
                                                @if(count($subcat->childs) > 0)
                                                    <div class="categorie_sub_menu">
                                                        <ul>
                                                            @foreach($subcat->childs as $childcat)
                                                                <li><input type="checkbox" value="sub_cat##{{ $childcat->id }}" class="cat_checkbox" data-name="{{ $childcat->name }}" style="display: inline-block; margin-right: 5px;">{{$childcat->name}}</li>
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

<!-- Vendor Cat Modal -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBXKJKT"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script src="{{asset('assets/front/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{url('/front-end/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/front-end/js/bootstrap-select.min.js')}}"></script>
<script src="{{url('/front-end/js/bootstrap-select-country.min.js')}}"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    }
    $('.countrypicker').countrypicker();
    $('#vendor-login').on('shown.bs.modal', function (e) {
        $('.refresh_captcha_vendor').trigger('click');
    });
    @if(!auth()->guard('web')->check())
    $(document).ready(function(){
        $("#upload_file_vendor_registration").filer({
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
    @endif
    $(document).ready(function(){
        $('.selectpicker, .product_select, select.nice').selectpicker();
        $('.lang_select').selectpicker({
            showIcon: true,
        });
        $('select[name=currency], select[name=language]').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });

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

        $('#product-cat, #services-cat').on('show.bs.modal', function (e) {
            $('#vendor-login').modal('hide');
            //$('#vendor-login').css('visibility','hidden');
        });
        $('#product-cat, #services-cat').on('hide.bs.modal', function (e) {
            //$('#vendor-login').css('visibility','visible');
            $('#vendor-login').modal('show');

        });
        /*$('body').on('show.bs.modal', function() {
         $('html').addClass('modal-open');
         });
         $('body').on('hidden.bs.modal', function() {
         $('html').removeClass('modal-open');
         });*/
        $('select[name=who_are_you]').on('change',function(){
            $('.category_main_cont').parent('div').find('input[type=hidden]').remove();
            $('.category_main_cont').find('span').remove();
            $('.cat_checkbox').each(function(){
                $(this).prop('checked',false);
            });
            $('.category_modal .modal-count span').text(0);
            $('.category_modal .modal-count').hide();
            if($(this).val() != 'both'){
                $('.col-lg-6.cats').hide();
                $('.col-lg-6.'+$(this).val()).show();
            }
            else{
                $('.col-lg-6.cats').show();
            }
        });
    });

    function removeCat(_this, type){
        type = $.trim(type);
        $('#'+type+'-cat input.cat_checkbox[value='+$(_this).parents('.form-cat').data('id')+']').prop('checked',false).change();
        $(_this).parents('.form-cat').remove();
        var i=0;
        $('.'+type+'_catgeory_cont').parent('div').find('input[type=hidden]').remove();
        $('#'+type+'-cat .cat_checkbox').each(function(){
            if($(this).prop('checked') == true){
                $('.'+type+'_catgeory_cont').parent('div').append('<input type="hidden" name="category[]" value="'+$(this).val()+'">');
                i=parseInt(i)+1;
            }
            $('#'+type+'-cat .modal-count span').text(i);
            if(i >= 1){
                $('#'+type+'-cat .modal-count').show();
            }
        });
    }
</script>
<script type="text/javascript">
    var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq ||
        {widgetcode:"548be5ef21c039ad725904510fbab272000fd1c282c48252d635aabd4319db5f9798270d4337cd11deda006f2483f83e1a2010ab7b6727677d37b27582c0e9c4", values:{},ready:function(){}};
    var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
    s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
</script>

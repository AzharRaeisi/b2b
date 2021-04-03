@if (count($vendors) > 0)
    @foreach ($vendors as $key => $vendor)
        <li>
            <a href="{{ route('front.vendor', $vendor['shop_name']) }}" class="all_prod_img">
                <img src="{{$vendor['photo'] ? asset('assets/images/users/'.$vendor['photo']):asset('assets/images/'.$gs->user_image)}}" alt="">
            </a>
            <span class="all_prod_sup_name"><a style="color: #af241e" href="{{ route('front.vendor', $vendor['shop_name']) }}">{{$vendor['name']}}</a></span>
            <span class="all_prod_name" style="margin-bottom: 0;">{{$category_row['name']}}</span>
            @if(!empty($vendor['country']))
                <img style="width: 25px;" src="{{asset('assets/images/countries/'.strtolower($counties_code[$vendor['country']]).'.png')}}" alt="{{$vendor['country']}}"> &nbsp;<small>{{$vendor['country']}}</small>
            @endif
            <div class="all_prod_btn" style="text-align: center"><a href="{{ route('front.vendor', $vendor['shop_name']) }}">Contact</a></div>
        </li>
    @endforeach
    <div class="col-lg-12">
        <div class="page-center mt-5">
            {!! $vendors->appends(['search' => request()->input('search')])->links() !!}
        </div>
    </div>
@else
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <strong>Sorry!</strong> No record found.</a>
        </div>
    </div>
@endif
@extends('layouts.admin')

@section('styles')
@endsection

@section('content')

    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __("Request a Quote Details") }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-brequests-index') }}">{{ __("Buyer requests") }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-brequests-detail',$data->id) }}">{{ __("Buyer requests Details") }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="add-product-content1 customar-details-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Status:</label>
                                    <div class="action-list">
                                        <select autocomplete="off" class="process select droplinks drop-success">
                                            <option {{$data->status == 'Pending'?'selected':''}} data-val="Pending" value="{{route('admin-brequests-statusUpdate',[$data->id,'Pending'])}}">Pending</option>
                                            <option {{$data->status == 'Approved'?'selected':''}} data-val="Approved" value="{{route('admin-brequests-statusUpdate',[$data->id,'Approved'])}}">Approved</option>
                                            <option {{$data->status == 'Reject'?'selected':''}} data-val="Reject" value="{{route('admin-brequests-statusUpdate',[$data->id,'Reject'])}}">Reject</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>Details</th>
                                            </tr>
                                            <tr>
                                                <td><p>{!! $data['details'] !!}</p></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>{{ __("Name") }}</th>
                                                <td>{{$data->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Email") }}</th>
                                                <td>{{ $data->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("City") }}</th>
                                                <td>{{ $data->city }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Type") }}</th>
                                                <td>{{ $data->type }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Phone Number") }}</th>
                                                <td>{{ $data->phone  }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Country") }}</th>
                                                <td>{{ $data->country_code }} <img style="width: 30px;max-height: 100%;border-radius: 0px;height: auto;" src="{{asset('assets/images/countries/'.strtolower($data->country_code).'.png')}}"></td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>File</th>
                                            </tr>
                                            @php
                                                $files = json_decode($data->files,1);
                                            @endphp
                                            @foreach($files as $file)
                                                <tr>
                                                    <td><a href="{{asset('files/quotes/'.$data->id.'/'.$file)}}" target="_blank"><i class="fa fa-download"></i> {{ $file }}</a> </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>Main Categories</th>
                                            </tr>
                                            @foreach($main_categories_info as $category)
                                                <tr>
                                                    <td><p>{!! $category !!}</p></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">

                                            <tr>
                                                <th>Sub Categories</th>
                                            </tr>
                                            @foreach($sub_categories_info as $category)
                                                <tr>
                                                    <td><p>{!! $category !!}</p></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>Child Categories</th>
                                            </tr>
                                            @foreach($child_categories_info as $category)
                                                <tr>
                                                    <td><p>{!! $category !!}</p></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('scripts')

@endsection

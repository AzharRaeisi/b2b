@extends('layouts.load')

@section('content')

    <div class="content-area">

        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            @include('includes.admin.form-error')
                            <form id="yiwuformdata" action="{{route('admin-cat-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Name') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="name" placeholder="{{ __('Enter Name') }}" required="" value="{{$data->name}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Slug') }} *</h4>
                                            <p class="sub-heading">{{ __('(In English)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" onblur="makeSlugify(this)" name="slug" placeholder="{{ __('Enter Slug') }}" required="" value="{{$data->slug}}">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Type') }} *</h4>
                                            <p class="sub-heading">{{ __('In English') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="type" class="input-field">
                                            <option value="">Select Type</option>
                                            <option value="product" {{($data->type == 'product')?'selected=selected':''}}>Product</option>
                                            <option value="services"  {{($data->type == 'services')?'selected=selected':''}}>Service</option>
                                            <option value="both" {{($data->type == 'both')?'selected=selected':''}}>Both</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Default Sort Position') }} *</h4>
                                            <p class="sub-heading">{{ __('In English') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="number" min="0" value="{{$data->sort_order}}" name="sort_order" class="input-field">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Featured On Suppliers Page') }}</h4>
                                            <p class="sub-heading">{{ __('In English') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="checkbox" name="featured_for_suppliers" {{$data->featured_for_suppliers=='1'?'checked':''}}>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" value="{{$data->suppliers_sort_order}}" placeholder="{{ __('Suppliers Page Sort Position') }}" name="suppliers_sort_order" class="input-field">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Featured On Products Page') }}</h4>
                                            <p class="sub-heading">{{ __('In English') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="checkbox" name="featured_for_products" {{$data->featured_for_products=='1'?'checked':''}}>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" value="{{$data->products_sort_order}}" placeholder="{{ __('Products Page Sort Position') }}" name="products_sort_order" class="input-field">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Featured On Services Page') }}</h4>
                                            <p class="sub-heading">{{ __('In English') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="checkbox" name="featured_for_services" {{$data->featured_for_services=='1'?'checked':''}}>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" value="{{$data->services_sort_order}}" placeholder="{{ __('Services Page Sort Position') }}" name="services_sort_order" class="input-field">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Current Icon') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="img-upload">
                                            <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/categories/'.$data->photo):asset('assets/images/noimage.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Icon') }}</label>
                                                <input type="file" name="photo" class="img-upload" id="image-upload">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" name="is_featured" class="checkclick" id="is_featured" value="1" {{ $data->is_featured != 0 ? "checked":"" }}>
                                            <label for="is_featured">{{ __('Allow Featured Category') }}</label>
                                        </div>
                                        <p><small>Last 4 sorted featured will shown on home page</small></p>
                                    </div>
                                </div>


                                <div class="{{ $data->is_featured == 0 ? "showbox":"" }}">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Feature Sort Order') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" min="0" value="{{$data->feature_sort_order}}" name="feature_sort_order" class="input-field">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Current Featured Image') }}*</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="img-upload">
                                                <div id="image-preview" class="img-preview" style="background: url({{ $data->image ? asset('assets/images/categories/'.$data->image):asset('assets/images/noimage.png') }});">
                                                    <label for="image-upload" class="img-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                    <input type="file" name="image" class="img-upload">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>



                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

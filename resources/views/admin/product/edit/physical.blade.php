@extends('layouts.admin')
@section('styles')

    <link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

@endsection
@section('content')

    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading"> {{ __('Edit Product') }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-prod-index') }}">{{ __('Products') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Physical Product') }}</a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Edit') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <form id="yiwuform" action="{{route('admin-prod-update',$data->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
		<div class="row">




			<div class="col-lg-12">


				<!-- <div class="add-product-content mb-4 " >
					<div class="product-description">
						<div class="row px-3">
							<div class="basic-info col-lg-3 pt-4 pb-4  m-0">
								<h4>Basic Information</h4>
							</div>
							<div class="basic-info col-lg-3 pt-4 pb-4 m-0">
								<h4><a href="#productDescription" style="color: black;"> Product Description</a></h4>
							</div>
							<div class="basic-info col-lg-3 pt-4 pb-4 m-0">
								<h4>Price and Description</h4>
							</div>
							<div class="basic-info col-lg-3 pt-4 pb-4 m-0">
								<h4>Trade Information</h4>
							</div>
							
						</div>

					</div>
				</div> -->

				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description product-basic-info ">

								<div class="basic-info pt-4 px-4">
									<h4>Basic Information</h4>
								</div>
								<div class="body-area">

									<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
									</div>

									@include('includes.admin.form-both')

									<div class="row form-group">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-12 col-sm-6">
											<div class="left-area text-left">
												<h4 class="heading">{{ __('Product Name') }} <span class="label-star">*</span></h4>
												<p class="sub-heading">{{ __('(In Any Language)') }}</p>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product_name">
												<input type="text" class="input-field" placeholder="{{ __('Enter Product Name') }}" name="name" required="" value="{{ $data->name }}">
											</div>
										</div>
									</div>
									<div class="row form-group">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-12 col-sm-6">
											<div class="left-area text-left">
												<h4 class="heading">{{ __('Product Sku') }} <span class="label-star">*</span> </h4>

											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="product_name">
												<input type="text" class="input-field" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ $data->sku }}">

												<div class="checkbox-wrapper" style="display: none">
													<input type="checkbox" name="product_condition_check" class="checkclick" id="conditionCheck" value="1">
													<label for="conditionCheck">{{ __('Allow Product Condition') }}</label>
												</div>
											</div>
										</div>
									</div>


									<div class="showbox" style="display: none">
										<div class="row form-group">
											<div class="col-lg-4 col-md-4 col-12 col-sm-6">
												<div class="left-area float-right">
													<h4 class="heading">{{ __('Product Condition') }} <span class="label-star">*</span></h4>

												</div>
											</div>
											<div class="col-lg-8 col-md-8 col-12 col-sm-6">
												<div class="product-option w-50">
													<select name="product_condition">
														<option value="2">{{ __('New') }}</option>
														<option value="1">{{ __('Used') }}</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="row form-group">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-12 col-sm-6">
											<div class="left-area float-left">
												<h4 class="heading">{{ __('Category') }} <span class="label-star">*</span></h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="cat" name="category_id" required="">
													<option value="">{{ __('Select Category') }}</option>
													@foreach($cats as $cat)
													<option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{$cat->id}}" {{$cat->id == $data->category_id ? "selected":""}} >{{$cat->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row form-group">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-12 col-sm-6">
											<div class="left-area">
												<h4 class="heading">{{ __('Sub Category') }} <span class="label-star">*</span></h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="subcat" name="subcategory_id" disabled="">
													<option value="">{{ __('Select Sub Category') }}</option>
                                                    @if($data->subcategory_id == null)
															@foreach($data->category->subs as $sub)
																<option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{$sub->id}}" >{{$sub->name}}</option>
															@endforeach
														@else
															@foreach($data->category->subs as $sub)
																<option data-href="{{ route('admin-childcat-load',$sub->id) }}" value="{{$sub->id}}" {{$sub->id == $data->subcategory_id ? "selected":""}} >{{$sub->name}}</option>
															@endforeach
														@endif
												</select>
											</div>
										</div>
									</div>

									<div class="row form-group">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-12 col-sm-6">
											<div class="left-area">
												<h4 class="heading">{{ __('Child Category') }} <span class="label-star">*</span></h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="childcat" name="childcategory_id" disabled="">
													<option value="">{{ __('Select Child Category') }}</option>
                                                    @if($data->subcategory_id != null)
															@if($data->childcategory_id == null)
																@foreach($data->subcategory->childs as $child)
																	<option value="{{$child->id}}" >{{$child->name}}</option>
																@endforeach
															@else
																@foreach($data->subcategory->childs as $child)
																	<option value="{{$child->id}} " {{$child->id == $data->childcategory_id ? "selected":""}}>{{$child->name}}</option>
																@endforeach
															@endif
														@endif
												</select>
											</div>
										</div>
									</div>





									<!--  meta tag design -->
									<div class="col-lg-10 m-auto px-3 py-3" style="background-color: #F0F0F0;">
										<label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
										<div class="row form-group inline-block">
											<div class="col-lg-11">
												<div class="left-area">
													<h4 class="heading">{{ __('Meta Tags') }} <span class="label-star">*</span></h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="meta-tagss">
													<ul id="metatags" class="myTags" style="background-color: white;">
                                                    @if(!empty($data->meta_tag))
                                                            @foreach ($data->meta_tag as $element)
                                                                <li>{{  $element }}</li>
                                                            @endforeach
                                                        @endif
													</ul>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-11">
												<div class="left-area">
													<h4 class="heading">{{ __('Meta Description') }} <span class="label-star">*</span></h4>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="text-editor">
													<!-- <textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea> -->
                                                    <textarea name="meta_description" class="input-field" placeholder="{{ __('Details') }}">{{ $data->meta_description }}</textarea>
												</div>
											</div>
										</div>
									</div>







									<!-- Video url -->
									<div class="row mt-3">
										<div class="offset-lg-1 col-lg-2 col-md-4 col-sm-12 col-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Video URL') }} <span class="label-star">*</span></h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-8 col-md-12">
											<div class="video_url">
												<input name="youtube" type="text" value="{{ $data->youtube }}" class="input-field" placeholder="{{ __('Video URL') }}">
											</div>
										</div>
									</div>

									<div id="catAttributes"></div>
									<div id="subcatAttributes"></div>
									<div id="childcatAttributes"></div>


								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">

									<div class="row featured-tags d-none">
										<div class="col-lg-6 col-md-12">
											<div class="left-area">

											</div>

											<div class="featured-keyword-area">
												<div class="left-area">
													<h4 class="heading">{{ __('Feature Tags') }}</h4>
												</div>
												<div class="feature-tag-top-filds" id="feature-section">
													<div class="feature-area">
														<span class="remove feature-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-lg-6">
																<input type="text" name="features[]" class="input-field" placeholder="{{ __('Enter Your Keyword') }}">
															</div>

															<div class="col-lg-6">
																<div class="input-group colorpicker-component cp">
																	<input type="text" name="colors[]" value="#000000" class="input-field cp" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>
													</div>
												</div>





											</div>
										</div>
									</div>


									<div class="row tagss d-none">
										<div class="col-lg-6 col-md-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Tags') }} *</h4>
											</div>
											<ul id="tags" class="myTags">
											</ul>
										</div>
									</div>
									<input type="hidden" name="type" value="Physical">

								</div>
							</div>
						</div>
					</div>
				</div>

				<!-------another add-product-content--edited ------->
				<div class="add-product-content my-4 product-desc">
					<div class="product-description">
						<div class="basic-info pt-4 px-4">
							<h4 id="productDescription">Product Quantity</h4>
						</div>
						<div class="body-area">

							<div class="row form-group m-0">
								<div class="col-lg-2 col-md-4 col-12 col-sm-12">
									<div class="left-area">
										<h4 class="heading">{{ __('Product Photo') }} <span class="label-star">*</span></h4>
									</div>
								</div>
								<div class="col-lg-8 col-md-4 col-12 col-sm-12">
									<div class="left-area">
										<h4 class="heading inline-block">{{ __('Image Gallery') }} <span class="font-weight-light">(You can select multiple images)</span></h4>
									</div>
								</div>
							</div>
							<div class="row form-group m-1 show-img-gallery">
								<div class="col-lg-2 col-md-2 ">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style=" min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								
								<!-- <div class="col-lg-2 col-md-2">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<a href="javascript:;" id="crop-image" style="">
												<i class="icofont-plus"></i><br /> {{ __('Set Gallery') }}
											</a>
										</div>
									</div>
								</div> -->
								<div class="col-lg-2 col-md-2">
									<div class="panel panel-body">
										<div class="span4 text-center" style="min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
										<a href="#" data-toggle="modal" data-target="#setgallery">
													<i class="icofont-plus"></i> {{ __('Set Gallery') }}
												</a>
										</div>
									</div>
								</div>
							</div>

							<div class="row form-group m-2">
								<div class="col-lg-2 col-md-4 col-12 col-sm-12">
									<div class="left-area text-center">
										<a href="#">{{ __('Change') }}</a> | <a class="text-danger" href="#">{{ __('Delete') }}</a>
									</div>
								</div>
							</div>

							<input type="hidden" id="feature_photo" value="{{ $data->photo }}" name="photo" value="">

							<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*"
											   multiple>

										<!-- <div class="row mb-4">
											<div class="col-lg-12 mb-2">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Product Gallery Images') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
													<i class="icofont-plus"></i> {{ __('Set Gallery') }}
												</a>
											</div>
										</div> -->
							<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>


							<div class="row form-group">
								<div class="col-lg-4 col-sm-12 col-md-4 col-12 d-none">
									<div class="left-area text-right">
										<h4 class="heading"><span class="label-star">*</span>{{ __('Product Description') }} </h4>

									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-12 col-sm-12">
									<textarea class="form-control" id="summernote" placeholder="Enter the Description" name="details">{{$data->details}}</textarea>

								</div>
							</div>

							<br>

							<!-- <div class="row form-group">
								<div class="col-lg-12 col-sm-12 col-md-12 col-12 text-center">
									<div class="left-area">
										<h4 class="heading"><span class="label-star">*</span>{{ __('Product Buy/Return Policy') }} </h4>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-12 col-sm-12">
									<div class="text-editor">
										<textarea class="form-control" id="summernote" placeholder="Product Buy/Return Policy" name="policy">{{$data->policy}}</textarea>

										<textarea class="nic-edit-p" name="policy"></textarea>

									</div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<div class="add-product-content my-4 product-desc">
					<div class="product-description">
						<div class="basic-info pt-4 px-4">
							<h4>Price and Description</h4>
						</div>
						<div class="body-area">
							<div class="row inline-flex">

								<!-- <div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1">
													<label for="allowProductMinimumQuantity">{{ __('Minimum Order Quantity') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-5">
											<div class="row mt-3">
												<div class="col-lg-6 d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('MOQ') }}*</h4>
													</div>
												</div>
												<div class="col-lg-10 pr-4">
													<input class="form-control" placeholder="Digit only: 0" style="height:45px;" type="number" value="" name="minimum_quantity">
												</div>
											</div>
											<div class="row d-none">
												<div class="col-lg-6">
													<div class="left-area">
														<h4 class="heading">{{ __('MOQ') }}*</h4>
													</div>
												</div>
												<div class="col-lg-6">
													<input class="form-control" placeholder="Ex: piece, tons etc.." type="text" value="" name="minimum_qty_type">
												</div>
											</div>
										</div>




									</div>
								</div> -->


								<!-- moq -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<div class="left-area">
												<h4 class="heading" style="font-size:1rem; font-weight:400px;">Minimum Order Quantity</h4>
											</div>
										</div>
										<div class="col-lg-4 pr-2">
											<input class="form-control" placeholder="Digit only: 0" style="height:45px;" value="{{ $data->minimum_quantity }}" type="number" value="" name="minimum_quantity">
										</div>
									</div>
								</div>

								<!-- product inventory -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<div class="left-area">
												<h4 class="heading" style="font-size:1rem; font-weight:400px;">Product Inventory</h4>
											</div>
										</div>
										<div class="col-lg-4 pr-2">
											<input name="pro_inventory" type="text" class="input-field" placeholder="e.g 20">
										</div>
									</div>
								</div>

								<!-- unit of measurement -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1"> -->
													<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="allowProductMeasurement">{{ __('Unit of Measurement') }}</h4>

												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="row">
												<div class="d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('Unit of Measurement') }}*</h4>
													</div>
												</div>
												<div class="col-lg-6 mt-3">
													<select id="product_measure" name="measure">
														<option value="Custom" {{$data->measure == 'Custom' ? 'selected':''}}>{{ __('Custom Measurement') }}</option>
														<option value="Gram" {{$data->measure == 'Gram' ? 'selected':''}}>{{ __('Gram') }}</option>
														<option value="Kilogram" {{$data->measure == 'Kilogram' ? 'selected':''}}>{{ __('Kilogram') }}</option>
														<option value="Litre" {{$data->measure == 'Litre' ? 'selected':''}}>{{ __('Litre') }}</option>
														<option value="Pound" {{$data->measure == 'Pound' ? 'selected':''}}>{{ __('Pound') }}</option>
														<option value="Pair" {{$data->measure == 'Pair' ? 'selected':''}}>{{ __('Pair') }}</option>
														<option value="">{{ __('Nothing') }}</option>
													</select>
												</div> 
												<div class="col-lg-6 mt-3 " id="measure">
													<input name="unit_measurement" type="text" id="measurement" class="input-field" placeholder="{{ __('Unit of Measurement') }}">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- quantity price -->
								<div class="col-lg-12">
									<div class="row  mb-0">
										<div class="offset-lg-1 col-lg-2">

											<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="whole_check">{{ __('Quantity Price (CNY)') }}</h4>

										</div>

										

										<div class="col-lg-9 size-area" id="whole-section">
                                        @if(!empty($data->whole_sell_qty))
                                            @foreach($data->whole_sell_qty as $key => $wh1)
											<div class="row px-3">
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_qty[]" value="{{ $data->whole_sell_qty[$key] }}" class="input-field" placeholder="MOQ(Unit) - 1-10">
												</div>
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_discount[]" value="{{ $data->whole_sell_discount[$key] }}" class="input-field" placeholder="Price(Unit) - 2.09" />
												</div>
												<span class="input-group-text whole-remove text-danger" id="basic-addon2"><i class="fas fa-times"></i></span>

											</div>
                                            @endforeach
											@else
											<div class="row px-3">
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_qty[]" value="" class="input-field" placeholder="MOQ(Unit) - 1-10">
												</div>
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_discount[]" value="" class="input-field" placeholder="Price(Unit) - 2.09" />
												</div>
												<span class="input-group-text whole-remove text-danger" id="basic-addon2"><i class="fas fa-times"></i></span>

											</div>
                                            @endif

										</div>



									</div>
									<div class="col-lg-12 mt-3">
										<a href="javascript:;" id="whole-btn" class="add-fild-btn float-right position-relative add-more rounded-pill"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>

									</div>


								</div>

								<!-- color altered from quantity -->
								<div class="col-lg-12">
									<div class="row  mb-0 mt-3">
										<div class="offset-lg-1 col-lg-2">
											<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="whole_check">{{ __('Product Colors') }}</h4>

											<!-- <label for="whole_check">{{ __('Product Colors')	 }}</label> -->
										</div>


										<div class="col-lg-9 size-area" id="color-section">
                                        @if(!empty($data->color))
                                            @foreach($data->color as $key => $wh1)
											<div class="row px-3 ">
												<div class="col-md-4 col-sm-6 select-input-color cp mb-0">
													<div class="input-group-prepend ">
														<button class="btn btn-outline-secondary input-group-addon new-addon new-colors" type="button" id="new_one_colors"><span class="fa fa-angle-down"></span></button>
														<input type="text" name="color[]" value="{{ $data->color[$key] }}" class="input-field cp text-center form-control" />

													</div>


												</div>

												<div class="col-md-4 col-sm-6">
													<div class="input-group">
														<input name="add_photo[]" type="file" class="input-field  form-control" value="{{ $data->add_photo[$key] }}" placeholder="{{ __('Add Photo') }}">

													</div>

												</div>

												<span class="input-group-text color-remove text-danger" style="height: 45px;"><i class="fas fa-times"></i></span>

											</div>
                                            @endforeach
											@else
											<div class="row px-3 ">
												<div class="col-md-4 col-sm-6 select-input-color cp mb-0">
													<div class="input-group-prepend ">
														<button class="btn btn-outline-secondary input-group-addon new-addon new-colors" type="button" id="new_one_colors"><span class="fa fa-angle-down"></span></button>
														<input type="text" name="color[]" value="" class="input-field cp text-center form-control" />

													</div>


												</div>

												<div class="col-md-4 col-sm-6">
													<div class="input-group">
														<input name="add_photo[]" type="file" class="input-field  form-control" value="" placeholder="{{ __('Add Photo') }}">

													</div>

												</div>

												<span class="input-group-text color-remove text-danger" style="height: 45px;"><i class="fas fa-times"></i></span>

											</div>
                                            @endif

										</div>



									</div>
									<div class="col-lg-12 mt-3">
										<a href="javascript:;" id="color-btn" class="add-fild-btn float-right position-relative add-more rounded-pill"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>

									</div>


								</div>

								<!-- product type -->
								<div class="col-lg-12">
									<div class="row  mb-0 mt-3">
										<div class="offset-lg-1 col-lg-2">
											<!-- <label for="size-check">{{ __('Product Type') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Product Type') }}</h4>

										</div>
										<div class="col-lg-9 px-3" id="size-display">
											<div class="product-size-details pb-3" id="size-section">
                                            @if(!empty($data->size))
                                            @foreach($data->size as $key => $wh1)
												<div class="size-area">
													<div class="row px-3">

														<div class="input-group">
															<input type="text" name="size[]" value="{{ $data->size[$key] }}" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Name (eg. S,M,L,XL,XXL,3XL,4XL)">

															<input type="number" name="size_qty[]" value="{{ $data->size_qty[$key] }}" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Quantity - 1" min="1">

															<input type="number" name="size_price[]" value="{{ $data->size_price[$key] }}" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Price - eg. 02.20" min="0">

															<span class="input-group-text size-remove text-danger"><i class="fas fa-times"></i></span>

														</div>

													</div>
												</div>
                                                @endforeach
												@else
												<div class="size-area">
													<div class="row px-3">

														<div class="input-group">
															<input type="text" name="size[]" value="" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Name (eg. S,M,L,XL,XXL,3XL,4XL)">

															<input type="number" name="size_qty[]" value="" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Quantity - 1" min="1">

															<input type="number" name="size_price[]" value="" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Price - eg. 02.20" min="0">

															<span class="input-group-text size-remove text-danger"><i class="fas fa-times"></i></span>

														</div>

													</div>
												</div>
                                                @endif
											</div>
										</div>

									</div>

									<div class="col-lg-12">
										<a href="javascript:;" id="size-btn" class="add-more float-right position-relative rounded-pill "><i class="fas fa-plus"></i>Add More Fields </a>

									</div>

								</div>


								<!-- weight and dimensions -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<!-- <label for="size-check">{{ __('Package Weight and Dimensions') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Package Weight and Dimensions') }}</h4>

										</div>
										<div class="col-lg-9">
											<div class="product-size-details pb-3" id="package-section">
                                            
												<div class="size-area">
													<!-- <span class="remove package-remove"><i class="fas fa-times"></i></span> -->
													<div class="row">
														<div class="col-md-3 col-sm-4">
															<label>
																Package Weight :
															</label>
															
															<div class="input-group mb-3">
																<input type="text" name="weight[]" value="{{ $data->weight }}" style="padding: 12px 15px;" placeholder="Weight" class="form-control" />

																<div class="input-group-append">
																	<span class="input-group-text">Kg</span>
																</div>
															</div>
														</div>
														<div class="col-md-7 col-sm-4">
															<label>
																Package Dimenisions - L × W × H

															</label>
															<div class="row  px-3">
																<div class="input-group">
																	<input type="text" name="length[]" value="{{ $data->length }}" class="form-control" style="padding: 12px 15px;" placeholder="Length">
																	<input type="text" name="width[]" value="{{ $data->width }}" class="form-control" style="padding: 12px 15px;" placeholder="Width" />
																	<input type="text" name="height[]" value="{{ $data->height }}" class="form-control" style="padding: 12px 15px;" placeholder="Height" />

																</div>
																<!-- <div class="col-md-4">
																			<input type="text" name="length[]" class="input-field" placeholder="Length">
																		</div>
																		<div class="col-md-4">
																			<input type="text" name="width[]" class="input-field" placeholder="Width" />
																		</div>
																		<div class="col-md-4">
																			<input type="text" name="height[]" class="input-field" placeholder="Height" />
																		</div> -->
															</div>
														</div>
														<div class="col-md-3 col-sm-4">
															<label>
																Cubic Meters (m³)

															</label>
															<!-- <div class="select-input-color">
																<div class="color-area">
																	<div class="input-group">
																		<input type="number" name="cubic_meter[]" class="input-field" placeholder="Cubic Meters (m³)" value="" min="0">
																		<span class="input-group-addon"><i>m³</i></span>
																	</div>
																</div>
															</div> -->
															<div class="input-group mb-3">
																<input type="number" name="cubic_meter[]" value="{{ $data->cubic_meter }}" style="padding: 12px 15px;" class="form-control" placeholder="Cubic Meters (m³)" value="" min="0">

																<div class="input-group-append">
																	<span class="input-group-text">m³</span>
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>
											<!-- <a href="javascript:;" id="package-weight-btn" class="add-more float-right position-relative" style="left:15px;"><i class="fas fa-plus"></i>Add More Fields
												</a> -->
										</div>
									</div>
								</div>




								<!-- estimated shipping time -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<!-- <label for="check1">{{ __('Estimated Shipping Time') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Estimated Shipping Time') }}</label>

										</div>
										<div class="col-lg-4 p-0 ml-3">
											<div class="row">
												<div class="col-lg-12 d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('Product Estimated Shipping Time') }}* </h4>
													</div>
												</div>
												<div class="col-lg-12">
													<input type="text" class="input-field" placeholder="{{ __('Estimated Shipping Time') }}" value="{{ $data->ship }}" name="ship">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="add-product-content my-4 product-desc">
					<div class="product-description">
						<div class="basic-info pt-4 px-4">
							<h4>Trade Information</h4>
						</div>
						<div class="body-area">
							<div class="row inline-flex">
								<!-- <div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
													<input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1">
													<label for="allowProductMeasurement">{{ __('FOB Port') }}</label>
													<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="allowProductMeasurement">{{ __('FOB Port') }}</h4>
												</div>
											</div>
										</div>
										<div class="col-lg-9">

											<div class="row">
												<div class="d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('FOB Port') }}*</h4>
													</div>
												</div>
												<div class="col-lg-6 mt-3">
													<input name="fob_port" type="text" value="{{ $data->fob_port }}" class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
												<div class="col-lg-6 mt-3 hidden">
													<input name="fob_port_unit" type="text" class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
											</div>
										</div>
									</div>
								</div> -->

								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="allowProductMinimumQuantity">{{ __('Payment Terms') }}</h4>
											<!-- <label for="allowProductMinimumQuantity">{{ __('Payment Terms') }}</label> -->

										</div>
										<div class="col-lg-9 ">
											<div class="row px-3 d-flex">
												<div class="col-lg-4 p-0 ">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" @foreach($data->payment_terms as $key => $pt) @if($data->payment_terms[$key] == 'Cash on Delivery (COD)') {{ 'checked' }} @endif @endforeach value="Cash on Delivery (COD)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Cash on Delivery (COD)') }}</label>
													</div> 
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" @foreach($data->payment_terms as $key => $pt) @if($data->payment_terms[$key] == 'Cash in Advance (CID)') {{ 'checked' }} @endif @endforeach value="Cash in Advance (CID)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Cash in Advance (CID)') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Days After Acceptance (DA)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Days After Acceptance (DA)') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Letter of Credit (L/C)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Letter of Credit (L/C)') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Telegraphic Transfer (T/T)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Telegraphic Transfer (T/T)') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Western Union" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Western Union') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Other" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Other') }}</label>
													</div>
												</div>
											</div>
										</div>
										<!-- <div class="col-lg-12 py-4">
											<div class="row">
												<div class="offset-lg-1 col-lg-2">
													<div class="left-area">
														<h4 class="heading" style="font-size:1rem; font-weight:400px;">Product Stock*</h4>
													</div>
												</div>
												<div class="col-lg-4 pr-2">
													<input name="stock" value="{{ $data->stock }}" type="text" class="input-field" placeholder="e.g 20">
												</div>
											</div>
										</div> -->
									</div>
								</div>



								<!-- SAMPLE Available Starts -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<!-- <label for="allowProductMinimumQuantity">{{ __('Sample Available') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Sample Available') }}</h4>

										</div>
										<div class="col-lg-4">
											<div class="row px-3 d-flex">
												<div class="col-lg-2">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2 chk" type="checkbox" value="yes" name="sample_check">
														<label for="allowProductMinimumQuantity">{{ __('Yes') }}</label>
													</div>
												</div>
												<div class="col-lg-2">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2 chk" type="checkbox" value="no" name="sample_check">
														<label for="allowProductMinimumQuantity">{{ __('No') }}</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Sample available end -->

								<!-- Simple policy starts  -->
								<div class="col-lg-12 ">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
											<!-- <label for="allowProductMinimumQuantity">{{ __('Simple Policy') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Simple Policy') }}</h4>

										</div>
										<div class="col-lg-8">
											<select id="product_measure" name="simple_policy">
												<option value="Custom">{{ __('Select') }}</option>
												<option value="Free Sample are Available" {{$data->simple_policy == 'Free Sample are Available' ? 'selected':''}}>{{ __('Free Sample are Available') }}</option>
												<option value="Within certain price rang free sample are available" {{$data->simple_policy == 'Within certain price rang free sample are available' ? 'selected':''}} >{{ __('Within certain price rang free sample are available') }}</option>
												<option value="Free Sample available with shipping and tax paid by" {{$data->simple_policy == 'Free Sample available with shipping and tax paid by' ? 'selected':''}} >{{ __('Free Sample available with shipping and tax paid by') }}</option>
												<option value="Sample Costs shipping and taxes have to be paid by the" {{$data->simple_policy == 'Sample Costs shipping and taxes have to be paid by the' ? 'selected':''}} >{{ __('Sample Costs shipping and taxes have to be paid by the') }}</option>
												<option value="If order is confirmed we will reimbuse the sample costs" {{$data->simple_policy == 'If order is confirmed we will reimbuse the sample costs' ? 'selected':''}} >{{ __('If order is confirmed we will reimbuse the sample costs') }}</option>
												<option value="Contact us for information regarding our sample policy" {{$data->simple_policy == 'Contact us for information regarding our sample policy' ? 'selected':''}} >{{ __('Contact us for information regarding our sample policy') }}</option>
											</select>
										</div>
									</div>
								</div>

								<!-- Simple policy end -->

								<!-- Main export market start -->
								<div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
											<!-- <label for="allowProductMinimumQuantity">{{ __('Main Export Market(s)') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Main Export Market(s)') }}</h4>

										</div>
										<div class="col-lg-8">
											<div class="row d-flex">

												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" {{ ($data->export_market[$key] === 'Asia') ? 'checked':''  }} value="Asia" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Asia') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="Central Asia" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Central Asia') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="South America" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('South America') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="Western Europe" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Western Europe') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="Africa" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Africa') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="Australia" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Australia') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="North America" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('North America') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="East Europe" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('East Europe') }}</label>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" form-check mr-2" type="checkbox" value="Middle East" name="export_market[]">
														<label for="allowProductMinimumQuantity">{{ __('Middle East') }}</label>
													</div>
												</div>
											</div>
										</div>



									</div>
								</div>

								<!-- Main Export ends -->


								<!-- Pckage details start -->
								<div class="col-lg-12">
									<div class="row d-flex">
										<div class="offset-lg-1 col-lg-2">
											<!-- <label for="allowProductMinimumQuantity">{{ __('Package Details') }}</label> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;">{{ __('Package Details') }}</label>

										</div>

										<div class="col-lg-9 col-md-9 col-9 col-sm-12">
											<!-- <div class="text-editor"> -->
												<textarea class="form-control" id="summernote" placeholder="Meta Description" name="policy"></textarea>
											<!-- </div> -->
										</div>
									</div>
								</div>




								<div class="col-sm-12">
									<center>
										<input type="submit" class="btn btn-info center position-relative add-more rounded-pill" name="form_submit" value="Add Product">

									</center>
								</div>

								<!-- Packagr Details end		 -->
							</div>
						</div>
					</div>
					<!-------ends edited----->

				</div>
			</div>
        </form>
    </div>

    <div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="top-area">
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                <div class="upload-img-btn">
                                    <form  method="POST" enctype="multipart/form-data" id="form-gallery">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="pid" name="product_id" value="">
                                        <input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="file_extension|video/*|image/*|media_type" multiple>
                                        <label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="javascript:void(0);" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
                            </div>
                            <div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
                        </div>
                    </div>
                    <div class="gallery-images">
                        <div class="selected-image">
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>
  $('textarea#summernote').summernote({
	placeholder: '',
	tabsize: 2,
	height: 500,
	toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
		['fontname', ['fontname']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['style','ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],
		['insert', ['link', 'picture', 'hr']],
		['view', ['fullscreen', 'codeview']],
		['help', ['help']]
	],
  });
  $('.dropdown-toggle').dropdown();
</script>	
@endsection

@section('scripts')

    <script type="text/javascript">

        // Gallery Section Update

        $(document).on("click", ".set-gallery" , function(){
            var pid = $(this).find('input[type=hidden]').val();
            $('#pid').val(pid);
            $('.selected-image .row').html('');
            $.ajax({
                type: "GET",
                url:"{{ route('admin-gallery-show') }}",
                data:{id:pid},
                success:function(data){
                    if(data[0] == 0)
                    {
                        $('.selected-image .row').addClass('justify-content-center');
                        $('.selected-image .row').html('<h3>{{ __('No Images Found.') }}</h3>');
                    }
                    else {
                        $('.selected-image .row').removeClass('justify-content-center');
                        $('.selected-image .row h3').remove();
                        var arr = $.map(data[1], function(el) {
                            return el });

                        for(var k in arr)
                        {
                            if(arr[k]['type'] == 'image'){
                                $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                    '<span class="remove-img"><i class="fas fa-times"></i>'+
                                    '<input type="hidden" value="'+arr[k]['id']+'">'+
                                    '</span>'+
                                    '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                    '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                    '</a>'+
                                    '</div>'+
                                    '</div>');
                            }
                            if(arr[k]['type'] == 'video'){
                                $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                    '<span class="remove-img"><i class="fas fa-times"></i>'+
                                    '<input type="hidden" value="'+arr[k]['id']+'">'+
                                    '</span>'+
                                    '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                    ' <video width="320" height="350" controls><source src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" type="video/mp4">Your browser does not support the video tag.</video> '+
                                    '</a>'+
                                    '</div>'+
                                    '</div>');
                            }
                        }
                    }

                }
            });
        });


        $(document).on('click', '.remove-img' ,function() {
            var id = $(this).find('input[type=hidden]').val();
            $(this).parent().parent().remove();
            $.ajax({
                type: "GET",
                url:"{{ route('admin-gallery-delete') }}",
                data:{id:id}
            });
        });

        $(document).on('click', '#prod_gallery' ,function() {
            $('#uploadgallery').click();
        });


        $("#uploadgallery").change(function(){
            $("#form-gallery").submit();
        });

        $(document).on('submit', '#form-gallery' ,function() {
            $.ajax({
                url:"{{ route('admin-gallery-store') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data != 0)
                    {
                        $('.selected-image .row').removeClass('justify-content-center');
                        $('.selected-image .row h3').remove();
                        var arr = $.map(data, function(el) {
                            return el });
                        for(var k in arr)
                        {
                            if(arr[k]['type'] == 'image'){
                                $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                    '<span class="remove-img"><i class="fas fa-times"></i>'+
                                    '<input type="hidden" value="'+arr[k]['id']+'">'+
                                    '</span>'+
                                    '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                    '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                    '</a>'+
                                    '</div>'+
                                    '</div>');
                            }
                            if(arr[k]['type'] == 'video'){
                                $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                    '<span class="remove-img"><i class="fas fa-times"></i>'+
                                    '<input type="hidden" value="'+arr[k]['id']+'">'+
                                    '</span>'+
                                    '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                    ' <video width="320" height="350" controls><source src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" type="video/mp4">Your browser does not support the video tag.</video> '+
                                    '</a>'+
                                    '</div>'+
                                    '</div>');
                            }

                        }
                    }

                }

            });
            return false;
        });


        // Gallery Section Update Ends

    </script>

    <script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

    <script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

    <script type="text/javascript">

        $('.cropme').simpleCropper();
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
			$(".chk").change(function() {
		$(".chk").prop('checked', false);
		$(this).prop('checked', true);
	});

            let html = `<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/'.$data->photo) }}" alt="">`;
            $(".span4.cropme").html(html);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


        $('.ok').on('click', function () {

            setTimeout(
                function() {


                    var img = $('#feature_photo').val();

                    $.ajax({
                        url: "{{route('admin-prod-upload-update',$data->id)}}",
                        type: "POST",
                        data: {"image":img},
                        success: function (data) {
                            if (data.status) {
                                $('#feature_photo').val(data.file_name);
                            }
                            if ((data.errors)) {
                                for(var error in data.errors)
                                {
                                    $.notify(data.errors[error], "danger");
                                }
                            }
                        }
                    });

                }, 1000);



        });

    </script>

    <script type="text/javascript">

        $('#imageSource').on('change', function () {
            var file = this.value;
            if (file == "file"){
                $('#f-file').show();
                $('#f-link').hide();
            }
            if (file == "link"){
                $('#f-file').hide();
                $('#f-link').show();
            }
        });

    </script>

    <script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection

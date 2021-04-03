@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Add Product') }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Products') }} </a>
					</li>
					<li>
						<a href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a>
					</li>
					<li>
						<a href="{{ route('admin-prod-types') }}">{{ __('Add Product') }}</a>
					</li>
					<li>
						<a href="{{ route('admin-prod-physical-create') }}">{{ __('Product') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="yiwuform" action="{{route('admin-prod-store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
		{{csrf_field()}}
		<div class="row">
			<div class="col-lg-12">
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
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="left-area text-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Product Name') }} </h4>
												<p class="sub-heading">{{ __('(In Any Language)') }}</p>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product_name">
												<input type="text" class="input-field" placeholder="{{ __('Enter Product Name') }}" name="name" required>
											</div>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="left-area text-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Product Sku') }} </h4>

											</div>
										</div>	
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="product_name">
												<input type="text" class="input-field" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ str_random(3).substr(time(), 6,8).str_random(3) }}">

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
													<h4 class="heading"><span class="label-star">*</span>{{ __('Product Condition') }} </h4>

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
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="left-area float-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Category') }} </h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="cat" name="category_id" required="">
													<option value="">{{ __('Select Category') }}</option>
													@foreach($cats as $cat)
													<option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="left-area float-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Sub Category') }} </h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="subcat" name="subcategory_id" disabled="">
													<option value="">{{ __('Select Sub Category') }}</option>
												</select>
											</div>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-4 col-md-4 col-12 col-sm-6">
											<div class="left-area float-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Child Category') }} </h4>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-12 col-sm-6">
											<div class="product-option w-50">
												<select id="childcat" name="childcategory_id" disabled="">
													<option value="">{{ __('Select Child Category') }}</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row text-center">
										<div class="col-lg-6 col-md-12">
											<div class="checkbox-wrapper">
												<!-- <input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" value="1"> -->
												<label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
											</div>
										</div>
									</div>



									<div >
										<div class="row form-group">
											<div class="col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="left-area text-right">
													<h4 class="heading"><span class="label-star">*</span>{{ __('Meta Tags') }} </h4>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-12 col-sm-12">
												<div class="meta-tagss">
													<ul id="metatags" class="myTags">
													</ul>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="left-area text-right">
													<h4 class="heading"><span class="label-star">*</span>{{ __('Meta Description') }} </h4>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-12 col-sm-12">
												<div class="text-editor">
													<textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-12 col-12">
											<div class="left-area text-right">
												<h4 class="heading"><span class="label-star">*</span>{{ __('Video URL') }} </h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="video_url">
												<input name="youtube" type="text" class="input-field" placeholder="{{ __('Video URL') }}">
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

									<!--
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Product Current Price') }}*
													</h4>
													<p class="sub-heading">
														({{ __('In') }} {{$sign->name}})
													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="price" type="number" class="input-field"
													   placeholder="{{ __('e.g 20') }}" step="0.01" required="" min="0">
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Previous Price') }}*</h4>
													<p class="sub-heading">{{ __('(Optional)') }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="previous_price" step="0.01" type="number" class="input-field"
													   placeholder="{{ __('e.g 20') }}" min="0">
											</div>
										</div>
-->
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
							<h4>Product Description</h4>
						</div>
						<div class="body-area">
							<div class="row form-group">
								<div class="col-lg-4 col-md-4 col-12 col-sm-12">
									<div class="left-area text-right">
										<h4 class="heading"><span class="label-star">*</span>{{ __('Product Photo') }} </h4>
									</div>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-lg-2 col-md-2 ">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="width: 120px; min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-md-2" >
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="width: 120px; min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 ">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="width: 120px;  min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-md-2 ">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="width: 120px;  min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-md-2">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style="width: 120px;  min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
											<!-- <a href="javascript:;" id="crop-image" class=" mybtn1" style="">
											<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
											</a> -->
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-md-2">
									<div class="panel panel-body">
										<div class="span4 cropme text-center" id="landscape" style=" width: 120px; min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
										<a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
													<i class="icofont-plus"></i> {{ __('Set Gallery') }}
												</a>
										</div>
									</div>
								</div>
							</div>

							<input type="hidden" id="feature_photo" name="photo" value="">

										<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*"
											   multiple>

										<div class="row mb-4">
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
										</div>

							<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>


							<div class="row form-group">
								<div class="col-lg-4 col-sm-12 col-md-4 col-12 d-none">
									<div class="left-area text-right">
										<h4 class="heading"><span class="label-star">*</span>{{ __('Product Description') }} </h4>

									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-12 col-sm-12">
									<textarea class="form-control" id="summernote" placeholder="Enter the Description" name="details"></textarea>
									<!--
													<textarea class="nic-edit-p" name="details"></textarea>
-->
								</div>
							</div>



							<div class="row form-group">
								<div class="col-lg-12 col-sm-12 col-md-12 col-12 text-center">
									<div class="left-area">
										<h4 class="heading"><span class="label-star">*</span>{{ __('Product Buy/Return Policy') }} </h4>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-12 col-sm-12">
									<div class="text-editor">
										<textarea class="form-control" id="summernote" placeholder="Product Buy/Return Policy" name="policy"></textarea>
										<!--
													<textarea class="nic-edit-p" name="policy"></textarea>
-->
									</div>
								</div>
							</div>
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
								
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
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
										<div class="col-lg-12 py-4">
											<div class="row">
												<div class="col-lg-3">
													<div class="left-area">
														<h4 class="heading" style="font-size:1rem; font-weight:400px;">Product Inventory</h4>
													</div>
												</div>
												<div class="col-lg-4 pr-2">
													<input name="pro_inventory" type="text" class="input-field" placeholder="e.g 20">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1"> -->
													<label for="allowProductMeasurement">{{ __('Unit of Measurement') }}</label>
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
													    <option value="Custom">{{ __('Custom Measurement') }}</option>
														<option value="Gram">{{ __('Gram') }}</option>
														<option value="Kilogram">{{ __('Kilogram') }}</option>
														<option value="Litre">{{ __('Litre') }}</option>
														<option value="Pound">{{ __('Pound') }}</option>
														<option value="Pair">{{ __('Pair') }}</option>
														<option value="">{{ __('Nothing') }}</option>
													</select>
												</div>
												<div class="col-lg-6 mt-3 " id="measure">
													<input name="unit_measurement" type="text" id="measurement" class="input-field" placeholder="{{ __('Unit of Measurement') }}" >
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3 mr-4">
											<div class="col-lg-12 p-0">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12 p-0">
												<div class="col-lg-4">
													<ul class="list">
														<li>
															<!-- <input class="checkclick1" name="whole_check" type="checkbox" id="whole_check" value="1"> -->
															<label for="whole_check">{{ __('Quantity Price (CNY)') }}</label>
														</li>
													</ul>
												</div>
											</div>
										</div>

										<div >
											<div class="row">
												
												<div class="col-lg-8">
													<div class="featured-keyword-area">
														<div class="feature-tag-top-filds" id="whole-section">
															<!-- <div class="feature-area"> -->
															<span class="remove whole-remove"><i class="fas fa-times"></i></span>
																<div class="row">
																	<div class="col-lg-3 ">
																		<input type="text" name="whole_sell_qty[]" class="input-field" placeholder="MOQ(Unit) - 1-10">
																	</div>

																	<div class="col-lg-3">
																		<input type="text" name="whole_sell_discount[]" class="input-field" placeholder="Price(Unit) - 2.09" />
																	</div>
																<!-- </div> -->
															</div>
														</div>	
													</div>
												</div>

												<div class="col-lg-2">
													<a href="javascript:;" id="whole-btn" class="add-fild-btn add-more rounded"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- <div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12 p-0">
												<ul class="list">
													<li>
														<input class="checkclick1" name="color_check" type="checkbox" id="check3" value="1">
														<label for="check3">{{ __('Allow Product Colors') }}</label>
													</li>
												</ul>
											</div>
										</div>

										<div class="showbox col-lg-8" style="margin-left: 13px;">

											<div class="row">
												<div class="col-lg-8 p-0">
													<div class="col-lg-12 p-0 d-none ">
														<div class="left-area">
															<h4 class="heading">
																{{ __('Product Colors') }}*
															</h4>
															<p class="sub-heading">
																{{ __('(Choose Your Favorite Colors)') }}
															</p>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="select-input-color">
															<div class="color-area">
																<div class="input-group colorpicker-component">
																	<input type="text" name="inputcolor[]" value="#000000" class="input-field" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>

													</div>
													<div class="col-lg-4 p-0">
														<div class="select-input-color" id="color-section">
															<div class="color-area">
																<span class="remove color-remove"><i class="fas fa-times"></i></span>
																<div class="input-group colorpicker-component cp">
																	<input type="text" name="color[]" value="#000000" class="input-field cp" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>

													</div>
												</div>
												<div class="col-lg-4">
													<a href="javascript:;" id="color-btn" class="add-more m-0"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>
												</div>
											</div>

										</div>
									</div>
								</div> -->

								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1"> -->
													<label for="allowProductMeasurement">{{ __('Product Colors') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">

											<div class="row">
												<div class="d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('Product Colors') }}*</h4>
													</div>
												</div>
												<div class="row" id="color-section">
												<div class="col-lg-6 mt-3">
														<div class="select-input-color">
															<div class="color-area">
																<span class="remove color-remove"><i class="fas fa-times"></i></span>
																<div class="input-group colorpicker-component cp">
																<!-- <span class="fa fa-angle-down"></span> -->
																<span class="input-group-addon new-addon new-colors" id="new_one_colors"><i></i></span>
																
																	<input type="text" name="color[]" value="#ffcb48" class="input-field cp text-center" />
																	<span class="input-group-text" ><i class="fa fa-angle-down"></i></span>
																</div>
															</div> 
														</div>

													</div>
													<div class="col-lg-4 mt-3">
													<input name="add_photo" type="text" class="input-field" placeholder="{{ __('Add Photo') }}">
													</div>
													</div>
													<div class="col-lg-2 mt-3">
													<a href="javascript:;" id="color-btn" class="add-more m-0 rounded"><i class="fas fa-plus"></i>{{ __('Add More Fields') }} </a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12 p-0">
												<ul class="list">
													<li>
														<!-- <input name="size_check" type="checkbox" id="size-check" value="1"> -->
														<label for="size-check">{{ __('Product Type') }}</label>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-lg-9 p-0" id="size-display">
											<div class="col-lg-11">
												<div class="">
												</div>
												<div class="">
													<div class="product-size-details pb-3" id="size-section">
														<div class="size-area">
															<span class="remove size-remove"><i class="fas fa-times"></i></span>
															<div class="row px-3">
																<div class="col-md-4 col-sm-6">
																	<!-- <label>
																		Size Name :
																		<span>
																			(eg. S,M,L,XL,XXL,3XL,4XL)
																		</span>
																	</label> -->
																	<input type="text" name="size[]" class="input-field" placeholder="Name">
																</div>
																<div class="col-md-4 col-sm-6">
																	<!-- <label>
																		Size Qty :
																		<span>
																			(Number of quantity of this size)
																		</span>
																	</label> -->
																	<input type="number" name="size_qty[]" class="input-field" placeholder="Quantity - 1" value="Price - eg. 02.20" min="1">
																</div>
																<div class="col-md-4 col-sm-6">
																	<!-- <label>
																		Size Price :
																		<span>
																			(This price will be added with base price)
																		</span>
																	</label> -->
																	<input type="number" name="size_price[]" class="input-field" placeholder="Price - eg. 02.20" value="Price - eg. 02.20" min="0">
																</div>
															</div>
														</div>
													</div>

													<a href="javascript:;" id="size-btn" class="add-more float-right position-relative rounded" style="left:15px;"><i class="fas fa-plus"></i>Add More Fields </a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<!-- <div class="row"> -->
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12 p-0">
												<ul class="list">
													<li>
														<!-- <input name="size_check" type="checkbox" id="size-check" value="1"> -->
														<label for="size-check">{{ __('Package Weight and Dimensions') }}</label>
													</li>
												</ul>
											</div>
											
										</div>
										<div class="col-lg-12 p-0" >
											<div class="col-lg-12">
												
												<div class="">
													<div class="product-size-details pb-3" id="package-section">
														<div class="size-area">
															<span class="remove package-remove"><i class="fas fa-times"></i></span>
															<div class="row px-3">
																<div class="col-md-4 col-sm-4">
																		<label>
																			Package Weight :
																		</label>
																	<div class="select-input-color">
																		<div class="color-area">
																			<div class="input-group">
																				<input type="text" name="weight[]" value="" placeholder="Weight" class="input-field" />
																				<span class="input-group-addon"><i>Kg</i></span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-8 col-sm-4">
																	<label>
																		Package Dimenisions - L × W × H
																	
																	</label>
																<div class="row">
																	<div class="col-md-4">
																		<input type="text" name="length[]" class="input-field" placeholder="Length">
																	</div>
																	<div class="col-md-4">
																		<input type="text" name="width[]" class="input-field" placeholder="Width" />
																	</div>
																	<div class="col-md-4">
																		<input type="text" name="height[]" class="input-field" placeholder="Height" />
																	</div>
																</div>
																</div>
																<div class="col-md-4 col-sm-4">
																	<label>
																		Cubic Meters (m³)
																		
																	</label>
																	<div class="select-input-color">
																		<div class="color-area">
																			<div class="input-group">
																	<input type="number" name="cubic_meter[]" class="input-field" placeholder="Cubic Meters (m³)" value="" min="0">
																	<span class="input-group-addon"><i>m³</i></span>
																</div>
																</div>
																</div>
																</div>
															</div>
														</div>
													</div>
													<a href="javascript:;" id="package-weight-btn" class="add-more float-right position-relative" style="left:15px;"><i class="fas fa-plus"></i>Add More Fields
													 </a>
												</div>
											</div>
										</div>
									<!-- </div> -->
								</div>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3 p-0">
											<div class="col-lg-12 p-0">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12 p-0">
												<ul class="list px-3">
													<li>
														<!-- <input class="checkclick1" name="shipping_time_check" type="checkbox" id="check1" value="1"> -->
														<label for="check1">{{ __('Estimated Shipping Time') }}</label>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-lg-4 p-0 ml-3">
											<div class="row">
												<div class="col-lg-12 d-none">
													<div class="left-area">
														<h4 class="heading">{{ __('Product Estimated Shipping Time') }}* </h4>
													</div>
												</div>
												<div class="col-lg-12">
													<input type="text" class="input-field" placeholder="{{ __('Estimated Shipping Time') }}" name="ship">
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
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="measure_check" class="checkclick" id="allowProductMeasurement" value="1"> -->
													<label for="allowProductMeasurement">{{ __('FOB Port') }}</label>
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
												<input name="fob_port" type="text"  class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
												<div class="col-lg-6 mt-3 hidden">
													<input name="fob_port_unit" type="text" class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
													<label for="allowProductMinimumQuantity">{{ __('Payment Terms') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-9">
											<div class="row d-flex">											
													<div class="col-lg-4 p-0 ">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class="form-check mr-1"  type="checkbox" value="Cash on Delivery (COD)" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Cash on Delivery (COD)') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Cash in Advance (CID)" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Cash in Advance (CID)') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Days After Acceptance (DA)" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Days After Acceptance (DA)') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Letter of Credit (L/C)" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Letter of Credit (L/C)') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Telegraphic Transfer (T/T)" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Telegraphic Transfer (T/T)') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Western Union" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Western Union') }}</label>
														</div>
													</div>
													<div class="col-lg-4 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Other" name="payment_terms[]">
															<label for="allowProductMinimumQuantity">{{ __('Other') }}</label>
														</div>
													</div>	
											</div>
										</div>
										<div class="col-lg-12 py-4">
											<div class="row">
												<div class="col-lg-3">
													<div class="left-area">
														<h4 class="heading" style="font-size:1rem; font-weight:400px;">Product Stock*</h4>
													</div>
												</div>
												<div class="col-lg-4 pr-2">
													<input name="stock" type="text" class="input-field" placeholder="e.g 20">
												</div>
											</div>
										</div>
									</div>
								</div>


								
<!-- Supply ability start -->
								<div class="col-lg-12 ">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
													<label for="allowProductMinimumQuantity">{{ __('Supply Ability') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="row">
												<div class="col-lg-6 mt-3 " id="measure">
													<input name="supply_ability" type="text" id="measurement" class="input-field" placeholder="{{ __('Enter Supply Ability') }}" >
												</div>
												<div class="col-lg-6 mt-3">
														<select id="product_measure" name="supply_ability_options">
															<option value="Custom">{{ __('Select Unit') }}</option>
															<option value="Gram">{{ __('Gram') }}</option>
															<option value="Kilogram">{{ __('Kilogram') }}</option>
															<option value="Litre">{{ __('Litre') }}</option>
															<option value="Pound">{{ __('Pound') }}</option>
															<option value="Pair">{{ __('Pair') }}</option>
															<option value="">{{ __('Nothing') }}</option>
														</select>
												</div>
											</div>
										</div>
									</div>
								</div>
<!-- Supply ability ends -->

<!-- SAMPLE Available Starts -->
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
													<label for="allowProductMinimumQuantity">{{ __('Sample Available') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="row d-flex">
												<div class="col-lg-2 p-0 ">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-1 chk"  type="checkbox" value="yes" name="sample_check">
														<label for="allowProductMinimumQuantity">{{ __('Yes') }}</label>
													</div>
												</div>
												<div class="col-lg-2 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class=" checkclick1 mr-1 chk"  type="checkbox" value="no" name="sample_check">
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
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
													<label for="allowProductMinimumQuantity">{{ __('Simple Policy') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="row">
												<div class="col-lg-6 mt-3">
														<select id="product_measure" name="simple_policy">
															<option value="Custom">{{ __('Select') }}</option>
															<option value="Free Sample are Available">{{ __('Free Sample are Available') }}</option>
															<option value="Within certain price rang free sample are available">{{ __('Within certain price rang free sample are available') }}</option>
															<option value="Free Sample available with shipping and tax paid by">{{ __('Free Sample available with shipping and tax paid by') }}</option>
															<option value="Sample Costs shipping and taxes have to be paid by the">{{ __('Sample Costs shipping and taxes have to be paid by the') }}</option>
															<option value="If order is confirmed we will reimbuse the sample costs">{{ __('If order is confirmed we will reimbuse the sample costs') }}</option>
															<option value="Contact us for information regarding our sample policy">{{ __('Contact us for information regarding our sample policy') }}</option>
														</select>
												</div>
											</div>
										</div>
									</div>
								</div>

<!-- Simple policy end -->

<!-- Main export market start -->
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<!-- <input type="checkbox" name="minimum_quantity_check" class="checkclick" id="allowProductMinimumQuantity" value="1"> -->
													<label for="allowProductMinimumQuantity">{{ __('Main Export Market(s)') }}</label>
												</div>
											</div>
										</div>
										<div class="col-lg-9">
											<div class="row d-flex">
																						
													<div class="col-lg-1 p-0 ">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class="form-check mr-1"  type="checkbox" value="Asia" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('Asia') }}</label>
														</div>
													</div>
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Central Asia" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('Central Asia') }}</label>
														</div>
													</div>
													<div class="col-lg-3 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="South America" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('South America') }}</label>
														</div>
													</div>
													<div class="col-lg-3 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Western Europe" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('Western Europe') }}</label>
														</div>
													</div>
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Africa" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('Africa') }}</label>
														</div>
													</div>
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Australia" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('Australia') }}</label>
														</div>
													</div>
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="North America" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('North America') }}</label>
														</div>
													</div>
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="East Europe" name="export_market[]">
															<label for="allowProductMinimumQuantity">{{ __('East Europe') }}</label>
														</div>
													</div>	
													<div class="col-lg-2 p-0">
														<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
															<input class=" checkclick1 mr-1"  type="checkbox" value="Middle East" name="export_market[]">
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
										<div class="col-lg-3">
											<div class="col-lg-12 p-0">
												<div class="checkbox-wrapper">
													<label for="allowProductMinimumQuantity">{{ __('Package Details') }}</label>
												</div>
											</div>
										</div>

										<div class="col-lg-9 col-md-9 col-9 col-sm-12">
											<div class="text-editor">
												<textarea class="form-control" id="summernote" placeholder="Meta Description" name="package_detail"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">

						<div class="col-sm-6">
							<input type="submit" class="btn btn-info" name="form_submit" value="Submit">
						</div>

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
								<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
						</div>
						<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small>
							)</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">

						

						</div>
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
			['para', ['style', 'ul', 'ol', 'paragraph']],
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

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">
	// Gallery Section Insert

	$(document).on('click', '.remove-img', function() {
		var id = $(this).find('input[type=hidden]').val();
		$('#galval' + id).remove();
		$(this).parent().parent().remove();
	});

	$(document).on('click', '#prod_gallery', function() {
		$('#uploadgallery').click();
		$('.selected-image .row').html('');
		$('#yiwuform').find('.removegal').val(0);
	});
	$(".chk").change(function() {
    $(".chk").prop('checked', false);
    $(this).prop('checked', true);
});


	$("#uploadgallery").change(function() {
		var total_file = document.getElementById("uploadgallery").files.length;
		for (var i = 0; i < total_file; i++) {
			$('.selected-image .row').append('<div class="col-sm-6">' +
				'<div class="img gallery-img">' +
				'<span class="remove-img"><i class="fas fa-times"></i>' +
				'<input type="hidden" value="' + i + '">' +
				'</span>' +
				'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
				'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
				'</a>' +
				'</div>' +
				'</div> '
			);
			$('#yiwuform').append('<input type="hidden" name="galval[]" id="galval' + i +
				'" class="removegal" value="' + i + '">')
		}

	});

	// Gallery Section Insert Ends
</script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
</script>


<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
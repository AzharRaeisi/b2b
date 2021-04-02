@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area" data-spy="scroll" data-target=".navbar" data-offset="50">
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

	<form id="yiwuform" action="{{route('admin-prod-store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" data-spy="scroll" data-target="#myScrollspy" data-offset="20">
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
												<input type="text" class="input-field" placeholder="{{ __('Enter Product Name') }}" name="name" required="">
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
													<option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
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
													<textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea>
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


									<!-- <div class="row">
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
										</div> -->




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
							<h4 id="productDescription">Product Description</h4>
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
										<div class="span4 cropme text-center" id="landscape" style="overflow-y: hidden; min-height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">
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
											<a href="#" class=" my-auto" data-toggle="modal" data-target="#setgallery">
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

							<input type="hidden" id="feature_photo" name="photo" value="">

							<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>

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
									<textarea class="form-control" id="summernote" placeholder="Enter the Description" name="details"></textarea>


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
										<textarea class="form-control" id="summernote" placeholder="Product Buy/Return Policy" name="policy"></textarea>


									</div>
								</div>
							</div> -->
						</div>
					</div>
				</div>



				<div class="add-product-content my-4 product-desc">
					<div class="product-description">
						<div class="basic-info pt-4 px-4">
							<h4>Price and Quantity</h4>
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
											<input class="form-control" placeholder="Digit only: 0" style="height:45px;" type="number" value="" name="minimum_quantity">
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

											<!-- <div class="col-lg-12 p-0">
												<div class="col-lg-4">
													<ul class="list">
														<li>
															<input class="checkclick1" name="whole_check" type="checkbox" id="whole_check" value="1">
															<label for="whole_check">{{ __('Quantity Price (CNY)') }}</label>
														</li>
													</ul>
												</div>
											</div> -->
											<h4 class="heading" style="font-size:1rem; font-weight:400px;" for="whole_check">{{ __('Quantity Price (CNY)') }}</h4>

										</div>

										<!-- <div class="col-lg-9">
											<div class="featured-keyword-area">
												<div class="feature-tag-top-filds" id="whole-section">
													<div class="feature-area">
													<span class="remove whole-remove"><i class="fas fa-times"></i></span>
													<div class="row">
														<div class="col-lg-3 ">
															<input type="text" name="whole_sell_qty[]" class="input-field" placeholder="MOQ(Unit) - 1-10">
														</div>

														<div class="col-lg-3">
															<input type="text" name="whole_sell_discount[]" class="input-field" placeholder="Price(Unit) - 2.09" />
														</div>
														</div>
													</div>
												</div>
											</div>
										</div> -->

										<div class="col-lg-9 size-area" id="whole-section">
											<div class="row px-3">
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_qty[]" class="input-field" placeholder="MOQ(Unit) - 1-10">
												</div>
												<div class="col-md-4 col-sm-6">
													<input type="text" name="whole_sell_discount[]" class="input-field" placeholder="Price(Unit) - 2.09" />



												</div>
												<span class="input-group-text whole-remove text-danger" id="basic-addon2"><i class="fas fa-times"></i></span>

											</div>

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
											<div class="row px-3 ">
												<div class="col-md-4 col-sm-6 select-input-color cp mb-0">
													<div class="input-group-prepend ">
														<button class="btn btn-outline-secondary input-group-addon new-addon new-colors" type="button" id="new_one_colors"><span class="fa fa-angle-down"></span></button>
														<input type="text" name="color[]" value="#ffcb48" class="input-field cp text-center form-control" />

													</div>


												</div>

												<div class="col-md-4 col-sm-6">
													<div class="input-group">
														<input name="add_photo" type="file" class="input-field  form-control" placeholder="{{ __('Add Photo') }}">

													</div>

												</div>

												<span class="input-group-text color-remove text-danger" style="height: 45px;"><i class="fas fa-times"></i></span>

											</div>

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
												<div class="size-area">
													<div class="row px-3">

														<div class="input-group">
															<input type="text" name="size[]" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Name (eg. S,M,L,XL,XXL,3XL,4XL)">

															<input type="number" name="size_qty[]" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Quantity - 1" value="Price - eg. 02.20" min="1">

															<input type="number" name="size_price[]" class="form-control col-lg-3" style="padding: 12px 15px;" placeholder="Price - eg. 02.20" value="Price - eg. 02.20" min="0" step=".001">

															<span class="input-group-text size-remove text-danger"><i class="fas fa-times"></i></span>

														</div>

													</div>
												</div>
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
															<!-- <div class="select-input-color">
																<div class="color-area">
																	<div class="input-group">
																		<input type="text" name="wieight[]" value="" placeholder="Weight" class="input-field" />
																		<span class="input-group-addon"><i>Kg</i></span>
																	</div>
																</div>
															</div> -->
															<div class="input-group mb-3">
																<input type="text" name="weight[]" value="" style="padding: 12px 15px;" placeholder="Weight" class="form-control" />

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
																	<input type="text" name="length[]" class="form-control" style="padding: 12px 15px;" placeholder="Length">
																	<input type="text" name="width[]" class="form-control" style="padding: 12px 15px;" placeholder="Width" />
																	<input type="text" name="height[]" class="form-control" style="padding: 12px 15px;" placeholder="Height" />

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
																<input type="number" name="cubic_meter[]" style="padding: 12px 15px;" class="form-control" placeholder="Cubic Meters (m³)" value="" min="0">

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
							<!-- FOB Port Starts -->
								<!-- <div class="col-lg-12">
									<div class="row">
										<div class="offset-lg-1 col-lg-2" id="stckprod2">
											<div class="">
												<div class="checkbox-wrapper">
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
													<input name="fob_port" type="text" class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
												<div class="col-lg-6 mt-3 hidden">
													<input name="fob_port_unit" type="text" class="input-field" placeholder="{{ __('Enter Unit') }}">
												</div>
											</div>
										</div>
									</div>
								</div> -->
							<!-- FOB Port ends -->


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
														<input class="form-check mr-2" type="checkbox" value="Cash on Delivery (COD)" name="payment_terms[]">
														<label for="allowProductMinimumQuantity">{{ __('Cash on Delivery (COD)') }}</label>
													</div>
												</div>
												<div class="col-lg-4 p-0">
													<div class="checkbox-wrapper d-flex align-items-center justify-content-start ">
														<input class="form-check mr-2" type="checkbox" value="Cash in Advance (CID)" name="payment_terms[]">
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
													<input name="stock" type="text" class="input-field" placeholder="e.g 20">
												</div>
											</div>
										</div> -->
									</div>
								</div>


								<!-- Supply ability start -->
								<!-- <div class="col-lg-12 ">
									<div class="row">
										<div class="offset-lg-1 col-lg-2">
											<label for="allowProductMinimumQuantity">{{ __('Supply Ability') }}</label>
										</div>
										<div class="col-lg-8">
											<div class="row">
												<div class="col-lg-6 mt-3 " id="measure">
													<input name="supply_ability" type="text" id="measurement" class="input-field" placeholder="{{ __('Enter Supply Ability') }}">
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
								</div> -->
								<!-- Supply ability ends -->

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
										<div class="col-lg-9">
											<select id="product_measure" name="simple_policy">
												<option value="Custom">{{ __('Select') }}</option>
												<option value="Gram">{{ __('Free Sample are Available') }}</option>
												<option value="Kilogram">{{ __('Within certain price rang free sample are available') }}</option>
												<option value="Litre">{{ __('Free Sample available with shipping and tax paid by') }}</option>
												<option value="Pound">{{ __('Sample Costs shipping and taxes have to be paid by the') }}</option>
												<option value="Pair">{{ __('If order is confirmed we will reimbuse the sample costs') }}</option>
												<option value="">{{ __('Contact us for information regarding our sample policy') }}</option>
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
														<input class="form-check mr-2" type="checkbox" value="Asia" name="export_market[]">
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
											<div class="text-editor">
												<textarea class="form-control" id="summernote" placeholder="Meta Description" name="package_detail"></textarea>
											</div>
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
			if (i < 4) {
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
				$('.show-img-gallery').append(
					'<div class="col-lg-2 col-md-2">' +
					'<div class="panel panel-body">' +
					'<div class="span4 cropme text-center" style="overflow-y: hidden; height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">' +
					'<span class="remove-img  position-absolute px-2 m-1 bg-white rounded-circle"><i class="fas fa-times"></i>' +
					'<input type="hidden" value="' + i + '">' +
					'</span>' +
					'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
					'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image" style="overflow-y: hidden">' +
					'</a>' +
					'</div>' +
					'</div> ' +
					'</div>'
				);
				$('#yiwuform').append('<input type="hidden" name="galval[]" id="galval' + i +
					'" class="removegal" value="' + i + '">')
			} else {

				$('.selected-image .row').append('<div class="col-sm-6">' +
					'<div class="img gallery-img hidden">' +
					'<span class="remove-img"><i class="fas fa-times"></i>' +
					'<input type="hidden" value="' + i + '">' +
					'</span>' +
					'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
					'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
					'</a>' +
					'</div>' +
					'</div> '
				);
				$('.show-img-gallery').append(
					'<div class="col-lg-2 col-md-2 hidden">' +
					'<div class="panel panel-body">' +
					'<div class="span4 cropme text-center" style="height:122px; border: 1px dashed #ddd; background: #f1f1f1;box-shadow: 2px 4px 5px #ddd;">' +
					'<span class="remove-img  position-absolute px-2 m-1 bg-white rounded-circle"><i class="fas fa-times"></i>' +
					'<input type="hidden" value="' + i + '">' +
					'</span>' +
					'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
					'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
					'</a>' +
					'</div>' +
					'</div> ' +
					'</div>'
				);
				$('#yiwuform').append('<input type="hidden" name="galval[]" id="galval' + i +
					'" class="removegal" value="' + i + '">')
			}

		}

	});



	// Gallery Section Insert Ends
</script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
</script>


<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
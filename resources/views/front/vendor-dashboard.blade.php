@extends('layouts.front')
<head>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{asset('assets/front/css/theme.min.css')}}">
</head>
@section('content')
    <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
            <div class="media media-ie-fix align-items-center pb-3">
                <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;"><img class="rounded-circle" src="img/marketplace/account/avatar.png" alt="Createx Studio"></div>
                <div class="media-body pl-3">
                    <h3 class="text-light font-size-lg mb-0">Createx Studio</h3><span class="d-block text-light font-size-ms opacity-60 py-1">Member since November 2017</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="text-sm-right mr-5">
                    <div class="text-light font-size-base">Total sales</div>
                    <h3 class="text-light">426</h3>
                </div>
                <div class="text-sm-right">
                    <div class="text-light font-size-base">Seller rating</div>
                    <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                    </div>
                    <div class="text-light opacity-60 font-size-xs">Based on 98 reviews</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 pb-3">
        <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
            <div class="row">
                <!-- Sidebar-->
                <aside class="col-lg-4">
                    <!-- Account menu toggler (hidden on screens larger 992px)-->
                    <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="czi-menu mr-2"></i>Account menu</a></div>
                    <!-- Actual menu-->
                    <div class="cz-sidebar-static h-100 p-0">
                        <div class="secondary-nav collapse border-right" id="account-menu">
                            <div class="bg-secondary p-4">
                                <h3 class="font-size-sm mb-0 text-muted">Account</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-settings.html"><i class="czi-settings opacity-60 mr-2"></i>Settings</a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-purchases.html"><i class="czi-basket opacity-60 mr-2"></i>Purchases</a></li>
                                <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-favorites.html"><i class="czi-heart opacity-60 mr-2"></i>Favorites<span class="font-size-sm text-muted ml-auto">4</span></a></li>
                            </ul>
                            <div class="bg-secondary p-4">
                                <h3 class="font-size-sm mb-0 text-muted">Seller Dashboard</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-sales.html"><i class="czi-dollar opacity-60 mr-2"></i>Sales<span class="font-size-sm text-muted ml-auto">$1,375.00</span></a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="dashboard-products.html"><i class="czi-package opacity-60 mr-2"></i>Products<span class="font-size-sm text-muted ml-auto">5</span></a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-add-new-product.html"><i class="czi-cloud-upload opacity-60 mr-2"></i>Add New Product</a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-payouts.html"><i class="czi-currency-exchange opacity-60 mr-2"></i>Payouts</a></li>
                                <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html"><i class="czi-sign-out opacity-60 mr-2"></i>Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
                <!-- Content-->
                <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
                    <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
                        <!-- Title-->
                        <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                            <h2 class="h3 py-2 mr-2 text-center text-sm-left">Your products<span class="badge badge-secondary font-size-sm text-body align-middle ml-2">5</span></h2>
                            <div class="py-2">
                                <div class="form-inline flex-nowrap pb-3">
                                    <label class="text-nowrap mr-2" for="sorting">Sort by:</label>
                                    <select class="custom-select custom-select-sm mr-2" id="sorting">
                                        <option>Date Purchased</option>
                                        <option>Product Name</option>
                                        <option>Price</option>
                                        <option>Rating</option>
                                        <option>Updates</option>
                                    </select>
                                    <button class="btn btn-outline-secondary btn-sm px-2" type="button"><i class="czi-arrow-up"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block mb-3 mb-sm-0 mr-sm-4 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg" src="img/marketplace/products/th08.jpg" alt="Product"></a>
                            <div class="media-body text-center text-sm-left">
                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Flat-line E-Commerce Icons (AI)</a></h3>
                                <div class="d-inline-block text-accent">$18.<small>00</small></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Sales: <span class="font-weight-medium">26</span></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Earnings: <span class="font-weight-medium">$327.<small>60</small></span></div>
                                <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                                    <button class="btn bg-faded-accent btn-icon mr-2" type="button" data-toggle="tooltip" title="Download"><i class="czi-download text-accent"></i></button>
                                    <button class="btn bg-faded-info btn-icon mr-2" type="button" data-toggle="tooltip" title="Edit"><i class="czi-edit text-info"></i></button>
                                    <button class="btn bg-faded-danger btn-icon" type="button" data-toggle="tooltip" title="Delete"><i class="czi-trash text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg" src="img/marketplace/products/th09.jpg" alt="Product"></a>
                            <div class="media-body text-center text-sm-left">
                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Square Style Mobile UI Kit (Sketch)</a></h3>
                                <div class="d-inline-block text-accent">$24.<small>00</small></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Sales: <span class="font-weight-medium">153</span></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Earnings: <span class="font-weight-medium">$2,570.<small>40</small></span></div>
                                <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                                    <button class="btn bg-faded-accent btn-icon mr-2" type="button" data-toggle="tooltip" title="Download"><i class="czi-download text-accent"></i></button>
                                    <button class="btn bg-faded-info btn-icon mr-2" type="button" data-toggle="tooltip" title="Edit"><i class="czi-edit text-info"></i></button>
                                    <button class="btn bg-faded-danger btn-icon" type="button" data-toggle="tooltip" title="Delete"><i class="czi-trash text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg" src="img/marketplace/products/th10.jpg" alt="Product"></a>
                            <div class="media-body text-center text-sm-left">
                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Floating Phone and Tablet Mockup (PSD)</a></h3>
                                <div class="d-inline-block text-accent">$15.<small>00</small></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Sales: <span class="font-weight-medium">109</span></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Earnings: <span class="font-weight-medium">$1,144.<small>50</small></span></div>
                                <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                                    <button class="btn bg-faded-accent btn-icon mr-2" type="button" data-toggle="tooltip" title="Download"><i class="czi-download text-accent"></i></button>
                                    <button class="btn bg-faded-info btn-icon mr-2" type="button" data-toggle="tooltip" title="Edit"><i class="czi-edit text-info"></i></button>
                                    <button class="btn bg-faded-danger btn-icon" type="button" data-toggle="tooltip" title="Delete"><i class="czi-trash text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div class="media d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg" src="img/marketplace/products/th11.jpg" alt="Product"></a>
                            <div class="media-body text-center text-sm-left">
                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Minimal Mobile App UI Kit (Sketch)</a></h3>
                                <div class="d-inline-block text-accent">$23.<small>00</small></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Sales: <span class="font-weight-medium">117</span></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Earnings: <span class="font-weight-medium">$1,883.<small>70</small></span></div>
                                <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                                    <button class="btn bg-faded-accent btn-icon mr-2" type="button" data-toggle="tooltip" title="Download"><i class="czi-download text-accent"></i></button>
                                    <button class="btn bg-faded-info btn-icon mr-2" type="button" data-toggle="tooltip" title="Edit"><i class="czi-edit text-info"></i></button>
                                    <button class="btn bg-faded-danger btn-icon" type="button" data-toggle="tooltip" title="Delete"><i class="czi-trash text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div class="media d-block d-sm-flex align-items-center pt-4 pb-2"><a class="d-block position-relative mb-3 mb-sm-0 mr-sm-4 mx-auto" href="marketplace-single.html" style="width: 12.5rem;"><img class="rounded-lg" src="img/marketplace/products/th12.jpg" alt="Product"></a>
                            <div class="media-body text-center text-sm-left">
                                <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">Travel &amp; Landmark Icon Pack (AI)</a></h3>
                                <div class="d-inline-block text-accent">$17.<small>00</small></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Sales: <span class="font-weight-medium">21</span></div>
                                <div class="d-inline-block text-muted font-size-ms border-left ml-2 pl-2">Earnings: <span class="font-weight-medium">$249.<small>90</small></span></div>
                                <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                                    <button class="btn bg-faded-accent btn-icon mr-2" type="button" data-toggle="tooltip" title="Download"><i class="czi-download text-accent"></i></button>
                                    <button class="btn bg-faded-info btn-icon mr-2" type="button" data-toggle="tooltip" title="Edit"><i class="czi-edit text-info"></i></button>
                                    <button class="btn bg-faded-danger btn-icon" type="button" data-toggle="tooltip" title="Delete"><i class="czi-trash text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Toast: Added to Cart-->
    <div class="toast-container toast-bottom-center">
        <div class="toast mb-3" id="cart-toast" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white"><i class="czi-check-circle mr-2"></i>
                <h6 class="font-size-sm text-white mb-0 mr-auto">Added to cart!</h6>
                <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">This item has been added to your cart.</div>
        </div>
    </div>
    <!-- Footer-->
    <!-- Footer-->
    <!-- Toolbar for handheld devices-->
    <div class="cz-handheld-toolbar">
        <div class="d-table table-fixed w-100"><a class="d-table-cell cz-handheld-toolbar-item" href="account-wishlist.html"><span class="cz-handheld-toolbar-icon"><i class="czi-heart"></i></span><span class="cz-handheld-toolbar-label">Wishlist</span></a><a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)"><span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span><span class="cz-handheld-toolbar-label">Menu</span></a><a class="d-table-cell cz-handheld-toolbar-item" href="shop-cart.html"><span class="cz-handheld-toolbar-icon"><i class="czi-cart"></i><span class="badge badge-primary badge-pill ml-1">4</span></span><span class="cz-handheld-toolbar-label">$265.00</span></a>
        </div>
    </div>
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon czi-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="{{asset('assets/front/js/vendor/jquery/dist/jquery.slim.min.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/tiny-slider/dist/min/tiny-slider.js')}}"></script>
    <script src="{{asset('assets/front/js/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
    <!-- Main theme script-->
    <script src="{{asset('assets/front/js/theme.min.js')}}"></script>
@endsection
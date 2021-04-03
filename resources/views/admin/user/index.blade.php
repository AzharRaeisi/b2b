@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __("CUSTOMER") }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __("Buyers") }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-user-index') }}">{{ __("Buyers") }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mr-table allproduct">
                        @include('includes.admin.form-success')
                        <div class="table-responsiv">
                            <table id="yiwutable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{ __("Name") }}</th>
                                    <th>{{ __("Email") }}</th>
                                    <th>{{ __("Status") }}</th>
                                    <th>{{ __("Options") }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ADD / EDIT MODAL --}}
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="submit-loader">
                    <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                </div>
            </div>
        </div>

    </div>

    {{-- ADD / EDIT MODAL ENDS --}}

    {{-- DELETE MODAL --}}

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header d-block text-center">
                    <h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-center">{{ __("You are about to delete this Customer.") }}</p>
                    <p class="text-center">{{ __("Do you want to proceed?") }}</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
                </div>

            </div>
        </div>
    </div>

    {{-- DELETE MODAL ENDS --}}

    {{-- MESSAGE MODAL --}}
    <div class="sub-categori">
        <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-form">
                                        <form id="emailreply1">
                                            {{csrf_field()}}
                                            <ul>
                                                <li>
                                                    <input type="email" class="input-field eml-val" id="eml1" name="to" placeholder="{{ __("Email") }} *" value="" required="">
                                                </li>
                                                <li>
                                                    <input type="text" class="input-field" id="subj1" name="subject" placeholder="{{ __("Subject") }} *" required="">
                                                </li>
                                                <li>
                                                    <textarea class="input-field textarea" name="message" id="msg1" placeholder="{{ __("Your Message") }} *" required=""></textarea>
                                                </li>
                                            </ul>
                                            <button class="submit-btn" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MESSAGE MODAL ENDS --}}
    {{-- GALLERY MODAL --}}
    <div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Attachments') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="top-area">
                        <div class="row">
                            <div class="col-sm-12 d-inline-block">

                                <h5> Details: <small id="detail"></small></h5>
                            </div>

                        </div>
                    </div>

                    <div class="gallery-images">
                        <div class="selected-image">
                            <div class="row">


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-right">
                        <a id="verify-btn" data-type="verify"  href="javascript:;"  class="btn btn-success f-btn" > <i class="fas fa-check"></i> {{ __("Verify") }}</a>
                    </div>
                    <div class="col-sm-6">
                        <a id="decline-btn" data-type="decline" href="javascript:;"  class="btn btn-danger f-btn" > <i class="fas fa-times"></i> {{ __("Decline") }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- GALLERY MODAL ENDS --}}
    {{-- VERIFICATION MODAL --}}

    <div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="submit-loader">
                    <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">ASK FOR VERIFICATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                </div>
            </div>
        </div>

    </div>

    {{-- VERIFICATION MODAL ENDS --}}
@endsection

@section('scripts')

    {{-- DATA TABLE --}}

    <script type="text/javascript">

        var table = $('#yiwutable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-user-datatables') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status' },
                { data: 'action', searchable: false, orderable: false }
            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            },
            drawCallback : function( settings ) {
                $('.select').niceSelect();
            }
        });
        $(document).on("click", ".set-gallery" , function(){
            var pid = $(this).find('input[type=hidden]').val();
            $('#pid').val(pid);
            $('.selected-image .row').html('');
            $.ajax({
                type: "GET",
                url:"{{ route('admin-vr-show') }}",
                data:{id:pid},
                success:function(data){
                    $('#detail').html(data[2]);
                    $('#verify-btn').attr('href',data[3]);
                    $('#decline-btn').attr('href',data[4]);
                    if(data[0] == 0)
                    {
                        $('.selected-image .row').addClass('justify-content-center');
                        $('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
                    }
                    else {
                        $('.selected-image .row').removeClass('justify-content-center');
                        $('.selected-image .row h3').remove();
                        var arr = $.map(data[1], function(el) {
                            return el });

                        for(var k in arr)
                        {
                            /*$('.selected-image .row').append('<div class="col-md-6">'+
                             '<div class="img gallery-img">'+
                             '<a class="img-popup" href="'+'{{asset('assets/images/attachments').'/'}}'+arr[k]+'">'+
                         '<img  src="'+'{{asset('assets/images/attachments').'/'}}'+arr[k]+'" alt="gallery image">'+
                         '</a>'+
                         '</div>'+
                         '</div>');*/
                            $('.selected-image .row').append('<div class="col-md-6">'+
                                '<div class="img gallery-img">'+
                                arr[k]+
                                '</div>'+
                                '</div><a class="img-popup" target="_blank" download="'+arr[k]+'" href="'+'{{asset('assets/images/attachments').'/'}}'+arr[k]+'"><div class="col-md-6"><i class="fas fa-download"></i>Download</a></div>');
                        }
                    }
                    /*$('.img-popup').magnificPopup({
                     type: 'image'
                     });*/
                    $(document).off('focusin');

                }


            });
        });
        $('.f-btn').on('click',function(e){
            e.preventDefault();
            if(confirm('Are you sure you want to '+$(this).attr('data-type')+'?')) {
                $.ajax({
                    type: "GET",
                    url: $(this).attr('href'),
                    success: function (data) {

                        if (admin_loader == 1) {
                            $('.submit-loader').hide();
                        }

                        $('#setgallery').modal('toggle');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success p').html(data[0]);
                        table.ajax.reload();
                    }
                });
            }
        });
        $(document).on('click','.verify',function(){
            if(admin_loader == 1)
            {
                $('.submit-loader').show();
            }
            $('#verify-modal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
                if(status == "success")
                {
                    if(admin_loader == 1)
                    {
                        $('.submit-loader').hide();
                    }
                }
            });
        });
    </script>

    {{-- DATA TABLE --}}

@endsection   
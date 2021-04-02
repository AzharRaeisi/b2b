@extends('layouts.front')

@section('content')
    <section class="user-dashbord">
        <div class="container">
            <div class="row">
                @include('includes.user-dashboard-sidebar')
                <div class="col-lg-10">
                    <div class="add-product-content1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-profile-details">
                                    <div class="body-area">

                                        @if($data->checkVerification())
                                            <div class="alert alert-success validation" style="">
                                                <p class="text-left"><div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>{{ $langg->lang804 }}</h3></div></p>
                                            </div>
                                        @else
                                            @include('includes.admin.form-both')
                                            <form id="verifyform"  action="{{route('user-verify-submit')}}" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul>
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><strong class="text-danger">{{$verify->warning_reason}}</strong></li>
                                                            </ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div  class="col-md-3"></div>
                                                    <div class="col-md-7">
                                                        <label>{{ __('Description') }} *</label>
                                                        <textarea class="form-control" name="text" required="" placeholder="{{ __('Enter Details') }}"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div  class="col-md-3"></div>
                                                    <div  class="col-md-7">
                                                        {{ __('Attachment') }}*
                                                        <p class="sub-heading">(Maximum Size is 10 MB)</p>
                                                        <div class="attachments" id="attachment-section">
                                                            <div class="attachment-area">
                                                                <span class="remove attachment-remove"><i class="fas fa-times"></i></span>
                                                                <input type="file" class="form-control" name="attachments[]" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <a href="javascript:;" id="attachment-btn" class="add-more mt-4"><i class="fas fa-plus"></i>{{ __('Add More Attachment') }} </a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="warning" value="{{ isset($verify) ? $verify->admin_warning : '0' }}" />
                                                <input type="hidden" name="verify_id" value="{{ isset($verify) ? $verify->id : '0' }}" />
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area"></div>
                                                    </div>
                                                    <div class="col-lg-7 mt-3 mb-3">
                                                        <button class="btn btn-danger" type="submit" style="background: #af241e;border-radius: 0 4px 4px 0;">{{ __('Submit') }}</button>
                                                    </div>
                                                </div>
                                            </form>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')


    <script type="text/javascript">


        function isEmpty(el){
            return !$.trim(el.html())
        }

        // Color Section

        $("#attachment-btn").on('click', function(){

            $("#attachment-section").append(''+
                '<div class="attachment-area  mt-2">'+
                '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                '<input type="file" class="form-control" name="attachments[]" required>'+
                '</div>'
                +'');
        });


        $(document).on('click','.attachment-remove', function(){

            $(this.parentNode).remove();
            if (isEmpty($('#attachment-section'))) {

                $("#attachment-section").append(''+
                    '<div class="attachment-area  mt-2">'+
                    '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                    '<input type="file" name="attachments[]" required>'+
                    '</div>'
                    +'');

            }

        });
        $(document).on('submit','#verifyform',function(e){
            e.preventDefault();
            $('button.addProductSubmit-btn').prop('disabled',true);
            $.ajax({
                method:"POST",
                url:$(this).prop('action'),
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {

                    if ((data.errors)) {
                        $('.alert-success').hide();
                        $('.alert-danger').show();
                        $('.alert-danger ul').html('');
                        for(var error in data.errors)
                        {
                            $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                        }
                        $('#verifyform input , #verifyform select , #verifyform textarea').eq(1).focus();
                    }
                    else
                    {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success p').html(data);
                        $('#verifyform').html('');
                    }

                    $('button.addProductSubmit-btn').prop('disabled',false);
                }

            });

        });
        // Color Section Ends
    </script>
@endsection

@extends('layouts.admin')

@section('content')

	<div class="content-area">
		<div class="mr-breadcrumb">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="heading">{{ __("Buyers Requests") }}</h4>
					<ul class="links">
						<li>
							<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
						</li>
						<li>
							<a href="{{ route('admin-brequests-index') }}">{{ __("Buyers Requests") }}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="product-area">
			<div class="row">
				<div class="col-lg-12">
					<div class="mr-table allproduct">
						@include('includes.admin.form-both')
						<div class="table-responsiv">
							<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th>{{ __("#Sl") }}</th>
									<th>{{ __("Name") }}</th>
									<th>{{ __("Email") }}</th>
									<th>{{ __("Type") }}</th>
									<th>{{ __("City") }}</th>
									<th>{{ __("Details") }}</th>
									<th>{{ __("Status") }}</th>
									<th>{{ __("Action") }}</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- DELETE MODAL --}}
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header d-block text-center">
					<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<p class="text-center">{{ __('You are about to delete this buyers requests.') }}</p>
					<p class="text-center">{{ __('Do you want to proceed?') }}</p>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
					<a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
				</div>

			</div>
		</div>
	</div>

@endsection



@section('scripts')

	<script type="text/javascript">

        $('#example').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-brequests-datatables') }}?status={{$status}}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'type', name: 'type' },
                { data: 'city', name: 'city' },
                { data: 'details', searchable: false, orderable: false },
                { data: 'status', searchable: false, orderable: false },
                { data: 'action', searchable: false, orderable: false }

            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            },
            "aoColumnDefs": [ {
                "aTargets": [ 6 ],
                "mRender": function ( data, type, full ) {
                    return $("<div/>").html(data).text();
                }
            } ]
        });
        $('#confirm-delete').on('hidden.bs.modal', function () {
            window.location.reload();
        });
	</script>
@endsection   
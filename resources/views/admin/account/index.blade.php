@extends('layouts.app')

@section('content') 
<div class="row">
	<div class="col-lg-10 mx-auto p-0 mb-5">
		<div class="d-flex justify-content-between align-items-end">
			<form class="row col-md-10 p-0" action="" method="get">
				@csrf
				<div class="col-2">
					<label class="label_title">Name</label><br>
					<input id="user_name" name="filter[full_name]" name="" type="text" class="form-control"
						value="{{ request()->input('filter')['full_name'] ?? '' }}" maxlength="255" />
				</div>
				<div class="col-3">
					<label class="label_title">Email</label><br>
					<input id="email" name="filter[email]" class="form-control"
						value="{{ request()->input('filter')['email'] ?? '' }}" maxlength="255" />
				</div>
				<div class="col-3">
					<x-option-group 
						id="role_id"
						name="filter[role_id]"
						label="Role"
						value="{{ request()->input('filter')['role_id'] ?? null }}"
						:keyOptions="['value' => 'value', 'label' => 'label']"
						:options="$roleOptions"
						placeHolder="Select Role"
                	/>
					
				</div>
				<input type="hidden" id="sort" name="sort" value="{{ request()->input('sort') }}" />
				<div class="form-group col-2 d-flex align-items-end mb-3">
					<button type="submit" class="btn btn-primary me-1">Search</button>
					<button type="button" onclick="clearSearch('company_name', 'user_name', 'email', 'role_id')"
						class="btn btn-secondary btn-clear">Clear</button>
				</div>
			</form>
			<a href="{{ route('account.create') }}" class="col-lg-2 btn btn-primary mb-3">New</a>
		</div>
	</div>

	<div class="col-md-10 mx-auto p-0">
		<x-table class="table table-bordered">
			<x-slot name="header">
				<th >
					<x-sorting-link field="full_name">Name</x-sorting-link>
				</th>
				<th>
					<x-sorting-link field="email">Email</x-sorting-link>
				</th>
				<th>Phone</th>
				<th>
					<x-sorting-link field="role_id">Role</x-sorting-link>
				</th>
				<th width="10%">Deleted</th>
				<th width="10%">Action</th>
			</x-slot>
			<x-slot name="body">

				@if (!$users->isEmpty())
					@foreach ($users as $key => $item)
						<tr>
							<td>{{ $item->full_name }}</td>
							<td>{{ $item->email }}</td>
							<td>{{ $item->phone }}</td>
							<td>
								@foreach ($roleOptions as $role)
									{{ (int)$role["value"] === $item->role_id ? $role["label"] : ""}}
								@endforeach
							</td>
							<td>{{ $item->is_deleted ? "Yes" : "No" }}</td>
							<td class="text-center">
								<a href="{{ route("account.edit", $item->id) }}" class="btn btn-outline-primary btn-sm">
									<i class="fas fa-pencil-alt"></i>
								</a>
								<button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-root="{{ Request::route()->uri }}"
									data-id="{{ $item->id }}" id="button-open-delete" class="btn btn-outline-danger btn-sm">
									<i class="fa-solid fa-trash"></i>
								</button>
							</td>
						</tr>
					@endforeach
				@else
					<tr class="no-data">
						<td colspan="10">
							<i class="fa-regular fa-face-smile"></i>
							<span>No Data</span>
						</td>
					</tr>
				@endif
			</x-slot>

			<x-slot name="pagination">
				{{ $users->appends(request()->except('page'))->onEachSide(1)->links() }}
			</x-slot>
		</x-table>
	</div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Delete</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are you sure you want to delete it?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<form id="deleteForm" method="post">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">OK</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
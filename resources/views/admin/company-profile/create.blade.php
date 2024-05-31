@extends('layouts.app')

@section('content')
<div class="main_fields py-3">
	<div class="row">
		<div class="col-lg-10 mx-auto p-0 mb-5">
			<div class="d-flex justify-content-between align-items-end">
				<form class="row col-md-10 p-0" action="" method="get">
					@csrf
					<div class="form-group col-3">
						<label class="label_title">Company Name</label><br>
						<input id="company_name" name="company_name" type="text" class="form-control" value="{{ old('company_name') }}" maxlength="255" />
					</div>
					<div class="form-group col-2">
						<label class="label_title">Name</label><br>
						<input id="user_name" name="user_name" type="text" class="form-control" value="{{ old('user_name') }}"  maxlength="255" />
					</div>
					<div class="form-group col-3">
						<label class="label_title">Email</label><br>
						<input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" maxlength="255" />
					</div>
					<input type="hidden" id="sort" name="sort" value="{{ request()->input('sort') }}" />
					<div class="form-group col-2 d-flex align-items-end ">
						<button type="submit" class="btn btn-primary me-1">Search</button>
						<button type="button" onclick="clearSearch()" class="btn btn-secondary btn-clear">Clear</button>
					</div>
				</form>
				<a href="" class="col-lg-2 btn btn-primary">New</a>
			</div>
		</div>

		<div class="col-md-10 mx-auto p-0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Company Name</th>
						<th>Email</th>
						<th>Image</th>
						<th>Phone</th>
						<th>Country</th>
						<th>Views</th>
						<th>Referal Code</th>
						<th>Status</th>
						<th>Action</th>
					</tr>

				</thead>
				<tbody>

					@foreach ($company as $item)
					<tr>
						<td>{{ $item->user_name }}</td>
						<td>{{ $item->user_name }}</td>
						<td>{{ $item->email }}</td>
						<td>{{ $item->user_name }}</td>
						<td>{{ $item->phone }}</td>
						<td>{{ $item->company->country }}</td>
						<td>{{ $item->user_name }}</td>
						<td>{{ $item->company->referal_code }}</td>
						<td>
							{{ $item->company->allow }}
						</td>
						<td class="text-center">
							<a href="" class="btn btn-outline-primary btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a href="" class="btn btn-outline-danger btn-sm">
								<i class="fa-solid fa-trash"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
<script>
	function clearSearch() {
            const company_name = document.getElementById("company_name");
            company_name.value = null;
            const user_name = document.getElementById("user_name");
            user_name.value = null;
            const email = document.getElementById("email");
            email.value = null;
        }
</script>
@endsection
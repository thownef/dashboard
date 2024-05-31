@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form action="{{ route('account.store') }}" method="POST">
                @csrf
                <x-input name="full_name" label="Full Name" value="{{ old('full_name') }}" isRequired="true" />
                <x-input name="email" label="Email" value="{{ old('email') }}" isRequired="true" />
                <x-input name="phone" label="Phone" value="{{ old('phone') }}" isRequired="true" />
                <x-input name="password" label="Password" type="password" isRequired="true" />

                <x-option-group 
                    name="role_id"
                    label="Role"
                    value="{{ old('role_id') }}"
                    placeHolder="Select Role"
                    :keyOptions="['value' => 'value', 'label' => 'label']"
                    :options="$roleOptions"
                    isRequired="true"
                />
                <div class="btn-group--center">
                    <button type="submit" class="btn btn-primary me-3">Save</button>
                    <a href="{{ route('account.index' )}}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

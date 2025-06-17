@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <a href="{{ route("admin.roles.index") }}" class="breadcrumbs__item">User Management</a>
        <a href="{{ route("admin.roles.index") }}" class="breadcrumbs__item">Roles</a>
        <a href="" class="breadcrumbs__item active">Create</a>
    </nav>
@endsection
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('global.create') }}  {{ trans('cruds.permission.title_singular') }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}"> <label for="title">{{ trans('cruds.role.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}" required>
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }} ">
                <label for="permissions">{{ trans('cruds.role.fields.permissions') }} * :
                    <span class="btn btn-primary btn-sm select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-warning btn-sm deselect-all">{{ trans('global.deselect_all') }}</span></label>
            </div>
            <div class="mt-1">
                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <p class="help-block">
                        {{ $errors->first('permissions') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.permissions_helper') }}
                </p>
            </div>
            {{-- <div>
                <input class="btn btn-sm btn-primary" type="submit" value="{{ trans('global.save') }}">
            </div> --}}
            <hr class="mt-5">
            <div class="d-flex justify-content-between">
                <a class="btn btn-warning btn-submit waves-effect waves-float waves-light" href="{{ url()->previous() }}">
                    <i data-feather='arrow-left'></i> {{ trans('global.back') }}
                </a>
                <button class="btn btn-primary btn-submit waves-effect waves-float waves-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

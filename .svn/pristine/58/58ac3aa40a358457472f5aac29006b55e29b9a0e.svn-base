@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <a href="{{ route("admin.roles.index") }}" class="breadcrumbs__item">User Management</a>
        <a href="{{ route("admin.roles.index") }}" class="breadcrumbs__item">Roles</a>
        <a href="" class="breadcrumbs__item active">View</a>
    </nav>
@endsection
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('global.show') }} {{ trans('cruds.role.title') }}</h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Permissions
                        </th>
                        <td>
                            @foreach($role->permissions as $id => $permissions)
                                <span class="badge bg-primary">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-warning btn-submit waves-effect waves-float waves-light mt-2" href="{{ url()->previous() }}">
                <i data-feather='arrow-left'></i> {{ trans('global.back') }}
            </a>
        </div>

    </div>
</div>
@endsection

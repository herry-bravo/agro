@extends('layouts.erorrs')
@section('code', '403')
@section('description', 'You dont have access to this modul contact Administrator')
@section('title', __($exception->getMessage() ?: 'Forbidden'))
@section('nilai')
{{$nilai = 403}}
@endsection

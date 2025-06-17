@extends('layouts.erorrs')
@section('title', __('Too Many Requests'))
@section('code', '429')
@section('description', __('Too Many Requests'))
@section('nilai')
{{$nilai = 429}}
@endsection

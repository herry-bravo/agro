@extends('layouts.admin')
@section('styles')
<style>
    .grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-5.gap-8.md\:gap-8 {
        margin-left: 1%;
        margin-right: 1%;
    }

    input.appearance-none.w-full.bg-white.border-gray-300.hover\:border-gray-500.px-3.py-2.pr-8.rounded.leading-tight.focus\:outline-none.focus\:bg-white.focus\:border-gray-500.focus\:border-2.border {
        margin-left: 2%;
    }

</style>
@endsection
@section('content')

<div class="card">

    <div class="card-header">
        <h6 class="card-title mb-2 mt-2">
            <a href="" class="breadcrumbs__item">{{ trans('cruds.physic.fields.inv') }}</a>
            <a href="{{ route("admin.item-master.index") }}" class="breadcrumbs__item"> {{ trans('cruds.itemMaster.title_singular') }}</a>
            <a href="{{ route("admin.gallery.index") }}" class="breadcrumbs__item">Gallery Items</a>
        </h6>
    </div>
    <hr>
    <div class="card-body mt-25">
        @laravelViewsStyles
        @yield('content')
        <livewire:items-grid-view />
        @livewireScripts

        @laravelViewsScripts
    </div>
</div>
<div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="col-lg-14 ">
                                <img src="" class="img-fluid ml-12 mb-2" id="my-image" alt="Responsive image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).on('click', '#url', function() {
        var img = $(this).data('img');
        var localhostUrl = 'http://localhost:8000/' + img
        let myImage = document.getElementById('my-image');
        myImage.setAttribute('src', localhostUrl);
    });

</script>
@endpush

<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.customer.index', function ($trail) {
    $trail->push('Customer Index', route('admin.customer.index'));
});

Breadcrumbs::for('admin.customer.create', function ($trail) {
    $trail->push('Customer Create', route('admin.customer.create'));
});

Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('Home', route('admin.home'));
});

Breadcrumbs::for('admin.orders.index', function ($trail) {
    $trail->push('Title Here', route('admin.orders.index'));
});

Breadcrumbs::for('admin.salesorder.index', function ($trail) {
    $trail->push('Title Here', route('admin.salesorder.index'));
});

Breadcrumbs::for('admin.salesorder.create', function ($trail) {
    $trail->push('Title Here', route('admin.salesorder.create'));
});

Breadcrumbs::for('admin.pricelist.index', function ($trail) {
    $trail->push('Title Here', route('admin.pricelist.index'));
});

Breadcrumbs::for('admin.pricelist.show' , function ($trail) {
    $trail->push('Title Here', route('admin.pricelist.show', '$pricelist'));
});

Breadcrumbs::for('admin.pricelist.create', function ($trail) {
    $trail->push('Title Here', route('admin.pricelist.create'));
});

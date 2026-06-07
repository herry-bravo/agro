<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/charts/apexcharts.css')); ?>">
<style>
.dash-stat-card {
    border-radius: 12px;
    border: none;
    overflow: hidden;
    transition: transform .18s, box-shadow .18s;
}
.dash-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,.10) !important;
}
.dash-stat-card .card-body {
    padding: 1.4rem 1.4rem;
    display: flex;
    align-items: center;
    gap: 1.1rem;
}
.ds-icon {
    width: 54px; height: 54px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.ds-icon svg { width: 24px; height: 24px; }
.ds-label  { font-size: .72rem; color: #8a97ae; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 3px; }
.ds-value  { font-size: 1.28rem; font-weight: 700; color: #1e293b; line-height: 1.2; }
.ds-sub    { font-size: .73rem; color: #8a97ae; margin-top: 2px; }

.ds-blue   .ds-icon { background: rgba(59,130,246,.11); color: #3b82f6; }
.ds-green  .ds-icon { background: rgba(16,185,129,.11); color: #10b981; }
.ds-orange .ds-icon { background: rgba(245,158,11,.11); color: #f59e0b; }
.ds-purple .ds-icon { background: rgba(139,92,246,.11); color: #8b5cf6; }

.section-title-sm {
    font-size: .88rem;
    font-weight: 600;
    color: #374151;
}
.table-dash thead th {
    background: #f8fafc;
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: .04em;
    color: #6b7280;
    border-bottom: 1px solid #e9ecef;
    padding: .65rem .9rem;
    font-weight: 600;
}
.table-dash tbody tr:hover { background: #f8fafc; }
.table-dash tbody td { padding: .6rem .9rem; font-size: .85rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
.table-dash tbody tr:last-child td { border-bottom: none; }
.badge-status { font-size: .7rem; padding: .25rem .55rem; border-radius: 20px; font-weight: 600; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row match-height mb-1">
    <div class="col-xl-3 col-sm-6 col-12 mb-1">
        <div class="card dash-stat-card ds-blue shadow-sm h-100">
            <div class="card-body">
                <div class="ds-icon"><i data-feather="trending-up"></i></div>
                <div>
                    <div class="ds-label">Sales This Month</div>
                    <div class="ds-value">Rp <?php echo e(number_format($salesThisMonth, 0, ',', '.')); ?></div>
                    <div class="ds-sub"><?php echo e($salesCountMonth); ?> orders</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-1">
        <div class="card dash-stat-card ds-green shadow-sm h-100">
            <div class="card-body">
                <div class="ds-icon"><i data-feather="package"></i></div>
                <div>
                    <div class="ds-label">On-Hand Stock</div>
                    <div class="ds-value"><?php echo e(number_format($onhandQty, 0, ',', '.')); ?></div>
                    <div class="ds-sub">total quantity on hand</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-1">
        <div class="card dash-stat-card ds-orange shadow-sm h-100">
            <div class="card-body">
                <div class="ds-icon"><i data-feather="monitor"></i></div>
                <div>
                    <div class="ds-label">POS Sales Today</div>
                    <div class="ds-value">Rp <?php echo e(number_format($posToday, 0, ',', '.')); ?></div>
                    <div class="ds-sub"><?php echo e(\Carbon\Carbon::now()->isoFormat('D MMM YYYY')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $totalRevenue = array_sum($monthlyRevenue);
        $totalCost    = array_sum($monthlyCost);
        $netProfit    = $totalRevenue - $totalCost;
    ?>
    <div class="col-xl-3 col-sm-6 col-12 mb-1">
        <div class="card dash-stat-card ds-purple shadow-sm h-100">
            <div class="card-body">
                <div class="ds-icon"><i data-feather="bar-chart-2"></i></div>
                <div>
                    <div class="ds-label">Net Profit <?php echo e($currentYear); ?></div>
                    <div class="ds-value" style="color:<?php echo e($netProfit >= 0 ? '#10b981' : '#ef4444'); ?>">
                        <?php echo e($netProfit >= 0 ? '+' : ''); ?>Rp <?php echo e(number_format($netProfit, 0, ',', '.')); ?>

                    </div>
                    <div class="ds-sub">Revenue − Cost</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-1">
    
    <div class="col-xl-8 col-12 mb-1">
        <div class="card shadow-sm h-100">
            <div class="card-header border-bottom py-1 d-flex justify-content-between align-items-center">
                <span class="section-title-sm">Revenue vs Cost — <?php echo e($currentYear); ?></span>
                <div class="d-flex gap-1">
                    <span class="badge-status" style="background:#dbeafe;color:#1d4ed8;">Revenue</span>
                    <span class="badge-status" style="background:#fef3c7;color:#b45309;">Cost</span>
                </div>
            </div>
            <div class="card-body pt-1 pb-1">
                <div id="revCostChart"></div>
            </div>
        </div>
    </div>

    
    <div class="col-xl-4 col-12 mb-1">
        <div class="card shadow-sm h-100">
            <div class="card-header border-bottom py-1">
                <span class="section-title-sm">Profit / Loss — <?php echo e($currentYear); ?></span>
            </div>
            <div class="card-body pt-1 pb-0">
                <div id="profitChart"></div>
                <div class="text-center pb-1">
                    <div class="fw-bold" style="font-size:1.05rem;color:<?php echo e($netProfit >= 0 ? '#10b981' : '#ef4444'); ?>">
                        <?php echo e($netProfit >= 0 ? '+' : ''); ?>Rp <?php echo e(number_format($netProfit, 0, ',', '.')); ?>

                    </div>
                    <div style="font-size:.72rem;color:#8a97ae;">Net Profit/Loss <?php echo e($currentYear); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header border-bottom py-1 d-flex justify-content-between align-items-center">
                <span class="section-title-sm mb-0">Recent Sales Orders</span>
                <a href="<?php echo e(url('admin/salesorder')); ?>" class="btn btn-sm btn-outline-primary py-0 px-1"
                   style="font-size:.78rem;">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dash mb-0">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th class="text-end">Amount</th>
                                <th class="text-center" style="display:none;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $so): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(url('admin/salesorder/'.$so->id)); ?>" class="fw-bold text-primary">
                                        <?php echo e($so->order_number); ?>

                                    </a>
                                </td>
                                <td><?php echo e($so->customer->party_name ?? '-'); ?></td>
                                <td><?php echo e($so->ordered_date ? \Carbon\Carbon::parse($so->ordered_date)->format('d M Y') : '-'); ?></td>
                                <td class="text-end">Rp <?php echo e(number_format($so->total_payment, 0, ',', '.')); ?></td>
                                <td class="text-center" style="display:none;">
                                    <?php if($so->open_flag === 'C'): ?>
                                        <span class="badge-status" style="background:#dcfce7;color:#166534;">Closed</span>
                                    <?php elseif($so->open_flag === 'O'): ?>
                                        <span class="badge-status" style="background:#fef9c3;color:#854d0e;">Open</span>
                                    <?php else: ?>
                                        <span class="badge-status" style="background:#f1f5f9;color:#475569;"><?php echo e($so->open_flag ?? '-'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No sales orders found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/vendors/js/charts/apexcharts.min.js')); ?>"></script>
<script>
(function () {
    var months  = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var revData  = <?php echo json_encode(array_values($monthlyRevenue)); ?>;
    var costData = <?php echo json_encode(array_values($monthlyCost)); ?>;

    var fmt = function (v) { return 'Rp ' + new Intl.NumberFormat('id-ID').format(v); };

    // Bar chart: Revenue vs Cost
    new ApexCharts(document.querySelector('#revCostChart'), {
        chart: { type: 'bar', height: 280, toolbar: { show: false }, fontFamily: 'inherit' },
        plotOptions: { bar: { borderRadius: 4, columnWidth: '55%' } },
        colors: ['#3b82f6', '#f59e0b'],
        series: [
            { name: 'Revenue', data: revData  },
            { name: 'Cost',    data: costData }
        ],
        xaxis: { categories: months, labels: { style: { fontSize: '11px' } } },
        yaxis: { labels: { formatter: fmt, style: { fontSize: '10px' } } },
        tooltip: { y: { formatter: fmt } },
        legend: { show: false },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        dataLabels: { enabled: false }
    }).render();

    // Area chart: Profit / Loss
    var profitData = revData.map(function (r, i) { return r - costData[i]; });
    new ApexCharts(document.querySelector('#profitChart'), {
        chart: { type: 'area', height: 200, toolbar: { show: false }, fontFamily: 'inherit' },
        colors: ['#10b981'],
        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: .35, opacityTo: .04 } },
        series: [{ name: 'Profit/Loss', data: profitData }],
        xaxis: { categories: months, labels: { style: { fontSize: '10px' } } },
        yaxis: { labels: { formatter: fmt, style: { fontSize: '10px' } } },
        tooltip: { y: { formatter: fmt } },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 }
    }).render();
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/home/index.blade.php ENDPATH**/ ?>
<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', './login');
Route::redirect('/home', './admin');
Auth::routes(['register' => true]);
// Route::post('/register', [HomeController::class, 'register'])->name('register');
// Route::get('/item_code', 'SearchController@item_code');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Lang
    Route::get('lang/home', 'LangController@index');
    Route::get('lang/change', 'LangController@change')->name('changelang');

    Route::post('/account-code/{id}', 'AccountCodeController@update')->name('account-code.update');


    // Lang
    // Route::resource('language','LocalizationController')->name('language.index');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Currencies
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Transactiontypes
    Route::delete('transaction-types/destroy', 'TransactionTypeController@massDestroy')->name('transaction-types.massDestroy');
    Route::resource('transaction-types', 'TransactionTypeController');

    // Inventory
Route::delete('inventory/destroy', 'InventoryController@massDestroy')->name('inventory.massDestroy');
    Route::resource('inventory', 'InventoryController');

    // Incomesources
    Route::delete('income-sources/destroy', 'IncomeSourceController@massDestroy')->name('income-sources.massDestroy');
    Route::resource('income-sources', 'IncomeSourceController');

    // Clientstatuses
    Route::delete('client-statuses/destroy', 'ClientStatusController@massDestroy')->name('client-statuses.massDestroy');
    Route::resource('client-statuses', 'ClientStatusController');

    // Projectstatuses
    Route::delete('project-statuses/destroy', 'ProjectStatusController@massDestroy')->name('project-statuses.massDestroy');
    Route::resource('project-statuses', 'ProjectStatusController');

    // Clients
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Projects
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectController');

    // Notes
    Route::delete('notes/destroy', 'NoteController@massDestroy')->name('notes.massDestroy');
    Route::resource('notes', 'NoteController');

    // Documents
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
    Route::resource('documents', 'DocumentController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionController');

    // Clientreports
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

    //Item Master
    Route::delete('item-master/destroy', 'ItemMasterController@massDestroy')->name('item-master.massDestroy');
    Route::resource('item-master', 'ItemMasterController');
    // Orders
    Route::delete('orders/destroy', 'PurchaseOrdersController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'PurchaseOrdersController');
     // Quotation
     Route::delete('quotation/destroy', 'QuotationController@massDestroy')->name('quotation.massDestroy');
     Route::resource('quotation', 'QuotationController');

     //Sales Order
     Route::delete('salesorder/destroy', 'SalesOrderController@massDestroy')->name('sales-order.massDestroy');
     Route::resource('salesorder', 'SalesOrderController');
     //Vendor
     Route::delete('vendor/destroy', 'VendorController@massDestroy')->name('vendor.massDestroy');
     Route::resource('vendor', 'VendorController');

    // Customer
    Route::delete('customer/destroy', 'CustomerController@massDestroy')->name('customer.massDestroy');
    Route::resource('customer', 'CustomerController');

    // Price List
    Route::delete('pricelist/destroy', 'SellingPriceController@massDestroy')->name('pricelist.massDestroy');
    Route::resource('pricelist', 'SellingPriceController');

	 //Category
     Route::delete('category/destroy', 'CategoryController@massDestroy')->name('category.massDestroy');
     Route::resource('category', 'CategoryController');
	 //Account Code (COA)
     Route::delete('accountCode/destroy', 'AccountCodeController@massDestroy')->name('accountCode.massDestroy');
     Route::resource('accountCode', 'AccountCodeController');
	 //Account Code (COA)
     Route::delete('site/destroy', 'SiteController@massDestroy')->name('site.massDestroy');
     Route::resource('site', 'SiteController');
	 //Purchase Requisition
     Route::delete('purchase-requisition/destroy', 'PurchaseRequisitionController@massDestroy')->name('purchase-requisition.massDestroy');
     Route::resource('purchase-requisition', 'PurchaseRequisitionController');

	 // delivery --Heryy-- updateed at --06-04-2022--
    Route::delete('deliveries/destroy', 'DeliveriesController@massDestroy')->name('deliveries.massDestroy');
    Route::get('deliveries/fullfill', 'DeliveriesController@fullfill')->name('deliveries.fullfill');
    Route::resource('deliveries', 'DeliveriesController');
	 // delivery --Heryy-- updateed at --06-01-2023--
    Route::delete('tax/destroy', 'TaxController@massDestroy')->name('tax.massDestroy');
    Route::resource('tax', 'TaxController');

    // Shipments --Heryy-- updateed at --06-06-2022--
    // Route::delete('deliveriesdetail/destroy', 'DeliveriesDetailController@massDestroy')->name('deliveriesdetail.massDestroy');
    Route::resource('deliveriesdetail', 'DeliveriesDetailController');

    // Shipments --Heryy-- updateed at --07-06-2022--
    Route::delete('deliveriesterms/destroy', 'DeliveriesTermsController@massDestroy')->name('deliveriesterms.massDestroy');
    Route::resource('deliveriesterms', 'DeliveriesTermsController');

    // Shipments --Heryy-- updateed at --22-06-2022--
    // Route::delete('deliveriesconfirm/destroy', 'DeliveriesShipConfirmController@massDestroy')->name('deliveriesconfirm.massDestroy');
    // Route::resource('deliveriesconfirm', 'DeliveriesShipConfirmController');

    // Shipments --Heryy-- updateed at --06-04-2022--
    Route::delete('shipment/destroy', 'ShipmentController@massDestroy')->name('shipment.massDestroy');
    Route::resource('shipment', 'ShipmentController');
    Route::resource('shipment/show', 'ShipmentController');
    // Route::resource('shipment/view/{id}', 'ShipmentController')->name('view');
    Route::get('deliveryOrders/{id}', 'ShipmentController@deliveryOrders')->name('deliveryOrders');
    Route::delete('shipment/rollDestroy', 'ShipmentController@rollDestroy')->name('shipment.rollDestroy');

    // Invoices --Heryy-- updateed at --06-04-2022--
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
    Route::resource('invoices', 'InvoicesController');


    // prdetail --Heryy-- updateed at --16-10-2024--
    Route::resource('pr-detail', 'PurchaseRequisitionDetailController');
    // glmanual --Heryy-- updateed at --20-12-2022--
    Route::delete('gl/destroy', 'GlmanualsController@index')->name('gl.massDestroy');
    Route::resource('gl', 'GlmanualsController');
    // glpaymane --Heryy-- updateed at --02-01-2023--
    Route::delete('bankaccount/destroy','AddBankAccountController@massDestroy')->name('bankaccount.massDestroy');
    Route::resource('bankaccount','AddBankAccountController');
    // Shipments --Heryy-- updateed at --18-05-2022--
    // Route::delete('shipmentdetil/destroy', 'ShipmentDetailController@massDestroy')->name('shipmentdetil.massDestroy');
    // Route::resource('shipmentdetil', 'ShipmentDetailController');

    //Ar Payment --Heryy-- updateed at --23-05-2023--
    Route::delete('ar-payment/destroy','ArPaymentController@index')->name('ar-payment.massDestroy');
    Route::resource('ar-payment', 'ArPaymentController');

    // Terms -- Shindi Purnama created at -- 19-04-2022 --
    Route::delete('terms/destroy','TermsController@MassDestroy')->name('terms.massDestroy');
    Route::resource('terms', 'TermsController');

    // rcv -- Syarifuddin -- 09-04-2022 --
    
    Route::delete('rcv/destroy','ReceivesController@MassDestroy')->name('receives.massDestroy');
    Route::resource('rcv', 'ReceivesController');
    // rcv -- herry -- 15-07-2022 --
    Route::resource('rcvcustomer', 'ReceivesCustomerController');

    //supplier direct receive
    Route::get('rcvdirect','ReceivesController@rcv_direct')->name('rcvdirect');
    Route::post('rcvdirect-store','ReceivesController@rcv_direct_store')->name('rcvdirect-store');
    Route::get('rcvdirect-edit','ReceivesController@rcv_direct_edit')->name('rcvdirect-edit');

    //Sub Inventories -- Shindi -- 27-04-2022 --
    Route::delete('subInventory/destroy','SubInventoryController@index')->name('subInventory.massDestroy');
    Route::resource('subInventory', 'SubInventoryController');

    Route::delete('faktur/destroy','FakturController@index')->name('faktur.massDestroy');
    Route::resource('faktur', 'FakturController');

    //Material Transaction Type -- Shindi -- 27-04-2022 --
    Route::delete('materialTrnTypes/destroy','SubInventoryController@index')->name('materialTrnTypes.massDestroy');
    Route::resource('materialTrnTypes', 'MaterialTrnTypeController');

    //uom -- Shindi -- 27-04-2022 --
    Route::delete('uom/destroy','UomController@index')->name('uom.massDestroy');
    Route::resource('uom', 'UomController');

    //Material Trans -- Shindi -- 27-04-2022
    Route::delete('material-txns/destroy','MaterialTxnsController@index')->name('material-txns.massDestroy');
    Route::resource('material-txns', 'MaterialTxnsController');

    //Material Transfer
    Route::resource('mtl-transfer', 'MaterialTransferController');

    //Miss Transaction -- Shindi -- 06-05-2022
    Route::resource('missTransaction', 'MissTransactionController');

    // return -- Shindi -- 22-04-2022 --
    Route::delete('return/destroy','ReturnController@MassDestroy')->name('return.massDestroy');
    Route::resource('return', 'ReturnController');

    //Trx Statuses -- Shindi -- 09-05-2022
    Route::delete('trx-statuses/destroy','TrxStatusesController@index')->name('trx-statuses.massDestroy');
    Route::resource('trx-statuses', 'TrxStatusesController');

    /** Added by Shindi -- 10 Mei 2022 */
    //auto create
    Route::delete('auto-create/destroy', 'AutoCreateController@massDestroy')->name('auto-create.massDestroy');
    Route::resource('auto-create', 'AutoCreateController');

    //report
    route::delete('std-reports/destroy','StdReportController@index')->name('std-reports.massDestroy');
    Route::resource('std-reports', 'StdReportController');
    Route::get('bs-index', 'StdReportController@bs_index');

    //report
    route::delete('journalTypes/destroy','JournalTypesController@index')->name('journalTypes.massDestroy');
    Route::resource('journalTypes', 'JournalTypesController');

    Route::resource('reportPDF', 'poController');
    Route::resource('suratJalan', 'SuratJalanController');
    Route::resource('packingList', 'PackingListController');
    Route::resource('salesInvoicing', 'SalesInvoicingController');
    Route::resource('inv-report','InventoryReportController');
    Route::resource('inv-print', InvoicesprintController::class);
    Route::resource('missExpenses-report','MissExpensesReportController');
    Route::resource('pr-report','prReportController');
    Route::resource('apreport','apController');
    Route::resource('paymentreport','paymentController');
    Route::get('pnlReport', 'paymentController@pnlReport')->name('paymentreport.pnlReport');
    Route::get('balancesheet', 'paymentController@balancesheet')->name('paymentreport.balancesheet');
    Route::get('glReport', 'paymentController@glReport')->name('paymentreport.glReport');
    Route::get('bankReport', 'paymentController@bankReport')->name('paymentreport.bankReport');
    Route::get('cashReport', 'paymentController@cashReport')->name('paymentreport.cashReport');
    Route::resource('woPrint','woReportController');

    //purchase report
    Route::get('purchase/data', 'PurchaseOrdersController@data')->name('purchase.data');

    //Sales report
    Route::get('sales/data', 'SalesOrderController@data')->name('sales.data');
    Route::get('sales/data_invoice', 'SalesOrderController@data_invoice')->name('sales.data_invoice');
    //Delivery Reports
    Route::get('sales/data_shipment', 'SalesOrderController@data_shipment')->name('sales.data_shipment');
    //Payment
    Route::get('accountPayable/data', 'AccountPayableController@data')->name('accountPayable.data');

    //grn
    Route::delete('grn/destroy','GrnController@MassDestroy')->name('Grn.massDestroy');
    Route::resource('grn', 'GrnController');
    Route::get('grn/pdf/{from}/{to}', 'GrnController@pdf')->name('grn.pdf');

    //req detail
    Route::delete('requisition-detail/destroy', 'RequisitionDetailController@massDestroy')->name('requisition-detail.massDestroy');
     Route::resource('requisition-detail', 'RequisitionDetailController');

    // so detail
    Route::delete('salesOrder-detail/destroy', 'SalesOrderDetailController@massDestroy')->name('salesOrder-detail.massDestroy');
    Route::resource('salesOrder-detail', 'SalesOrderDetailController');

    //physical Inventory
    Route::delete('physic/destroy','PhysicalInventoryController@MassDestroy')->name('PhysicalInventory.massDestroy');
    Route::resource('physic', 'PhysicalInventoryController');
    Route::post('physic/autoApply', 'PhysicalInventoryController@autoApply')->name('physic.autoApply');
    Route::post('physic/importExcel', 'PhysicalInventoryController@importExcel')->name('physic.importExcel');

    //BOM!!
    Route::resource('bom', 'BomController');

    //Work Order
    Route::delete('work-order/destroy','WorkOrderController@MassDestroy')->name('WorkOrder.massDestroy');
    Route::resource('work-order', 'WorkOrderController');
    Route::resource('fg-ostd', 'OutstandingFGController');

    Route::delete('completion/destroy','CompletionController@MassDestroy')->name('completion.massDestroy');
    Route::resource('completion', 'CompletionController');
    Route::get('label/{id}', 'CompletionController@label')->name('label');
    Route::post('completion/quality', 'CompletionController@quality')->name('completion.quality');

     // Orders detail ---07-06-2022--- Syarifuddin
     Route::delete('orderDet/destroy', 'PurchaseDetController@massDestroy')->name('orderDet.massDestroy');
     Route::resource('orderDet', 'PurchaseDetController');

     Route::delete('app/destroy','AppController@index')->name('App.massDestroy');
     Route::resource('app', 'AppController');

     // item-IMG syarifuddin 03-Jun-2022
     Route::delete('item-img/destroy','ItemImgController@index')->name('item-img.massDestroy');
     Route::resource('item-img', 'ItemImgController');

     // Ap syarifuddin 03-Jun-2022
    //  Route::delete('ap/destroy','AccountPayableController@index')->name('ap.massDestroy');
     Route::resource('ap', 'AccountPayableController');
     Route::get('ap/destroy/{id}', 'AccountPayableController@destroy');

     // Ar Shindi 08-Jul-2022
     Route::delete('arCalendar/destroy','arCalendarController@index')->name('arCalendar.massDestroy');
     Route::resource('arCalendar', 'arCalendarController');

     // ad By Syarifuddin 22-AUG-2022
     Route::delete('atp/destroy','atpController@index')->name('atp.massDestroy');
     Route::resource('atp', 'atpController');

     Route::delete('arAuto/destroy','ArAutoController@index')->name('arAuto.massDestroy');
     Route::resource('arAuto', 'ArAutoController');

     Route::delete('ar/destroy','ArController@index')->name('ar.massDestroy');
     Route::resource('ar', 'ArController');


     Route::delete('gallery/destroy','GalleryController@index')->name('ar.massDestroy');
     Route::resource('gallery', 'GalleryController');

     Route::delete('opunit/destroy','OpUnitController@index')->name('opunit.massDestroy');
     Route::resource('opunit', 'OpUnitController');

     Route::delete('gsm/destroy','GramaturStdController@index')->name('gsm.massDestroy');
     Route::resource('gsm', 'GramaturStdController');

     //ProductionPlanning **Syarifuddin 02-Dec-2022**
     Route::delete('prodplan/destroy','ProductionPlanningController@index')->name('prodplan.massDestroy');
     Route::resource('prodplan', 'ProductionPlanningController');

     //uom conversion
    Route::delete('uom-conversion/destroy','UomConversionController@index')->name('uom-conversion.massDestroy');
    Route::resource('uom-conversion', 'UomConversionController');

    //missExpense
    Route::delete('missExpense/destroy','MissExpenseController@index')->name('missExpense.massDestroy');
    Route::resource('missExpense', 'MissExpenseController');

    //Quality Management - Material
    Route::delete('qm-material/destroy','MaterialQualityController@index')->name('qm-material.massDestroy');
    Route::resource('qm-material', 'MaterialQualityController');
    Route::post('qm-material/store', 'MaterialQualityController@store');

    //Quality Management - FG
    Route::delete('qm-finsihGood/destroy','FinishGoodQualityController@index')->name('qm-finsihGood.massDestroy');
    Route::resource('qm-finsihGood', 'FinishGoodQualityController');

    //Ap Payment
    Route::delete('ap-payment/destroy','ApPayementController@index')->name('ap-payment.massDestroy');
    Route::resource('ap-payment', 'ApPayementController');

    // GL manual
    Route::get('gl-entries', 'GlmanualsController@gl_entries')->name('gl.gl-entries');

    //Credit Note
     Route::delete('credit-note/destroy','CreditNoteController@destroy')->name('credit-note.massDestroy');
     Route::resource('credit-note', 'CreditNoteController');

    //Credit memo
     Route::delete('credit-memo/destroy','CreditMemoController@destroy')->name('credit-memo.massDestroy');
     Route::resource('credit-memo', 'CreditMemoController');

     //Asset
     Route::delete('asset/destroy','AssetController@index')->name('asset.massDestroy');
     Route::resource('asset', 'AssetController');

     Route::delete('asset-line/destroy','AssetLineController@destroy')->name('asset-line.destroy');
     Route::resource('asset-line', 'AssetLineController');

     Route::delete('asset-category/destroy','AssetCategoryController@index')->name('asset-category.massDestroy');
     Route::resource('asset-category', 'AssetCategoryController');

    Route::get('bank', 'GlmanualsController@bank')->name('gl.bank');
    Route::get('cash', 'GlmanualsController@cash')->name('gl.cash');
    
});



Route::group(['prefix' => 'search', 'as' => 'admin.', 'middleware' => ['auth']], function (){
    Route::post('asetto-gl', 'SearchController@asettoGL')->name('asetto-gl');

	 Route::any('customer_name', 'SearchController@customer_name');
	 Route::any('item_code', 'SearchController@item_code');
	 Route::any('vendor', 'SearchController@vendor');
	 Route::any('site', 'SearchController@site');
	 Route::any('supplier-site', 'SearchController@supplier_site');
	 Route::any('purchase-item', 'SearchController@purchase_item');
	 Route::any('purchase-item-det', 'SearchController@purchase_item_det');
	 Route::any('acc_category', 'SearchController@acc_category');
     Route::any('price_list', 'SearchController@price_list');
     Route::any('price_list_detail', 'SearchController@price_list_detail');
     Route::any('sales_order', 'SearchController@sales_order');
     Route::any('taxesmaster', 'SearchController@taxesmaster');
     Route::any('sales_order_detail', 'SearchController@sales_order_detail');
     Route::any('plnDet', 'SearchController@pln_det');

    //  search shipment herry 14/04/22
	 Route::any('shipmentsearch', 'SearchController@shipment_search');
	 Route::any('shipmentsearchitem', 'SearchController@shipment_search_item');
	 Route::any('rcvcustomer', 'SearchController@rcv_customer');
	 Route::any('taxmaster', 'SearchController@taxmaster');
    //  search sales return herry 06/07/22
	 Route::any('copyLinesselected', 'SearchController@copyLinesselected');
    //  search receive  herry 14/07/2
	 Route::any('newreceive', 'SearchController@newreceive');
    //  search sales return herry 08/07/22
	 Route::any('searchSplitLine', 'SearchController@searchSplitLine');
	 Route::any('taxlist', 'SearchController@tax_list');
	 Route::any('asset', 'SearchController@asset_list');
	 Route::any('assetcategory', 'SearchController@assetcategory_list');
	 Route::any('outstanding', 'SearchController@out_standing');
    //  search arpayment herry 30/05/23
    Route::any('arpayment', 'SearchController@ar_payment');
    Route::any('ap_payments', 'SearchController@ap_payments');
    Route::any('roll','SearchController@roll');
    //  search prdetil herry 16/10/24
    Route::any('pr-detil','SearchController@pr_detail');

    //  search shipment herry 06/06/22
	//  Route::any('subinventories', 'DeliveriesDetailController@sub_inventory');

    // Add Item_Detail url ---  Shindi --- 27/04/2022
    Route::any('item_detail', 'SearchController@item_detail');
    Route::any('txs-report', 'SearchController@txs_report');
    Route::any('miss-report', 'SearchController@miss_report');

    //Add by Shindi 09-05-2022
    Route::any('data-return', 'SearchController@data_return');
    Route::any('subinventory', 'SearchController@subinventory');
    Route::any('search_coa', 'SearchController@search_coa');

    // 10-05-2022
    Route::any('data-receive', 'SearchController@data_receive');
    Route::any('cost-center', 'SearchController@cost_center');
    Route::any('product_category', 'SearchController@product_category');
    //Filter Work Order
    Route::any('work-order','SearchController@workOrder_search');
    Route::any('bom','SearchController@search_bom');
    Route::any('acc-code','SearchController@acc_code');
    Route::any('data-vendor','SearchController@data_vendor');
    Route::any('data-grn','SearchController@data_grn');
    Route::any('store-ap','StoreController@store_ap');
    Route::any('rcv-report','SearchController@rcv_report');
    Route::any('rcv-index','SearchController@rcv_index');
    Route::any('onhand-report','SearchController@onhand_report');
    Route::any('subinv-data','SearchController@subinv_data');

    //27-07-2022 - Add by shindi ==> Ar Item Search
    Route::any('ar-item','SearchController@ar_item');
    Route::any('ar-itemDet','SearchController@ar_item_detail');
    Route::any('acc-search','SearchController@acc_search');
    Route::any('acc-detail','SearchController@acc_search_detail');
    Route::any('po-report','SearchController@po_report');
    Route::any('item-report','SearchController@item_report');
    Route::any('op-unit','SearchController@op_unit');
    Route::any('sub-category','SearchController@sub_category');
    Route::any('ref-aju','SearchController@ref_aju');
    Route::any('product_subcategory','SearchController@product_subcategory');
    Route::any('product_subcategory_det','SearchController@product_subcategory_det');
    Route::any('trf-report','SearchController@trf_report');
    Route::any('mtl-trx-report','SearchController@mtl_trx_report');
    Route::any('pr-report','SearchController@pr_report');
    Route::any('req-report','SearchController@pr_detail_report');
    Route::any('ap-report','SearchController@ap_report');
    Route::any('ap-index','SearchController@ap_index');
    Route::any('sales-report','SearchController@sales_report');
    Route::any('sales-invoice','SearchController@sales_invoice_report');
    Route::any('delivery-report','SearchController@delivery_report');
    Route::any('shipment-report','SearchController@shipment_report');
    Route::any('po-atp','SearchController@po_atp');
    Route::any('atp-data','SearchController@atp_data');
    Route::any('ap-item','SearchController@ap_item');
    Route::any('ap-itemDet','SearchController@ap_item_detail');
    Route::any('planning-report','SearchController@planning_report');
    Route::any('order-summary','SearchController@order_summary');
    Route::any('sales-data','SearchController@sales_data');
    Route::any('invoices-data','SearchController@invoices_data');
    Route::any('faktur-data','SearchController@faktur_data');
    Route::any('shipment-data','SearchController@shipment_data');
    Route::any('workorder','SearchController@wolist');
    Route::any('glmanual','SearchController@gllist');
    Route::any('gl-bank','SearchController@gl_bank');
    Route::any('gl-cash','SearchController@gl_cash');
    Route::any('journalEntries','SearchController@journal_entries');
    Route::any('bankacc','SearchController@addbank');
    Route::any('appayment','SearchController@ap_payment');
    Route::any('addtax','SearchController@add_tax');
    Route::any('completion-data','SearchController@completion_index');

    // 11-08-22 - Add by Shindi => Uom Conversion
    Route::any('uom-conversion','SearchController@uom_conversion');
    Route::any('uom-conversion-det','SearchController@uom_conversion_detail');

    //data_missExpense
    Route::any('data-missExpense','SearchController@data_missExpense');

    //data_sales X wo
    Route::any('data-sales','SearchController@data_sales');
    Route::any('bom-code','SearchController@bom_code');
    Route::any('bom-detail','SearchController@bom_detail');

    //RollID
    Route::any('getRollID','SearchController@get_roll_id');
    Route::any('storeRollID','StoreController@store_rollID');
    Route::any('phyupdate','StoreController@phyupdate');
    Route::any('updatebyid','StoreController@updatebyid');
    Route::any('RollDist','SearchController@get_roll_dist');
    Route::any('rollCounter','SearchController@roll_counter');

    //qm
    Route::any('qm_report','SearchController@qm_report');
    Route::any('qm_fg_report','SearchController@qm_fg_report');

    //jumbo roll search
    Route::any('data-jumboRoll','SearchController@data_roll');
    // rate 11-01-2023 syarifuddin
    Route::any('getRate','SearchController@get_rate');

    //asset
    Route::any('asset-category','SearchController@asset_category');

    Route::any('credit-memo','SearchController@credit_memo');

	 Route::any('search_wo', 'SearchController@search_wo');
	 Route::any('roll_detail', 'SearchController@roll_detail');
	 Route::any('fg_item', 'SearchController@fg_item');

    //  purchase report
    Route::any('purchase-report','SearchController@purchase_report');
    Route::any('vendor-data','SearchController@vendor_data');
    Route::any('site-data','SearchController@site_data');
    Route::any('auto-create','SearchController@auto_create');
    Route::any('ar-index','SearchController@ar_index');

    //remove ar tax
    Route::any('remove-ReceivableTax','StoreController@delete_ar_tax');
    Route::any('remove-PayableTax','StoreController@delete_ap_tax');

    //delivery closed
    Route::any('delivery-closed','SearchController@delivery_closed');

});

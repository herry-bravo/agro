<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AGRO POS — @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/components.css') }}">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f4f5f8; font-family: 'Segoe UI', sans-serif; overflow: hidden; }

        /* ===== TOPBAR (height: 50px) ===== */
        .pos-topbar {
            background: #1a1a2e;
            color: #fff;
            padding: 0 14px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 200;
            box-shadow: 0 2px 8px rgba(0,0,0,.3);
            gap: 10px;
        }
        .pos-topbar .brand { font-weight: 700; font-size: 1rem; letter-spacing: 1px; white-space: nowrap; }
        .pos-topbar .session-info { font-size: .78rem; color: #adb5bd; flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .pos-topbar .session-info strong { color: #fff; }
        .topbar-right { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .btn-switch-wh {
            background: #334155; border: 1px solid #475569; color: #94a3b8;
            padding: 4px 10px; border-radius: 6px; font-size: .75rem; cursor: pointer;
            white-space: nowrap; transition: all .15s;
        }
        .btn-switch-wh:hover { background: #475569; color: #fff; }
        .btn-switch-wh .wh-code { color: #38bdf8; font-weight: 700; margin-left: 4px; }
        .pos-topbar .btn-close-session {
            background: #dc3545; border: none; color: #fff;
            padding: 5px 12px; border-radius: 6px; font-size: .82rem; cursor: pointer;
            white-space: nowrap;
        }
        .pos-topbar .btn-close-session:hover { background: #c82333; }

        /* ===== MAIN WRAPPER (below topbar, fills rest of viewport) ===== */
        .pos-wrapper {
            display: flex;
            height: calc(100vh - 50px);
            margin-top: 50px;
        }

        /* ===== LEFT PANEL: Products ===== */
        .pos-left {
            flex: 0 0 62%;
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
            overflow: hidden;
        }
        .pos-search-bar {
            padding: 10px 12px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            flex-shrink: 0;
        }
        .pos-search-bar input {
            width: 100%;
            padding: 9px 14px;
            border: 1.5px solid #ced4da;
            border-radius: 8px;
            font-size: .9rem;
            outline: none;
        }
        .pos-search-bar input:focus { border-color: #4361ee; }

        .product-grid {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 8px;
            align-content: start;
        }
        .product-card {
            background: #fff;
            border: 1.5px solid #e9ecef;
            border-radius: 10px;
            padding: 10px 8px;
            cursor: pointer;
            transition: all .15s;
            text-align: center;
            user-select: none;
        }
        .product-card:hover { border-color: #4361ee; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(67,97,238,.15); }
        .product-card:active { transform: translateY(0); }
        .product-card .item-code { font-size: .68rem; color: #6c757d; margin-bottom: 3px; }
        .product-card .item-name { font-size: .82rem; font-weight: 600; color: #212529; line-height: 1.25; margin-bottom: 6px; }
        .product-card .item-price { font-size: .9rem; font-weight: 700; color: #4361ee; }
        .product-card .item-uom { font-size: .68rem; color: #adb5bd; }
        .product-card.no-result { grid-column: 1/-1; text-align: center; color: #adb5bd; padding: 40px; }

        /* ===== RIGHT PANEL: Cart ===== */
        .pos-right {
            flex: 0 0 38%;
            display: flex;
            flex-direction: column;
            background: #fff;
            overflow: hidden;   /* critical: clips nothing escapes */
        }

        /* Cart Header — fixed, 36px */
        .cart-header {
            flex-shrink: 0;
            padding: 9px 14px;
            background: #1a1a2e;
            color: #fff;
        }
        .cart-header h6 { margin: 0; font-size: .87rem; }

        /* Customer Row — fixed, ~48px */
        .customer-row {
            flex-shrink: 0;
            padding: 7px 12px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            position: relative;
        }

        /*
         * CART ITEMS — the hero element.
         * flex: 1 1 0 → grows to fill all available space, can shrink freely.
         * When checkout panel opens it takes some space, cart items gives it up gracefully.
         * min-height: 0 allows it to shrink as small as needed (flex will not go below 0px).
         */
        .cart-items {
            flex: 1 1 0;
            min-height: 0;
            overflow-y: auto;
        }
        /* Comfortable scrollbar */
        .cart-items::-webkit-scrollbar { width: 5px; }
        .cart-items::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        .cart-table { width: 100%; border-collapse: collapse; font-size: .8rem; }
        .cart-table thead th {
            background: #f8f9fa;
            padding: 6px 8px;
            border-bottom: 2px solid #dee2e6;
            color: #6c757d;
            font-weight: 600;
            position: sticky; top: 0; z-index: 1;
        }
        .cart-table tbody tr { border-bottom: 1px solid #f0f0f0; }
        .cart-table tbody tr:hover { background: #f8f9fa; }
        .cart-table td { padding: 6px 8px; vertical-align: middle; }
        .cart-table td.item-col { font-weight: 500; max-width: 110px; }
        .cart-table td.item-col small { display: block; color: #adb5bd; font-size: .7rem; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .qty-ctrl { display: flex; align-items: center; gap: 3px; }
        .qty-ctrl button {
            width: 22px; height: 22px; border: 1px solid #dee2e6; background: #fff;
            border-radius: 4px; cursor: pointer; font-size: .85rem; line-height: 1; padding: 0;
        }
        .qty-ctrl button:hover { background: #e9ecef; }
        .qty-ctrl input {
            width: 40px; text-align: center; border: 1px solid #dee2e6;
            border-radius: 4px; padding: 2px 3px; font-size: .8rem;
        }
        .btn-remove { background: none; border: none; color: #dc3545; cursor: pointer; padding: 2px 5px; font-size: .95rem; }
        .cart-empty { text-align: center; color: #adb5bd; padding: 30px 16px; font-size: .88rem; }

        /* ===== CHECKOUT TOGGLE BAR — always visible, fixed height ===== */
        .checkout-toggle-bar {
            flex-shrink: 0;
            padding: 7px 12px;
            background: #f1f5f9;
            border-top: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .total-quick { font-size: .92rem; font-weight: 700; color: #212529; }
        .total-quick small { display: block; font-size: .7rem; font-weight: 400; color: #64748b; }
        .btn-checkout-toggle {
            padding: 7px 16px;
            background: #198754;
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s;
            white-space: nowrap;
        }
        .btn-checkout-toggle:hover { background: #157347; }
        .checkout-open .btn-checkout-toggle { background: #475569; }
        .checkout-open .btn-checkout-toggle:hover { background: #334155; }

        /*
         * CHECKOUT PANEL — hidden by default, expands downward when toggled.
         *
         * flex-shrink: 0 → takes its full content height (doesn't compete with cart).
         * overflow-y: auto → scrolls internally if content exceeds max-height.
         * max-height: calc(...) → guarantees cart items always has at least 100px.
         *   Formula: 100vh - topbar(50) - cart-header(36) - customer-row(48)
         *            - toggle-bar(43) - min-cart-visible(100) = 100vh - 277px
         */
        .checkout-panel {
            display: none;
            flex-direction: column;
            flex-shrink: 0;
            overflow-y: auto;
            overflow-x: hidden;
            max-height: calc(100vh - 277px);
        }
        .checkout-panel::-webkit-scrollbar { width: 5px; }
        .checkout-panel::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .checkout-open .checkout-panel { display: flex; }

        /* PPN Toggle */
        .ppn-toggle-row {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 14px;
            background: #fffbeb;
            border-top: 1px solid #fcd34d;
            border-bottom: 1px solid #fcd34d;
            font-size: .78rem;
        }
        .ppn-toggle-row label { margin: 0; font-weight: 600; color: #92400e; cursor: pointer; display: flex; align-items: center; gap: 5px; }
        .ppn-badge {
            font-size: .68rem; font-weight: 700; padding: 2px 7px; border-radius: 20px;
            background: #198754; color: #fff; transition: background .15s;
        }
        .ppn-badge.off { background: #6c757d; }

        /* Totals */
        .cart-totals {
            flex-shrink: 0;
            padding: 7px 14px;
            background: #f8f9fa;
            border-bottom: 1px solid #e2e8f0;
        }
        .totals-row { display: flex; justify-content: space-between; font-size: .8rem; margin-bottom: 2px; color: #495057; }
        .totals-row.grand { font-size: .96rem; font-weight: 700; color: #0f172a; border-top: 1px solid #dee2e6; padding-top: 4px; margin-top: 3px; }
        .totals-row.tax-row { color: #6c757d; }
        .totals-row.tax-row.hidden { display: none; }

        /* Payment Section */
        .payment-section {
            flex-shrink: 0;
            padding: 9px 12px 10px;
            background: #fff;
        }
        .pay-method-tabs { display: flex; gap: 6px; margin-bottom: 7px; }
        .pay-tab {
            flex: 1; padding: 5px; border: 2px solid #dee2e6; background: #fff;
            border-radius: 7px; font-size: .8rem; cursor: pointer; font-weight: 600;
            transition: all .15s; text-align: center;
        }
        .pay-tab.active { border-color: #4361ee; background: #4361ee; color: #fff; }

        .transfer-ref { margin-bottom: 6px; }
        .transfer-ref input {
            width: 100%; padding: 6px 10px; border: 1.5px solid #ced4da;
            border-radius: 7px; font-size: .82rem;
        }

        /* Amount + Discount side by side */
        .pay-inputs-row { display: flex; gap: 6px; margin-bottom: 5px; }
        .pay-inputs-row input {
            flex: 1; padding: 7px 9px; border: 1.5px solid #ced4da;
            border-radius: 7px; font-size: .88rem; text-align: right;
        }
        .pay-inputs-row input:focus { border-color: #4361ee; outline: none; }
        .pay-inputs-row .input-label {
            font-size: .68rem; color: #94a3b8; display: block; margin-bottom: 2px;
        }

        .change-row {
            display: flex; justify-content: space-between;
            font-size: .86rem; font-weight: 700; margin-bottom: 8px;
            padding: 4px 0;
            color: #059669;
            border-top: 1px dashed #e2e8f0;
        }
        .btn-process {
            width: 100%; padding: 11px; font-size: .92rem; font-weight: 700;
            background: #16a34a; color: #fff; border: none; border-radius: 9px;
            cursor: pointer; transition: background .15s; letter-spacing: .3px;
        }
        .btn-process:hover { background: #15803d; }
        .btn-process:disabled { background: #94a3b8; cursor: not-allowed; }

        /* ===== RECEIPT MODAL ===== */
        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.5); z-index: 500;
            align-items: center; justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .receipt-modal {
            background: #fff; border-radius: 12px; padding: 22px;
            width: 360px; max-height: 90vh; overflow-y: auto;
            box-shadow: 0 8px 32px rgba(0,0,0,.2);
        }
        .receipt-modal .receipt-header { text-align: center; margin-bottom: 12px; }
        .receipt-modal .receipt-header h5 { margin: 0 0 3px; }
        .receipt-table { width: 100%; font-size: .82rem; border-collapse: collapse; }
        .receipt-table td { padding: 3px 0; }
        .receipt-table td:last-child { text-align: right; }
        .receipt-divider { border: none; border-top: 1px dashed #dee2e6; margin: 8px 0; }
        .btn-new-trx {
            width: 100%; padding: 10px; background: #4361ee; color: #fff;
            border: none; border-radius: 8px; font-size: .9rem; cursor: pointer; margin-top: 10px;
        }
        .btn-new-trx:hover { background: #3451d1; }

        /* ===== WAREHOUSE MODAL ===== */
        .wh-modal-backdrop {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.5); z-index: 600;
            align-items: center; justify-content: center;
        }
        .wh-modal-backdrop.show { display: flex; }
        .wh-modal {
            background: #fff; border-radius: 12px; padding: 22px 24px;
            width: 340px; box-shadow: 0 8px 32px rgba(0,0,0,.25);
        }
        .wh-modal h6 { margin: 0 0 14px; font-size: .95rem; font-weight: 700; color: #1a1a2e; }
        .wh-modal select {
            width: 100%; padding: 9px 12px; border: 1.5px solid #ced4da;
            border-radius: 8px; font-size: .9rem; margin-bottom: 14px;
            background: #fff;
        }
        .wh-modal .btn-wh-save {
            width: 100%; padding: 10px; background: #198754; color: #fff;
            border: none; border-radius: 8px; font-size: .9rem; font-weight: 700; cursor: pointer;
        }
        .wh-modal .btn-wh-cancel {
            width: 100%; padding: 9px; background: #fff; color: #6c757d;
            border: 1px solid #dee2e6; border-radius: 8px; font-size: .88rem; cursor: pointer; margin-top: 6px;
        }
    </style>
    @yield('styles')
</head>
<body>
    @yield('content')

    <script src="{{ asset('app-assets/js/scripts/jquery.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

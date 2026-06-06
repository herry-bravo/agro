@extends('layouts.pos')

@section('title', $session->session_number)

@section('styles')
<style>
.item-stock { font-size: .7rem; margin-top: 3px; font-weight: 600; }
.item-stock.in-stock  { color: #198754; }
.item-stock.low-stock { color: #f59e0b; }
.item-stock.no-stock  { color: #dc3545; }
.product-card.no-stock-card { opacity: .45; cursor: not-allowed; }
.product-card.no-stock-card:hover { border-color: #e9ecef; transform: none; box-shadow: none; }

.btn-print-receipt {
    width: 100%; padding: 10px; font-size: .88rem; font-weight: 600;
    background: #fff; color: #1a1a2e; border: 2px solid #1a1a2e;
    border-radius: 8px; cursor: pointer; margin-bottom: 8px;
    transition: background .15s;
}
.btn-print-receipt:hover { background: #f0f0f0; }
</style>
@endsection

@section('content')
{{-- TOP BAR --}}
<div class="pos-topbar">
    <div class="brand">&#9632; AGRO POS</div>
    <div class="session-info">
        <strong>{{ $session->session_number }}</strong> &nbsp;|&nbsp;
        <strong>{{ Auth::user()->name }}</strong> &nbsp;|&nbsp;
        {{ now()->format('d M Y') }}
    </div>
    <div class="topbar-right">
        <button class="btn-switch-wh" onclick="openWhModal()">
            &#128465; Gudang: <span class="wh-code" id="whCodeLabel">{{ $session->subinventory_code ?? '—' }}</span>
        </button>
        <button class="btn-close-session" data-bs-toggle="modal" data-bs-target="#modalClose">
            Close Session
        </button>
    </div>
</div>

<div class="pos-wrapper" id="posWrapper">

    {{-- LEFT: PRODUCTS --}}
    <div class="pos-left">
        <div class="pos-search-bar">
            <input type="text" id="itemSearch" placeholder="&#128269; Search product by code or name...">
        </div>
        <div class="product-grid" id="productGrid">
            <div class="product-card no-result">
                <p>Loading products...</p>
            </div>
        </div>
    </div>

    {{-- RIGHT: CART --}}
    <div class="pos-right" id="cartPanel">
        <div class="cart-header">
            <h6>&#128722; Shopping Cart &nbsp;<span id="cartCount" style="font-size:.75rem;opacity:.75;"></span></h6>
        </div>

        {{-- Customer Search --}}
        <div class="customer-row">
            <div style="display:flex;gap:6px;align-items:center;">
                <div style="position:relative;flex:1;">
                    <input type="text" id="customerSearch"
                           placeholder="&#128100; Search customer (name / code)..."
                           autocomplete="off"
                           oninput="searchCustomer(this.value)"
                           onfocus="if(this.value.length>=2) showDropdown()"
                           style="width:100%;padding:6px 30px 6px 9px;border:1.5px solid #e2e8f0;border-radius:7px;font-size:.8rem;">
                    <span id="custClearBtn" onclick="clearCustomer()"
                          style="display:none;position:absolute;right:7px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:.95rem;line-height:1;">&#10005;</span>
                </div>
                <button type="button" onclick="setWalkIn()"
                        id="walkInBtn"
                        style="padding:6px 10px;background:#f1f5f9;border:1.5px solid #e2e8f0;border-radius:7px;font-size:.76rem;color:#475569;white-space:nowrap;cursor:pointer;">
                    Walk-in
                </button>
            </div>
            <div id="custSelected"
                 style="display:none;margin-top:4px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:6px;padding:4px 9px;font-size:.76rem;color:#065f46;">
                <strong id="custSelectedName"></strong>
                <span id="custSelectedCode" style="color:#6b7280;margin-left:5px;"></span>
            </div>
        </div>
        <input type="hidden" id="customerId" value="">
        <input type="hidden" id="customerName" value="">

        {{-- Cart Items (grows to fill remaining space) --}}
        <div class="cart-items">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cartBody">
                    <tr id="emptyCart">
                        <td colspan="5">
                            <div class="cart-empty">Cart is empty.<br>Select a product from the left panel.</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Checkout Toggle Bar (always visible) --}}
        <div class="checkout-toggle-bar">
            <div class="total-quick">
                <small>TOTAL</small>
                <span id="quickTotal">Rp 0</span>
            </div>
            <button class="btn-checkout-toggle" id="btnCheckoutToggle" onclick="toggleCheckout()">
                &#9654; Checkout
            </button>
        </div>

        {{-- Checkout Panel (hidden until toggle) --}}
        <div class="checkout-panel" id="checkoutPanel">

            {{-- PPN Toggle --}}
            <div class="ppn-toggle-row">
                <label for="usePPN">
                    <input type="checkbox" id="usePPN" checked onchange="togglePPN()">
                    Apply VAT
                </label>
                <span class="ppn-badge" id="ppnBadge">PPN 11% ON</span>
            </div>

            <div class="cart-totals">
                <div class="totals-row">
                    <span>Subtotal (DPP)</span>
                    <span id="dispSubtotal">Rp 0</span>
                </div>
                <div class="totals-row tax-row" id="rowTax">
                    <span>PPN 11%</span>
                    <span id="dispTax">Rp 0</span>
                </div>
                <div class="totals-row grand">
                    <span>TOTAL</span>
                    <span id="dispTotal">Rp 0</span>
                </div>
            </div>

            <div class="payment-section">
                <div class="pay-method-tabs">
                    <div class="pay-tab active" id="tabCash" onclick="setPayMethod('cash')">&#128181; Cash</div>
                    <div class="pay-tab" id="tabTransfer" onclick="setPayMethod('transfer')">&#128196; Transfer</div>
                </div>

                <div id="refRow" class="transfer-ref" style="display:none;">
                    <input type="text" id="transferRef" placeholder="Reference No. / Transfer Proof">
                </div>

                <div class="pay-inputs-row">
                    <div style="flex:1;">
                        <span class="input-label">Amount Paid</span>
                        <input type="number" id="amountPaid" placeholder="0" min="0" step="1000" oninput="calcChange()">
                    </div>
                    <div style="flex:0 0 110px;">
                        <span class="input-label">Discount</span>
                        <input type="number" id="discountAmount" placeholder="0" min="0" step="1000" oninput="calcChange()">
                    </div>
                </div>
                <div class="change-row">
                    <span>Change</span>
                    <span id="dispChange">Rp 0</span>
                </div>

                <button class="btn-process" id="btnProcess" onclick="processPayment()">
                    &#9654; PROCESS PAYMENT
                </button>
            </div>
        </div>{{-- /checkout-panel --}}

    </div>{{-- /pos-right --}}
</div>{{-- /pos-wrapper --}}

{{-- Customer Dropdown — di luar pos-wrapper agar position:fixed tidak terpotong overflow:hidden --}}
<div id="custDropdown"
     style="display:none;position:fixed;z-index:10000;background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;box-shadow:0 8px 28px rgba(0,0,0,.18);max-height:240px;overflow-y:auto;min-width:200px;">
    <div id="custDropdownList"></div>
</div>

{{-- RECEIPT MODAL --}}
<div class="modal-overlay" id="receiptOverlay">
    <div class="receipt-modal">
        <div id="printArea">
            <div class="receipt-header">
                <h5>AGRO POS</h5>
                <small id="rcptDate"></small>
                <small id="rcptSession" style="color:#888;"></small>
                <small id="rcptCashier" style="color:#555;"></small>
            </div>
            <hr class="receipt-divider">
            <table class="receipt-table">
                <tbody id="rcptLines"></tbody>
            </table>
            <hr class="receipt-divider">
            <table class="receipt-table">
                <tr><td>Subtotal (DPP)</td><td id="rcptSubtotal"></td></tr>
                <tr id="rcptTaxRow"><td>PPN 11%</td><td id="rcptTax"></td></tr>
                <tr><td><strong>TOTAL</strong></td><td id="rcptTotal"></td></tr>
                <tr id="rcptDiscRow" style="display:none;"><td>Discount</td><td id="rcptDiscount" style="color:#dc3545;"></td></tr>
                <tr><td>Paid</td><td id="rcptPaid"></td></tr>
                <tr><td>Change</td><td id="rcptChange"></td></tr>
            </table>
            <hr class="receipt-divider">
            <small id="rcptSO" class="text-muted"></small><br>
            <small id="rcptPPN" style="color:#888;"></small>
        </div>

        <div class="no-print" style="margin-top:12px;">
            <button class="btn-print-receipt" onclick="printReceipt()">&#128438; Print Receipt</button>
            <button class="btn-new-trx" onclick="newTransaction()">+ New Transaction</button>
        </div>
    </div>
</div>

{{-- WAREHOUSE MODAL --}}
<div class="wh-modal-backdrop" id="whModalBackdrop">
    <div class="wh-modal">
        <h6>&#128339; Change Warehouse</h6>
        <select id="whSelect">
            @foreach($subinventories as $sub)
                <option value="{{ $sub->sub_inventory_name }}"
                    {{ $session->subinventory_code == $sub->sub_inventory_name ? 'selected' : '' }}>
                    {{ $sub->sub_inventory_name }}{{ $sub->description ? ' — ' . $sub->description : '' }}
                </option>
            @endforeach
        </select>
        <button class="btn-wh-save" onclick="saveWarehouse()">&#10003; Apply & Reload Products</button>
        <button class="btn-wh-cancel" onclick="closeWhModal()">Cancel</button>
    </div>
</div>

{{-- CLOSE SESSION MODAL --}}
@php $openedToday = \Carbon\Carbon::parse($session->opened_at)->isToday(); @endphp
<div class="modal fade" id="modalClose" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ route('admin.pos.close', $session->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header {{ $openedToday ? 'bg-warning' : 'bg-danger' }} text-white">
                    <h6 class="modal-title mb-0" style="{{ $openedToday ? 'color:#1a1a2e;' : '' }}">
                        Close Session {{ $session->session_number }}
                    </h6>
                    <button type="button" class="btn-close {{ $openedToday ? '' : 'btn-close-white' }}" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if($openedToday)
                        <div style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:10px;padding:12px 14px;margin-bottom:10px;">
                            <div style="font-weight:700;color:#92400e;font-size:.88rem;margin-bottom:4px;">
                                &#9888; Session Cannot Be Closed Yet
                            </div>
                            <div style="color:#78350f;font-size:.8rem;line-height:1.5;">
                                This session was opened today
                                <strong>({{ \Carbon\Carbon::parse($session->opened_at)->format('d M Y') }})</strong>.<br>
                                Sessions can only be closed <strong>the next day</strong>.
                            </div>
                        </div>
                        <p class="text-muted small mb-0" style="font-size:.78rem;">
                            You can still process transactions in this session until end of day.
                        </p>
                    @else
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:10px 12px;margin-bottom:10px;font-size:.82rem;color:#7f1d1d;">
                            All transactions in this session will be locked after closing.
                        </div>
                        <div class="form-group mb-0">
                            <label style="font-size:.82rem;font-weight:600;color:#475569;">Closing Cash (Rp)</label>
                            <input type="number" name="closing_cash" class="form-control form-control-sm mb-2"
                                   placeholder="0" min="0" style="border-radius:8px;">
                            <label style="font-size:.82rem;font-weight:600;color:#475569;">Notes</label>
                            <textarea name="notes" class="form-control form-control-sm" rows="2"
                                      placeholder="Optional..." style="border-radius:8px;resize:none;"></textarea>
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        {{ $openedToday ? 'Close' : 'Cancel' }}
                    </button>
                    @if(!$openedToday)
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i data-feather="x-circle" style="width:13px;height:13px;" class="mr-1"></i>
                            Close Session
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@if($sessionExpired)
<div id="sessionExpiredBanner" style="position:fixed;bottom:0;left:0;right:0;background:#dc3545;color:#fff;text-align:center;padding:10px 16px;font-size:.88rem;font-weight:600;letter-spacing:.02em;z-index:9999;">
    &#9888; Session expired &mdash; please close this session and open a new session.
</div>
@endif

@endsection

@push('scripts')
<script>
const SESSION_ID      = {{ $session->id }};
const CSRF            = document.querySelector('meta[name=csrf-token]').content;
const TAX_RATE        = 11;
const SESSION_NUM     = '{{ $session->session_number }}';
const CASHIER_NAME    = '{{ Auth::user()->name }}';
const WH_SWITCH_URL   = '/admin/pos/session/' + SESSION_ID + '/warehouse';
const SESSION_EXPIRED = {{ $sessionExpired ? 'true' : 'false' }};

let cart        = [];
let payMethod   = 'cash';
let usePPN      = true;
let allProducts = [];
let searchTimer = null;
let checkoutOpen = false;

/* ===== CHECKOUT TOGGLE ===== */
function toggleCheckout() {
    checkoutOpen = !checkoutOpen;
    const wrapper  = document.getElementById('posWrapper');
    const cartPanel = document.getElementById('cartPanel');
    const btn      = document.getElementById('btnCheckoutToggle');

    if (checkoutOpen) {
        cartPanel.classList.add('checkout-open');
        btn.innerHTML = '&#10005; Close';
    } else {
        cartPanel.classList.remove('checkout-open');
        btn.innerHTML = '&#9654; Checkout';
    }
}

/* ===== PPN TOGGLE ===== */
function togglePPN() {
    usePPN = document.getElementById('usePPN').checked;
    const badge = document.getElementById('ppnBadge');
    badge.textContent = usePPN ? 'PPN 11% ON' : 'Non-PPN';
    badge.className   = 'ppn-badge' + (usePPN ? '' : ' off');
    document.getElementById('rowTax').classList.toggle('hidden', !usePPN);
    updateTotals();
}

/* ===== WAREHOUSE MODAL ===== */
function openWhModal() {
    document.getElementById('whModalBackdrop').classList.add('show');
}
function closeWhModal() {
    document.getElementById('whModalBackdrop').classList.remove('show');
}

function saveWarehouse() {
    const code = document.getElementById('whSelect').value;
    if (!code) return;

    const btn = document.querySelector('.btn-wh-save');
    btn.disabled = true;
    btn.textContent = 'Saving...';

    fetch(WH_SWITCH_URL, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ subinventory_code: code }),
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = '&#10003; Apply & Reload Products';
        if (res.success) {
            document.getElementById('whCodeLabel').textContent = code;
            closeWhModal();
            // Reload product grid with new warehouse's stock
            initProducts();
        } else {
            alert('Failed: ' + (res.message || 'Unknown error'));
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = '&#10003; Apply & Reload Products';
        alert('Error: ' + err.message);
    });
}

// Close warehouse modal on backdrop click
document.getElementById('whModalBackdrop').addEventListener('click', function(e) {
    if (e.target === this) closeWhModal();
});

/* ===== PRODUCTS ===== */
function initProducts() {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = '<div class="product-card no-result"><p>Loading products...</p></div>';

    fetch(`/admin/pos/items?session_id=${SESSION_ID}`)
        .then(r => r.json())
        .then(items => {
            allProducts = items;
            renderGrid(allProducts);
        })
        .catch(() => {
            grid.innerHTML = '<div class="product-card no-result"><p>Failed to load products.</p></div>';
        });
}

function filterProducts(term) {
    if (!term) { renderGrid(allProducts); return; }
    const q = term.toLowerCase();
    renderGrid(allProducts.filter(i =>
        i.item_code.toLowerCase().includes(q) ||
        i.description.toLowerCase().includes(q)
    ));
}

function deductLocalStock(soldItems) {
    soldItems.forEach(sold => {
        const p = allProducts.find(i => i.inventory_item_id == sold.inventory_item_id);
        if (p && p.stock_qty !== null) {
            p.stock_qty = Math.max(0, p.stock_qty - sold.quantity);
        }
    });
}

function buildCard(item) {
    const stock   = item.stock_qty;
    const noStock = stock !== null && stock !== undefined && stock <= 0;
    let stockHtml = '';
    let cardClass = 'product-card';
    let clickAttr = `onclick='addToCart(${JSON.stringify(item).replace(/'/g, "&#39;")})'`;

    if (stock !== null && stock !== undefined) {
        const qty = Math.floor(stock);
        if (qty > 10) {
            stockHtml = `<div class="item-stock in-stock">Stock: ${qty}</div>`;
        } else if (qty > 0) {
            stockHtml = `<div class="item-stock low-stock">&#9888; Stock: ${qty}</div>`;
        } else {
            stockHtml  = `<div class="item-stock no-stock">Out of Stock</div>`;
            cardClass += ' no-stock-card';
            clickAttr  = '';
        }
    }

    return `<div class="${cardClass}" ${clickAttr}>${
        `<div class="item-code">${item.item_code}</div>` +
        `<div class="item-name">${item.description}</div>` +
        `<div class="item-price">Rp ${fmtNum(item.item_cost ?? 0)}</div>` +
        `<div class="item-uom">${item.primary_uom_code ?? ''}</div>` +
        stockHtml
    }</div>`;
}

function renderGrid(items) {
    const grid = document.getElementById('productGrid');
    if (!items.length) {
        grid.innerHTML = '<div class="product-card no-result"><p>No products found.</p></div>';
        return;
    }
    grid.innerHTML = items.map(buildCard).join('');
}

/* ===== CART ===== */
function addToCart(item) {
    const idx = cart.findIndex(c => c.inventory_item_id == item.inventory_item_id);
    if (idx >= 0) {
        cart[idx].quantity += 1;
    } else {
        cart.push({
            inventory_item_id: item.inventory_item_id,
            item_code:         item.item_code,
            item_description:  item.description,
            uom:               item.primary_uom_code ?? 'PCS',
            unit_price:        parseFloat(item.item_cost ?? 0),
            discount:          0,
            quantity:          1,
        });
    }
    renderCart();
}

function removeFromCart(idx) {
    cart.splice(idx, 1);
    renderCart();
}

function updateQty(idx, val) {
    const qty = parseFloat(val);
    if (qty <= 0) { removeFromCart(idx); return; }
    cart[idx].quantity = qty;
    renderCart();
}

function updatePrice(idx, val) {
    const price = parseFloat(val);
    if (isNaN(price) || price < 0) return;
    cart[idx].unit_price = price;
    renderCart();
}

function renderCart() {
    const tbody = document.getElementById('cartBody');
    const countEl = document.getElementById('cartCount');

    if (!cart.length) {
        tbody.innerHTML = `<tr id="emptyCart"><td colspan="5">
            <div class="cart-empty">Cart is empty.<br>Select a product from the left panel.</div>
        </td></tr>`;
        countEl.textContent = '';
        updateTotals();
        return;
    }

    const totalQty = cart.reduce((s, c) => s + c.quantity, 0);
    countEl.textContent = `(${cart.length} item${cart.length > 1 ? 's' : ''}, qty: ${totalQty})`;

    tbody.innerHTML = cart.map((c, i) => {
        const lineTotal = (c.quantity * c.unit_price) - c.discount;
        return `<tr>
            <td class="item-col">${c.item_description}<small>${c.item_code}</small></td>
            <td>
                <div class="qty-ctrl">
                    <button onclick="updateQty(${i}, ${c.quantity - 1})">−</button>
                    <input type="number" value="${c.quantity}" min="0.01" step="1"
                           onchange="updateQty(${i}, this.value)" style="width:40px;">
                    <button onclick="updateQty(${i}, ${c.quantity + 1})">+</button>
                </div>
            </td>
            <td>
                <input type="number" value="${c.unit_price}" min="0" step="1"
                       onchange="updatePrice(${i}, this.value)"
                       style="width:86px;text-align:right;border:1px solid #dee2e6;border-radius:4px;padding:3px 5px;font-size:.78rem;">
            </td>
            <td class="text-right"><strong>Rp ${fmtNum(lineTotal)}</strong></td>
            <td><button class="btn-remove" onclick="removeFromCart(${i})">&#128465;</button></td>
        </tr>`;
    }).join('');
    updateTotals();
}

function calcGrandTotal() {
    let total = 0;
    cart.forEach(c => { total += (c.quantity * c.unit_price) - c.discount; });
    return total;
}

function updateTotals() {
    const total   = calcGrandTotal();
    const taxMult = 1 + TAX_RATE / 100;
    let untax, tax;

    if (usePPN) {
        untax = total / taxMult;
        tax   = total - untax;
    } else {
        untax = total;
        tax   = 0;
    }

    document.getElementById('dispSubtotal').textContent = 'Rp ' + fmtNum(untax);
    document.getElementById('dispTax').textContent      = 'Rp ' + fmtNum(tax);
    document.getElementById('dispTotal').textContent    = 'Rp ' + fmtNum(total);
    document.getElementById('quickTotal').textContent   = 'Rp ' + fmtNum(total);
    calcChange();
}

function calcChange() {
    const total    = calcGrandTotal();
    const discount = parseFloat(document.getElementById('discountAmount').value) || 0;
    const effective = Math.max(0, total - discount);
    const paid     = parseFloat(document.getElementById('amountPaid').value) || 0;
    const change   = Math.max(0, paid - effective);
    document.getElementById('dispChange').textContent = 'Rp ' + fmtNum(change);
}

/* ===== PAYMENT ===== */
function setPayMethod(method) {
    payMethod = method;
    document.getElementById('tabCash').classList.toggle('active', method === 'cash');
    document.getElementById('tabTransfer').classList.toggle('active', method === 'transfer');
    document.getElementById('refRow').style.display = method === 'transfer' ? 'block' : 'none';
    if (method === 'cash') document.getElementById('transferRef').value = '';
}

function processPayment() {
    if (SESSION_EXPIRED) {
        alert('Session expired. Please close this session and open a new session.');
        return;
    }
    if (!cart.length) { alert('Cart is empty!'); return; }

    const total    = calcGrandTotal();
    const discount = parseFloat(document.getElementById('discountAmount').value) || 0;
    const effective = Math.max(0, total - discount);
    const paid     = parseFloat(document.getElementById('amountPaid').value) || 0;

    if (payMethod === 'cash' && paid < effective) {
        alert('Amount paid is less than total after discount!'); return;
    }
    if (payMethod === 'transfer' && paid <= 0) {
        alert('Please enter transfer amount!'); return;
    }

    const btn = document.getElementById('btnProcess');
    btn.disabled    = true;
    btn.textContent = 'Processing...';

    const payload = {
        session_id:      SESSION_ID,
        customer_id:     document.getElementById('customerId').value || null,
        customer_name:   document.getElementById('customerName').value || '',
        use_ppn:         usePPN,
        discount_amount: discount,
        items:           cart,
        payments:        [{
            method:    payMethod,
            amount:    paid,
            reference: document.getElementById('transferRef').value || '',
        }],
    };

    fetch('/admin/pos/process', {
        method:  'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body:    JSON.stringify(payload),
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled    = false;
        btn.textContent = '▶ PROCESS PAYMENT';
        if (res.success) {
            showReceipt(res, payload, total, paid);
        } else {
            alert('Failed: ' + res.message);
        }
    })
    .catch(err => {
        btn.disabled    = false;
        btn.textContent = '▶ PROCESS PAYMENT';
        alert('Error: ' + err.message);
    });
}

function showReceipt(res, payload, total, paid) {
    const taxMult  = 1 + TAX_RATE / 100;
    const untax    = usePPN ? total / taxMult : total;
    const tax      = usePPN ? total - untax   : 0;
    const discount = payload.discount_amount || 0;
    const effective = Math.max(0, total - discount);
    const change   = Math.max(0, paid - effective);

    document.getElementById('rcptDate').textContent     = new Date().toLocaleString('id-ID');
    document.getElementById('rcptSession').textContent  = SESSION_NUM;
    document.getElementById('rcptCashier').textContent  = 'Cashier: ' + CASHIER_NAME;
    document.getElementById('rcptLines').innerHTML     = payload.items.map(item => {
        const lt = (item.quantity * item.unit_price) - (item.discount || 0);
        return `<tr>
            <td>${item.item_description}<br><small>${item.quantity} &times; Rp ${fmtNum(item.unit_price)}</small></td>
            <td>Rp ${fmtNum(lt)}</td>
        </tr>`;
    }).join('');

    document.getElementById('rcptSubtotal').textContent    = 'Rp ' + fmtNum(untax);
    document.getElementById('rcptTax').textContent         = 'Rp ' + fmtNum(tax);
    document.getElementById('rcptTotal').textContent       = 'Rp ' + fmtNum(total);
    document.getElementById('rcptDiscount').textContent    = '- Rp ' + fmtNum(discount);
    document.getElementById('rcptDiscRow').style.display   = discount > 0 ? '' : 'none';
    document.getElementById('rcptPaid').textContent        = 'Rp ' + fmtNum(paid);
    document.getElementById('rcptChange').textContent      = 'Rp ' + fmtNum(change);
    document.getElementById('rcptTaxRow').style.display    = usePPN ? '' : 'none';
    document.getElementById('rcptSO').textContent          = 'SO: ' + res.so_number + ' | INV: ' + res.order_number;
    document.getElementById('rcptPPN').textContent         = usePPN ? 'Includes VAT 11%' : 'No VAT';

    document.getElementById('receiptOverlay').classList.add('show');
}

function newTransaction() {
    deductLocalStock(cart);
    document.getElementById('receiptOverlay').classList.remove('show');
    cart = [];
    clearCustomer();
    document.getElementById('amountPaid').value     = '';
    document.getElementById('discountAmount').value = '';
    document.getElementById('transferRef').value    = '';
    // Close checkout panel after new transaction
    if (checkoutOpen) toggleCheckout();
    renderCart();
    filterProducts(document.getElementById('itemSearch').value);
}

/* ===== CUSTOMER SEARCH ===== */
let custTimer = null;

function searchCustomer(val) {
    clearTimeout(custTimer);
    const trimmed = val.trim();

    if (trimmed.length < 2) {
        hideDropdown();
        if (trimmed.length === 0) {
            document.getElementById('customerId').value   = '';
            document.getElementById('customerName').value = '';
            document.getElementById('custSelected').style.display = 'none';
        }
        return;
    }

    custTimer = setTimeout(() => {
        fetch(`/admin/pos/customers?q=${encodeURIComponent(trimmed)}`, {
            headers: { 'X-CSRF-TOKEN': CSRF }
        })
        .then(r => r.json())
        .then(data => renderDropdown(data))
        .catch(() => {});
    }, 250);
}

function renderDropdown(customers) {
    const list = document.getElementById('custDropdownList');
    if (!customers.length) {
        list.innerHTML = '<div style="padding:9px 13px;color:#94a3b8;font-size:.78rem;">No customer found.</div>';
    } else {
        list.innerHTML = customers.map(c => `
            <div onclick="selectCustomer(${c.id}, '${escStr(c.party_name)}', '${escStr(c.cust_party_code)}')"
                 style="padding:8px 13px;cursor:pointer;font-size:.8rem;border-bottom:1px solid #f1f5f9;transition:background .1s;"
                 onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background=''">
                <div style="font-weight:700;color:#1e293b;">${c.party_name}</div>
                <div style="color:#64748b;font-size:.74rem;">${c.cust_party_code}${c.city ? ' — ' + c.city : ''}</div>
            </div>`).join('');
    }
    showDropdown();
}

function selectCustomer(id, name, code) {
    document.getElementById('customerId').value   = id;
    document.getElementById('customerName').value = name;
    document.getElementById('customerSearch').value = name;
    document.getElementById('custSelectedName').textContent = name;
    document.getElementById('custSelectedCode').textContent = '(' + code + ')';
    document.getElementById('custSelected').style.display  = 'block';
    document.getElementById('custClearBtn').style.display  = 'inline';
    hideDropdown();
}

function clearCustomer() {
    document.getElementById('customerId').value   = '';
    document.getElementById('customerName').value = '';
    document.getElementById('customerSearch').value = '';
    document.getElementById('custSelected').style.display  = 'none';
    document.getElementById('custClearBtn').style.display  = 'none';
    hideDropdown();
}

function setWalkIn() {
    document.getElementById('customerId').value   = '';
    document.getElementById('customerName').value = 'Walk-in Customer';
    document.getElementById('customerSearch').value = 'Walk-in Customer';
    document.getElementById('custSelectedName').textContent = 'Walk-in Customer';
    document.getElementById('custSelectedCode').textContent = '';
    document.getElementById('custSelected').style.display  = 'block';
    document.getElementById('custClearBtn').style.display  = 'inline';
    hideDropdown();
}

function showDropdown() {
    const input    = document.getElementById('customerSearch');
    const dropdown = document.getElementById('custDropdown');
    const rect     = input.getBoundingClientRect();

    // Lebar mengikuti input field
    dropdown.style.left  = rect.left + 'px';
    dropdown.style.width = rect.width + 'px';

    // Perkirakan tinggi dropdown (max 240px)
    const spaceBelow = window.innerHeight - rect.bottom - 8;
    const spaceAbove = rect.top - 8;
    const dropH      = 240;

    if (spaceBelow >= 100 || spaceBelow >= spaceAbove) {
        // Tampil ke bawah (normal)
        dropdown.style.top    = (rect.bottom + 3) + 'px';
        dropdown.style.bottom = 'auto';
        dropdown.style.maxHeight = Math.max(100, spaceBelow) + 'px';
    } else {
        // Flip ke atas jika ruang bawah lebih sempit
        dropdown.style.top    = 'auto';
        dropdown.style.bottom = (window.innerHeight - rect.top + 3) + 'px';
        dropdown.style.maxHeight = Math.max(100, spaceAbove) + 'px';
    }

    dropdown.style.display = 'block';
}

function hideDropdown() {
    document.getElementById('custDropdown').style.display = 'none';
}

function escStr(s) { return (s||'').replace(/'/g, "\\'").replace(/"/g, '&quot;'); }

document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('custDropdown');
    const row      = document.querySelector('.customer-row');
    if (!row.contains(e.target) && !dropdown.contains(e.target)) hideDropdown();
});

/* ===== UTILS ===== */
function fmtNum(n) {
    return Math.round(parseFloat(n || 0)).toLocaleString('id-ID');
}

/* ===== INIT ===== */
document.getElementById('itemSearch').addEventListener('input', function () {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => filterProducts(this.value), 200);
});

initProducts();
</script>
<script src="{{ asset('js/pos-print.js') }}"></script>
@endpush

@extends('layouts.admin')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Point of Sale</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">POS Sessions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-feather="check-circle" class="mr-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i data-feather="alert-circle" class="mr-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Hero Card --}}
    <div class="row">
        <div class="col-12 mb-2">

            {{-- Banner: ada sesi aktif — semua kasir bisa masuk --}}
            @if($anyOpenSession)
            <div class="alert border-0 mb-2 py-3 px-4 d-flex align-items-center justify-content-between flex-wrap gap-2"
                 style="background:linear-gradient(135deg,#065f46,#047857);border-radius:12px;color:#fff;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:44px;height:44px;background:rgba(255,255,255,.15);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;animation:pulse 1.8s infinite;">
                        &#9654;
                    </div>
                    <div>
                        <div class="fw-bold" style="font-size:.95rem;">
                            Active Session: <strong>{{ $anyOpenSession->session_number }}</strong>
                            &nbsp;
                            <span style="background:rgba(255,255,255,.2);border-radius:20px;padding:2px 10px;font-size:.75rem;font-weight:600;">LIVE</span>
                        </div>
                        <div style="font-size:.8rem;opacity:.85;margin-top:2px;">
                            Opened by: <strong>{{ $anyOpenSession->cashier->name ?? '-' }}</strong>
                            &nbsp;|&nbsp; Location: <strong>{{ $anyOpenSession->subinventory_code ?? '-' }}</strong>
                            &nbsp;|&nbsp; {{ \Carbon\Carbon::parse($anyOpenSession->opened_at)->format('d M Y H:i') }}
                        </div>
                        <div style="font-size:.76rem;opacity:.7;margin-top:2px;">
                            All cashiers can process transactions in this session. Each transaction is recorded under the logged-in cashier's name.
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.pos.show', $anyOpenSession->id) }}"
                   class="btn btn-sm fw-semibold"
                   style="background:#fff;color:#065f46;border:none;border-radius:10px;padding:9px 22px;font-size:.88rem;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,.15);">
                    <i data-feather="monitor" style="width:14px;height:14px;" class="mr-1"></i>
                    Enter Session
                </a>
            </div>
            @endif

            <div class="card border-0" style="background: linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%); color:#fff; border-radius:14px; overflow:hidden;">
                <div class="card-body py-3 px-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:48px;height:48px;background:linear-gradient(135deg,#2563eb,#7c3aed);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">
                                &#9632;
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold" style="color:#fff;">AGRO Point of Sale</h5>
                                <p class="mb-0" style="color:#94a3b8;font-size:.82rem;">
                                    @if($anyOpenSession)
                                        A session is currently active. Close it before opening a new one.
                                    @else
                                        Select a warehouse location to open a new cashier session.
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($anyOpenSession)
                            <button class="btn btn-sm px-4 py-2 fw-semibold" disabled
                                    style="background:#334155;color:#94a3b8;border:none;border-radius:10px;font-size:.88rem;cursor:not-allowed;"
                                    title="Close the active session first">
                                <i data-feather="lock" style="width:15px;height:15px;" class="mr-1"></i>
                                Open New Session
                            </button>
                        @else
                            <button class="btn btn-sm px-4 py-2 fw-semibold"
                                    style="background:#2563eb;color:#fff;border:none;border-radius:10px;font-size:.88rem;box-shadow:0 2px 10px rgba(37,99,235,.4);"
                                    data-bs-toggle="modal" data-bs-target="#modalOpenSession">
                                <i data-feather="monitor" style="width:15px;height:15px;" class="mr-1"></i>
                                Open New Session
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Sessions Table --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between py-3 px-4" style="background:#fff;">
                    <div>
                        <h5 class="mb-0 fw-bold" style="color:#0f172a;">Session History</h5>
                        <small class="text-muted">All POS sessions — active and closed</small>
                    </div>
                    <span class="badge" style="background:#eff6ff;color:#2563eb;font-size:.78rem;padding:5px 12px;border-radius:20px;">
                        {{ $sessions->total() }} sessions
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover w-100" style="font-size:.85rem;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th class="px-4 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Session No.</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Cashier</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Location</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Opened</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Closed</th>
                                    <th class="px-3 py-3 border-bottom text-center" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Trx</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Status</th>
                                    <th class="px-3 py-3 border-bottom" style="color:#64748b;font-weight:600;font-size:.75rem;letter-spacing:.5px;text-transform:uppercase;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sessions as $session)
                                <tr>
                                    <td class="px-4 py-3" style="font-weight:700;color:#1e293b;">
                                        {{ $session->session_number }}
                                    </td>
                                    <td class="px-3 py-3" style="color:#475569;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:28px;height:28px;background:#eff6ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;color:#2563eb;font-weight:700;flex-shrink:0;">
                                                {{ strtoupper(substr($session->cashier->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <span>{{ $session->cashier->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        @if($session->subinventory_code)
                                            <span style="background:#f0fdf4;color:#059669;border:1px solid #a7f3d0;border-radius:20px;padding:3px 10px;font-size:.75rem;font-weight:600;display:inline-flex;align-items:center;gap:4px;">
                                                <i data-feather="map-pin" style="width:10px;height:10px;"></i>
                                                {{ $session->subinventory_code }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3" style="color:#64748b;white-space:nowrap;">
                                        {{ $session->opened_at ? \Carbon\Carbon::parse($session->opened_at)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="px-3 py-3" style="color:#64748b;white-space:nowrap;">
                                        {{ $session->closed_at ? \Carbon\Carbon::parse($session->closed_at)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:20px;padding:2px 10px;font-size:.8rem;font-weight:700;color:#475569;">
                                            {{ $session->orders()->where('status','paid')->count() }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3">
                                        @if($session->status === 'open')
                                            <span style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;border-radius:20px;padding:3px 10px;font-size:.75rem;font-weight:700;display:inline-flex;align-items:center;gap:4px;">
                                                <span style="width:6px;height:6px;background:#059669;border-radius:50%;display:inline-block;animation:pulse 1.5s infinite;"></span>
                                                Active
                                            </span>
                                        @else
                                            <span style="background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0;border-radius:20px;padding:3px 10px;font-size:.75rem;font-weight:600;">
                                                Closed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="d-flex align-items-center gap-1">
                                            @if($session->status === 'open')
                                                <a href="{{ route('admin.pos.show', $session->id) }}"
                                                   style="background:#2563eb;color:#fff;border-radius:7px;padding:4px 11px;font-size:.75rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;">
                                                    <i data-feather="monitor" style="width:11px;height:11px;"></i> Open
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.pos.report', $session->id) }}"
                                               style="background:#f0fdf4;color:#059669;border:1px solid #a7f3d0;border-radius:7px;padding:4px 11px;font-size:.75rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;">
                                                <i data-feather="file-text" style="width:11px;height:11px;"></i> Report
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div style="color:#94a3b8;">
                                            <div style="font-size:2.5rem;margin-bottom:12px;opacity:.4;">&#128196;</div>
                                            <p class="mb-0" style="font-size:.88rem;">No POS sessions found.</p>
                                            <small>Click "Open New Session" to get started.</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($sessions->hasPages())
                <div class="card-footer bg-white border-top px-4 py-3">
                    {{ $sessions->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Open Session --}}
<div class="modal fade" id="modalOpenSession" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius:14px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.2);">
            <form action="{{ route('admin.pos.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0 px-4 pt-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f);border-radius:14px 14px 0 0;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:32px;height:32px;background:linear-gradient(135deg,#2563eb,#7c3aed);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.9rem;">&#9632;</div>
                        <h5 class="modal-title mb-0 fw-bold" style="color:#fff;font-size:.95rem;">Open POS Session</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pt-3 pb-2">
                    <div class="form-group mb-3">
                        <label class="fw-semibold mb-1" style="font-size:.83rem;color:#475569;">Stock Location <span class="text-danger">*</span></label>
                        <select name="subinventory_code" class="form-control" required style="border-radius:8px;font-size:.85rem;border:1.5px solid #e2e8f0;">
                            <option value="">— Select Warehouse Location —</option>
                            @foreach($subinventories as $sub)
                                <option value="{{ $sub->sub_inventory_name }}">
                                    {{ $sub->sub_inventory_name }} — {{ $sub->description }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Stock will be deducted from this location on every transaction.</small>
                    </div>
                    <div class="form-group mb-2">
                        <label class="fw-semibold mb-1" style="font-size:.83rem;color:#475569;">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes..." style="border-radius:8px;font-size:.85rem;border:1.5px solid #e2e8f0;resize:none;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-2">
                    <button type="button" class="btn btn-sm btn-light px-4" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn btn-sm px-4 fw-semibold" style="background:#2563eb;color:#fff;border:none;border-radius:8px;box-shadow:0 2px 8px rgba(37,99,235,.3);">
                        <i data-feather="play" style="width:13px;height:13px;" class="mr-1"></i> Open Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .4; }
}
</style>
@endsection

@push('script')
<script>
    feather.replace();
</script>
@endpush

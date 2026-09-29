@extends('layouts.petugas')

@section('title', 'Sinkronisasi SiPintu')
@section('page-title', 'Sinkronisasi SiPintu')

@section('content')
    <style>
        .sync-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .status-card {
            background: white;
            border: 1px solid #fee2e2;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.06);
            padding: 24px;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: .6px;
            text-transform: uppercase;
        }
        .status-pill.success { background: #ecfdf5; color: #065f46; }
        .status-pill.failed { background: #fef2f2; color: #991b1b; }
        .status-pill.warning { background: #fff7ed; color: #9a5d00; }
        .stat-mini {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
        }
        .stat-mini:last-child { border-bottom: none; }
        .primary-cta {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff !important;
            border: none;
            border-radius: 12px;
            padding: 14px 22px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(239, 68, 68, 0.25);
            transition: all .2s ease;
        }
        .primary-cta:hover { transform: translateY(-2px); }
        .primary-cta:disabled {
            opacity: .7;
            cursor: wait;
        }
        .progress {
            height: 12px;
            border-radius: 999px;
            background: #fef2f2;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(90deg, #ef4444 0%, #f87171 100%);
        }
        .progress-bar.indeterminate {
            width: 35% !important;
            animation: sync-indeterminate 1.2s ease-in-out infinite alternate;
        }
        @keyframes sync-indeterminate {
            from { transform: translateX(-20%); }
            to { transform: translateX(210%); }
        }
        .table-status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }
        .table-status.success { background: #ecfdf5; color: #065f46; }
        .table-status.failed { background: #fef2f2; color: #991b1b; }
        .table-status.partial { background: #fff7ed; color: #9a5d00; }
        .table-status.running { background: #eff6ff; color: #1d4ed8; }
        .sync-warning-list { color: #854d0e; font-size: 13px; }
    </style>

    <div class="content-card">
        <div class="page-head mb-4">
            <div>
                <h5 class="mb-1">
                    <span class="head-icon"><i class="fas fa-rotate"></i></span>
                    Sinkronisasi SiPintu
                </h5>
                <small class="text-muted">Ambil data siswa dari SiPintu Gateway ke tabel lokal SIKES</small>
            </div>
            <a href="{{ route('petugas.dashboard') }}" class="btn btn-sm btn-light border text-danger fw-semibold" style="border-color: #fecaca !important;">
                <i class="fas fa-home"></i> Beranda
            </a>
        </div>

        <div class="sync-grid">
            <div class="status-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-bold text-dark">Koneksi Gateway</h6>
                                        <span id="gatewayStatus" class="status-pill {{ $gateway['state'] === 'connected' ? 'success' : ($gateway['state'] === 'slow' ? 'warning' : 'failed') }}"
                                                    data-state="{{ $gateway['state'] }}" data-label="{{ $gateway['label'] }}" data-message="{{ $gateway['message'] }}" data-latency="{{ $gateway['latency_ms'] ?? '' }}">
                                                {{ $gateway['label'] }}
                                        </span>
                </div>

                <div class="stat-mini">
                    <span>Base URL</span>
                    <strong id="gatewayBaseUrl">{{ $gateway['host'] }}</strong>
                </div>
                <div class="stat-mini">
                    <span>Latensi</span>
                    <strong id="gatewayLatency">{{ $gateway['latency_ms'] === null ? '-' : $gateway['latency_ms'] . ' ms' }}</strong>
                </div>
                <div class="stat-mini">
                    <span>Status</span>
                    <strong id="gatewayStatusText">{{ $gateway['message'] }}</strong>
                </div>

                <div class="mt-3">
                    <button type="button" id="testConnectionBtn" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-wifi"></i> Tes Koneksi
                    </button>
                </div>
            </div>

            <div class="status-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-bold text-dark">Sinkronisasi Terakhir</h6>
                    <span id="lastLogStatus" class="status-pill {{ ($lastLog?->status ?? 'failed') === 'success' ? 'success' : (in_array($lastLog?->status, ['running', 'partial']) ? 'warning' : 'failed') }}">
                        {{ $lastLog?->status ?? 'Belum ada' }}
                    </span>
                </div>

                @if($lastLog)
                    <div class="stat-mini">
                        <span>Waktu</span>
                        <strong id="lastLogTime">{{ $lastLog->started_at ? $lastLog->started_at->format('d/m/Y H:i') : '-' }}</strong>
                    </div>
                    <div class="stat-mini">
                        <span>Petugas</span>
                        <strong id="lastLogUser">{{ $lastLog->user?->name ?? '-' }}</strong>
                    </div>
                    <div class="stat-mini">
                        <span>Baru / Update / Lewati / Gagal</span>
                        <strong id="lastLogCounts">{{ $lastLog->created_count }}/{{ $lastLog->updated_count }}/{{ $lastLog->skipped_count }}/{{ $lastLog->failed_count }}</strong>
                    </div>
                    <div class="stat-mini">
                        <span>Durasi</span>
                        <strong id="lastLogDuration">
                            @if($lastLog->started_at && $lastLog->finished_at)
                                {{ $lastLog->started_at->diffInSeconds($lastLog->finished_at) }}s
                            @else
                                -
                            @endif
                        </strong>
                    </div>
                    <div id="lastLogMessage" class="small text-muted mt-2">{{ $lastLog->error_message }}</div>
                    <ul id="lastLogWarnings" class="sync-warning-list mt-2 mb-0 {{ $lastLog->warnings ? '' : 'd-none' }}">
                        @foreach($lastLog->warnings ?? [] as $warning)
                            <li>{{ $warning }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted mt-3">Belum ada riwayat sinkronisasi.</div>
                @endif
            </div>
        </div>

        <div class="content-card mb-4" style="padding: 20px;">
            <div id="syncAlert" class="alert d-none" role="alert">
                <div id="syncAlertMessage"></div>
                <ul id="syncAlertWarnings" class="mb-2 d-none"></ul>
                <div id="syncWorkerHint" class="small d-none"></div>
                <button type="button" id="retrySyncBtn" class="btn btn-sm btn-outline-danger mt-2 d-none">Coba Lagi</button>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                <div>
                    <h6 class="mb-1 fw-bold text-dark">Proses Sinkronisasi Siswa</h6>
                    <small class="text-muted">Melakukan upsert data siswa dari gateway SiPintu ke database lokal.</small>
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <label class="form-check mb-0">
                        <input type="checkbox" id="forceRefresh" class="form-check-input">
                        <span class="form-check-label">Paksa ambil ulang dari gateway</span>
                    </label>
                    <button type="button" id="syncBtn" class="primary-cta" data-log-id="{{ $lastLog?->status === 'running' ? $lastLog->id : '' }}" @disabled($lastLog?->status === 'running')>
                        <i class="fas fa-rotate me-2"></i> Sinkronisasi Data Siswa
                    </button>
                </div>
            </div>

            <div id="syncProgressBlock" class="{{ $lastLog?->status === 'running' ? '' : 'd-none' }}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted fw-semibold" id="syncStatusLabel">{{ $lastLog?->error_message ?? 'Menunggu respons SiPintu...' }}</small>
                    <small class="fw-bold text-danger" id="syncPercentLabel">{{ ($lastLog?->total ?? 0) > 0 ? round(($lastLog->processed / $lastLog->total) * 100) . '%' : '...' }}</small>
                </div>
                <div class="progress">
                    <div id="syncProgressBar" class="progress-bar {{ $lastLog?->status === 'running' && ! $lastLog?->total ? 'indeterminate' : '' }}" role="progressbar" style="width: {{ ($lastLog?->total ?? 0) > 0 ? min(100, round(($lastLog->processed / $lastLog->total) * 100)) : 0 }}%"></div>
                </div>
            </div>
        </div>

        <div class="content-card" style="padding: 0; overflow: hidden;">
            <div style="padding: 20px 20px 0;">
                <h6 class="fw-bold text-dark mb-3">Riwayat Sinkronisasi</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Petugas</th>
                            <th>Status</th>
                            <th>Baru</th>
                            <th>Update</th>
                            <th>Lewati</th>
                            <th>Gagal</th>
                            <th>Durasi</th>
                            <th>Pesan</th>
                        </tr>
                    </thead>
                    <tbody id="syncHistoryRows">
                        @forelse($logs as $item)
                            <tr id="history-log-{{ $item->id }}">
                                <td>{{ $item->started_at ? $item->started_at->format('d/m/Y H:i') : '-' }}</td>
                                <td>{{ $item->user?->name ?? '-' }}</td>
                                <td>
                                    <span class="table-status {{ $item->status }}">{{ $item->status }}</span>
                                </td>
                                <td>{{ $item->created_count }}</td>
                                <td>{{ $item->updated_count }}</td>
                                <td>{{ $item->skipped_count }}</td>
                                <td>{{ $item->failed_count }}</td>
                                <td>
                                    @if($item->started_at && $item->finished_at)
                                        {{ $item->started_at->diffInSeconds($item->finished_at) }}s
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="small">{{ $item->error_message }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">Belum ada riwayat sinkronisasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="p-3 d-flex justify-content-end">{{ $logs->links() }}</div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const syncBtn = document.getElementById('syncBtn');
        const syncProgressBlock = document.getElementById('syncProgressBlock');
        const syncStatusLabel = document.getElementById('syncStatusLabel');
        const syncPercentLabel = document.getElementById('syncPercentLabel');
        const syncProgressBar = document.getElementById('syncProgressBar');
        const gatewayStatus = document.getElementById('gatewayStatus');
        const gatewayStatusText = document.getElementById('gatewayStatusText');
        const gatewayLatency = document.getElementById('gatewayLatency');
        const syncAlert = document.getElementById('syncAlert');
        const syncAlertMessage = document.getElementById('syncAlertMessage');
        const syncAlertWarnings = document.getElementById('syncAlertWarnings');
        const syncWorkerHint = document.getElementById('syncWorkerHint');
        let activePoll = null;

        function setProgress(value, label, indeterminate = false) {
            syncProgressBlock.classList.remove('d-none');
            syncStatusLabel.textContent = label;
            syncProgressBar.classList.toggle('indeterminate', indeterminate);
            syncPercentLabel.textContent = indeterminate ? '...' : value + '%';
            syncProgressBar.style.width = indeterminate ? '35%' : value + '%';
        }

        function setGatewayStatus(data) {
            const state = data.state || (data.status === 'rejected' ? 'rejected' : (data.connected ? (data.status === 'slow' ? 'slow' : 'connected') : 'unavailable'));
            const labels = {
                connected: 'Terhubung',
                slow: 'Terhubung lambat',
                rejected: 'Kredensial Ditolak',
                unavailable: 'Tidak Terhubung'
            };
            gatewayStatus.className = 'status-pill ' + (state === 'connected' ? 'success' : (state === 'slow' ? 'warning' : 'failed'));
            gatewayStatus.textContent = labels[state] || labels.unavailable;
            gatewayStatusText.textContent = data.message || labels[state] || labels.unavailable;
            gatewayLatency.textContent = data.latency_ms === null || data.latency_ms === undefined ? '-' : data.latency_ms + ' ms';
        }

        function showSyncAlert(kind, message, warnings = [], workerCommand = '') {
            syncAlert.className = 'alert alert-' + kind;
            syncAlertMessage.textContent = message || 'Sinkronisasi selesai.';
            syncAlertWarnings.replaceChildren();
            warnings.forEach((warning) => {
                const item = document.createElement('li');
                item.textContent = warning;
                syncAlertWarnings.appendChild(item);
            });
            syncAlertWarnings.classList.toggle('d-none', warnings.length === 0);
            syncWorkerHint.textContent = workerCommand ? 'Pastikan worker aktif: ' + workerCommand : '';
            syncWorkerHint.classList.toggle('d-none', !workerCommand);
            document.getElementById('retrySyncBtn').classList.toggle('d-none', kind === 'success' || Boolean(workerCommand));
        }

        function updateSummary(status) {
            const statusElement = document.getElementById('lastLogStatus');
            if (statusElement) {
                statusElement.textContent = status.status;
                statusElement.className = 'status-pill ' + (status.status === 'success' ? 'success' : (status.status === 'running' || status.status === 'partial' ? 'warning' : 'failed'));
            }
            document.getElementById('lastLogCounts').textContent = `${status.created_count}/${status.updated_count}/${status.skipped_count}/${status.failed_count}`;
            document.getElementById('lastLogMessage').textContent = status.error_message || status.message || '';
            document.getElementById('lastLogUser').textContent = status.user_name || '-';
            if (status.started_at) {
                const started = new Date(status.started_at);
                document.getElementById('lastLogTime').textContent = started.toLocaleString('id-ID');
                const ended = status.finished_at ? new Date(status.finished_at) : new Date();
                document.getElementById('lastLogDuration').textContent = `${Math.max(0, Math.round((ended - started) / 1000))}s`;
            }
            const warningList = document.getElementById('lastLogWarnings');
            warningList.replaceChildren();
            (status.warnings || []).forEach((warning) => {
                const item = document.createElement('li');
                item.textContent = warning;
                warningList.appendChild(item);
            });
            warningList.classList.toggle('d-none', !(status.warnings || []).length);
        }

        function updateHistory(status) {
            const rows = document.getElementById('syncHistoryRows');
            let row = document.getElementById('history-log-' + status.id);
            if (!row) {
                row = document.createElement('tr');
                row.id = 'history-log-' + status.id;
                rows.querySelector('[colspan]')?.remove();
                rows.prepend(row);
            }
            const started = status.started_at ? new Date(status.started_at) : null;
            const ended = status.finished_at ? new Date(status.finished_at) : null;
            const values = [
                started ? started.toLocaleString('id-ID') : '-',
                status.user_name || '-',
                status.status,
                status.created_count,
                status.updated_count,
                status.skipped_count,
                status.failed_count,
                started && ended ? `${Math.max(0, Math.round((ended - started) / 1000))}s` : '-',
                status.error_message || ''
            ];
            row.replaceChildren();
            values.forEach((value, index) => {
                const cell = document.createElement('td');
                cell.textContent = value;
                if (index === 2) {
                    cell.innerHTML = '';
                    const badge = document.createElement('span');
                    badge.className = 'table-status ' + status.status;
                    badge.textContent = status.status;
                    cell.appendChild(badge);
                }
                if (index === 8) cell.className = 'small';
                row.appendChild(cell);
            });
        }

        function finishSync(status) {
            if (activePoll) clearInterval(activePoll);
            activePoll = null;
            syncBtn.disabled = false;
            syncBtn.dataset.logId = '';
            syncBtn.innerHTML = '<i class="fas fa-rotate me-2"></i> Sinkronisasi Data Siswa';
            const kind = status.status === 'success' ? 'success' : (status.status === 'partial' ? 'warning' : 'danger');
            showSyncAlert(kind, status.error_message || status.message, status.warnings || []);
            updateSummary(status);
            updateHistory(status);
            if (status.status === 'success' && typeof window.toastr !== 'undefined') window.toastr.success(status.message);
            if (status.status === 'failed' && typeof window.toastr !== 'undefined') window.toastr.error(status.error_message || status.message);
        }

        async function pollStatus(logId, startedAt = Date.now()) {
            if (Date.now() - startedAt >= 20 * 60 * 1000) {
                if (activePoll) clearInterval(activePoll);
                activePoll = null;
                syncBtn.disabled = false;
                showSyncAlert('danger', 'Batas polling 20 menit tercapai. Proses perlu diperiksa sebelum mencoba lagi.');
                return;
            }

            try {
                const response = await fetch('{{ url('petugas/sync-sipintu/status') }}/' + logId, {
                    headers: { 'Accept': 'application/json' }
                });
                const status = await response.json();
                updateSummary(status);
                updateHistory(status);
                setProgress(status.percent || 0, status.message, status.status === 'running' && !status.total);

                if (status.stalled) {
                    showSyncAlert('warning', 'Proses tampak stalled. Periksa worker queue.', status.warnings || [], status.worker_command);
                } else if (status.status === 'running') {
                    syncAlert.classList.add('d-none');
                } else {
                    finishSync(status);
                }
            } catch (error) {
                syncStatusLabel.textContent = 'Menunggu pembaruan status dari server...';
            }
        }

        function startPolling(logId) {
            syncBtn.disabled = true;
            syncBtn.dataset.logId = logId;
            syncBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyinkronkan...';
            const startedAt = Date.now();
            pollStatus(logId, startedAt);
            activePoll = setInterval(() => pollStatus(logId, startedAt), 2000);
        }

        async function runSync() {
            syncBtn.disabled = true;
            syncBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyinkronkan...';
            setProgress(0, 'Menunggu respons SiPintu (bisa sampai 1-2 menit)...', true);

            try {
                const response = await fetch('{{ route('petugas.sync.run') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ force: document.getElementById('forceRefresh').checked })
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal memulai sinkronisasi.');
                startPolling(data.log_id);
            } catch (error) {
                syncBtn.disabled = false;
                syncBtn.innerHTML = '<i class="fas fa-rotate me-2"></i> Sinkronisasi Data Siswa';
                showSyncAlert('danger', error.message || 'Sinkronisasi gagal dimulai.');
            }
        }

        async function testConnection() {
            const button = document.getElementById('testConnectionBtn');
            button.disabled = true;
            try {
                const response = await fetch('{{ route('petugas.sync.test') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                });
                setGatewayStatus(await response.json());
            } catch (error) {
                setGatewayStatus({ status: 'error', connected: false, message: 'Tidak dapat terhubung ke SiPintu.' });
            } finally {
                button.disabled = false;
            }
        }

        syncBtn.addEventListener('click', runSync);
        document.getElementById('retrySyncBtn').addEventListener('click', runSync);
        document.getElementById('testConnectionBtn').addEventListener('click', testConnection);
        if (syncBtn.dataset.logId) startPolling(syncBtn.dataset.logId);
    </script>
@endpush

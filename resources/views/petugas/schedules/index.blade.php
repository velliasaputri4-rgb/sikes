@extends('layouts.petugas')

@section('title', 'Jadwal Piket')
@section('page-title', 'Jadwal Piket')

@section('content')
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(30, 58, 138, 0.3); }
        .filter-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 20px; }
        .filter-card .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12); }
        .table thead th { background: #f8fafc; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid #e2e8f0; }
        .table-hover tbody tr:hover { background-color: #eff6ff; }
        .badge-group { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-users-cog"></i></span> Grup Petugas Piket</h5>
                <small class="text-muted">Kelola grup dan anggota petugas piket UKS</small>
            </div>
            <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> Tambah Grup
            </button>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="filter-card">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama grup atau deskripsi...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="scheduleTable">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>Nama Grup</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $index => $schedule)
                        @php
                            $members = json_decode($schedule->members ?? '[]', true) ?? [];
                            $membersCount = count($members);
                            $emergencyCount = 0;
                            foreach($members as $m) {
                                if (is_array($m) && !empty($m['phone'])) $emergencyCount++;
                            }
                        @endphp
                        <tr data-group="{{ strtolower($schedule->group_name ?? '') }}" data-desc="{{ strtolower($schedule->description ?? '') }}">
                            <td class="text-muted">{{ ($schedules->currentPage() - 1) * $schedules->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $schedule->group_name ?? '-' }}</td>
                            <td><small class="text-muted">{{ $schedule->description ?? '-' }}</small></td>
                            <td>
                                <span class="badge-group">
                                    <i class="fas fa-users me-1"></i> {{ $membersCount }} anggota
                                </span>
                                @if($emergencyCount > 0)
                                    <span class="badge bg-success ms-1"><i class="fas fa-phone"></i> {{ $emergencyCount }}</span>
                                @endif
                            </td>
                            <td>
                                @if($schedule->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick='editSchedule({{ json_encode($schedule) }})' title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('petugas.piket.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus grup {{ $schedule->group_name ?? 'ini' }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data grup petugas</p>
                                <small>Klik tombol "Tambah Grup" untuk membuat data pertama</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">{{ $schedules->links() }}</div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Grup Piket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('petugas.piket.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Grup <span class="text-danger">*</span></label>
                            <input type="text" name="group_name" class="form-control" placeholder="Contoh: Kelompok 1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi (Opsional)</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Contoh: Piket hari Senin & Selasa"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Anggota Grup</label>
                            <div id="membersContainer">
                                <div class="member-input mb-2 p-2 bg-light rounded">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <input type="text" name="members[0][name]" class="form-control form-control-sm" placeholder="Nama Anggota" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="members[0][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addMember()">
                                <i class="fas fa-plus me-1"></i>Tambah Anggota
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Edit Grup Piket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Grup <span class="text-danger">*</span></label>
                            <input type="text" name="group_name" id="editGroupName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi (Opsional)</label>
                            <textarea name="description" id="editDescription" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Anggota Grup</label>
                            <div id="editMembersContainer"></div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addEditMember()">
                                <i class="fas fa-plus me-1"></i>Tambah Anggota
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let editMemberCount = 0;

        function addMember() {
            const container = document.getElementById('membersContainer');
            const index = container.querySelectorAll('.member-input').length;
            const div = document.createElement('div');
            div.className = 'member-input mb-2 p-2 bg-light rounded';
            div.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="members[${index}][name]" class="form-control form-control-sm" placeholder="Nama Anggota" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="members[${index}][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)">
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="this.closest('.member-input').remove()">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(div);
        }

        function editSchedule(schedule) {
            document.getElementById('editId').value = schedule.id;
            document.getElementById('editForm').action = '/petugas/piket/' + schedule.id;
            document.getElementById('editGroupName').value = schedule.group_name || '';
            document.getElementById('editDescription').value = schedule.description || '';
            
            const members = JSON.parse(schedule.members || '[]');
            const container = document.getElementById('editMembersContainer');
            container.innerHTML = '';
            editMemberCount = 0;
            
            members.forEach((member) => {
                addEditMemberField(member.name || '', member.phone || '');
            });
            
            if (members.length === 0) {
                addEditMemberField('', '');
            }
            
            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        }

        function addEditMember() {
            addEditMemberField('', '');
        }

        function addEditMemberField(name = '', phone = '') {
            const container = document.getElementById('editMembersContainer');
            const index = editMemberCount++;
            const div = document.createElement('div');
            div.className = 'member-input mb-2 p-2 bg-light rounded';
            div.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" name="members[${index}][name]" class="form-control form-control-sm" placeholder="Nama Anggota" value="${name}" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="members[${index}][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)" value="${phone}">
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="this.closest('.member-input').remove()">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(div);
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const search = this.value.toLowerCase();
            const rows = document.querySelectorAll('#scheduleTable tbody tr');
            
            rows.forEach(row => {
                const group = row.dataset.group;
                const desc = row.dataset.desc;
                const match = group.includes(search) || desc.includes(search);
                row.style.display = match ? '' : 'none';
            });
        });
    </script>
@endsection
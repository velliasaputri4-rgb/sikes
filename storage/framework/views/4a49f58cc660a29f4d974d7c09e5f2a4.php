

<?php $__env->startSection('title', 'Jadwal Piket'); ?>
<?php $__env->startSection('page-title', 'Jadwal Piket'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        :root { --navy-900: #0f172a; }
        
        /* ✅ PERBAIKAN MODAL: Pastikan muncul di atas sidebar */
        .modal { z-index: 1060 !important; }
        .modal-backdrop { z-index: 1050 !important; }
        
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(30, 58, 138, 0.3); }
        .filter-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 20px; }
        .filter-card .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12); }
        .table thead th { background: #f8fafc; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid #e2e8f0; }
        .table-hover tbody tr:hover { background-color: #eff6ff; }
        .badge-group { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 4px; }

        /* ✅ KUNCI VISIBILITAS: Default (Desktop) */
        .mobile-only { display: none !important; }
        .desktop-only { display: inline-flex !important; }

        /* ✅ MOBILE CARD LAYOUT: Ganti tabel jadi card rapi di HP */
        @media (max-width: 768px) {
            /* Tukar visibilitas */
            .mobile-only { display: block !important; }
            .desktop-only { display: none !important; }
            
            .table-responsive { border: 0; }
            .table thead { display: none; }
            
            .table tbody tr {
                display: block;
                margin-bottom: 16px;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 16px;
                background: white;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            }
            
            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border: none;
                border-bottom: 1px solid #f1f5f9;
                text-align: right;
            }
            
            /* Label di sebelah kiri untuk mobile */
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748b;
                text-align: left;
                margin-right: auto;
                font-size: 0.85rem;
            }
            
            .table tbody td:last-child {
                border-bottom: none;
                padding-bottom: 0;
                justify-content: flex-end;
            }
            .table tbody td:last-child::before {
                display: none;
            }
            
            .mobile-actions {
                display: flex !important;
                gap: 8px;
                width: 100%;
            }
            
            .mobile-actions .btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-users-cog"></i></span> Grup Petugas Piket</h5>
                <small class="text-muted">Kelola grup dan anggota petugas piket UKS</small>
            </div>
            <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> <span class="d-none d-sm-inline">Tambah Grup</span><span class="d-sm-none">Tambah</span>
            </button>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?> <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm"><?php echo e(session('success')); ?> <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?> <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"><?php echo e(session('error')); ?> <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $members = json_decode($schedule->members ?? '[]', true) ?? [];
                            $membersCount = count($members);
                            $emergencyCount = 0;
                            foreach($members as $m) {
                                if (is_array($m) && !empty($m['phone'])) $emergencyCount++;
                            }
                        ?>
                        <tr data-group="<?php echo e(strtolower($schedule->group_name ?? '')); ?>" data-desc="<?php echo e(strtolower($schedule->description ?? '')); ?>">
                            <td data-label="No" class="text-muted"><?php echo e(($schedules->currentPage() - 1) * $schedules->perPage() + $loop->iteration); ?></td>
                            <td data-label="Nama Grup" class="fw-semibold"><?php echo e($schedule->group_name ?? '-'); ?></td>
                            <td data-label="Deskripsi"><small class="text-muted"><?php echo e(Str::limit($schedule->description ?? '-', 40)); ?></small></td>
                            <td data-label="Anggota">
                                <!-- Desktop badges -->
                                <div class="desktop-only">
                                    <span class="badge-group"><i class="fas fa-users"></i> <?php echo e($membersCount); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($emergencyCount > 0): ?>
                                        <span class="badge bg-success ms-1" title="Memiliki kontak darurat"><i class="fas fa-phone"></i> <?php echo e($emergencyCount); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <!-- Mobile badges -->
                                <div class="mobile-only">
                                    <span class="badge-group mb-1"><i class="fas fa-users"></i> <?php echo e($membersCount); ?> anggota</span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($emergencyCount > 0): ?>
                                        <span class="badge bg-success"><i class="fas fa-phone"></i> <?php echo e($emergencyCount); ?> kontak</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </td>
                            <td data-label="Status">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($schedule->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td data-label="Aksi" class="text-center">
                                <!-- Desktop actions -->
                                <div class="desktop-only">
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick='editSchedule(<?php echo e(json_encode($schedule)); ?>)' title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </button>
                                    <form action="<?php echo e(route('petugas.piket.destroy', $schedule->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus grup ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                                <!-- Mobile actions -->
                                <div class="mobile-only">
                                    <div class="mobile-actions">
                                        <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick='editSchedule(<?php echo e(json_encode($schedule)); ?>)'>
                                            <i class="fas fa-pen-to-square me-1"></i> Edit
                                        </button>
                                        <form action="<?php echo e(route('petugas.piket.destroy', $schedule->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus grup ini?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                <i class="fas fa-trash-can me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data grup petugas</p>
                                <small>Klik tombol "Tambah Grup" untuk membuat data pertama</small>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3"><?php echo e($schedules->links()); ?></div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Grup Piket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('petugas.piket.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
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
                                    <div class="row g-2 align-items-end">
                                        <div class="col-6">
                                            <input type="text" name="members[0][name]" class="form-control form-control-sm" placeholder="Nama Anggota" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="members[0][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100" onclick="addMember()">
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
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Edit Grup Piket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
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
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100" onclick="addEditMember()">
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
                <div class="row g-2 align-items-end">
                    <div class="col-6">
                        <input type="text" name="members[${index}][name]" class="form-control form-control-sm" placeholder="Nama Anggota" required>
                    </div>
                    <div class="col-6">
                        <input type="text" name="members[${index}][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)">
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.member-input').remove()">
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
            
            let members = [];
            try {
                members = typeof schedule.members === 'string' ? JSON.parse(schedule.members || '[]') : (schedule.members || []);
            } catch (e) {
                members = [];
            }
            
            const container = document.getElementById('editMembersContainer');
            container.innerHTML = '';
            editMemberCount = 0;
            
            if (members.length > 0) {
                members.forEach((member) => {
                    addEditMemberField(member.name || '', member.phone || '');
                });
            } else {
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
                <div class="row g-2 align-items-end">
                    <div class="col-6">
                        <input type="text" name="members[${index}][name]" class="form-control form-control-sm" placeholder="Nama Anggota" value="${name}" required>
                    </div>
                    <div class="col-6">
                        <input type="text" name="members[${index}][phone]" class="form-control form-control-sm" placeholder="No. HP (opsional)" value="${phone}">
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.member-input').remove()">
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
                const group = row.dataset.group || '';
                const desc = row.dataset.desc || '';
                const match = group.includes(search) || desc.includes(search);
                row.style.display = match ? '' : 'none';
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/schedules/index.blade.php ENDPATH**/ ?>
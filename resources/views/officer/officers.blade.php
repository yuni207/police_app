@extends('components.master')

@section('content')
<div class="container-fluid pt-2 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 900px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Officer</h4>
            <button id="addOfficerBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOfficerModal">
                <i class="fas fa-plus"></i> Tambah Officer
            </button>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover" id="officersTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Badge</th>
                        <th>Rank</th>
                        <th>Area Tugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="officersTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Officer -->
<div class="modal fade" id="createOfficerModal" tabindex="-1" aria-labelledby="createOfficerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createOfficerForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOfficerLabel">Tambah Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="addName" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="addName" name="name">
                    <div class="text-danger small" id="createNameError"></div>
                </div>
                <div class="mb-3">
                    <label for="addBadgeNumber" class="form-label">Nomor Badge</label>
                    <input type="text" class="form-control" id="addBadgeNumber" name="badge_number">
                    <div class="text-danger small" id="createBadgeNumberError"></div>
                </div>
                <div class="mb-3">
                    <label for="addRank" class="form-label">Rank</label>
                    <input type="text" class="form-control" id="addRank" name="rank">
                    <div class="text-danger small" id="createRankError"></div>
                </div>
                <div class="mb-3">
                    <label for="addArea" class="form-label">Area Tugas</label>
                    <input type="text" class="form-control" id="addArea" name="assigned_area">
                    <div class="text-danger small" id="createAreaError"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit Officer -->
<div class="modal fade" id="editOfficerModal" tabindex="-1" aria-labelledby="editOfficerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editOfficerForm" class="modal-content">
            <input type="hidden" id="editOfficerId" name="id">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfficerLabel">Edit Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editName" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="editName" name="name">
                    <div class="text-danger small" id="editNameError"></div>
                </div>
                <div class="mb-3">
                    <label for="editBadgeNumber" class="form-label">Nomor Badge</label>
                    <input type="text" class="form-control" id="editBadgeNumber" name="badge_number">
                    <div class="text-danger small" id="editBadgeNumberError"></div>
                </div>
                <div class="mb-3">
                    <label for="editRank" class="form-label">Rank</label>
                    <input type="text" class="form-control" id="editRank" name="rank">
                    <div class="text-danger small" id="editRankError"></div>
                </div>
                <div class="mb-3">
                    <label for="editArea" class="form-label">Area Tugas</label>
                    <input type="text" class="form-control" id="editArea" name="assigned_area">
                    <div class="text-danger small" id="editAreaError"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

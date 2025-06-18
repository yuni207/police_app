if (window.location.pathname.includes('/panel-control/officers')) {
    document.addEventListener("DOMContentLoaded", async function () {
        try {
            const token = decodeURIComponent(getCookie('token'));
            if (!token) {
                console.warn("Token tidak ditemukan.");
                window.location.href = '/';
                return;
            }

            const response = await axios.get('/api/panel-control/officers', {
                headers: { 'Authorization': `Bearer ${token}` },
                withCredentials: true
            });

            displayOfficers(response.data.data);
        } catch (error) {
            showErrorToast(error.response?.data?.message || "Gagal memuat data.");
            if (error.response?.status === 401 || error.response?.status === 403) {
                window.location.href = '/';
            }
        }

        document.getElementById("createOfficerForm").addEventListener("submit", addOfficer);
        document.getElementById("editOfficerForm").addEventListener("submit", updateOfficer);
    });

    function showErrorToast(message) {
        Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: message, timer: 3000, showConfirmButton: false });
    }

    function clearCreateFormErrors() {
        document.getElementById("createNameError").textContent = "";
        document.getElementById("createBadgeNumberError").textContent = "";
        document.getElementById("createRankError").textContent = "";
        document.getElementById("createAreaError").textContent = "";
    }

    function clearEditFormErrors() {
        document.getElementById("editNameError").textContent = "";
        document.getElementById("editBadgeNumberError").textContent = "";
        document.getElementById("editRankError").textContent = "";
        document.getElementById("editAreaError").textContent = "";
    }

    async function addOfficer(e) {
        e.preventDefault();
        clearCreateFormErrors();

        const token = decodeURIComponent(getCookie('token'));
        const name = document.getElementById("addName").value.trim();
        const badge_number = document.getElementById("addBadgeNumber").value.trim();
        const rank = document.getElementById("addRank").value.trim();
        const assigned_area = document.getElementById("addArea").value.trim();

        try {
            const response = await axios.post('/api/panel-control/officers', {
                name, badge_number, rank, assigned_area
            }, {
                headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
                withCredentials: true
            });

            $('#createOfficerModal').modal('hide');
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: response.data.message, timer: 3000, showConfirmButton: false });
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response?.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("createNameError").textContent = errors.name[0];
                if (errors.badge_number) document.getElementById("createBadgeNumberError").textContent = errors.badge_number[0];
                if (errors.rank) document.getElementById("createRankError").textContent = errors.rank[0];
                if (errors.assigned_area) document.getElementById("createAreaError").textContent = errors.assigned_area[0];
            } else {
                showErrorToast(error.response?.data?.message || "Gagal menambahkan officer.");
            }
        }
    }

    function displayOfficers(data) {
        const tbody = document.getElementById("officersTableBody");
        tbody.innerHTML = "";

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data not available</td></tr>`;
            return;
        }

        window.officerData = data;

        data.forEach((item, i) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <th scope="row">${i + 1}</th>
                <td>${item.name}</td>
                <td>${item.badge_number}</td>
                <td>${item.rank}</td>
                <td>${item.assigned_area}</td>
                <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOfficerModal" onclick="showEditOfficerModal(${item.id}, ${i})">Edit</button>
                    <button class="btn btn-danger" onclick="confirmDeleteOfficer(${item.id})">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });

        $('#officersTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada data yang tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    }
    fetchOfficers();

    function showEditOfficerModal(id, index) {
        clearEditFormErrors();
        const item = window.officerData[index];
        document.getElementById("editOfficerId").value = id;
        document.getElementById("editName").value = item.name;
        document.getElementById("editBadgeNumber").value = item.badge_number;
        document.getElementById("editRank").value = item.rank;
        document.getElementById("editArea").value = item.assigned_area;
    }

    async function updateOfficer(e) {
        e.preventDefault();
        clearEditFormErrors();

        const id = document.getElementById("editOfficerId").value;
        const name = document.getElementById("editName").value.trim();
        const badge_number = document.getElementById("editBadgeNumber").value.trim();
        const rank = document.getElementById("editRank").value.trim();
        const assigned_area = document.getElementById("editArea").value.trim();

        const token = decodeURIComponent(getCookie('token'));

        try {
            const response = await axios.put(`/api/panel-control/officers/${id}`, {
                name, badge_number, rank, assigned_area
            }, {
                headers: { 'Authorization': `Bearer ${token}` },
                withCredentials: true
            });

            $('#editOfficerModal').modal('hide');
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: response.data.message, timer: 3000, showConfirmButton: false });
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response?.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("editNameError").textContent = errors.name[0];
                if (errors.badge_number) document.getElementById("editBadgeNumberError").textContent = errors.badge_number[0];
                if (errors.rank) document.getElementById("editRankError").textContent = errors.rank[0];
                if (errors.assigned_area) document.getElementById("editAreaError").textContent = errors.assigned_area[0];
            } else {
                showErrorToast(error.response?.data?.message || "Gagal mengupdate officer.");
            }
        }
    }
}

async function confirmDeleteOfficer(id) {
    console.log("Delete officer with ID:", id);
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    });

    if (result.isConfirmed) {
        deleteOfficer(id);
    }
}

async function deleteOfficer(id) {
    try {
        const token = decodeURIComponent(getCookie('token'));
        const response = await axios.delete(`/api/panel-control/officers/${id}`, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
            withCredentials: true
        });

        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            icon: 'success',
            title: response.data.message || 'Data deleted successfully.'
        });

        document.getElementById('officersTableBody').innerHTML = '';
        setTimeout(() => location.reload(), 1000);
    } catch (error) {
        console.error("Gagal menghapus data:", error);
        const errorMessage = error.response?.data?.message || "Terjadi kesalahan saat menghapus data.";
        showErrorToast(errorMessage);
    }
} 

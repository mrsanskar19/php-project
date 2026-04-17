<?php 
include '../config/init.php'; 
include '../components/admin_header.php'; 

// Fake User Data (Based on your student list)
$users = [
    ['id' => 501, 'name' => 'Soham Bharat Bankar', 'email' => 'soham@iit.edu', 'role' => 'Student', 'status' => 'Active'],
    ['id' => 502, 'name' => 'Sanskar Vinod Bandgar', 'email' => 'sanskar@cto.com', 'role' => 'Admin', 'status' => 'Active'],
    ['id' => 503, 'name' => 'Ghansham Lalaso Gore', 'email' => 'ghansham@iit.edu', 'role' => 'Student', 'status' => 'Inactive'],
    ['id' => 504, 'name' => 'Avadhut Pramod Jagtap', 'email' => 'avadhut@iit.edu', 'role' => 'Student', 'status' => 'Active'],
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">User Management</h3>
        <p class="text-muted small">Manage student access and administrative roles.</p>
    </div>
    <button class="btn btn-primary-custom rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Add New User
    </button>
</div>

<div class="mb-4">
    <div class="input-group shadow-sm rounded-pill overflow-hidden">
        <span class="input-group-text bg-white border-0 ps-3">🔍</span>
        <input type="text" id="userSearch" class="form-control border-0 py-2" placeholder="Search by name, email or roll number...">
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="userTable">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Roll No</th>
                    <th>User Details</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr class="user-row">
                    <td class="ps-4 fw-bold">#<?php echo $u['id']; ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; font-size: 0.8rem;">
                                <?php echo substr($u['name'], 0, 1); ?>
                            </div>
                            <div>
                                <div class="fw-bold user-name"><?php echo $u['name']; ?></div>
                                <div class="small text-muted user-email"><?php echo $u['email']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border"><?php echo $u['role']; ?></span></td>
                    <td>
                        <span class="badge <?php echo ($u['status'] == 'Active') ? 'bg-success' : 'bg-secondary'; ?> rounded-pill px-3">
                            <?php echo $u['status']; ?>
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <button class="btn btn-light btn-sm rounded-3 me-1" onclick="editUser(<?php echo $u['id']; ?>)">Edit</button>
                        <button class="btn btn-outline-danger btn-sm rounded-3" onclick="deleteUser(<?php echo $u['id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../components/admin_footer.php'; ?>
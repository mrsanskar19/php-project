<?php 
include '../config/init.php';
// Add security: check if user is actually an admin
include '../components/admin_header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Executive Overview</h3>
    <button class="btn btn-primary-custom btn-sm">Download Report</button>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3">
            <p class="text-muted small mb-1">Total Sales</p>
            <h3 class="fw-bold">₹8,45,200</h3>
            <span class="text-success small">↑ 12% from last month</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3">
            <p class="text-muted small mb-1">Total Orders</p>
            <h3 class="fw-bold">156</h3>
            <span class="text-primary small">24 pending</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3">
            <p class="text-muted small mb-1">New Customers</p>
            <h3 class="fw-bold">42</h3>
            <span class="text-success small">↑ 5% increase</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3">
            <p class="text-muted small mb-1">Active Now</p>
            <h3 class="fw-bold">12</h3>
            <span class="text-warning small">● Live users</span>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-4">Recent Orders</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#ORD-5521</td>
                    <td>Soham Bankar</td>
                    <td><span class="badge bg-success-subtle text-success rounded-pill">Delivered</span></td>
                    <td>₹1,250</td>
                    <td><button class="btn btn-light btn-sm">Edit</button></td>
                </tr>
                <tr>
                    <td>#ORD-5522</td>
                    <td>Avadhut Jagtap</td>
                    <td><span class="badge bg-warning-subtle text-warning rounded-pill">Processing</span></td>
                    <td>₹25,000</td>
                    <td><button class="btn btn-light btn-sm">Edit</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</div>

<?php include "../components/admin_footer.php" ?>
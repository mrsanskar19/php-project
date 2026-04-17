<?php 
include '../config/init.php'; 
include '../components/admin_header.php'; 

// Fake Orders Data with extra details
$orders = [
    [
        'id' => 'ORD-101',
        'customer' => 'Soham Bankar',
        'email' => 'soham@iit.edu',
        'items' => 'MacBook Pro (1), Mouse (1)',
        'total' => '2,51,000',
        'status' => 'Pending',
        'address' => 'Hostel 7, IIT Bombay, Powai',
        'date' => '2026-04-11'
    ],
    [
        'id' => 'ORD-102',
        'customer' => 'Avadhut Jagtap',
        'email' => 'avadhut@company.com',
        'items' => 'iPhone 15 Pro (1)',
        'total' => '1,29,900',
        'status' => 'Shipped',
        'address' => 'Sector 15, Vashi, Navi Mumbai',
        'date' => '2026-04-10'
    ]
];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Order Management</h3>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Export CSV</button>
        <button class="btn btn-primary-custom btn-sm rounded-pill px-3">Filter</button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                <tr>
                    <td class="ps-4 fw-bold"><?php echo $o['id']; ?></td>
                    <td class="small text-muted"><?php echo $o['date']; ?></td>
                    <td>
                        <div class="fw-bold"><?php echo $o['customer']; ?></div>
                        <div class="small text-muted"><?php echo $o['email']; ?></div>
                    </td>
                    <td class="fw-bold text-primary-custom">₹<?php echo $o['total']; ?></td>
                    <td>
                        <?php 
                            $badge = 'bg-warning-subtle text-warning';
                            if($o['status'] == 'Shipped') $badge = 'bg-info-subtle text-info';
                            if($o['status'] == 'Delivered') $badge = 'bg-success-subtle text-success';
                        ?>
                        <span class="badge <?php echo $badge; ?> rounded-pill px-3">
                            <?php echo $o['status']; ?>
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <button class="btn btn-light btn-sm rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $o['id']; ?>">View</button>
                        <button class="btn btn-outline-primary btn-sm rounded-3">Update Status</button>
                    </td>
                </tr>

                <div class="modal fade" id="viewModal<?php echo $o['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 border-0 shadow-lg">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="fw-bold">Order Details: <?php echo $o['id']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3 bg-light rounded-3 mb-3">
                                    <h6 class="fw-bold small text-uppercase text-muted">Shipping Address</h6>
                                    <p class="mb-0 small"><?php echo $o['address']; ?></p>
                                </div>
                                <div class="p-3 bg-light rounded-3 mb-3">
                                    <h6 class="fw-bold small text-uppercase text-muted">Items Ordered</h6>
                                    <p class="mb-0 small"><?php echo $o['items']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Payment Mode</span>
                                    <span class="fw-bold small">UPI / QR Code</span>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button class="btn btn-primary-custom w-100 rounded-3">Print Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../components/admin_footer.php'; ?>
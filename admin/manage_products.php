<?php include '../components/admin_header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Manage Products</h3>
    <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addModal">+ Add New Product</button>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><div class="bg-light p-2 rounded text-center" style="width: 40px;">💻</div></td>
                <td class="fw-bold">MacBook Pro M3</td>
                <td>Computers</td>
                <td>₹2,49,000</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Add New Gear</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <input type="text" class="form-control mb-3 rounded-3" placeholder="Product Name">
            <input type="text" class="form-control mb-3 rounded-3" placeholder="Price (INR)">
            <select class="form-select mb-3 rounded-3"><option>Select Category</option></select>
            <button class="btn btn-primary-custom w-100">Save Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../components/admin_footer.php'; ?>
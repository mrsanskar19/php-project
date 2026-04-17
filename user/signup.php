<?php 
include '../config/init.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if ($username && $name && $email && $password) {

        $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $check->bind_param("ss", $email, $username);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $error = "User already exists";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("
                INSERT INTO users (username, email, phone, name, password, role) 
                VALUES (?, ?, ?, ?, ?, 'user')
            ");

            $stmt->bind_param("sssss", $username, $email, $phone, $name, $hash);

            if ($stmt->execute()) {
                $success = "Account created successfully";
            } else {
                $error = "Something went wrong";
            }
        }

    } else {
        $error = "Please fill all required fields";
    }
}

include '../components/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
        <div class="card shadow-sm p-4 rounded-4 border-0">

            <h3 class="fw-bold mb-4 text-center">Create Account</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button class="btn btn-primary w-100 py-2">
                    Register
                </button>

            </form>

            <div class="text-center mt-3">
                <small>
                    Already have an account? 
                    <a href="login.php">Login</a>
                </small>
            </div>

        </div>

    </div>
</div>


</div>

<?php include '../components/footer.php'; ?>

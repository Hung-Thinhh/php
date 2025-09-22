<?php
session_start();
include "db.php";
if (isset($_SESSION['canbo'])) { header(header: "Location: dashboard.php"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_cb = $_POST['ma_cb'];
    $mat_khau = $_POST['mat_khau'];

    $sql = "SELECT * FROM canbo WHERE ma_cb=? AND mat_khau=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ma_cb, $mat_khau);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['canbo'] = $ma_cb;
        header("Location: list_interns.php");
    } else {
        echo "Sai mã cán bộ hoặc mật khẩu!";
    }
}
?>

<form method="POST">
    Mã cán bộ: <input type="text" name="ma_cb" required><br>
    Mật khẩu: <input type="password" name="mat_khau" required><br>
    <button type="submit">Đăng nhập</button>
</form>

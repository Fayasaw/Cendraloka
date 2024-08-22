<?php 
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        $password = md5($password);

        $checkEmail = "SELECT * FROM tb_user WHERE email='$email'";
        $result = $conn->query($checkEmail);
        if ($result->num_rows > 0) {
            echo "Email Address Already Exist!";
        } else {
            $insertQuery = "INSERT INTO tb_user (username, email, password)
                            VALUES ('$username', '$email', '$password')";
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: login-register.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } 
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password dengan md5
    $password = md5($password);

    // Verifikasi email dan password
    $sql = "SELECT * FROM tb_user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: index.html");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>

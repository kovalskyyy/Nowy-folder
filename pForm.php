<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baza_danych";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$db = $_POST['db'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$province = $_POST['province'];
$gender = $_POST['gender'];
$newsletter = isset($_POST['newsletter']) ? 1 : 0;


$firstName = mysqli_real_escape_string($conn, $firstName);
$lastName = mysqli_real_escape_string($conn, $lastName);
$email = mysqli_real_escape_string($conn, $email);
$phone = mysqli_real_escape_string($conn, $phone);
$province = mysqli_real_escape_string($conn, $province);
$gender = mysqli_real_escape_string($conn, $gender);


$sql = "INSERT INTO users (firstName, lastName, db, email, phone, province, gender, newsletter)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);


$stmt->bind_param("sssssssi", $firstName, $lastName, $db, $email, $phone, $province, $gender, $newsletter);


if ($stmt->execute()) {

    $stmt->close();
    $conn->close();


    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
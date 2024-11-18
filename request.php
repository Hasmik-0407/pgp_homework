<?php
session_start();

$data = [
    'firstName' => $_POST["firstName"] ?? "",
    'lastName' => $_POST["lastName"] ?? "",
    'email' => $_POST["email"] ?? "",
    'age' => $_POST["age"] ?? "",
    'address' => $_POST["address"] ?? ""
];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userTest";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate inputs
if (empty($data['firstName'])) {
    $_SESSION['firstNameError'] = "First name is required.";
}
if (empty($data['lastName'])) {
    $_SESSION['lastNameError'] = "Last name is required.";
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['emailError'] = "Invalid email format.";
}
if (empty($data['age'])) {
    $_SESSION['ageError'] = "Age is required.";
}
if (empty($data['address'])) {
    $_SESSION['addressError'] = "Address is required.";
}

if (array_filter($_SESSION)) {
    header("Location: index.php");
    exit;
}

// Insert into database
$checkEmailQuery = "SELECT * FROM users WHERE email = '{$data['email']}'";
$result = mysqli_query($conn, $checkEmailQuery);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['emailError'] = "This email is already registered.";
    header("Location: index.php");
    exit;
}

$insertQuery = "INSERT INTO users (firstName, lastName, email, age, address) VALUES (
    '{$data['firstName']}', '{$data['lastName']}', '{$data['email']}', {$data['age']}, '{$data['address']}'
)";
if (mysqli_query($conn, $insertQuery)) {
    $_SESSION['successMessage'] = "Registration successful!";
} else {
    $_SESSION['emailError'] = "Database error: " . mysqli_error($conn);
}

mysqli_close($conn);
header("Location: index.php");

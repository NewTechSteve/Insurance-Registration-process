<?php
// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "insurance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Stage 1: Personal Information
  $name = $_POST["name"];
  $address = $_POST["address"];
  $contact = $_POST["contact"];
  $dob = $_POST["dob"];
  $id_doc = $_FILES["id-doc"]["name"];
  move_uploaded_file($_FILES["id-doc"]["tmp_name"], "uploads/" . $id_doc);

  // Insert into database
  $sql = "INSERT INTO clients (name, address, contact, dob, id_doc) VALUES ('$name', '$address', '$contact', '$dob', '$id_doc')";
  $conn->query($sql);

  // Stage 2: Insurance Details
  $insurance_type = $_POST["insurance-type"];
  $coverage_amount = $_POST["coverage-amount"];
  $deductible = $_POST["deductible"];
  $term_length = $_POST["term-length"];

  // Insert into database
  $sql = "INSERT INTO insurance_details (insurance_type, coverage_amount, deductible, term_length) VALUES ('$insurance_type', '$coverage_amount', '$deductible', '$term_length')";
  $conn->query($sql);

  // Stage 3: Risk Assessment
  $health_factors = $_POST["health-factors"];
  $lifestyle_factors = $_POST["lifestyle-factors"];

  // Insert into database
  $sql = "INSERT INTO risk_assessment (health_factors, lifestyle_factors) VALUES ('$health_factors', '$lifestyle_factors')";
  $conn->query($sql);

  // Close connection
  $conn->close();

  // Redirect to confirmation page
  header("Location: confirmation.php");
  exit();
}


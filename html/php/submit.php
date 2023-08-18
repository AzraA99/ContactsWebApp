<?php
include "dbConnection.php";

// Get the latest ID from the table
$query = "SELECT MAX(ID) AS max_id FROM users";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$latest_id = $row['max_id'];

$new_id = $latest_id + 1;

// Insert data into the table
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $country = $_POST['countries'];
    $city = $_POST['city'];
    $u_date = $_POST['u_date'];
    $age = $_POST['age'];

    list($selectedCountryID, $selectedCountryName) = explode('|', $_POST["countries"]);

    // ... (Extract other input data) ...
    $sql = "INSERT INTO users(ID, firstname, lastname, phone, gender, email, country, city, u_date, age) 
            VALUES ('$new_id', '$firstname', '$lastname', '$phone', '$gender', '$email', '$selectedCountryID', '$city', '$u_date', '$age')";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to the form page (index.php)
        header("Location: index.php");  // Change this to the actual form page
        exit();  // Make sure to exit to prevent further execution of the code
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
?>

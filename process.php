<?php

function saveToDatabase($name, $email) {
$serverName = "localhost";
$database = "registration";
$username = "root";
$password = "";

//Open database connection
$conn = mysqli_connect($serverName, $username, $password, $database);

// Check that connection exists
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO users (firstname, lastname, email, password, number, gender, country, created_date)
    VALUES ('$firstname', '$lastname', '$email', '$password', '$number', '$gender', '$country', NOW())";
$result = mysqli_query($conn, $sql);

//Check for errors
if (!$result) {
die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

//Close the connection
mysqli_close($conn);
}




?>
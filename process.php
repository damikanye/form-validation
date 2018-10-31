<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
saveToFile($firstname, $email);
saveToDatabase($firstname, $email);
header('Location:index.html');

function saveToFile($name, $email) {
//Logic to save to a file goes here
$fileHandler = fopen('record.txt', 'a');
$string = $firstname . ',' . $lastname . "\n";
fwrite($fileHandler, $string);
fclose($fileHandler);

}

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
$sql = 'INSERT INTO users (firstname, lastname, email, password, tel, gender, country, created_date)
    VALUES ("$firstname", "$lastname", "$email", "$password", "$tel", "$gender", "$country", NOW())';
$result = mysqli_query($conn, $sql);

//Check for errors
if (!$result) {
die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

//Close the connection
mysqli_close($conn);
}




?>
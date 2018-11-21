<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$created_at =  date("Y-m-d H:i:s");
/*
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
$sql = 'INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `tel`, `gender`, `country`, `created_date`)
    VALUES ("$firstname", "$lastname", "$email", "$password", "$tel", "$gender", "$country", NOW())';
$result = mysqli_query($conn, $sql);

//Check for errors
if (!$result) {
die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

//Close the connection
mysqli_close($conn);
}
*/

if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($password) || !empty($tel) || !empty($gender)
|| !empty($country)) {
    $serverName = "localhost";
    $database = "registration";
    $username = "root";
    $password = "";
    
    //create connection
    $conn = mysqli_connect($serverName, $username, $password, $database);

    // Check that connection exists
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }else{
        $SELECT = "SELECT email From users WHERE email = ? Limit 1";
        $INSERT = "INSERT Into users (firstname, lastname, email, password, tel, gender, country, created_at) 
        values (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt-> store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password",  $password);
            $stmt->bindParam(":tel",  $tel);
            $stmt->bindParam(":gender",  $gender);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":created_at", $created_at);
            $stmt->execute();
            echo "New record inserted successfully";
        }else {
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }

} else{
    echo "All field are required";
    die();
}

?>
<?php
$db_host = 'localhost';
$db_user = 'admin';
$db_password = '1234';
$db_name = 'bokningssystem';

// Create a database connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the users table if it doesn't exist
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    from_date DATETIME NOT NULL,
    to_date DATETIME NOT NULL
)";

if (mysqli_query($conn, $sql_users)) {
    // echo "users table created successfully!";
} else {
    echo "Error creating users table: " . mysqli_error($conn);
}

// Create the bikes table if it doesn't exist
$sql_bikes = "CREATE TABLE IF NOT EXISTS bikes (
    Bike_ID INT AUTO_INCREMENT PRIMARY KEY,
    Bike_Name VARCHAR(255) NOT NULL,
    Availability_Status VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql_bikes)) {
    // echo "Bikes table created successfully!";
} else {
    echo "Error creating bikes table: " . mysqli_error($conn);
}

// Create the manage table if it doesn't exist
$sql_manage = "CREATE TABLE IF NOT EXISTS manage (
    Booking_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT NOT NULL,
    Bike_ID INT NOT NULL,
    Booking_Date DATETIME NOT NULL,
    Return_Date DATETIME NOT NULL,
    FOREIGN KEY (User_ID) REFERENCES users(User_ID),
    FOREIGN KEY (Bike_ID) REFERENCES bikes(Bike_ID)
)";

if (mysqli_query($conn, $sql_manage)) {
    // echo "Manage table created successfully!";
} else {
    echo "Error creating manage table: " . mysqli_error($conn);
}

?>

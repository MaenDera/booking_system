<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $bike_id = $_POST["bike_id"]; // Added to capture the selected bike
    $availability_status = $_POST["availability_status"]; // Added to capture availability status

    // Insert user data into the "users" table
    $sql_users = "INSERT INTO users (first_name, last_name, email, telephone, from_date, to_date)
            VALUES ('$first_name', '$last_name', '$email', '$telephone', '$from_date', '$to_date')";
            
    // Insert reservation data into the "manage" table
    $sql_manage = "INSERT INTO manage (User_ID, Bike_ID, Booking_Date, Return_Date) 
            VALUES (LAST_INSERT_ID(), '$bike_id', '$from_date', '$to_date')";

    if (mysqli_query($conn, $sql_users) && mysqli_query($conn, $sql_manage)) {
        // Update the availability status of the selected bike to 'Booked' in the 'bikes' table
        $updateBikeSQL = "UPDATE bikes SET Availability_Status = 'Booked' WHERE Bike_ID = $bike_id";
        
        if (mysqli_query($conn, $updateBikeSQL)) {
            echo "<p>Thank you, $first_name, for booking a bike. You will be redirected to the payment page.</p>";
            // Add payment processing logic or redirection to the actual payment gateway here.
        } else {
            echo "Error updating bike availability status: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Payment Page</h1>
    <a href="index.php">Back to Booking</a>
    <!-- This is only for test -->
    <a href="admin_bookings.php">Go to admin</a>
</body>
</html>

<?php
include('db_config.php');

// Check if the "Delete" button is clicked
if (isset($_POST['action']) && $_POST['action'] === 'delete_booking') {
    $bookingID = $_POST['booking_id'];

    // Get the associated bike ID
    $bikeIDQuery = "SELECT Bike_ID FROM manage WHERE Booking_ID = $bookingID";
    $bikeIDResult = mysqli_query($conn, $bikeIDQuery);
    if ($bikeIDResult && mysqli_num_rows($bikeIDResult) > 0) {
        $row = mysqli_fetch_assoc($bikeIDResult);
        $bikeID = $row['Bike_ID'];

        // Update the bike availability status to 'Available'
        $updateBikeStatusQuery = "UPDATE bikes SET Availability_Status = 'Available' WHERE Bike_ID = $bikeID";
        mysqli_query($conn, $updateBikeStatusQuery);

        // Delete the booking from the "manage" table
        $deleteQuery = "DELETE FROM manage WHERE Booking_ID = $bookingID";
        if (mysqli_query($conn, $deleteQuery)) {
            // Successful deletion
            header("Location: admin_bookings.php");
            exit;
        }
    }
}

// Query to retrieve data from the "manage" table
$sql = "SELECT m.Booking_ID, m.User_ID, m.Bike_ID, m.Booking_Date, m.Return_Date, u.first_name, u.last_name, u.email, u.telephone, b.Bike_Name
        FROM manage m
        INNER JOIN users u ON m.User_ID = u.User_ID
        INNER JOIN bikes b ON m.Bike_ID = b.Bike_ID";

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Manage Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>View Manage Table</h1>
    <div class="grid-container"> <!-- Add the grid container -->
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="grid-item">'; // Use grid items for each table row
            echo '<p><strong>Booking ID:</strong> ' . $row['Booking_ID'] . '</p>';
            echo '<p><strong>User ID:</strong> ' . $row['User_ID'] . '</p>';
            echo '<p><strong>Bike ID:</strong> ' . $row['Bike_ID'] . '</p>';
            echo '<p><strong>Bike Name:</strong> ' . $row['Bike_Name'] . '</p>';
            echo '<p><strong>Booking Date/Time:</strong> ' . $row['Booking_Date'] . '</p>';
            echo '<p><strong>Return Date/Time:</strong> ' . $row['Return_Date'] . '</p>';
            echo '<p><strong>First Name:</strong> ' . $row['first_name'] . '</p>';
            echo '<p><strong>Last Name:</strong> ' . $row['last_name'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
            echo '<p><strong>Telephone:</strong> ' . $row['telephone'] . '</p>';

            // Add a form to delete the booking
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="action" value="delete_booking">';
            echo '<input type="hidden" name="booking_id" value="' . $row['Booking_ID'] . '">';
            echo '<button type="submit">Delete</button>';
            echo '</form>';

            echo '</div>';
        }
        ?>
    </div>
    <br>
    <a href="bikes.php" class="admin-link">Bikes Page</a>
</div>
</body>
</html>

<?php
include('db_config.php');

// Check if the admin is logged in (You should have an admin authentication mechanism)
$adminLoggedIn = true; // Change this to your actual admin authentication check

if ($adminLoggedIn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "add_bike") {
                // Add a new bike
                $bikeName = $_POST["bike_name"];
                $availabilityStatus = $_POST["availability_status"];

                $sql = "INSERT INTO bikes (Bike_Name, Availability_Status) VALUES ('$bikeName', '$availabilityStatus')";

                if (mysqli_query($conn, $sql)) {
                    echo "Bike added successfully!";
                } else {
                    echo "Error adding bike: " . mysqli_error($conn);
                }
            } elseif ($_POST["action"] == "delete_bike") {
                // Delete an existing bike
                $bikeID = $_POST["bike_id"];

                $sql = "DELETE FROM bikes WHERE Bike_ID = $bikeID";

                if (mysqli_query($conn, $sql)) {
                    echo "Bike deleted successfully!";
                } else {
                    echo "Error deleting bike: " . mysqli_error($conn);
                }
            }
        }
    }

    // Fetch and display the list of bikes for the admin to manage
    $sql = "SELECT * FROM bikes";
    $result = mysqli_query($conn, $sql);
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Bike Management</title>
</head>
<body>
<div class="containerIndex">
    <h1>Admin Bike Management</h1>
    <h2>Add a Bike</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="add_bike">
        <label for="bike_name">Bike Name:</label>
        <input type="text" name="bike_name" required>
        <label for="availability_status">Availability Status:</label>
        <select name="availability_status">
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select><br><br>
        <button type="submit">Add Bike</button>
    </form>
</div><br>
<div class="container">
    <h2>Manage Bikes</h2>

    <div class="grid-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="grid-item">
            <p><strong>Bike ID:</strong> <?php echo $row["Bike_ID"]; ?></p>
            <p><strong>Bike Name:</strong> <?php echo $row["Bike_Name"]; ?></p>
            <p><strong>Availability Status:</strong> <?php echo $row["Availability_Status"]; ?></p>
            <form action="" method="post">
                <input type="hidden" name="action" value="delete_bike">
                <input type="hidden" name="bike_id" value="<?php echo $row["Bike_ID"]; ?>">
                <button type="submit">Delete</button>
            </form>
        </div>
        <?php }} ?>
    </div>
    <br>
    <a href="admin_bookings.php" class="admin-link">Admin Bookings</a>
</div>

</body>
</html>

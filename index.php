<?php
include('db_config.php'); // Include the database connection configuration
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bike Rental Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="containerIndex">
        <h2>Bike Rental Booking</h2>
        <form action="payment.php" method="post" onsubmit="return validateForm()">

            <p id="emailError" class="error"></p>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required placeholder="John">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required placeholder="Doe">

            <!-- Bike selection -->
            <label for="bike_id">Select a Bike:</label>
            <select name="bike_id" id="bike_id" required>
                <?php
                // Fetch and display the available bikes from the "bikes" table
                $sql = "SELECT Bike_ID, Bike_Name FROM bikes WHERE Availability_Status = 'Available'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row["Bike_ID"] . '">' . $row["Bike_Name"] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>No available bikes</option>';
                }
                ?>
            </select>

            <!-- Availability status (you can fetch this value from the database) -->
            <input type="hidden" name="availability_status" value="Available">
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required placeholder="john.doe@example.com">
            <label for="confirm_email">Confirm Email:</label>
            <input type="email" name="confirm_email" id="confirm_email" required placeholder="john.doe@example.com">
            <p id="emailConfirmError" class="error"></p>

            <label for="telephone">Telephone Number:</label>
            <input type="tel" name="telephone" id="telephone" required placeholder="07123456789">
            <p id="telephoneError" class="error"></p>

            <label for="from_date">From Date and Time:</label>
            <input type="datetime-local" name="from_date" id="from_date" required placeholder="YYYY-MM-DDTHH:MM">

            <label for="to_date">To Date and Time:</label>
            <input type="datetime-local" name="to_date" id="to_date" required placeholder="YYYY-MM-DDTHH:MM">
            <p id="dateError" class="error"></p>

            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>

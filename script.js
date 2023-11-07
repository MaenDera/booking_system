function validateForm() {
    var email = document.getElementById("email").value;
    var confirmEmail = document.getElementById("confirm_email").value;
    var telephone = document.getElementById("telephone").value;
    var fromDate = new Date(document.getElementById("from_date").value);
    var toDate = new Date(document.getElementById("to_date").value);
    var today = new Date(); // Get the current date and time

    // Initialize error messages as empty
    var emailError = document.getElementById("emailError");
    var emailConfirmError = document.getElementById("emailConfirmError");
    var telephoneError = document.getElementById("telephoneError");
    var dateError = document.getElementById("dateError");

    emailError.textContent = ""; // Clear any existing error messages
    emailConfirmError.textContent = "";
    telephoneError.textContent = "";
    dateError.textContent = "";

    // Check if email matches confirm_email
    if (email !== confirmEmail) {
        emailConfirmError.textContent = "Emails do not match.";
        return false;
    }

    // Check if telephone starts with "07" and is a number
    if (!/^07\d{8}$/.test(telephone)) {
        telephoneError.textContent = "Telephone number should start with '07' and be 10 digits.";
        return false;
    }

    // Check if "From Date" is in the future
    if (fromDate <= today) {
        dateError.textContent = "From Date should be Today.";
        return false;
    }

    // Check if "To Date" is at least 24 hours from "From Date"
    var timeDifference = toDate - fromDate; // Time difference in milliseconds
    var hoursDifference = timeDifference / (1000 * 60 * 60); // Convert to hours
    if (hoursDifference < 24) {
        dateError.textContent = "To Date should be at least 24 hours from From Date.";
        return false;
    }

    return true;
}





<?php

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
    $proposed_date = strip_tags(trim($_POST["proposed_date"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    // Check that data was sent to the mailer.
    if (empty($name) or empty($message) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = "pnjuno@firstassurance.co.ke";

    // Set the email subject.
    $subject = "New Appointment Request from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content = "Phone Number: $phone\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\nRequest For Appointment\n\n";

    $email_content .= "Proposed Date: $proposed_date\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your request has been sent succcessfully.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>

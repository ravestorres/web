<?php

require 'config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim(filter_var($_POST['first_name'], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST['last_name'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $country = trim(filter_var($_POST['country'], FILTER_SANITIZE_STRING));

    // Validation
    if (empty($firstName)) $errors[] = "First name is required.";
    if (empty($lastName)) $errors[] = "Last name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($password) || strlen($password) < 8) $errors[] = "Password must be at least 8 characters.";
    if (empty($country)) $errors[] = "Country is required.";

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare("INSERT INTO client (first_name, last_name, email, password, country) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $country);

        if ($stmt->execute()) {
            echo "<p>Thank you, $firstName! Your account as a client has been created.</p>";
        } else {
            $errors[] = "An error occurred. Please try again later.";
            error_log("Database insert error: " . $stmt->error);
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Register as a Client</h1>
        
        <?php
        // Display error messages if there are any
        if (!empty($errors)) {
            echo '<div class="error-messages">';
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            echo '</div>';
        }
        ?>
        
        <form action="client_registration.php" method="POST">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName ?? ''); ?>" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName ?? ''); ?>" required>

            <label for="email">Work Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="country">Country</label>
            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($country ?? ''); ?>" required>

            <button type="submit">Create My Account</button>
        </form>

        <p>Looking for work? <a href="freelancer_registration.php">Apply as freelancer</a></p>
    </div>

</body>
</html>

<?php

    include 'config.php';
if (isset($_POST['role'])) {
    $role = $_POST['role'];

   
    if ($role === 'client') {
        
        header('Location: client_registration.php');
    } elseif ($role === 'freelancer') {
        
        header('Location: freelancer_registration.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as a Client or Freelancer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <h1>Join as a Client or Freelancer</h1>
        <form action="signup.php" method="POST">
            <div class="option">
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <p>I'm a client, hiring for a project</p>
                <input type="radio" id="client" name="role" value="client" onclick="updateButtonText()">
            </div>

            <div class="option">
                <div class="icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <p>I'm a freelancer, looking for work</p>
                <input type="radio" id="freelancer" name="role" value="freelancer" onclick="updateButtonText()">
            </div>

            <button type="submit" id="submitButton">Create Account</button>
        </form>
        <p>Already have an account? <a href="#">Log In</a></p>
    </div>

    <script>
        function updateButtonText() {
            const clientRadio = document.getElementById('client');
            const freelancerRadio = document.getElementById('freelancer');
            const submitButton = document.getElementById('submitButton');

            if (clientRadio.checked) {
                submitButton.textContent = 'Join as a Client';
            } else if (freelancerRadio.checked) {
                submitButton.textContent = 'Apply as a Freelancer';
            }
        }
    </script>

</body>
</html>

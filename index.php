<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $errorMessages = [
        'firstNameError' => $_SESSION['firstNameError'] ?? "",
        'lastNameError' => $_SESSION['lastNameError'] ?? "",
        'emailError' => $_SESSION['emailError'] ?? "",
        'ageError' => $_SESSION['ageError'] ?? "",
        'addressError' => $_SESSION['addressError'] ?? "",
        'successMessage' => $_SESSION['successMessage'] ?? ""
    ];
    ?>
    <div class="container">
        <form action="request.php" method="POST">
            <?php
            if (!empty($errorMessages['successMessage'])) {
                echo "<p class='success'>{$errorMessages['successMessage']}</p>";
            } elseif (array_filter($errorMessages)) {
                echo "<p class='error'>Please correct the highlighted fields.</p>";
            }
            ?>

            <div>
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Հասմիկ">
                <?php if (!empty($errorMessages['firstNameError'])): ?>
                    <span class="error"><?php echo $errorMessages['firstNameError']; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Հախվերդյան">
                <?php if (!empty($errorMessages['lastNameError'])): ?>
                    <span class="error"><?php echo $errorMessages['lastNameError']; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com">
                <?php if (!empty($errorMessages['emailError'])): ?>
                    <span class="error"><?php echo $errorMessages['emailError']; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label for="age">Age</label>
                <input type="number" id="age" name="age" placeholder="21">
                <?php if (!empty($errorMessages['ageError'])): ?>
                    <span class="error"><?php echo $errorMessages['ageError']; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Հաղարծին ">
                <?php if (!empty($errorMessages['addressError'])): ?>
                    <span class="error"><?php echo $errorMessages['addressError']; ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" id="submit">Submit</button>
        </form>
    </div>
</body>
</html>
<?php session_destroy(); ?>

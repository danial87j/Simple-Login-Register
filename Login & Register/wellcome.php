<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcome</title>
</head>
<body>
    <h1>Hallo,</h1>
    <h3>Tell Me About Your Experience In My Site</h3>
    <form method="post" action="wellcome.php">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required>
<br>
<br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
<br>
<br>
  <label for="comment">Comment:</label>
  <br>
  <textarea id="comment" name="comment" required></textarea>
<br>
<br>
  <button type="submit">Submit Comment</button>
</form>
</body>
</html>
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'login&register';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  // There was an error connecting to the database, display an error message
  die("Connection failed: " . $conn->connect_error);
}

// Get the comments from the database
$sql = "SELECT * FROM comments";

$result = $conn->query($sql);

// Loop through the results and display each comment
while ($row = $result->fetch_assoc()) {
  echo "<div class='comment'>";
  echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
  echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
  echo "</div>";
}

// Close the connection
$conn->close();


if (!empty($_POST)) {
    // Form data is available, process the form
  
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
  
    // Validate the form data
    if (empty($name)) {
      $nameError = "Name is required.";
    }
  
    if (empty($email)) {
      $emailError = "Email is required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = "Invalid email address.";
    }
  
    if (empty($comment)) {
      $commentError = "Comment is required.";
    }
  
    if (empty($nameError) && empty($emailError) && empty($commentError)) {
      // Form data is valid, insert it into the database
  
      // Connect to the database
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'login&register';
  
      $conn = new mysqli($host, $user, $password, $dbname);
  
      if ($conn->connect_error) {
        // There was an error connecting to the database, display an error message
        die("Connection failed: " . $conn->connect_error);
      }
  
      // Insert the form data into the database
      $sql = "INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)";
  
      $stmt = $conn->prepare($sql);
  
      if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $comment);
  
        if ($stmt->execute()) {
          // Comment was successfully submitted, display a success message
          echo "Comment has been submitted.";
        } else {
          // There was an error submitting the comment, display an error message
          echo "Error submitting comment: " . $stmt->error;
        }
  
        $stmt->close();
      } else {
        // There was an error preparing the statement, display an error message
        echo "Error: " . $conn->error;
      }
  
      $conn->close();
    }
}

?>

<?php

?>
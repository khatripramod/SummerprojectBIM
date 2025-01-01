<?php
// Database connectio
$conn = mysqli_connect("localhost","root","","books",3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image data based on author ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT image FROM authors WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Set appropriate content type header based on image type
        header("Content-type: image/jpeg"); // Assuming JPEG format for now
        echo $row['image'];
    } else {
        // If image not found, output a placeholder image or an error message
        header("Content-type: image/png");
        // Output a placeholder image or an error message image
        // Example:
        // echo file_get_contents('error_image.png');
    }
} else {
    // If author ID is not provided, output a placeholder image or an error message
    header("Content-type: image/png");
    // Output a placeholder image or an error message image
    // Example:
    // echo file_get_contents('error_image.png');
}

$conn->close();
?>

<?php
// Include your database connection code or any necessary configurations

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the medication ID from the AJAX request
    $medicationId = isset($_POST['id']) ? $_POST['id'] : '';

    // Update the database (replace with your actual database update logic)
    // For example, using PDO
    $dsn = "mysql:host=your_host;dbname=your_database";
    $username = "your_username";
    $password = "your_password";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Update the quantity and status to zero and "Out of stock" respectively
        $updateQuery = "UPDATE medication_table SET quantity = 0, status = 'Out of stock' WHERE id = :id";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':id', $medicationId);
        $stmt->execute();

        // Send a success response
        echo "Update successful";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating database: " . $e->getMessage();
    } finally {
        // Close the database connection
        $pdo = null;
    }
} else {
    // Handle other request methods (GET, etc.)
    echo "Invalid request method";
}
?>

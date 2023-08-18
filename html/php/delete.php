<?php include "dbConnection.php";
// Handle deletion
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $sql_delete = "DELETE FROM users WHERE ID = $delete_id";
        if (mysqli_query($conn, $sql_delete)) {
            echo "Record deleted successfully.";
            // Refresh the page to update the table
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    ?>
    
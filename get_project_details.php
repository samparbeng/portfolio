<?php

include 'config.php';
include 'includes/error_handling.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($stmt = $conn->prepare('SELECT title, image, description FROM portfolio_items WHERE id = ?')) {
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                echo json_encode($row);
            } else {
                echo json_encode(['error' => 'Project not found']);
            }
            $stmt->close();
        } else {
            logError("Failed to execute query: " . $stmt->error);
            echo json_encode(['error' => 'Failed to fetch project details']);
        }
    } else {
        logError("Failed to prepare query: " . $conn->error);
        echo json_encode(['error' => 'Failed to fetch project details']);
    }
} else {
    echo json_encode(['error' => 'Invalid project ID']);
}

$conn->close();
?>

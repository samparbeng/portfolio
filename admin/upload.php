<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);

        // Check if the directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Check file type
        $fileType = mime_content_type($_FILES['pdfFile']['tmp_name']);
        if ($fileType == 'application/pdf') {
            if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Error uploading the file.\n";
            }
        } else {
            echo "Please upload a valid PDF file.\n";
        }
    } else {
        echo "No file uploaded or there was an error uploading the file.\n";
    }
} else {
    echo "Invalid request method.\n";
}
?>

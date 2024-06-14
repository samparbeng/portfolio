<?php
// includes/error_handling.php
function logError($error_message) {
    $log_file = '../logs/error_log.txt';
    $current_time = date("Y-m-d H:i:s");
    $formatted_message = "[$current_time] - $error_message\n";
    file_put_contents($log_file, $formatted_message, FILE_APPEND);
}

function displayError($error_message) {
    echo "<div class='error'>$error_message</div>";
}
?>

<?php
// Set page title and content
$title = "Dashboard"; // Page title for the dashboard

// Start capturing content for the dashboard page
ob_start();
?>

<!-- End Page Content -->

<?php
// Capture the content and assign it to a variable
$content = ob_get_clean();

// Include the layout.php file and pass the content
include('admin/layouts/master.php');
?>

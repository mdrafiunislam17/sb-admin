<?php
// Start the session
session_start();

// Include your database configuration
require "includes/config.php"; // Ensure this contains your PDO connection ($conn)

// Check if the user is logged in by verifying if $_SESSION['user_id'] is set
if (isset($_SESSION['user_id'])) {
    try {
        // Prepare the SQL statement
        $sql = "SELECT name FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql); // Use PDO's prepare method

        // Bind the parameter (user_id from session)
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and store the name in the session
        if ($user) {
            $_SESSION['user_name'] = $user['name'];
        } else {
            // User not found
            echo "User not found!";
        }
    } catch (PDOException $e) {
        // Handle any PDO exceptions
        echo "Error: " . $e->getMessage();
    }
} else {
    // If user_id is not in session, handle the error
    echo "Please log in!";
}
?>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="#">&nbsp;SMS</a>

        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php
                        if (isset($_SESSION['user_name'])) {
                            echo $_SESSION['user_name'];
                        } else {
                            echo "Guest"; // Fallback if no session or user name is found
                        }
                    ?>
                </span>
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a> -->
                <a class="dropdown-item" href="logout.php">
                  Logut
                </a>


            </div>
        </li>

    </ul>

</nav>

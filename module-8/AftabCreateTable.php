<!--
    =============================================================================
    Title:            AftabCreateTable.php
    Author:           Aftabur Rahman
    Date:             September 14, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 8.2 Programming Assignment
    Description:      Connects to MySQL database baseball_01 using MySQLi and executes
                      a DDL query to create the state_parks table containing 6 fields
                      with multiple SQL data types (INT, VARCHAR, DATE, DECIMAL).
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 8.2: Create Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 750px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0f172a;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            font-size: 24px;
        }
        .message-box {
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 6px;
            font-size: 15px;
        }
        .success {
            background-color: #ecfdf5;
            border-left: 5px solid #10b981;
            color: #065f46;
        }
        .error {
            background-color: #fef2f2;
            border-left: 5px solid #ef4444;
            color: #991b1b;
        }
        .meta-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 14px 18px;
            margin-top: 24px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CSD 440 Server-Side Scripting</h1>
    <p><strong>Module 8.2:</strong> Database Table Creation Script</p>

    <?php
        $host = "127.0.0.1";
        $user = "student1";
        $pass = "pass";
        $dbName = "baseball_01";
        $port = 3307;

// Pass $port as the 5th parameter
        $conn = mysqli_connect($host, $user, $pass, $dbName, $port);

        if (!$conn) {
            echo "<div class='message-box error'>Connection failed: " . mysqli_connect_error() . "</div>";
        } else {
            // SQL DDL to create table with 6 fields and multiple data types
            $sql = "CREATE TABLE IF NOT EXISTS state_parks (
                park_id INT AUTO_ID NOT NULL AUTO_INCREMENT PRIMARY KEY,
                park_name VARCHAR(100) NOT NULL,
                state VARCHAR(50) NOT NULL,
                date_established DATE NOT NULL,
                acreage DECIMAL(10, 2) NOT NULL,
                camping_available VARCHAR(3) NOT NULL
            )";

            // Corrected syntax for standard auto increment
            $sql = "CREATE TABLE IF NOT EXISTS state_parks (
                park_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                park_name VARCHAR(100) NOT NULL,
                state VARCHAR(50) NOT NULL,
                date_established DATE NOT NULL,
                acreage DECIMAL(10, 2) NOT NULL,
                camping_available VARCHAR(3) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='message-box success'>";
                echo "<strong>Success!</strong> Table <code>state_parks</code> was created or already exists in database <code>{$dbName}</code>.";
                echo "</div>";
            } else {
                echo "<div class='message-box error'>";
                echo "<strong>Error creating table:</strong> " . mysqli_error($conn);
                echo "</div>";
            }

            mysqli_close($conn);
        }
    ?>

    <div class="meta-box">
        <p><strong>Target Database:</strong> <code>baseball_01</code> | <strong>User:</strong> <code>student1</code></p>
        <p><strong>Script Executed:</strong> <code>AftabCreateTable.php</code></p>
    </div>
</div>

</body>
</html>
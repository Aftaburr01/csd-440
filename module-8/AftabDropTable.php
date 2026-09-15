<!--
    =============================================================================
    Title:            AftabDropTable.php
    Author:           Aftabur Rahman
    Date:             September 14, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 8.2 Programming Assignment
    Description:      Connects to MySQL database baseball_01 via MySQLi and drops
                      the state_parks table using DROP TABLE IF EXISTS.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 8.2: Drop Table</title>
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
        .warning {
            background-color: #fffbeb;
            border-left: 5px solid #f59e0b;
            color: #92400e;
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
    <p><strong>Module 8.2:</strong> Database Table Deletion Script</p>

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
            $sql = "DROP TABLE IF EXISTS state_parks";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='message-box warning'>";
                echo "<strong>Table Dropped:</strong> The table <code>state_parks</code> has been successfully dropped from <code>{$dbName}</code>.";
                echo "</div>";
            } else {
                echo "<div class='message-box error'>";
                echo "<strong>Error dropping table:</strong> " . mysqli_error($conn);
                echo "</div>";
            }

            mysqli_close($conn);
        }
    ?>

    <div class="meta-box">
        <p><strong>Action:</strong> <code>DROP TABLE IF EXISTS state_parks</code></p>
        <p><strong>Script Executed:</strong> <code>AftabDropTable.php</code></p>
    </div>
</div>

</body>
</html>
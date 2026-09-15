<!--
    =============================================================================
    Title:            AftabPopulateTable.php
    Author:           Aftabur Rahman
    Date:             September 14, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 8.2 Programming Assignment
    Description:      Inserts initial state park exploration records into the 
                      state_parks table within the baseball_01 database using 
                      MySQLi multi-record insertion.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 8.2: Populate Table</title>
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
    <p><strong>Module 8.2:</strong> Database Record Insertion Script</p>

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
            // Insert 6 park records
            $insertSql = "INSERT INTO state_parks (park_name, state, date_established, acreage, camping_available) VALUES 
                ('Ha Ha Tonka State Park', 'Missouri', '1978-10-15', 3752.40, 'No'),
                ('Hocking Hills State Park', 'Ohio', '1949-05-12', 2356.10, 'Yes'),
                ('Custer State Park', 'South Dakota', '1919-07-01', 71000.00, 'Yes'),
                ('Watkins Glen State Park', 'New York', '1906-03-22', 778.50, 'Yes'),
                ('Palo Duro Canyon State Park', 'Texas', '1934-07-04', 29182.00, 'Yes'),
                ('Eldorado Canyon State Park', 'Colorado', '1978-08-20', 885.00, 'No')";

            if (mysqli_query($conn, $insertSql)) {
                $insertedCount = mysqli_affected_rows($conn);
                echo "<div class='message-box success'>";
                echo "<strong>Success!</strong> Successfully inserted <strong>{$insertedCount}</strong> state park records into <code>state_parks</code>.";
                echo "</div>";
            } else {
                echo "<div class='message-box error'>";
                echo "<strong>Error populating table:</strong> " . mysqli_error($conn);
                echo "</div>";
            }

            mysqli_close($conn);
        }
    ?>

    <div class="meta-box">
        <p><strong>Target Table:</strong> <code>state_parks</code></p>
        <p><strong>Script Executed:</strong> <code>AftabPopulateTable.php</code></p>
    </div>
</div>

</body>
</html>
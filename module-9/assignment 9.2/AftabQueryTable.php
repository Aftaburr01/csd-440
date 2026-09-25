<!--
    =============================================================================
    Title:            AftabQueryTable.php
    Author:           Aftabur Rahman
    Date:             September 14, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 8.2 Programming Assignment
    Description:      Connects to MySQL database baseball_01 via MySQLi, queries 
                      the state_parks table, and displays all records in a formatted 
                      HTML table using mysqli_fetch_array() and mysqli_num_rows().
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 8.2: Query Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 950px;
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
        p.subtitle {
            color: #64748b;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 12px 14px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #1e40af;
            color: #ffffff;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        tr:hover {
            background-color: #f1f5f9;
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
    <p class="subtitle"><strong>Module 8.2:</strong> US State Parks Directory Test Query</p>

    <?php
        $host = "127.0.0.1";
        $user = "student1";
        $pass = "pass";
        $dbName = "baseball_01";
        $port = 3307;

// Pass $port as the 5th parameter
        $conn = mysqli_connect($host, $user, $pass, $dbName, $port);

        if (!$conn) {
            echo "<p style='color:red;'>Connection error: " . mysqli_connect_error() . "</p>";
        } else {
            $sql = "SELECT park_id, park_name, state, date_established, acreage, camping_available FROM state_parks ORDER BY park_id ASC";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $totalRows = mysqli_num_rows($result);
                echo "<p><strong>Total Records Found:</strong> {$totalRows}</p>";
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Park Name</th>
                <th>State</th>
                <th>Date Established</th>
                <th>Acreage</th>
                <th>Camping Available</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)): 
            ?>
                <tr>
                    <td><?= $row['park_id']; ?></td>
                    <td><?= htmlspecialchars($row['park_name']); ?></td>
                    <td><?= htmlspecialchars($row['state']); ?></td>
                    <td><?= htmlspecialchars($row['date_established']); ?></td>
                    <td><?= number_format($row['acreage'], 2); ?> acres</td>
                    <td><?= htmlspecialchars($row['camping_available']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php
                mysqli_free_result($result);
            } else {
                echo "<p style='color:red;'>Query failed: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
        }
    ?>

    <div class="meta-box">
        <p><strong>Database:</strong> <code>baseball_01</code> | <strong>Table:</strong> <code>state_parks</code></p>
        <p><strong>Functions Used:</strong> <code>mysqli_connect()</code>, <code>mysqli_query()</code>, <code>mysqli_num_rows()</code>, <code>mysqli_fetch_array()</code>, <code>mysqli_close()</code></p>
        <p><strong>Query Timestamp:</strong> <?= date("F j, Y, g:i:s a"); ?></p>
    </div>
</div>

</body>
</html>
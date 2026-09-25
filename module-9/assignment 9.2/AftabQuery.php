<!--
    =============================================================================
    Title:            AftabQuery.php
    Author:           Aftabur Rahman
    Date:             September 15, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 9.2 Programming Assignment
    Description:      Interactive search page allowing users to filter the 
                      state_parks table by state name or camping availability. 
                      Executes secure parameterized queries via MySQLi prepared 
                      statements and renders results in a styled HTML table.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 9.2: Query State Parks</title>
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
        .search-form {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }
        .form-control {
            flex: 1;
            min-width: 200px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 13px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .btn-search {
            background-color: #1e40af;
            color: #ffffff;
            border: none;
            padding: 10px 22px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            height: 38px;
        }
        .btn-search:hover {
            background-color: #1d4ed8;
        }
        .btn-reset {
            background-color: #64748b;
            color: #ffffff;
            text-decoration: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            height: 20px;
            line-height: 20px;
        }
        .btn-reset:hover {
            background-color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 10px 14px;
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
        .nav-links {
            margin-top: 20px;
        }
        .nav-links a {
            color: #2563eb;
            font-weight: bold;
            text-decoration: none;
            margin-right: 15px;
        }
        .nav-links a:hover {
            text-decoration: underline;
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
    <p class="subtitle"><strong>Module 9.2:</strong> Search State Park Records</p>

    <!-- Query Filter Form -->
    <form method="GET" action="AftabQuery.php" class="search-form">
        <div class="form-control">
            <label for="state">Filter by State (or partial name):</label>
            <input type="text" id="state" name="state" placeholder="e.g., Missouri, Ohio, Dakota..." 
                   value="<?= htmlspecialchars($_GET['state'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-control">
            <label for="camping">Camping Available:</label>
            <select id="camping" name="camping">
                <option value="">-- All Options --</option>
                <option value="Yes" <?= (isset($_GET['camping']) && $_GET['camping'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?= (isset($_GET['camping']) && $_GET['camping'] === 'No') ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn-search">Search Records</button>
            <a href="AftabQuery.php" class="btn-reset">Reset</a>
        </div>
    </form>

    <?php
        $host = "127.0.0.1";
        $user = "student1";
        $pass = "pass";
        $dbName = "baseball_01";
        $port = 3307;

        $conn = mysqli_connect($host, $user, $pass, $dbName, $port);

        if (!$conn) {
            echo "<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>";
        } else {
            // Build dynamic parameterized query based on user input
            $stateParam = trim($_GET['state'] ?? '');
            $campingParam = trim($_GET['camping'] ?? '');

            $query = "SELECT park_id, park_name, state, date_established, acreage, camping_available FROM state_parks WHERE 1=1";
            $params = [];
            $types = "";

            if (!empty($stateParam)) {
                $query .= " AND state LIKE ?";
                $params[] = "%" . $stateParam . "%";
                $types .= "s";
            }

            if (!empty($campingParam)) {
                $query .= " AND camping_available = ?";
                $params[] = $campingParam;
                $types .= "s";
            }

            $query .= " ORDER BY park_id ASC";

            $stmt = mysqli_prepare($conn, $query);

            if (!empty($params)) {
                mysqli_stmt_bind_param($stmt, $types, ...$params);
            }

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);

            echo "<p><strong>Matching Records Found:</strong> {$count}</p>";
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
            <?php if ($count > 0): ?>
                <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
                    <tr>
                        <td><?= $row['park_id']; ?></td>
                        <td><?= htmlspecialchars($row['park_name']); ?></td>
                        <td><?= htmlspecialchars($row['state']); ?></td>
                        <td><?= htmlspecialchars($row['date_established']); ?></td>
                        <td><?= number_format($row['acreage'], 2); ?> acres</td>
                        <td><?= htmlspecialchars($row['camping_available']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; color:#64748b;">No matching park records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    ?>

    <div class="nav-links">
        <a href="AftabIndex.php">&larr; Return to Navigation Portal</a>
        <a href="AftabForms.php">Add New Park Record &rarr;</a>
    </div>

    <div class="meta-box">
        <p><strong>Query Mechanism:</strong> MySQLi Prepared Statements (<code>mysqli_prepare</code>, <code>mysqli_stmt_bind_param</code>)</p>
        <p><strong>Query Execution Timestamp:</strong> <?= date("F j, Y, g:i:s a"); ?></p>
    </div>
</div>

</body>
</html>
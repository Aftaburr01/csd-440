<!--
    =============================================================================
    Title:            AftabForms.php
    Author:           Aftabur Rahman
    Date:             September 15, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 9.2 Programming Assignment
    Description:      Presents an input form allowing users to add a new state 
                      park record. Validates all inputs (string, date, float, and 
                      selection) and uses MySQLi prepared statements to insert 
                      the validated row into state_parks on baseball_01.
    =============================================================================
-->
<?php
$host = "127.0.0.1";
$user = "student1";
$pass = "pass";
$dbName = "baseball_01";
$port = 3307;

$errors = [];
$successMessage = "";

// Form fields retaining values across submissions
$parkName = "";
$state = "";
$dateEstablished = "";
$acreage = "";
$campingAvailable = "Yes";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $parkName = trim($_POST['park_name'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $dateEstablished = trim($_POST['date_established'] ?? '');
    $acreage = trim($_POST['acreage'] ?? '');
    $campingAvailable = trim($_POST['camping_available'] ?? 'Yes');

    // Validation
    if (empty($parkName)) {
        $errors[] = "Park Name is required.";
    }

    if (empty($state)) {
        $errors[] = "State is required.";
    }

    if (empty($dateEstablished)) {
        $errors[] = "Date Established is required.";
    } else {
        $parts = explode('-', $dateEstablished);
        if (count($parts) !== 3 || !checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
            $errors[] = "Date Established must be a valid calendar date.";
        }
    }

    if ($acreage === '' || !is_numeric($acreage) || (float)$acreage <= 0) {
        $errors[] = "Acreage must be a positive numeric value.";
    }

    if (!in_array($campingAvailable, ['Yes', 'No'], true)) {
        $errors[] = "Camping availability must be either Yes or No.";
    }

    // Insert into database if validation passes
    if (empty($errors)) {
        $conn = mysqli_connect($host, $user, $pass, $dbName, $port);

        if (!$conn) {
            $errors[] = "Database connection failed: " . mysqli_connect_error();
        } else {
            $insertSql = "INSERT INTO state_parks (park_name, state, date_established, acreage, camping_available) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSql);

            if ($stmt) {
                $acreageFloat = (float)$acreage;
                mysqli_stmt_bind_param($stmt, "sssds", $parkName, $state, $dateEstablished, $acreageFloat, $campingAvailable);

                if (mysqli_stmt_execute($stmt)) {
                    $newId = mysqli_insert_id($conn);
                    $successMessage = "Park record successfully added with ID #{$newId}!";
                    // Reset form values on success
                    $parkName = "";
                    $state = "";
                    $dateEstablished = "";
                    $acreage = "";
                    $campingAvailable = "Yes";
                } else {
                    $errors[] = "Database insertion error: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                $errors[] = "Statement preparation error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 9.2: Add State Park Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 650px;
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
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 14px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .btn-submit {
            background-color: #1e40af;
            color: #ffffff;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #1d4ed8;
        }
        .alert {
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background-color: #dcfce7;
            border-left: 4px solid #16a34a;
            color: #15803d;
        }
        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #dc2626;
            color: #b91c1c;
        }
        .alert-error ul {
            margin: 6px 0 0 20px;
        }
        .nav-links {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
        }
        .nav-links a {
            color: #2563eb;
            font-weight: bold;
            text-decoration: none;
            font-size: 14px;
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
    <p class="subtitle"><strong>Module 9.2:</strong> Add New State Park Record</p>

    <!-- Feedback Messages -->
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success">
            <strong>&#10004; Success:</strong> <?= htmlspecialchars($successMessage); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <strong>&#10008; Please correct the following errors:</strong>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Insert Form -->
    <form action="AftabForms.php" method="POST" novalidate>
        <div class="form-group">
            <label for="park_name">Park Name:</label>
            <input type="text" id="park_name" name="park_name" placeholder="e.g., Elephant Rocks State Park" value="<?= htmlspecialchars($parkName); ?>">
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="e.g., Missouri" value="<?= htmlspecialchars($state); ?>">
        </div>

        <div class="form-group">
            <label for="date_established">Date Established:</label>
            <input type="date" id="date_established" name="date_established" value="<?= htmlspecialchars($dateEstablished); ?>">
        </div>

        <div class="form-group">
            <label for="acreage">Acreage (Acres):</label>
            <input type="number" step="0.01" id="acreage" name="acreage" placeholder="e.g., 131.00" value="<?= htmlspecialchars($acreage); ?>">
        </div>

        <div class="form-group">
            <label for="camping_available">Camping Available:</label>
            <select id="camping_available" name="camping_available">
                <option value="Yes" <?= ($campingAvailable === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?= ($campingAvailable === 'No') ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Insert Park Record</button>
    </form>

    <div class="nav-links">
        <a href="AftabIndex.php">&larr; Return to Navigation Portal</a>
        <a href="AftabQuery.php">Search & Verify Records &rarr;</a>
    </div>

    <div class="meta-box">
        <p><strong>Database Target:</strong> <code>baseball_01.state_parks</code> (Port 3307)</p>
        <p><strong>Insertion Method:</strong> Parameterized Prepared Statement</p>
    </div>
</div>

</body>
</html>
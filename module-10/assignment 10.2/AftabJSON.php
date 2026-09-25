<!--
    =============================================================================
    Title:            AftabJSON.php
    Author:           Aftabur Rahman
    Date:             September 25, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 10.2 Programming Assignment
    Description:      Server-side CGI script that validates the 8 submitted form 
                      fields, packages them into an associative array, encodes 
                      the data using json_encode(), and displays the formatted JSON.
    =============================================================================
-->
<?php
$errors = [];
$encodedJson = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Helper function for cleaning input
    function cleanInput($data) {
        return trim($data ?? '');
    }

    $fullName = cleanInput($_POST['fullName'] ?? '');
    $email = cleanInput($_POST['email'] ?? '');
    $age = cleanInput($_POST['age'] ?? '');
    $city = cleanInput($_POST['city'] ?? '');
    $state = cleanInput($_POST['state'] ?? '');
    $registrationDate = cleanInput($_POST['registrationDate'] ?? '');
    $accountBalance = cleanInput($_POST['accountBalance'] ?? '');
    $subscribe = isset($_POST['subscribe']) && $_POST['subscribe'] === '1';

    // 1. Validate Full Name
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    }

    // 2. Validate Email
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email Address format is invalid.";
    }

    // 3. Validate Age (Integer)
    if ($age === '' || filter_var($age, FILTER_VALIDATE_INT) === false || (int)$age < 1) {
        $errors[] = "Age must be a valid positive integer.";
    }

    // 4. Validate City
    if (empty($city)) {
        $errors[] = "City is required.";
    }

    // 5. Validate State
    if (empty($state)) {
        $errors[] = "State is required.";
    }

    // 6. Validate Date
    if (empty($registrationDate)) {
        $errors[] = "Registration Date is required.";
    } else {
        $parts = explode('-', $registrationDate);
        if (count($parts) !== 3 || !checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
            $errors[] = "Registration Date must be a valid calendar date.";
        }
    }

    // 7. Validate Account Balance (Float)
    if ($accountBalance === '' || filter_var($accountBalance, FILTER_VALIDATE_FLOAT) === false) {
        $errors[] = "Account Balance must be a valid numeric value.";
    }

    // If no validation errors exist, package into an array and encode to JSON
    if (empty($errors)) {
        $dataPackage = [
            "status" => "success",
            "timestamp" => date("c"),
            "user_profile" => [
                "full_name" => $fullName,
                "email" => $email,
                "age" => (int)$age,
                "city" => $city,
                "state" => $state,
                "registration_date" => $registrationDate,
                "account_balance" => (float)$accountBalance,
                "newsletter_subscription" => $subscribe
            ]
        ];

        // Encode array to formatted JSON string
        $encodedJson = json_encode($dataPackage, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
} else {
    $errors[] = "Direct script access prohibited. Please submit via AftabJSONForm.html.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 10.2: JSON Output Display</title>
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
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            font-size: 24px;
        }
        .success-title { color: #15803d; }
        .error-title { color: #b91c1c; }
        p.subtitle {
            color: #64748b;
            margin-bottom: 20px;
        }
        pre {
            background-color: #0f172a;
            color: #38bdf8;
            padding: 20px;
            border-radius: 8px;
            font-size: 14px;
            overflow-x: auto;
            line-height: 1.5;
        }
        .error-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 16px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error-box ul {
            margin: 8px 0 0 20px;
            color: #991b1b;
        }
        .error-box li { margin-bottom: 6px; }
        .btn-back {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 15px;
        }
        .btn-back:hover { background-color: #1d4ed8; }
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
    <?php if (!empty($errors)): ?>
        <!-- Error Display View -->
        <h1 class="error-title">Validation Errors Encountered</h1>
        <p class="subtitle">The form could not be processed due to the following issues:</p>

        <div class="error-box">
            <strong>Please resolve <?= count($errors); ?> error(s):</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a href="AftabJSONForm.html" class="btn-back">&larr; Return to Form</a>

    <?php else: ?>
        <!-- Success JSON Display View -->
        <h1 class="success-title">JSON Encoding Successful</h1>
        <p class="subtitle">All 8 fields were successfully validated and encoded into JSON format using <code>json_encode()</code>.</p>

        <pre><?= htmlspecialchars($encodedJson, ENT_QUOTES, 'UTF-8'); ?></pre>

        <a href="AftabJSONForm.html" class="btn-back">&larr; Submit Another Record</a>
    <?php endif; ?>

    <div class="meta-box">
        <p><strong>CGI Script:</strong> <code>AftabJSON.php</code></p>
        <p><strong>Encoding Timestamp:</strong> <?= date("F j, Y, g:i:s a"); ?></p>
    </div>
</div>

</body>
</html>
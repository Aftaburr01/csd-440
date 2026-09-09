PHP
<!--
    =============================================================================
    Title:            AftabResponse.php
    Author:           Aftabur Rahman
    Date:             September 8, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 7.2 Programming Assignment
    Description:      Server-side CGI script that validates seven incoming form 
                      fields across four+ data types. If validation errors exist, 
                      it displays a descriptive error report with a back link; 
                      otherwise, it renders a sanitized confirmation summary table.
    =============================================================================
-->
<?php
// Initialize error tracking array
$errors = [];
$validatedData = [];

// Verify HTTP request method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Helper sanitization function
    function cleanInput($data) {
        return trim($data ?? '');
    }

    // 1. Validate Full Name (String, required, alphabetic & spaces)
    $fullName = cleanInput($_POST['fullName'] ?? '');
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $fullName)) {
        $errors[] = "Full Name may only contain letters, hyphens, and spaces.";
    } else {
        $validatedData['Full Name'] = htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8');
    }

    // 2. Validate Email Address (Email format, required)
    $email = cleanInput($_POST['email'] ?? '');
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email Address must be a valid email format (e.g., name@domain.com).";
    } else {
        $validatedData['Email Address'] = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    }

    // 3. Validate Age (Integer, range 1-120)
    $age = cleanInput($_POST['age'] ?? '');
    if ($age === '') {
        $errors[] = "Age is required.";
    } elseif (filter_var($age, FILTER_VALIDATE_INT) === false || (int)$age < 1 || (int)$age > 120) {
        $errors[] = "Age must be an integer between 1 and 120.";
    } else {
        $validatedData['Age (Integer)'] = (int)$age . " years old";
    }

    // 4. Validate City (String, required)
    $city = cleanInput($_POST['city'] ?? '');
    if (empty($city)) {
        $errors[] = "City is required.";
    } elseif (!preg_match("/^[a-zA-Z\s.-]+$/", $city)) {
        $errors[] = "City may only contain letters, spaces, dots, and hyphens.";
    } else {
        $validatedData['City (Text)'] = htmlspecialchars($city, ENT_QUOTES, 'UTF-8');
    }

    // 5. Validate Registration Date (Date format YYYY-MM-DD)
    $registrationDate = cleanInput($_POST['registrationDate'] ?? '');
    if (empty($registrationDate)) {
        $errors[] = "Registration Date is required.";
    } else {
        $dateParts = explode('-', $registrationDate);
        if (count($dateParts) === 3 && checkdate((int)$dateParts[1], (int)$dateParts[2], (int)$dateParts[0])) {
            $validatedData['Registration Date'] = htmlspecialchars($registrationDate, ENT_QUOTES, 'UTF-8');
        } else {
            $errors[] = "Registration Date must be a valid calendar date.";
        }
    }

    // 6. Validate Account Balance (Float / Decimal, required, >= 0)
    $accountBalance = cleanInput($_POST['accountBalance'] ?? '');
    if ($accountBalance === '') {
        $errors[] = "Opening Account Balance is required.";
    } elseif (filter_var($accountBalance, FILTER_VALIDATE_FLOAT) === false || (float)$accountBalance < 0) {
        $errors[] = "Opening Balance must be a positive decimal or numeric dollar amount.";
    } else {
        $validatedData['Opening Balance (Float)'] = "$" . number_format((float)$accountBalance, 2);
    }

    // 7. Validate Terms and Conditions (Boolean checkbox flag)
    if (!isset($_POST['agreeTerms']) || $_POST['agreeTerms'] !== '1') {
        $errors[] = "You must accept the Terms and Conditions (Boolean agreement).";
    } else {
        $validatedData['Terms Accepted (Boolean)'] = "True (Accepted)";
    }

} else {
    $errors[] = "Direct access is prohibited. Please submit the form from AftabForm.html.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 7.2: Submission Result</title>
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
        .success-title {
            color: #15803d;
        }
        .error-title {
            color: #b91c1c;
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
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #1e40af;
            color: #ffffff;
            width: 35%;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .error-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 16px 20px;
            margin-top: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error-box ul {
            margin: 8px 0 0 20px;
            color: #991b1b;
        }
        .error-box li {
            margin-bottom: 6px;
        }
        .btn-back {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        .btn-back:hover {
            background-color: #1d4ed8;
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
    <?php if (!empty($errors)): ?>
        <!-- Error Display View -->
        <h1 class="error-title">Form Validation Errors Encountered</h1>
        <p class="subtitle">The following issues prevented your registration from being processed:</p>

        <div class="error-box">
            <strong>Please resolve the following <?= count($errors); ?> error(s):</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a href="AftabForm.html" class="btn-back">&larr; Return to Form and Correct Entries</a>

    <?php else: ?>
        <!-- Success Confirmation Display View -->
        <h1 class="success-title">Registration Confirmation</h1>
        <p class="subtitle">All 7 fields were validated successfully across all data types.</p>

        <table>
            <thead>
                <tr>
                    <th>Data Field</th>
                    <th>Validated User Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($validatedData as $label => $value): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($label); ?></strong></td>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="AftabForm.html" class="btn-back">Submit Another Record</a>
    <?php endif; ?>

    <div class="meta-box">
        <p><strong>CGI Endpoint:</strong> <code>AftabResponse.php</code></p>
        <p><strong>Server Processing Timestamp:</strong> <?= date("F j, Y, g:i:s a"); ?></p>
    </div>
</div>

</body>
</html>
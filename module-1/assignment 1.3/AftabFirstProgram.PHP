<!--
    =============================================================================
    Title:            AftabFirstProgram.php
    Author:           Aftabur Rahman
    Date:             August 13, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 1.3 Programming Assignment
    Description:      A simple dynamic web page demonstrating XAMPP server-side 
                      PHP integration, standard HTML5 structure, variable usage, 
                      and multiple PHP script snippets.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 1.3: First PHP Program</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f6f8;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            padding: 25px 35px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 650px;
        }
        h1 {
            color: #1e3a8a;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .output-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 12px 16px;
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CSD 440 Server-Side Scripting</h1>
    <p><strong>Assignment:</strong> Module 1.3 Programming Assignment</p>

    <!-- PHP Code Snippet 1: Variable Declaration & String Output -->
    <div class="output-box">
        <h3>User Profile & Course Details</h3>
        <?php
            // Declare variables
            $studentName = "Aftabur Rahman";
            $courseName = "CSD 440: Server-Side Scripting";
            $module = "Module 1.3";

            // Print formatted output using echo
            echo "<p><strong>Student:</strong> " . $studentName . "</p>";
            echo "<p><strong>Course:</strong> " . $courseName . "</p>";
            echo "<p><strong>Current Module:</strong> " . $module . "</p>";
        ?>
    </div>

    <!-- PHP Code Snippet 2: Dynamic Date & Server Environment Information -->
    <div class="output-box">
        <h3>Server Environment & Timestamp</h3>
        <?php
            // Dynamic date generation and server execution info
            $currentDate = date("F j, Y, g:i a");
            $phpVersion = phpversion();

            echo "<p><strong>Execution Time:</strong> " . $currentDate . "</p>";
            echo "<p><strong>Active PHP Version:</strong> " . $phpVersion . "</p>";
            echo "<p><em>Status: PHP and Apache are communicating successfully!</em></p>";
        ?>
    </div>
</div>

</body>
</html>
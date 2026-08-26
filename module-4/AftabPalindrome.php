<!--
    =============================================================================
    Title:            AftabPalindrome.php
    Author:           Aftabur Rahman
    Date:             August 25, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 4.2 Programming Assignment
    Description:      A PHP web application that evaluates six string test cases 
                      (three palindromes and three non-palindromes). A custom 
                      function normalizes input, reverses character order using 
                      strrev(), compares forward and reversed strings, and outputs 
                      the results in a styled HTML table.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 4.2: Palindrome Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
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
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 12px;
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
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
        }
        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
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
    <p class="subtitle"><strong>Module 4.2:</strong> Palindrome String Evaluation</p>

    <?php
        /**
         * Checks whether a given string is a palindrome.
         * Normalizes casing and strips non-alphanumeric characters for comparison.
         *
         * @param string $inputString The text string to evaluate.
         * @return array Associative array containing original, reversed, and boolean result.
         */
        function checkPalindrome($inputString) {
            // Remove non-alphanumeric characters and convert to lowercase
            $sanitized = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $inputString));
            
            // Reverse the sanitized string
            $reversed = strrev($sanitized);
            
            // Compare forward and backward versions
            $isPalindrome = ($sanitized === $reversed);

            return [
                'original' => $inputString,
                'reversed_display' => strrev($inputString),
                'sanitized' => $sanitized,
                'sanitized_reversed' => $reversed,
                'is_palindrome' => $isPalindrome
            ];
        }

        // Array of 6 test cases: 3 Palindromes and 3 Non-Palindromes
        $testStrings = [
            "Racecar",                          // Palindrome 1 (Word)
            "A man a plan a canal Panama",      // Palindrome 2 (Phrase)
            "Was it a car or a cat I saw",      // Palindrome 3 (Phrase)
            "Server Side Scripting",            // Non-Palindrome 1
            "Bellevue University",              // Non-Palindrome 2
            "Software Development 2026"         // Non-Palindrome 3
        ];
    ?>

    <!-- Results Table -->
    <table>
        <thead>
            <tr>
                <th>Test #</th>
                <th>Original String (Forward)</th>
                <th>Reversed String (Backward)</th>
                <th>Palindrome Result</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $testNumber = 1;
                foreach ($testStrings as $test): 
                    $result = checkPalindrome($test);
            ?>
                <tr>
                    <td><strong>#<?= $testNumber++; ?></strong></td>
                    <td><?= htmlspecialchars($result['original']); ?></td>
                    <td><code><?= htmlspecialchars($result['reversed_display']); ?></code></td>
                    <td>
                        <?php if ($result['is_palindrome']): ?>
                            <span class="badge badge-success">&#10004; True (Palindrome)</span>
                        <?php else: ?>
                            <span class="badge badge-danger">&#10008; False (Not Palindrome)</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="meta-box">
        <?php
            echo "<p><strong>Evaluation Function:</strong> <code>checkPalindrome(\$inputString)</code> utilizing <code>strrev()</code> and strict binary comparison (<code>===</code>)</p>";
            echo "<p><strong>Execution Timestamp:</strong> " . date("F j, Y, g:i:s a") . "</p>";
        ?>
    </div>
</div>

</body>
</html>
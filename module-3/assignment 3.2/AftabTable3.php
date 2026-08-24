<!--
    =============================================================================
    Title:            AftabTable3.php
    Author:           Aftabur Rahman
    Date:             August 18, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 3 Programming Assignment
    Description:      Generates an HTML table using nested PHP loops. Each cell's 
                      value is calculated using an external PHP function loaded via 
                      require_once, which computes the sum of two random numbers.
    =============================================================================
-->
<?php
    // Include the external function library
    require_once 'AftabFunctions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 3: Dynamic Table with External Functions</title>
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
            text-align: center;
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
            background-color: #e2e8f0;
        }
        .calculation-detail {
            font-size: 11px;
            color: #64748b;
            display: block;
            margin-top: 4px;
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
    <p class="subtitle"><strong>Module 3:</strong> Two-Dimensional Table Using External Functions</p>

    <!-- Static HTML Table Structure -->
    <table>
        <thead>
            <tr>
                <th>Row / Col</th>
                <?php 
                    $totalRows = 5;
                    $totalCols = 5;
                    
                    // Header Loop for Columns
                    for ($c = 1; $c <= $totalCols; $c++): 
                ?>
                    <th>Column <?= $c; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Outer Loop: Controls Table Rows
                for ($row = 1; $row <= $totalRows; $row++): 
            ?>
                <tr>
                    <th>Row <?= $row; ?></th>
                    <?php 
                        // Inner Nested Loop: Controls Table Columns/Cells
                        for ($col = 1; $col <= $totalCols; $col++): 
                            // Generate two random numbers
                            $val1 = rand(10, 50);
                            $val2 = rand(10, 50);

                            // Calculate sum using the external function from AftabFunctions.php
                            $sumResult = calculateCellSum($val1, $val2);
                    ?>
                        <td>
                            <strong><?= $sumResult; ?></strong>
                            <span class="calculation-detail">(<?= $val1; ?> + <?= $val2; ?>)</span>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="meta-box">
        <?php
            $cellCount = $totalRows * $totalCols;
            echo "<p><strong>Grid Dimensions:</strong> {$totalRows} rows &times; {$totalCols} columns ({$cellCount} total computed cells)</p>";
            echo "<p><strong>Function Execution:</strong> <code>calculateCellSum(\$num1, \$num2)</code> loaded via <code>AftabFunctions.php</code></p>";
            echo "<p><strong>Generated on:</strong> " . date("F j, Y, g:i:s a") . "</p>";
        ?>
    </div>
</div>

</body>
</html>
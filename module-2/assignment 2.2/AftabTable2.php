<!--
    =============================================================================
    Title:            AftabTable2.php
    Author:           Aftabur Rahman
    Date:             August 17, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 2 Programming Assignment
    Description:      Generates a 2D HTML table using nested PHP loops to populate 
                      cells with random integers. HTML structural tags are maintained 
                      as pure markup, utilizing opening/closing PHP tags for control 
                      flow and output rather than echoing table tags.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 2: 2D Dynamic Random Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 800px;
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
            font-size: 15px;
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
        .meta-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 12px 16px;
            margin-top: 24px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CSD 440 Server-Side Scripting</h1>
    <p class="subtitle"><strong>Module 2:</strong> Two-Dimensional Random Number Table</p>

    <!-- HTML Table Structure (Tags are not generated via PHP echo) -->
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
                            $randomNumber = rand(10, 99);
                    ?>
                        <td>
                            <?= $randomNumber; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="meta-box">
        <?php
            $minVal = 10;
            $maxVal = 99;
            $cellCount = $totalRows * $totalCols;
            echo "<p><strong>Grid Dimensions:</strong> {$totalRows} rows &times; {$totalCols} columns ({$cellCount} dynamic cells)</p>";
            echo "<p><strong>Random Value Range:</strong> [{$minVal} - {$maxVal}]</p>";
            echo "<p><strong>Generated on:</strong> " . date("F j, Y, g:i:s a") . "</p>";
        ?>
    </div>
</div>

</body>
</html>
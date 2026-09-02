PHP
<!--
    =============================================================================
    Title:            AftabCustomers.php
    Author:           Aftabur Rahman
    Date:             September 1, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 5.2 Programming Assignment
    Description:      Creates a multi-dimensional indexed/associative array of 10 
                      customer records containing first name, last name, age, and 
                      phone number. Utilizes PHP array functions (array_filter, 
                      array_column, array_search) to filter, search, and display 
                      customer records based on specific data criteria.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 5.2: Customer Records Management</title>
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
        h2 {
            color: #1e40af;
            font-size: 18px;
            margin-top: 30px;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 6px;
        }
        p.subtitle {
            color: #64748b;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
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
        tr:hover {
            background-color: #f1f5f9;
        }
        .filter-highlight {
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 10px 14px;
            margin-bottom: 10px;
            font-size: 14px;
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
    <p class="subtitle"><strong>Module 5.2:</strong> Customer Multi-Dimensional Array Operations</p>

    <?php
        // Multi-dimensional array holding 10 customer records
        $customers = [
            [
                "first_name" => "Aftabur",
                "last_name"  => "Rahman",
                "age"        => 42,
                "phone"      => "816-555-0142"
            ],
            [
                "first_name" => "Jose",
                "last_name"  => "Saenz",
                "age"        => 28,
                "phone"      => "816-555-0198"
            ],
            [
                "first_name" => "Miguel",
                "last_name"  => "Brazon",
                "age"        => 31,
                "phone"      => "913-555-0174"
            ],
            [
                "first_name" => "Rashai",
                "last_name"  => "Robertson",
                "age"        => 26,
                "phone"      => "816-555-0133"
            ],
            [
                "first_name" => "Sara",
                "last_name"  => "White",
                "age"        => 35,
                "phone"      => "913-555-0189"
            ],
            [
                "first_name" => "Patrice",
                "last_name"  => "Moracchini",
                "age"        => 48,
                "phone"      => "816-555-0111"
            ],
            [
                "first_name" => "Tiffany",
                "last_name"  => "Davidson",
                "age"        => 29,
                "phone"      => "913-555-0165"
            ],
            [
                "first_name" => "Robert",
                "last_name"  => "Breutzmann",
                "age"        => 52,
                "phone"      => "816-555-0128"
            ],
            [
                "first_name" => "Matthew",
                "last_name"  => "Rozendaal",
                "age"        => 39,
                "phone"      => "913-555-0104"
            ],
            [
                "first_name" => "Isaac",
                "last_name"  => "Ellingson",
                "age"        => 24,
                "phone"      => "816-555-0157"
            ]
        ];
    ?>

    <!-- 1. Display Full Customer List -->
    <h2>Master Customer Roster (All 10 Records)</h2>
    <table>
        <thead>
            <tr>
                <th>Record #</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $index => $customer): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($customer['first_name']); ?></td>
                    <td><?= htmlspecialchars($customer['last_name']); ?></td>
                    <td><?= $customer['age']; ?></td>
                    <td><?= htmlspecialchars($customer['phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 2. Search by Phone Number via array_column & array_search -->
    <h2>Target Search 1: Find by Phone Number (Using <code>array_search()</code>)</h2>
    <?php
        $targetPhone = "816-555-0111";
        $phoneList = array_column($customers, 'phone');
        $foundIndex = array_search($targetPhone, $phoneList, true);
    ?>
    <div class="filter-highlight">
        Search query: Phone number <strong><?= $targetPhone; ?></strong>
    </div>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Lookup Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($foundIndex !== false): ?>
                <tr>
                    <td><?= htmlspecialchars($customers[$foundIndex]['first_name']); ?></td>
                    <td><?= htmlspecialchars($customers[$foundIndex]['last_name']); ?></td>
                    <td><?= $customers[$foundIndex]['age']; ?></td>
                    <td><?= htmlspecialchars($customers[$foundIndex]['phone']); ?></td>
                    <td><strong>Found at Index <?= $foundIndex; ?></strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="5">No record found matching that phone number.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- 3. Filter by Age Threshold via array_filter -->
    <h2>Target Search 2: Filter by Age (Using <code>array_filter()</code> for Age &ge; 40)</h2>
    <?php
        $seniorCustomers = array_filter($customers, function ($cust) {
            return $cust['age'] >= 40;
        });
    ?>
    <div class="filter-highlight">
        Filtering condition: <strong>Age 40 and above</strong> (<?= count($seniorCustomers); ?> matching records)
    </div>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seniorCustomers as $cust): ?>
                <tr>
                    <td><?= htmlspecialchars($cust['first_name']); ?></td>
                    <td><?= htmlspecialchars($cust['last_name']); ?></td>
                    <td><?= $cust['age']; ?></td>
                    <td><?= htmlspecialchars($cust['phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 4. Filter by Last Name Match via array_filter -->
    <h2>Target Search 3: Find by Last Name (Using <code>array_filter()</code> for "Rahman")</h2>
    <?php
        $targetLastName = "Rahman";
        $matchedLastName = array_filter($customers, function ($cust) use ($targetLastName) {
            return strcasecmp($cust['last_name'], $targetLastName) === 0;
        });
    ?>
    <div class="filter-highlight">
        Filtering condition: Last Name equals <strong><?= $targetLastName; ?></strong>
    </div>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matchedLastName as $cust): ?>
                <tr>
                    <td><?= htmlspecialchars($cust['first_name']); ?></td>
                    <td><?= htmlspecialchars($cust['last_name']); ?></td>
                    <td><?= $cust['age']; ?></td>
                    <td><?= htmlspecialchars($cust['phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="meta-box">
        <?php
            echo "<p><strong>Array Operations Applied:</strong> <code>array_column()</code>, <code>array_search()</code>, <code>array_filter()</code>, and <code>strcasecmp()</code></p>";
            echo "<p><strong>Total Master Records:</strong> " . count($customers) . " customer profiles</p>";
            echo "<p><strong>Generated on:</strong> " . date("F j, Y, g:i:s a") . "</p>";
        ?>
    </div>
</div>

</body>
</html>
<!--
    =============================================================================
    Title:            AftabIndex.php
    Author:           Aftabur Rahman
    Date:             September 15, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 9.2 Programming Assignment
    Description:      Main landing portal providing clean navigation links to all 
                      Module 8 and Module 9 database operations (Query, Insert, 
                      Create, Populate, Drop, and View Roster).
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 9.2: State Parks Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 30px;
        }
        .container {
            max-width: 850px;
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
        h2 {
            color: #1e40af;
            font-size: 18px;
            margin-top: 25px;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 6px;
        }
        p.subtitle {
            color: #64748b;
            margin-bottom: 24px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
            margin-top: 15px;
        }
        .card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.2s ease-in-out;
        }
        .card:hover {
            border-color: #2563eb;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
        }
        .card h3 {
            margin: 0 0 8px 0;
            color: #0f172a;
            font-size: 16px;
        }
        .card p {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 14px 0;
        }
        .btn-link {
            display: inline-block;
            background-color: #1e40af;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
        }
        .btn-link:hover {
            background-color: #1d4ed8;
        }
        .btn-danger {
            background-color: #dc2626;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
        .meta-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 14px 18px;
            margin-top: 28px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CSD 440 Server-Side Scripting</h1>
    <p class="subtitle"><strong>Module 9.2:</strong> US State Parks Database Navigation Portal</p>

    <!-- Module 9 Primary Actions -->
    <h2>Module 9 Interactive Features</h2>
    <div class="grid">
        <div class="card">
            <h3>Search State Parks</h3>
            <p>Search park records filtered by state or camping facilities.</p>
            <a href="AftabQuery.php" class="btn-link">Launch Query Page</a>
        </div>
        <div class="card">
            <h3>Add New Park</h3>
            <p>Insert a new state park record with field validation.</p>
            <a href="AftabForms.php" class="btn-link">Open Record Form</a>
        </div>
    </div>

    <!-- Module 8 Administrative Actions -->
    <h2>Module 8 Schema Management & Roster</h2>
    <div class="grid">
        <div class="card">
            <h3>Full Park Directory</h3>
            <p>Run the baseline select query to view all records in the roster.</p>
            <a href="AftabQueryTable.php" class="btn-link">View Full Roster</a>
        </div>
        <div class="card">
            <h3>Populate Table</h3>
            <p>Execute batch insertion of initial sample state park data.</p>
            <a href="AftabPopulateTable.php" class="btn-link">Populate Data</a>
        </div>
        <div class="card">
            <h3>Create Table</h3>
            <p>Verify or recreate the <code>state_parks</code> schema.</p>
            <a href="AftabCreateTable.php" class="btn-link">Create Schema</a>
        </div>
        <div class="card">
            <h3>Drop Table</h3>
            <p>Remove the <code>state_parks</code> table from <code>baseball_01</code>.</p>
            <a href="AftabDropTable.php" class="btn-link btn-danger">Drop Schema</a>
        </div>
    </div>

    <div class="meta-box">
        <p><strong>Database:</strong> <code>baseball_01</code> (Port 3307) | <strong>User:</strong> <code>student1</code></p>
        <p><strong>Author:</strong> Aftabur Rahman | <strong>Portal Endpoint:</strong> <code>AftabIndex.php</code></p>
    </div>
</div>

</body>
</html>
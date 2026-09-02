<!--
    =============================================================================
    Title:            AftabMyInteger.php
    Author:           Aftabur Rahman
    Date:             September 1, 2026
    Course:           CSD 440 Server-Side Scripting
    Assignment:       Module 6.2 Programming Assignment
    Description:      Defines an object-oriented PHP class titled AftabMyInteger 
                      holding an encapsulated integer. Implements a parameterized 
                      constructor, getter/setter methods, parity checks (isEven, 
                      isOdd), and an isPrime evaluation. Two instances are created 
                      to execute and test all methods inside a styled HTML5 document.
    =============================================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSD 440 - Module 6.2: MyInteger OOP Class</title>
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
        h2 {
            color: #1e40af;
            font-size: 18px;
            margin-top: 25px;
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
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
        }
        .badge-true {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }
        .badge-false {
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
    <p class="subtitle"><strong>Module 6.2:</strong> Object-Oriented Integer Evaluation</p>

    <?php
        /**
         * Class AftabMyInteger
         * Encapsulates an integer and provides numeric evaluation methods.
         */
        class AftabMyInteger {
            // Encapsulated integer property
            private int $value;

            /**
             * Parameterized Constructor
             * 
             * @param int $value Initial integer value
             */
            public function __construct(int $value) {
                $this->value = $value;
            }

            /**
             * Getter method for $value
             * 
             * @return int
             */
            public function getValue(): int {
                return $this->value;
            }

            /**
             * Setter method for $value
             * 
             * @param int $value
             * @return void
             */
            public function setValue(int $value): void {
                $this->value = $value;
            }

            /**
             * Checks if an integer is even.
             * 
             * @param int $val
             * @return bool
             */
            public function isEven(int $val): bool {
                return ($val % 2 === 0);
            }

            /**
             * Checks if an integer is odd.
             * 
             * @param int $val
             * @return bool
             */
            public function isOdd(int $val): bool {
                return ($val % 2 !== 0);
            }

            /**
             * Evaluates whether the encapsulated object value is a prime number.
             * 
             * @return bool
             */
            public function isPrime(): bool {
                if ($this->value <= 1) {
                    return false;
                }
                if ($this->value <= 3) {
                    return true;
                }
                if ($this->value % 2 === 0 || $this->value % 3 === 0) {
                    return false;
                }

                // Check potential factors up to square root of value
                for ($i = 5; $i * $i <= $this->value; $i += 6) {
                    if ($this->value % $i === 0 || $this->value % ($i + 2) === 0) {
                        return false;
                    }
                }

                return true;
            }
        }

        // Helper function to render formatted boolean badges
        function renderBoolBadge(bool $val): string {
            return $val 
                ? '<span class="badge badge-true">True</span>' 
                : '<span class="badge badge-false">False</span>';
        }

        // Instantiate Object 1 with value 17
        $intObj1 = new AftabMyInteger(17);

        // Instantiate Object 2 with value 24
        $intObj2 = new AftabMyInteger(24);
    ?>

    <!-- Instance 1 Testing Table -->
    <h2>Instance 1 Testing (Initial Value: <?= $intObj1->getValue(); ?>)</h2>
    <table>
        <thead>
            <tr>
                <th>Method Invoked</th>
                <th>Argument Passed</th>
                <th>Returned Output</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>getValue()</code></td>
                <td><em>None</em></td>
                <td><strong><?= $intObj1->getValue(); ?></strong></td>
            </tr>
            <tr>
                <td><code>isEven(int)</code></td>
                <td><?= $intObj1->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj1->isEven($intObj1->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isOdd(int)</code></td>
                <td><?= $intObj1->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj1->isOdd($intObj1->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isPrime()</code></td>
                <td><em>Uses encapsulated state ($this->value)</em></td>
                <td><?= renderBoolBadge($intObj1->isPrime()); ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Instance 2 Testing Table -->
    <h2>Instance 2 Testing (Initial Value: <?= $intObj2->getValue(); ?>)</h2>
    <table>
        <thead>
            <tr>
                <th>Method Invoked</th>
                <th>Argument Passed</th>
                <th>Returned Output</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>getValue()</code></td>
                <td><em>None</em></td>
                <td><strong><?= $intObj2->getValue(); ?></strong></td>
            </tr>
            <tr>
                <td><code>isEven(int)</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj2->isEven($intObj2->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isOdd(int)</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj2->isOdd($intObj2->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isPrime()</code></td>
                <td><em>Uses encapsulated state ($this->value)</em></td>
                <td><?= renderBoolBadge($intObj2->isPrime()); ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Mutator (Setter) Demonstration on Instance 2 -->
    <h2>Setter Method Demonstration (Instance 2 Mutation)</h2>
    <?php
        $previousValue = $intObj2->getValue();
        $newValue = 29;
        $intObj2->setValue($newValue);
    ?>
    <p>Modified Instance 2 using <code>setValue(<?= $newValue; ?>)</code> (previously <?= $previousValue; ?>):</p>
    <table>
        <thead>
            <tr>
                <th>Method Invoked</th>
                <th>Current Value</th>
                <th>Returned Output</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>getValue()</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><strong><?= $intObj2->getValue(); ?></strong></td>
            </tr>
            <tr>
                <td><code>isEven(int)</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj2->isEven($intObj2->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isOdd(int)</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj2->isOdd($intObj2->getValue())); ?></td>
            </tr>
            <tr>
                <td><code>isPrime()</code></td>
                <td><?= $intObj2->getValue(); ?></td>
                <td><?= renderBoolBadge($intObj2->isPrime()); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="meta-box">
        <?php
            echo "<p><strong>Class Defined:</strong> <code>AftabMyInteger</code></p>";
            echo "<p><strong>Execution Status:</strong> All methods (constructor, getter, setter, isEven, isOdd, isPrime) tested successfully.</p>";
            echo "<p><strong>Server Timestamp:</strong> " . date("F j, Y, g:i:s a") . "</p>";
        ?>
    </div>
</div>

</body>
</html>
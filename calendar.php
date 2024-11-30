<?php
$week = ["Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота", "Неділя"];
$year = date('Y');
$month = date('m');
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = date('t', $firstDayOfMonth);
$currentDay = date('d');

$monthName = date('F', $firstDayOfMonth);
$monthNameUkr = [
    'January' => 'Січень',
    'February' => 'Лютий',
    'March' => 'Березень',
    'April' => 'Квітень',
    'May' => 'Травень',
    'June' => 'Червень',
    'July' => 'Липень',
    'August' => 'Серпень',
    'September' => 'Вересень',
    'October' => 'Жовтень',
    'November' => 'Листопад',
    'December' => 'Грудень',
];
$monthName = $monthNameUkr[$monthName];

$prevMonth = $month - 1 == 0 ? 12 : $month - 1;
$prevYear = $month - 1 == 0 ? $year - 1 : $year;
$daysInPrevMonth = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));

$firstDayOfWeek = date('N', $firstDayOfMonth);

$nextMonth = $month + 1 == 13 ? 1 : $month + 1;
$nextYear = $month + 1 == 13 ? $year + 1 : $year;

echo <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календар</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #74ebd5, #acb6e5);
        color: #333;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
    }

    h1 {
        font-size: 32px;
        color: #fff;
        margin-bottom: 20px;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    table {
        width: auto;
        border-collapse: collapse;
        margin: 20px;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        max-width: 100%;
    }

    th, td {
        width: 60px;
        height: 60px;
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        border: 1px solid #ddd;
    }

    th {
        background: #f7f7f7;
        color: #555;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .weekend {
        background: #ffe5e5;
        color: #d9534f;
        transition: background 0.3s ease;
    }

    .weekend:hover {
        background: #ffcccc;
        cursor: pointer;
    }

    .today {
        background: #fff7b2;
        font-weight: bold;
        color: #333;
    }

    .notToday {
        background: white;
        transition: background 0.3s ease;
    }

    .notToday:hover {
        background: #eee;
        cursor: pointer;
    }

    .otherMonth {
        background: #f0f0f0;
        color: #aaa;
        transition: background 0.3s ease;
    }
    .otherMonth:hover{
        background: #ccc;
        cursor: pointer;
    }
    td:empty {
        background: #f0f0f0;
    }

    @media (max-width: 768px) {
        th, td {
            width: 40px;
            height: 40px;
            font-size: 12px;
        }

        h1 {
            font-size: 24px;
        }
    }
</style>
</head>
<body>
<h1>$monthName $year</h1>
EOD;

echo "<table>";

echo "<tr>";
foreach ($week as $dayName) {
    $classOfDay = ($dayName == "Субота" || $dayName == "Неділя") ? "weekend" : "day";
    echo "<th class='$classOfDay'><span>$dayName</span></th>";
}
echo "</tr>";

$countOfDays = 0;

for ($i = $firstDayOfWeek - 1; $i > 0; $i--) {
    $prevDay = $daysInPrevMonth - $i + 1;
    echo "<td class='otherMonth'><span>$prevDay</span></td>";
    $countOfDays++;
}

for ($dayNumber = 1; $dayNumber <= $daysInMonth; $dayNumber++) {
    $isWeekend = ($countOfDays % 7 == 5 || $countOfDays % 7 == 6);
    $classOfToday = $dayNumber == $currentDay ? "today" : ($isWeekend ? "weekend" : "notToday");
    echo "<td class='$classOfToday'><span>$dayNumber</span></td>";
    $countOfDays++;

    if ($countOfDays % 7 == 0) {
        echo "</tr><tr>";
    }
}

$nextDay = 1;
while ($countOfDays % 7 != 0) {
    echo "<td class='otherMonth'><span>$nextDay</span></td>";
    $nextDay++;
    $countOfDays++;
}

echo "</tr>";
echo "</table>";
echo <<<EOD
</body>
</html>
EOD;

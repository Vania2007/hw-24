<?php
$students = [
    ["name" => "Іван", "birthdate" => strtotime("13.09.2007")],
    ["name" => "Олена", "birthdate" => strtotime("15.05.2010")],
    ["name" => "Петро", "birthdate" => strtotime("27.12.1989")],
    ["name" => "Марія", "birthdate" => strtotime("05.07.2018")],
    ["name" => "Андрій", "birthdate" => strtotime("02.02.2005")],
    ["name" => "Катерина", "birthdate" => strtotime("19.11.2008")],
    ["name" => "Максим", "birthdate" => strtotime("03.03.1997")],
    ["name" => "Анна", "birthdate" => strtotime("22.08.2001")],
    ["name" => "Олександр", "birthdate" => strtotime("14.04.1995")],
    ["name" => "Юлія", "birthdate" => strtotime("09.09.2003")],
    ["name" => "Володимир", "birthdate" => strtotime("30.10.2012")],
    ["name" => "Світлана", "birthdate" => strtotime("11.01.2006")],
    ["name" => "Дмитро", "birthdate" => strtotime("07.07.2009")],
    ["name" => "Оксана", "birthdate" => strtotime("25.12.2000")],
    ["name" => "Роман", "birthdate" => strtotime("17.06.1992")],
    ["name" => "Наталія", "birthdate" => strtotime("04.04.1998")],
    ["name" => "Тарас", "birthdate" => strtotime("28.02.1990")],
    ["name" => "Людмила", "birthdate" => strtotime("12.12.1985")],
    ["name" => "Віктор", "birthdate" => strtotime("21.03.2014")],
    ["name" => "Дарина", "birthdate" => strtotime("08.08.2002")],
];

function calculateAge($birthdate)
{
    $today = time();
    $age = date('Y', $today) - date('Y', $birthdate);
    if (date('md', $today) < date('md', $birthdate)) {
        $age--;
    }
    return $age;
}

$months = [
    1 => "Січень",
    2 => "Лютий",
    3 => "Березень",
    4 => "Квітень",
    5 => "Травень",
    6 => "Червень",
    7 => "Липень",
    8 => "Серпень",
    9 => "Вересень",
    10 => "Жовтень",
    11 => "Листопад",
    12 => "Грудень",
];

foreach ($students as $key => $student) {
    $students[$key]['age'] = calculateAge($student['birthdate']);
}

uasort($students, function ($a, $b) {
    return $a['age'] <=> $b['age'];
});
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенти</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Інформація про студентів</h1>
    <table>
        <thead>
            <tr>
                <th>Ім'я</th>
                <th>Дата народження</th>
                <th>Вік</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td>
                        <?php
$dateInfo = getdate($student['birthdate']);
echo $dateInfo['mday'] . " " . $months[$dateInfo['mon']] . " " . $dateInfo['year'];
?>
                    </td>
                    <td><?php echo $student['age']; ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</body>
</html>

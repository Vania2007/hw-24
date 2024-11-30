<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перевірка дати народження</title>
</head>
<body>
    <h1>Введіть вашу дату народження</h1>
    <form method="POST">
        <label for="day">День:</label>
        <input type="number" id="day" name="day" min="1" max="31" required><br/>

        <label for="month">Місяць:</label>
        <input type="number" id="month" name="month" min="1" max="12" required><br/>

        <label for="year">Рік:</label>
        <input type="number" id="year" name="year" required><br/><br/>

        <button type="submit">Перевірити</button>
    </form>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    if (checkdate($month, $day, $year)) {
        $date = "$day.$month.$year";
        $dayOfWeek = date('l', strtotime($date));

        $daysUkr = [
            'Monday' => 'Понеділок',
            'Tuesday' => 'Вівторок',
            'Wednesday' => 'Середа',
            'Thursday' => 'Четвер',
            'Friday' => 'Пʼятниця',
            'Saturday' => 'Субота',
            'Sunday' => 'Неділя',
        ];

        $dayOfWeekUkr = $daysUkr[$dayOfWeek];
        echo "<p style='color: green;'>Дата народження коректна: $date ({$dayOfWeekUkr}).</p>";
    } else {
        echo "<p style='color: red;'>Введено некоректну дату. Перевірте правильність введених даних.</p>";
    }
}
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Results</title>
    <style>
    h1
    {
        padding-top: 300px;
        text-align: center;
        color: black ;
    }
    img
    {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 120px;
        height: 100px;
    }
</style>
</head>
<body>
<img src="logo.jpg" alt="Corner Image" class="corner-image">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "sql12.freesqldatabase.com";
    $user = "sql12721705";
    $password = "byJ4gxnY7w";
    $db = "sql12721705";
            
    $data = mysqli_connect($host, $user, $password, $db);

    if ($data === false) {
        die("Connection error");
    }

    $subjects = [];
    for ($i = 1; $i <= 8; $i++) {
        $subjects["Sub$i"] = $_POST["Sub$i"];
    }

    $grades = [];
    for ($i = 1; $i <= 8; $i++) {
        $grades["G$i"] = $_POST["G$i"];
    }

    $gradePoints = [
        "O" => 10,
        "A+" => 9,
        "A" => 8,
        "B+" => 7,
        "B" => 6,
    ];

    $credits = [];
    foreach ($subjects as $key => $subject) {
        $query = "SELECT credits FROM CGPA WHERE sub_id='$subject'";
        $result = mysqli_query($data, $query);
        $row = mysqli_fetch_assoc($result);
        $credits[$key] = $row["credits"];
    }

    $totalCredits = array_sum($credits);
    $weightedSum = 0;

    foreach ($grades as $key => $grade) {
        $subjectKey = str_replace("G", "Sub", $key);
        $weightedSum += $credits[$subjectKey] * $gradePoints[$grade];
    }

    $cgpa = $weightedSum / $totalCredits;

    echo "<h1 style='text-align:center;'>CGPA: $cgpa</h1>";

    mysqli_close($data);
}
?>
</body>
</html>
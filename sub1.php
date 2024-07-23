<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="sub1">
<img src="public/logo.jpg" alt="Corner Image" class="corner-image">
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

                    $s = $_POST["s"];
                    $d = $_POST["d"];

                    $subjectQuery = "SELECT sub_id, sub_name FROM CGPA WHERE Sem='$s' AND Dept='$d'";
                    $subjectResult = mysqli_query($data, $subjectQuery);

                    if ($subjectResult === null || mysqli_num_rows($subjectResult) == 0) {
                        echo "No results found";
                    } else {
                        $subjects = mysqli_fetch_all($subjectResult, MYSQLI_ASSOC);
                    }
                }
                ?>

                <?php if (!empty($subjects)): ?>
                    <form method="post" action="sub.php">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <div>
                                <label class="l1">Subject <?php echo $i; ?>:</label>
                                <select name="Sub<?php echo $i; ?>" id="Sub<?php echo $i; ?>">
                                    <?php foreach ($subjects as $subject): ?>
                                        <option value="<?php echo $subject['sub_id']; ?>">
                                            <?php echo $subject['sub_id'] . " - " . $subject['sub_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="G<?php echo $i; ?>" id="gd<?php echo $i; ?>">
                                    <option value="O">O</option>
                                    <option value="A+">A+</option>
                                    <option value="A">A</option>
                                    <option value="B+">B+</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        <?php endfor; ?>
                        <div><br>
                            <input type="submit" name="submit" value="Calculate" class="btn btn-outline-dark">
                        </div>
                    </form>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
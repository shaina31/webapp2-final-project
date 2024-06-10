<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
    <h1>MAIN:<span> POSTS</span></h1>
    <div class="main-cont">
        <ul id="mainList">
        <?php

            require 'index.php';

            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit;
            }

            $dsn = "mysql:host=$hostLocal;dbname=$dBase;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);

                if ($pdo) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM `posts` WHERE user_id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $user_id]);

                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        echo '<li><a class ="link" href="details.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </ul>
    </div>
</body>

</html>
<?php
    session_start();
    require ('config.php');

    if(!isset($_SESSION['user_id'])) {
        header("location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <!-- header -->
        <?php include('nav.php'); ?>
        <!-- header  end-->

        <!-- heroes -->
        <div class="px-4 py-5 my-5 text-center">

            <?php 
                if(isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                }

                try {
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute([$user_id]);
                    $userData = $stmt->fetch();

                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>

            <h1 class="display-5 fw-bold text-body-emphasis">Welcome to Mydeshboard <?php echo $userData['username'] ?></h1>
            

        </div>
        <!-- heroes end-->

       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
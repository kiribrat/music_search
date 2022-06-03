<?php
    session_start();
    require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-light bg-gradient">  
    <section">
        <form class="container" action="admin.php" method="POST">
            <div style="height: 35vh"></div>
            <div class="row justify-content-center">
                <h3 class="col-4 text-center my-4"> Panel administracyjny </h3>
                <div class="w-100"></div>
                <div class="form-floating mb-3 col-3">
                    <input type="text" class="form-control" id="floatingInput" name="login" placeholder=" ">
                    <label for="floatingInput" class="ms-2">Login</label>
                </div>
                <div class="w-100"></div>
                <div class="form-floating col-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder=" ">
                    <label for="floatingPassword" class="ms-2">Hasło</label>
                </div>
                <div class="w-100"></div>
                <?php
                        if(isset($_POST['wyloguj']))
                        {
                            unset($_SESSION['zalogowany']);

                        }
                        if(isset($_SESSION['error'])) 
                        {
                            echo '<p class="text-danger col-3 mt-1">Nieprawidłowy login lub hasło</p>';
                            echo '<div class="w-100"></div>';
                            echo '<button type="submit" class="btn btn-success col-1 mt-1" type="button">Zaloguj</button>';
                        }
                        else
                        {
                            echo '<button type="submit" class="btn btn-success col-1 mt-5" type="button">Zaloguj</button>';
                        }
                        if(isset($_SESSION['zalogowany'])) header('Location: admin.php');
                ?>
                
            </div>
        </form>
    </section>  

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>




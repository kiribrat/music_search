<?php
    session_start();
    require_once "connect.php";
?>

<?php  
    if(!isset($_SESSION['zalogowany'])){
        if ($_POST['login'] != "midas" || $_POST['password'] != "2137")
        {
            $_SESSION['error']='error';
            header('Location: login.php');
        }
        else 
        {
            unset($_SESSION['error']);
            $_SESSION['zalogowany']=1;
        }
    }

    function check($nazwa)
        {
            $pop="x";

            for($i=0;$i<strlen($nazwa);$i++ )
            {
                if($nazwa[$i]>='a' && $nazwa[$i]<='z'
                || $nazwa[$i]>='A' && $nazwa[$i]<='Z'
                || $nazwa[$i]>='0' && $nazwa[$i]<='9') continue;

                if(($nazwa[$i]=="-" || $nazwa[$i]==" ") && $nazwa[$i-1]!=$nazwa[$i]) continue;

                $nazwa[$i]="X";
                $nazwa[$i]="X";
                $pop = $nazwa[$i];
                /* header('Location: index.php'); */
                return;

            }
            return $nazwa;
        }
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
        <div class="container">
        <div style="height: 15vh"></div>
        
        <div class="row">
            <h1 class="col-12 col-lg-8" style="font-size:3.5rem; font-weight:650">Panel administracyjny</h1>
            <form  action="login.php" method="POST" class="col-12 col-lg-4 nav justify-content-center justify-content-lg-end">
            <a href="index.php" role="utton" class="align-text-bottom btn border-0 text-dark rounded-start rounded-0 my-3 px-4 mx-0 me-1" style="--bs-btn-bg: #a3d0bb; --bs-btn-hover-bg: #479f76; line-height:32px">Strona główna</a>
            <button type="sumbit" name="wyloguj" class="btn border-0 text-dark rounded-end rounded-0 my-3 px-4" style="--bs-btn-bg: #dee2e6; --bs-btn-hover-bg: #adb5bd">Wyloguj</button>
        </form>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 g-5 mt-5" name="cards">
            <div class="col">
                <form class="card border-success mb-3 p-0" action="admin.php" method="POST">
                    <div class="card-header">Dodawanie</div>
                    <div class="card-body text-success">
                        <h5 class="card-title mb-4">Dodaj wybrany utwór</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Tytuł</label>
                            <input type="text" class="form-control" name="tytul" placeholder="Never Gonna Give You Up">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Wykonawca</label>
                            <input type="text" class="form-control" name="wykonawca" placeholder="Rick Astley">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Gatunek</label>
                            <input type="text" class="form-control" name="gatunek" placeholder="Dance-pop">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Data wydania (rok)</label>
                            <input type="text" class="form-control" name="data" placeholder="1987">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Popularność (0 - 100)</label>
                            <input type="text" class="form-control" name="Popularnosc" placeholder="67">
                        </div>
                        <button type="submit" name="dodaj" class="btn btn-success mt-3 px-4">Dodaj</button>
                    </div>
                </form>

                <?php
                    if (isset($_POST['dodaj'])) {
                        try {
                            $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
                
                            $tytul = check($_POST['tytul']);
                            $wykonawca = check($_POST['wykonawca']);
                            $gatunek = check($_POST['gatunek']);
                            $data = check($_POST['data']);
                            $Popularnosc = check($_POST['Popularnosc']);
                
                            $sql = "INSERT INTO spotify (tytul, wykonawca, gatunek, data, Popularnosc) VALUES ('$tytul', '$wykonawca', '$gatunek', '$data', '$Popularnosc'); ";
                            $result = $pdo->query($sql);
                            
                            
                            echo '<h5 data-aos="fade-up" class="card-title text-success mb-4" style="padding-left: 16px">Dodano utwór!</h5>';
                
                        } catch (PDOException $e) {
                            echo 'Error: '.$e->getMessage();
                        } finally {
                            $pdo = null;
                        }
                    }
                ?>
                
            </div>
            <div class="col">
                <form class="card border-warning mb-3 p-0" action="admin.php" method="POST">
                    <div class="card-header">Modyfikowanie</div>
                    <div class="card-body text-warning">
                        <h5 class="card-title mb-4">Zmień dane wybranego utworu</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">ID</label>
                            <input type="text" class="form-control" name="ID" id="ID" placeholder="122" required >
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Tytuł</label>
                            <input type="text" class="form-control" name="tytul" placeholder="Never Gonna Give You Up">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Wykonawca</label>
                            <input type="text" class="form-control" name="wykonawca" placeholder="Rick Astley">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Gatunek</label>
                            <input type="text" class="form-control" name="gatunek" placeholder="Dance-pop">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Data wydania (rok)</label>
                            <input type="text" class="form-control" name="data" placeholder="1987">
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Popularność (0 - 100)</label>
                            <input type="text" class="form-control" name="Popularnosc" placeholder="67">
                        </div>
                        <button type="submit" name="zmiana" class="btn btn-warning px-4">Wprowadź zmiany</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['zmiana'])) {
                        try {
                            $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
                
                            $ID = check($_POST['ID']);
                            $tytul = check($_POST['tytul']);
                            $wykonawca = check($_POST['wykonawca']);
                            $gatunek = check($_POST['gatunek']);
                            $data = check($_POST['data']);
                            $Popularnosc = check($_POST['Popularnosc']);
                
                            if ($tytul != "") $pdo->query("UPDATE spotify SET tytul='$tytul' WHERE ID='$ID'");
                            if ($wykonawca != "") $pdo->query("UPDATE spotify SET wykonawca='$wykonawca' WHERE ID='$ID'");
                            if ($gatunek != "") $pdo->query("UPDATE spotify SET gatunek='$gatunek' WHERE ID='$ID'");
                            if ($data != "") $pdo->query("UPDATE spotify SET data='$data' WHERE ID='$ID'");
                            if ($Popularnosc != "") $pdo->query("UPDATE spotify SET Popularnosc='$Popularnosc' WHERE ID='$ID'");

                            echo '<h5 data-aos="fade-up" class="card-title mb-4" style="color: #f9bc04; padding-left: 16px">Zmodyfikowano utwór!</h5>';
                
                        } catch (PDOException $e) {
                            echo '<h5 data-aos="fade-up" class="card-title mb-4" style="color: #f9bc04; padding-left: 16px">Błąd</h5>';
                        } finally {
                            $pdo = null;
                        }
                    }
                ?>
                
            </div>
            <div class="col">
                <form class="card border-danger mb-3 p-0" action="admin.php" method="POST">
                    <div class="card-header">Usuwanie</div>
                    <div class="card-body text-danger">
                        <h5 class="card-title mb-4">Usuń wybrany utwór z bazy danych</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">ID</label>
                            <input type="text" class="form-control" name="ID" id="ID" placeholder="46" required >
                        </div>
                        <button type="submit" name="usun" class="btn btn-danger px-4">Usuń</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['usun'])) {
                    try {
                        $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);

                        $ID = check($_POST['ID']);
                        $pdo->query("DELETE FROM spotify WHERE ID='$ID'");
                        echo '<h5 data-aos="zoom-in" class="card-title text-danger mb-4">Usunięto utwór!</h5>';

                    } catch (PDOException $e) {
                        echo '<h5 data-aos="zoom-in" class="card-title text-danger mb-4">Błąd</h5>';

                    } finally {
                        $pdo = null;
                    }
                }
                ?>
            </div>
    </section>  

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>








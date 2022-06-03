<?php
    session_start();
    require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css">
    <link rel="stylesheet" href="bower_components/jQuery-ui-Slider-Pips/dist/jquery-ui-slider-pips.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
       
    #flat-slider.ui-slider {
    background: #adb5bd;
    border: none;
    border-radius: 0; }
                      
    #flat-slider.ui-slider .ui-slider-handle {
      width: 26px;
      height: 26px;
      border-radius: 50% 50% 0;
      border-color: transparent;
      transition: border 0.4s ease; }
                      
      #flat-slider.ui-slider .ui-slider-handle.ui-state-hover, 
      #flat-slider.ui-slider .ui-slider-handle.ui-state-focus, 
      #flat-slider.ui-slider .ui-slider-handle.ui-state-active,
      .ui-wid {
        /*border-color: #f8f9fa;  */
        border-width: 1px;
        outline-style: none;
      }
                      
    #flat-slider.ui-slider .ui-slider-pip .ui-slider-line {
      background: #6c757d;
      transition: all 0.4s ease; }
                      
    #flat-slider.ui-slider.ui-slider-horizontal {
      height: 6px; }
                      
      #flat-slider.ui-slider.ui-slider-horizontal .ui-slider-handle {
        -webkit-transform: rotateZ(45deg);
                transform: rotateZ(45deg);
        top: -40px;
        margin-left: -13px; }
                      
      #flat-slider.ui-slider.ui-slider-horizontal .ui-slider-pip {
        top: 15px; }
                      
        #flat-slider.ui-slider.ui-slider-horizontal .ui-slider-pip .ui-slider-line {
          width: 2px;
          height: 10px;
          margin-left: -1px; }
                      
        #flat-slider.ui-slider.ui-slider-horizontal .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line {
          height: 20px; }
                      
        #flat-slider.ui-slider.ui-slider-horizontal .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line {
          height: 12px; }
                      
                      
  #flat-slider .ui-slider-handle,
  #flat-slider .ui-slider-range,
  #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line,
  #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line {
    background-color: RGBA(25,135,84,var(--bs-bg-opacity,1));
    background: RGBA(25,135,84,var(--bs-bg-opacity,1));
  }

  .ui-slider-label, .ui-slider-label:hover{
      margin-top: 20px;
      color:  #f8f9fa;
      font-weight: 400;
  }

  p {
    color: #f8f9fa;
    text-align: center;
    margin: 0.5em 1em;
    font-weight: 400;
    font-size: 1.3em;
  }

  .ui-slider-pip-selected-1, .ui-slider-pip-selected-2 {
    color: white;
  }

</style>
</head>

<body>  
  <section class="bg-dark py-5 text-center" style="min-height: 100vh">
  <div style="height: 10vh"></div>
    <form class="container text-light" action="index.php#wynik" method="POST" data-aos="zoom-in">
      <div class="row justify-content-end">
      <a type="button" class="btn btn-secondary col-4 col-lg-1 rounded-3" href="login.php">Zaloguj</a>
      </div>
      <div class=" py-5" style="font-size: 5rem; font-weight: 600; margin-bottom: 200px">Wyszukaj piosenkę :DD</div>
      <div id="flat-slider" class="my-5"></div>
      <input type="hidden" id="amount1" name="amount1">
      <input type="hidden" id="amount2" name="amount2">
      <div class="row py-5 justify-content-center">
        <div class="col-12 col-lg-3 mb-3">
          <select name="gatunek" class="shadow-lg form-select text-bg-success p-3 border-0 rounded-3 fw-semibold fs-5" aria-label="Default select example">
            <option value="gatunek" selected>Gatunek</option>
            <?php         
            
              try {
                  $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
                  $result = $pdo->query('SELECT gatunek FROM spotify GROUP BY gatunek');

                  foreach ($result as $row)
                  {
                    echo '<option value="'.$row['gatunek'].'">'.$row['gatunek'].'</option>';
                  }
                
              } catch (PDOException $e) {
                  echo 'Error: '.$e->getMessage();
              } finally {
                  $pdo = null;
              }
            ?>
          </select>
        </div>
        <div class="col-12 col-lg-3 mb-3">
          <select name="wykonawca" class="shadow-lg form-select text-bg-secondary p-3 border-0 rounded-3 fw-semibold fs-5" aria-label="Default select example">
            <option value="wykonawca" selected>Wykonawca</option>
            <?php         
              
              try {
                  $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
                  $result = $pdo->query('SELECT wykonawca FROM spotify GROUP BY wykonawca');

                  foreach ($result as $row)
                  {
                    echo '<option value="'.$row['wykonawca'].'">'.$row['wykonawca'].'</option>';
                  }
                
              } catch (PDOException $e) {
                  echo 'Error: '.$e->getMessage();
              } finally {
                  $pdo = null;
              }
            ?>
          </select>
        </div>
        <div class="col-12 col-lg-3 mb-3">
          <select name="popularnosc" class="shadow-lg form-select text-bg-warning p-3 border-0 rounded-3 fw-semibold fs-5" aria-label="Default select example">
            <option value="-100" selected>Popularność</option>
            <option value="0">0 - 25</option>
            <option value="25">25 - 50</option>
            <option value="50">50 - 75</option>
            <option value="75">75 - 100</option>
          </select>
        </div>
        <div class="col-12 col-lg-3 mb-3">
          <select name="sortuj" class="shadow-lg form-select text-bg-danger p-3 border-0 rounded-3 fw-semibold fs-5" aria-label="Default select example">
            <option value="sortuj" selected>Sortuj</option>
            <option value="tytul">Tutuł alfabetycznie</option>
            <option value="wykonawca">Wykonawca alfabetycznie</option>
            <option value="data">Data wydania</option>
            <option value="Popularnosc">Popularność</option>
          </select>
        </div>
      </div>
      <button type="submit" name="submit" class="shadow-lg col-2 btn btn-outline-light btn-lg fw-bold p-3 m-5 rounded-3">Znajdź</button>  
    </form>
  </section>

  
        <?php  
          if (isset($_POST['submit'])){
            $gatunek = filter_input(INPUT_POST, 'gatunek', FILTER_SANITIZE_STRING);

            if ($gatunek != "gatunek"){
              $gatunek = '"'.$gatunek.'"';
            }
        
            $wykonawca = filter_input(INPUT_POST, 'wykonawca', FILTER_SANITIZE_STRING);

            if ($wykonawca != "wykonawca"){
              $wykonawca = '"'.$wykonawca.'"';
            }
        
            $popularnosc1 = filter_input(INPUT_POST, 'popularnosc', FILTER_SANITIZE_STRING);

            if ($popularnosc1 == -100){
              $popularnosc2 = 100;
            }
            else {
              $popularnosc2 = intval($popularnosc1) + 25;
            }
        
            $date1 = $_POST['amount1'];
        
            $date2 = $_POST['amount2'];

            $sortuj = $_POST['sortuj'];

            

            if ($sortuj != "sortuj")
            {
              $sort_task = ' ORDER BY '.$sortuj;
            }
            else 
            {
              $sort_task = ' ';
            }

            echo '
            <section class="py-5" id="wynik">
            <div class="container ">
              <h1 class="text-center py-5 mb-5">Oto wyniki wyszukiwania:</h1>
              <table class="table table-success table-striped my-5 col-8 shadow-lg border-success">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Wykonawca</th>
                    <th scope="col">Gatunek</th>
                    <th scope="col">Data wydania</th>
                    <th scope="col">Popularność</th>
                  </tr>
                </thead>
                <tbody> ';
            
            try {
                $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
                /* $result = $pdo->query('SELECT ID, tytul, wykonawca, data, Popularnosc FROM spotify LIMIT 5'); */
                $sql = "SELECT ID, tytul, wykonawca, data, gatunek, Popularnosc FROM spotify WHERE gatunek=$gatunek AND wykonawca=$wykonawca AND data>=$date1 AND data<=$date2 AND Popularnosc>=$popularnosc1 AND Popularnosc<=$popularnosc2 $sort_task";
                $result = $pdo->query($sql);

                /* echo $sql; */
                
                foreach ($result as $row)
                {
                  echo '<tr>';
                  echo '<th scope="row">'.$row['ID'].'</th>';
                  echo '<td>'.$row['tytul'].'</td>';
                  echo '<td>'.$row['wykonawca'].'</td>';
                  echo '<td>'.$row['gatunek'].'</td>';
                  echo '<td>'.$row['data'].'</td>';
                  echo '<td>'.$row['Popularnosc'].'</td>';
                  echo '</tr>';
              }
              
            } catch (PDOException $e) {
                echo 'Error: '.$e->getMessage();
            } finally {
                $pdo = null;
            }
          }

          echo '
                </tbody>
              </table>
            </div>
          </section>';
        ?>
        

  
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
  AOS.init();
</script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="bower_components/jQuery-ui-Slider-Pips/dist/jquery-ui-slider-pips.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
       $.extend( $.ui.slider.prototype.options, { 
    animate: 300
});


var sstart = $("#slidestart").text()
var send = $("#slideend").text()

$(function() {
$("#flat-slider")
    .slider({
        min: 1950,
        max: 2020,
        range: true,
        values: [1965, 2010],
        step: 5,
        slide: function( event, ui ) {
          $( "#amount1" ).val(ui.values[ 0 ]);
		      $( "#amount2" ).val(ui.values[ 1 ]);

            if(ui.values[1] - ui.values[0] < 5){
                // do not allow change
                return false;
            } else {
                // allow change
                    $("#slidestart").text(ui.values[0])
                    $("#slideend").text(ui.values[1])   
            }   
        }
             
    })
    .slider("pips", {        
    })
    .slider("float", {
      pips: true
    });

  $( "#amount1" ).val($( "#flat-slider" ).slider( "values", 0 ));
	$( "#amount2" ).val($( "#flat-slider" ).slider( "values", 1 ));    

  });
    
    </script>
</body>
</html>
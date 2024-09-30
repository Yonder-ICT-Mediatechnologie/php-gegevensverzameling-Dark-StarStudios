<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom 
    <?php
    //Mijn kleine bibliotheek verbind met deze pagina
    //Controleer of ben je wel ingellogd
    require_once 'session_visitor.php';
    //Alles functies om monsters te bijwerken
    require_once 'CRUDmonstersSysteem.php';
    echo $gebruikersNaam;
    ?>
    </title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-oranje">
    <header class="bg-light mb-3 shadow d-flex justify-content-between align-items-center">
        <img class="m-2" id="logo" src="img/diced10.svg" alt="logo" />
        <h2 class="m-2">Online bestiarium D&D 5e</h2>
        <!-- <div>
        <h2>D&D 5e</h2>
        <h2><span>Online bestiarium</span></h2>
        </div> -->
    </header>
    <div class="d-flex">
        <div class="gap-2 W bg-light p-2 rounded shadow">
        <form class="d-grid mb-2" action="home.php">
                <button type="submit" class="shadow btn btn-danger">Home</button>
            </form>
            <form class="d-grid mb-2" action="home.php">
                <button type="submit" class="shadow btn btn-danger">Monsters</button>
            </form>
            <?php
            if(isset($_SESSION["login"])) {
                echo "<form class='d-grid mb-2' action='myMonsters.php'>
                        <button type='submit' class='shadow btn btn-danger'>My monsters</button>
                    </form>
                    <form class='d-grid mb-2' action='makeMonster.php'>
                        <button type='submit' class='shadow btn btn-primary'>Make monster</button>
                    </form>
                <form class='d-grid' action='home.php' method='post'>
                    <input type='hidden' name='uitloggen'>
                    <button type='submit' class='shadow btn btn-danger'>Uitloggen</button>
                </form>";
            }else{
                echo "<form class='d-grid mb-2' action='registreer.php'>
            <button type='submit' class='shadow btn btn-primary'>Registreren</button>
          </form>
          <form class='d-grid mb-2' action='login.php'>
            <button type='submit' class='shadow btn btn-primary'>Inloggen</button>
          </form>";
            }
            ?>
        </div>
        <div class="container-fluid">
            <div class="panel-monsters">
        <?php
        monstersRaeader();
        ?>
            </div>
        </div>
    </div>
    
</body>
<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
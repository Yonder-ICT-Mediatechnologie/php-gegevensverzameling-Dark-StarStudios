<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaats advertentie</title>
    <link rel="shortcut icon" href="marktplaats-logo.ico" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
</head>
<body class="bg-oranje">
    <div class="container bg-light mt-3 rounded shadow">
    <h1 class="text-grijs"> Maak monster </h1>

    <?php
    //Mijn kleine bibliotheek verbind met deze pagina
    //Controleer of ben je wel ingellogd
    require_once 'session.php';
    //Alles functies om monsters te bijwerken
    require_once 'CRUDmonstersSysteem.php';
    //Controleer of REQUEST METHOD POST is
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Controleer of alle post niet leeg zijn. Als ze zijn wel leeg dan komt een kennisgeving.
        if(post_control([$_POST["naam"]]))
        {
                //Roepen functie advertentieMaken met argumenten
                monsterMaken(htmlspecialchars(controllText($_POST["naam"])),
                htmlspecialchars(controllMaxMin(intval($_POST["armor"]))),
                htmlspecialchars(intval($_POST["HP"])),
                htmlspecialchars(controllMaxMin(intval($_POST["strength"]))),
                htmlspecialchars(controllMaxMin(intval($_POST["dexterity"]))),
                htmlspecialchars(controllMaxMin(intval($_POST["constitution"]))),
                htmlspecialchars(controllMaxMin(intval($_POST["intelligence"]))),
                htmlspecialchars(controllMaxMin(intval($_POST["wisdom"]))),
                htmlspecialchars(controllMaxMin(intval($_POST["charisma"]))),
                htmlspecialchars(intval($_POST["speed"])),
                htmlspecialchars(controllMaxMin(number_format((float)$_POST["Danger"], 2, ',', ''))),
                htmlspecialchars(controllMaxMin(intval($_POST["Mastery_Bonus"]))),
                htmlspecialchars(controllText($_POST["Immunities"])),
                htmlspecialchars(controllText($_POST["vulnerabilities"])),
                htmlspecialchars(controllText($_POST["actions"])),
                $gebruikersID);
                
        }else
        {
            //kennisgeving
            echo "<div class='alert alert-warning'><h4>Vul alstublieft alles in!</h4></div>";
        }
    }
    ?>

    <form action="makeMonster.php" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="naam" class="form-label">Naam van Monster:</label>
            <input type="text" name = "naam" class="form-control" id="naam" placeholder="Vul een naam van monster in" value="<?php echo htmlspecialchars(isset($_POST['naam'])&&!empty($_POST['naam'])?$_POST['naam']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="armor" class="form-label">Armor:</label>
            <input type="number" name = "armor" class="form-control" id="armor" placeholder="Vul een pantser in" value="<?php echo htmlspecialchars(isset($_POST['armor'])&&!empty($_POST['armor'])?$_POST['armor']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="HP" class="form-label">HP:</label>
            <input type="number" step="0.01" name = "HP" class="form-control" id="HP" placeholder="Vul een gezondheid in" value="<?php echo htmlspecialchars(isset($_POST['HP'])&&!empty($_POST['HP'])?$_POST['HP']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="strength" class="form-label">Strength:</label>
            <input type="number" name = "strength" class="form-control" id="strength" placeholder="Vul een kracht in" value="<?php echo htmlspecialchars(isset($_POST['strength'])&&!empty($_POST['strength'])?$_POST['strength']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="dexterity" class="form-label">Dexterity:</label>
            <input type="number" name = "dexterity" class="form-control" id="dexterity" placeholder="Vul een behendigheid in" value="<?php echo htmlspecialchars(isset($_POST['dexterity'])&&!empty($_POST['dexterity'])?$_POST['dexterity']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="constitution" class="form-label">Сonstitution:</label>
            <input type="number" name = "constitution" class="form-control" id="constitution" placeholder="Vul een lichaamsbouw in" value="<?php echo htmlspecialchars(isset($_POST['constitution'])&&!empty($_POST['constitution'])?$_POST['constitution']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="intelligence" class="form-label">Intelligence:</label>
            <input type="number" name = "intelligence" class="form-control" id="intelligence" placeholder="Vul een intelligentie in" value="<?php echo htmlspecialchars(isset($_POST['intelligence'])&&!empty($_POST['intelligence'])?$_POST['intelligence']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="wisdom" class="form-label">Wisdom:</label>
            <input type="number" name = "wisdom" class="form-control" id="wisdom" placeholder="Vul een wijsheid in" value="<?php echo htmlspecialchars(isset($_POST['wisdom'])&&!empty($_POST['wisdom'])?$_POST['wisdom']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="charisma" class="form-label">Charisma:</label>
            <input type="number" name = "charisma" class="form-control" id="charisma" placeholder="Vul een charisma in" value="<?php echo htmlspecialchars(isset($_POST['charisma'])&&!empty($_POST['charisma'])?$_POST['charisma']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="speed" class="form-label">Speed:</label>
            <input type="number" name = "speed" class="form-control" id="speed" placeholder="Vul een snelheid in(Feet)" value="<?php echo htmlspecialchars(isset($_POST['speed'])&&!empty($_POST['speed'])?$_POST['speed']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="Danger" class="form-label">Danger:</label>
            <input type="number" step="0.01" name = "Danger" class="form-control" id="Danger" placeholder="Vul een gevaarsniveau in" value="<?php echo htmlspecialchars(isset($_POST['Danger'])&&!empty($_POST['Danger'])?$_POST['Danger']:"");?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="Mastery_Bonus" class="form-label">Mastery Bonus:</label>
            <input type="number" name = "Mastery_Bonus" class="form-control" id="Mastery_Bonus" placeholder="Vul een master bonus in" value="<?php echo htmlspecialchars(isset($_POST['Mastery_Bonus'])&&!empty($_POST['Mastery_Bonus'])?$_POST['Mastery_Bonus']:"");?>">
        </div>
        <div class="mb-3">
            <label for="Immunities" class="form-label">Immunities(max 2000 letters):</label>
            <textarea  type="text" name = "Immunities" class="form-control" id="Immunities" placeholder="Vul Immuniteiten in"><?php echo htmlspecialchars(isset($_POST['Immunities'])&&!empty($_POST['Immunities'])?$_POST['Immunities']:"");?></textarea>
        </div>
        <div class="mb-3">
            <label for="vulnerabilities" class="form-label">Vulnerabilities(max 2000 letters):</label>
            <textarea  type="text" name = "vulnerabilities" class="form-control" id="vulnerabilities" placeholder="Vul  kwetsbaarheden in"><?php echo htmlspecialchars(isset($_POST['vulnerabilities'])&&!empty($_POST['vulnerabilities'])?$_POST['vulnerabilities']:"");?></textarea>
        </div>
        <div class="mb-3">
            <label for="actions" class="form-label">actions(max 2000 letters):</label>
            <textarea  type="text" name = "actions" class="form-control" id="actions" placeholder="Vul acties in"><?php echo htmlspecialchars(isset($_POST['actions'])&&!empty($_POST['actions'])?$_POST['actions']:"");?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Maak</button>
        <a href="home.php" class="btn btn-danger mb-3">Terug</a>
    </form>
    </div>
    
</body>
<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
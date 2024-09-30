<?php
// Array met gegevens voor de database connectie naar "dnd_npc"
$serverConnectieData = ["localhost","root","","dnd_npc"];

//Controleer of alle posts in array niet leeg zijn
function post_control($array){
    foreach($array as $element){
        if(empty($element)){
            return false;
        }
    }
    return true;
}

//Controleer of file wel afbeelding is
function is_afbeeldin($postAfbeelding){
    //Controleer of aflbeelding is wel bestaat
    if(empty($postAfbeelding['name'])){
        return false;
    }
    // Check of afbeelding file is echt afbeelding is
    $check = getimagesize($postAfbeelding["tmp_name"]);
    if($check === false) {
        return false;
    }
// Check file size
    if ($postAfbeelding["size"] > 16000000) {
        return false;
    }
    return true;
}

//Controleer of de nummer minder dan 30 en meer dan 0 is
function controllMaxMin($nummer){
    if($nummer <0){
        return 0;
    }
    if($nummer > 30){
        return 30;
    }
    return $nummer;
}

//Controleer of de tekst is
function controllText($text){
    return empty($text) ? "-": $text;
}

//berekent stat modifier
function eigenschappenRekenen($X){
 $antwoord = round(($X-10)/2);
 return $antwoord>0 ?  "+".$antwoord : $antwoord;
}


//Alle monsters laat zien
function monstersRaeader(){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
        // SQL-code die zal je naar database sturen
        $query = "SELECT idMonster,name,Danger FROM monsters";
        //Bereid de SQL-query voor en bind de parameters.
        $statement = $connectie->prepare($query);
        // Voer de query uit en controleer op fouten
        if (!$statement->execute())
        {
            throw new Exception($connectie->error);
        }
        // Bind de resultaten van de query aan variabelen
        $statement->bind_result($idMonster,$Naam,$danger);
        // Haal de resultaten op
        while($statement->fetch())
        {
            echo "<div class='bg-light rounded m-2 shadow' style='width: 31vw;'>
                        <a href='monster.php?monster=$idMonster'><h4 class='p-1 WW'>[<b>$danger</b>]".mb_strimwidth($Naam, 0, 30, "...")."</h4></a>
                </div>";
        }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "<div class='alert alert-warning'><h4>Oops: Is het iets met de Server!</h4></div>"; //. $e->getMessage();
    }
    finally
    {
            // Sluit de statement en de connectie
             if($statement){
                $statement->close();
             } 
            if($connectie){
                $connectie->close();
             } 
    }
}

//Alle monsters van gebruiker laat zien
function Mijn_monstersRaeader($gebruikersID){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
        // SQL-code die zal je naar database sturen
        $query = "SELECT idMonster,name,Danger FROM monsters WHERE idUser = ?";
        //Bereid de SQL-query voor en bind de parameters.
        $statement = $connectie->prepare($query);
        //Argument gebruikerID binden aan ?
        $statement->bind_param("i",$gebruikersID);
        // Voer de query uit en controleer op fouten
        if (!$statement->execute())
        {
            throw new Exception($connectie->error);
        }
        // Bind de resultaten van de query aan variabelen
        $statement->bind_result($idMonster,$Naam,$danger);
        // Haal de resultaten op
        while($statement->fetch())
        {
            echo "<div class='bg-light rounded m-2 shadow' style='width: 31vw;'>
                        <a href='monster.php?monster=$idMonster'><h4 class='p-1 WW'>[<b>$danger</b>]".mb_strimwidth($Naam, 0, 30, "...")."</h4></a>
                </div>";
        }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "<div class='alert alert-warning'><h4>Oops: Is het iets met de Server!</h4></div>"; //. $e->getMessage();
    }
    finally
    {
            // Sluit de statement en de connectie
            if($statement){
                $statement->close();
             } 
            if($connectie){
                $connectie->close();
             }
    }
}

//Een monster van gebruiker laat zien
function monsterRaeader($idMonster,$gebruikersID){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
        // SQL-code die zal je naar database sturen
        $query = "SELECT * FROM monsters WHERE idMonster = ?";
        // Bereid de SQL-query voor en bind de parameters.
        $statement = $connectie->prepare($query);
        //Argumenten binden aan ?
        $statement->bind_param("i",$idMonster);
        // Voer de query uit en controleer op fouten
        if (!$statement->execute())
        {
            throw new Exception($connectie->error);
        }
        // Bind de resultaten van de query aan variabelen
        $statement->bind_result($idMonster,$postNaam,$postArmor,$postHP,$postStrength,$postDexterity,$postConstitution,$postIntellihence,$postWisdom,$postCharisma,$postSpeed,$postDanger,$postMasteryBonus,$postImmunities,$postVulnerabilities,$postActions,$postgebruikersID);
    
        // Haal de resultaten op
        while($statement->fetch())
        {
            if($gebruikersID == $postgebruikersID){
                echo "<div class='bg-light rounded m-2 p-3'>
                
                    <h3 class='p-1 WW'><b>$postNaam</b> <img onclick='update(`naam van monster`,`name`,`s`)' src='img/icons8-settings.svg' /></h3>
                    <h4 class='p-1 WW mb-4'>Challenge $postDanger <img onclick='update(`gevaarsniveau `,`Danger`,`d`,`number`,`0.01`)' src='img/icons8-settings.svg' /></h4>
                    <h3 class='p-1 WW'><b>Armor Class </b>$postArmor <img onclick='update(`pantser`,`armor`,`i`,`number`)' src='img/icons8-settings.svg' /></h3>
                    <h3 class='p-1 WW'><b>Hit Points </b>$postHP <img onclick='update(`HP(gezondheid)`,`HP`,`i`,`number`)' src='img/icons8-settings.svg' /></h3>
                    <h3 class='p-1 WW mb-5'><b>Speed </b>$postSpeed<b>feet</b> <img onclick='update(`snelheid(feet)`,`speed`,`i`,`number`)' src='img/icons8-settings.svg' /></h3>
                    <table>
                    <tr class='mb-4'>
                    <th>STR</th><th>DEX</th><th>CON</th><th>INT</th><th>WIS</th><th>CHA</th>
                    </tr>
                    <tr>
                    <td>$postStrength(".eigenschappenRekenen($postStrength).")</td><td>$postDexterity(".eigenschappenRekenen($postDexterity).")</td>
                    <td>$postConstitution(".eigenschappenRekenen($postConstitution).")</td><td>$postIntellihence(".eigenschappenRekenen($postIntellihence).")</td>
                    <td>$postWisdom(".eigenschappenRekenen($postWisdom).")</td><td>$postCharisma(".eigenschappenRekenen($postCharisma).")</td>
                    </tr>
                    <tr>
                    <td><img onclick='update(`kracht`,`strength`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    <td><img onclick='update(`behendigheid`,`dexterity`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    <td><img onclick='update(`lichaamsbouw`,`constitution`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    <td><img onclick='update(`intelligentie`,`intelligence`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    <td><img onclick='update(`wijsheid`,`wisdom`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    <td><img onclick='update(`charisma`,`charisma`,`i`,`number`)' src='img/icons8-settings.svg' /></td>
                    </tr>
                    </table>
                    <h3 class='p-1 WW'><b>Proficiency Bonus +</b>$postMasteryBonus <img onclick='update(`master bonus`,`Mastery_Bonus`,`i`,`number`)' src='img/icons8-settings.svg' /></h3>
                    <h3 class='p-1 WW'><b>Damage Immunities: </b>$postImmunities <img onclick='update(`Immuniteit`,`Immunities`,`s`)' src='img/icons8-settings.svg' /></h3>
                    <h3 class='p-1 WW'><b>Vulnerabilities: </b>$postVulnerabilities <img onclick='update(`kwetsbaarheden`,`vulnerabilities`,`s`)' src='img/icons8-settings.svg' /></h3>
                    <h3 class='p-1 WW mt-5'><b>Actions: </b>$postActions <img onclick='update(`actie`,`actions`,`s`)' src='img/icons8-settings.svg' /></h3>
                    <form class='d-grid' action='monster.php?monster=".$_GET["monster"]."&Delete=true' method='post'>
                        <input type='hidden' name='Delete'>
                        <button type='submit' class='shadow btn btn-danger'>Verwijderen</button>
                    </form>
                </div>";
            }else{
                echo "<div class='bg-light rounded m-2 p-3'>
                
                    <h3 class='p-1 WW'><b>$postNaam</b></h3>
                    <h4 class='p-1 WW mb-4'>Challenge $postDanger</h4>
                    <h3 class='p-1 WW'><b>Armor Class </b>$postArmor</h3>
                    <h3 class='p-1 WW'><b>Hit Points </b>$postHP</h3>
                    <h3 class='p-1 WW mb-5'><b>Speed </b>$postSpeed<b>feet</b></h3>
                    <table>
                    <tr class='mb-4'>
                    <th>STR</th><th>DEX</th><th>CON</th><th>INT</th><th>WIS</th><th>CHA</th>
                    </tr>
                    <tr>
                    <td>$postStrength(".eigenschappenRekenen($postStrength).")</td><td>$postDexterity(".eigenschappenRekenen($postDexterity).")</td>
                    <td>$postConstitution(".eigenschappenRekenen($postConstitution).")</td><td>$postIntellihence(".eigenschappenRekenen($postIntellihence).")</td>
                    <td>$postWisdom(".eigenschappenRekenen($postWisdom).")</td><td>$postCharisma(".eigenschappenRekenen($postCharisma).")</td>
                    </tr>
                    </table>
                    <h3 class='p-1 WW'><b>Proficiency Bonus +</b>$postMasteryBonus</h3>
                    <h3 class='p-1 WW'><b>Damage Immunities: </b>$postImmunities</h3>
                    <h3 class='p-1 WW'><b>Vulnerabilities: </b>$postVulnerabilities</h3>
                    <h3 class='p-1 WW mt-5'><b>Actions: </b>$postActions</h3>
                </div>";
            }
            
        }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "<div class='alert alert-warning'><h4>Oops: Is het iets met de Server!</h4></div>"; //. $e->getMessage();
    }
    finally
    {
            // Sluit de statement en de connectie
            if($statement){
                $statement->close();
             }
            if($connectie){
                $connectie->close();
             }
    }
}

// functie die monster Update 
function monsterUpdate($What,$type,$result,$idMonster, $gebruikersID){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
            // SQL-code die zal je naar database sturen
            $query = "UPDATE monsters SET ".$What." = ? WHERE idUser = ? AND idMonster = ?";
            //Bereid de SQL-query voor en bind de parameters.
            $statement = $connectie->prepare($query);

            if($type == "d" || $type == "i" && $What != "HP" && $What != "speed"){
                $result = controllMaxMin($result);
            }
            //Argumenten binden aan ?
            $statement->bind_param($type."ii",$result,$gebruikersID,$idMonster);
            
        // Voer de query uit en controleer op fouten
        if (!$statement->execute())
        {
            throw new Exception($connectie->error);
        }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "Oops: Is het iets met de Server!";//. $e->getMessage();
    }
    finally
    {
            // unset($_COOKIE['idMonster']);
            // Sluit de statement en de connectie
            if($statement){
                $statement->close();
             }
            if($connectie){
                $connectie->close();
             }
            //De gebruiker word meten naar monster.php sturen
            header("location: monster.php?monster=".$idMonster);
            exit(); // Zorg ervoor dat het script stopt na de header redirect
    }
}

//monster van gebruiker verdwijneren
function monsterDelete($idMonster,$gebruikersID){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
        // SQL-code die zal je naar database sturen
        $query = "DELETE FROM monsters WHERE idUser = ? AND idMonster = ?";
        //Bereid de SQL-query voor en bind de parameters.
        $statement = $connectie->prepare($query);
        //Argumenten binden aan ?
        $statement->bind_param("ii",$gebruikersID,$idMonster);
        // Voer de query uit en controleer op fouten
        if (!$statement->execute())
        {
            throw new Exception($connectie->error);
        }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "<div class='alert alert-warning'><h4>Oops: Is het iets met de Server!</h4></div>"; //. $e->getMessage();
    }
    finally
    {
            // Sluit de statement en de connectie
            if($statement){
                $statement->close();
             } 
            if($connectie){
                $connectie->close();
             }
            //De gebruiker word meten naar myMonsters.php sturen
            header("location: myMonsters.php?monsterDelete=true");
            exit(); // Zorg ervoor dat het script stopt na de header redirect
    }
}

//functie die Monster Maken
function monsterMaken($postNaam,$postArmor,$postHP,$postStrength,$postDexterity,$postConstitution,$postIntellihence,$postWisdom,$postCharisma,$postSpeed,$postDanger,$postMasteryBonus,$postImmunities,$postVulnerabilities,$postActions,$gebruikersID){
    global $serverConnectieData;
    try
    {
        // Maak een nieuwe connectie naar de database "dnd_npc"
        $connectie = new mysqli($serverConnectieData[0],$serverConnectieData[1],$serverConnectieData[2],$serverConnectieData[3]);
        //Controleer of de connectie is gelukt.
        if ($connectie->error)
        {
            throw new Exception($connectie->connect_error);
        }
        // SQL-code die zal je naar database sturen
        $query = "INSERT INTO monsters(name,armor,HP,strength,dexterity,constitution,intelligence,wisdom,charisma,speed,Danger,Mastery_Bonus,Immunities,vulnerabilities,actions,idUser) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            //Bereid de SQL-query voor en bind de parameters.
            $statement = $connectie->prepare($query);
            //Argumenten binden aan ?
            $statement->bind_param("siiiiiiiiidisssi",$postNaam,$postArmor,$postHP,$postStrength,$postDexterity,$postConstitution,$postIntellihence,$postWisdom,$postCharisma,$postSpeed,$postDanger,$postMasteryBonus,$postImmunities,$postVulnerabilities,$postActions,$gebruikersID);
            // Voer de query uit en controleer op fouten
            if (!$statement->execute())
            {
                throw new Exception($connectie->error);
            }
    }
    catch(Exception $e)
    {
        //Als er fouten zijn, komt de volgende melding: 
        echo "<div class='alert alert-warning'><h4>Oops: Is het iets met de Server!</h4></div>"; //. $e->getMessage();
    }
    finally
    {
            // Sluit de statement en de connectie
            if($statement){
                $statement->close();
             } 
            if($connectie){
                $connectie->close();
             }
            //Je word meten naar myMonsters.php sturen
            header("location: myMonsters.php?monsterMaken=true");
            // header("location: home.php");
            exit(); // Zorg ervoor dat het script stopt na de header redirect
    }
}
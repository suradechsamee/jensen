<?php
session_start();
if(isset($_POST['submit']))
{
            $kurs = $_POST['Kurs'];
            $betyg = $_POST['Betyg'];
            $usersId = $_POST['id'];
     try 
    {
    require_once("../../includes/test.php");
        
        
    $query = "INSERT INTO betyg (kurs_id, student_betyg, user_id) ";
    $query .=  "VALUES (:Kurs, :Betyg, :id)";
    
    $ps = $db->prepare($query);
    $result = $ps->execute(array('Kurs'=>$kurs,'Betyg'=>$betyg,'id'=>$usersId));
        
    
    if($result)
    {
        echo "<script>alert(\"Succeed\")</script>";
    }
    else
    {
        echo "<script>alert(\"Failed\")</script>";
    }
    }
    catch(Exception $exception)
    {
        echo "Epic fail: <br /><br />";
        echo $exception."<br /><br />";
    }
}
    if($_SESSION['profession'] == 0) {

        try{
                require_once("../../includes/test.php");
				$query  = "SELECT * FROM project LEFT JOIN betyg ON project.id = betyg.user_id ";
                $query .= "WHERE project.profession = 0 AND project.id = :studentID";
				$ps = $db->prepare($query); 
						
				$result = $ps->execute(array('studentID' => $_SESSION['id']));
				$users = $ps->fetchAll();
						
			} catch(Exception $exception) {
				echo "Query failed, see error message below: <br /><br />";
				echo $exception. "<br /><br />";
			}
    }
    else {
        try{
                require_once("../../includes/test.php");
				$query  = "SELECT * FROM project LEFT JOIN class ON project.class_id = class.id ";
                $query .= "WHERE project.profession = 0 AND project.class_id = :classID";
				$ps = $db->prepare($query); 
						
				$result = $ps->execute(array('classID' => $_SESSION['class_id']));
				$users = $ps->fetchAll();
						
			} catch(Exception $exception) {
				echo "Query failed, see error message below: <br /><br />";
				echo $exception. "<br /><br />";
			}
    }

include('../layout/Header.php');
?>
<div class="container">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation"><a href="Home.php">Hem</a></li>
        <li class="dropdown active" role="presentation"><a href="About.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Om <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Profil.php">Profil</a></li>
            <li><a href="Klass.php">Klass</a></li>
            <li><a href="Betyg.php">Betyg</a></li>
            <li><a href="Schema.php">Schema</a></li>
            <li><a href="Kursplan.php">Kurs plan</a></li>
          </ul>
        </li>
        <li role="presentation"><a href="../kontakt/Contact.php">Kontakt</a></li>
        <li role="presentation"><a href="../layout/logout.php">Logga ut</a></li>
    </ul>
<div class="jumbotron">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Mina Betyg
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <?php
            
            echo "<tr>";
			echo "<td>". $users['kurs_id']. "</td><td>".$users['student_betyg']. "</td>";
			echo "</tr>";
            
        ?>
      </div>
    </div>
    </div>
<?php if($_SESSION['profession']==2 || $_SESSION['profession']==1):?>
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Sätt upp/Ändra Betyg
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" r ole="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
          <form role="form" action="Betyg.php" method="POST">
            
            <table class="table">
		    <thead>
            <th>Förnamn</th>
			<th>Efternamn</th>
            <th>Klass</th>
			<th>Kurser</th>
            <th>Betyg</th>
		    </thead>
            <?php
            foreach($users as $user){
			echo "<tr>";
			echo "<td>". $user['fname'] . "</td><td>" . $user['lname'] . "</td><td>" . $user['classname'] . "</td><td><select name='Kurs'>
            <option value=''>Anger Kurs</option>
            <option value='Html'>Html</option>
            <option value='Java'>java</option>
            <option value='Php'>Php</option>
            </select></td><td><select name='Betyg'>
            <option value=''>Anger Betyg</option>
            <option value='IG'>IG</option>
            <option value='G'>G</option>
            <option value='VG'>VG</option>
            </select></td>
            <input type='hidden' name='id' value='{$user['id']}'>
            ";
			echo "</tr>";
		    }
            ?>
            </table>
            <div class="form-group">
            <input type="submit" name="submit" value="Submit">
            </div>
          </form>
      </div>
    </div>
    </div>
<?php endif; ?>
</div>
</div>
</div>


 
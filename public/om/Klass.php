<?php
session_start();
require_once("../../includes/test.php");
   
            try{
                
				$query  = "SELECT * FROM project LEFT JOIN class ON project.class_id = class.id ";
                $query .= "WHERE profession = 0 AND class.id = :classID";
				$ps = $db->prepare($query); 
						
				$result = $ps->execute(array('classID' => $_SESSION['class_id'])); 
				$users = $ps->fetchAll();
						
			} catch(Exception $exception) {
				echo "Query failed, see error message below: <br /><br />";
				echo $exception. "<br /><br />";
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
          Min klass
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
        <table class="table">
		<thead>
			<th>Förnamn</th>
            <th>Efternamn</th>
			<th>Email</th>
		</thead>	
	<?php 
        foreach($users as $user){
			echo "<tr>";
			echo "<td>". $user['fname']. "</td><td>".$user['lname']. "</td><td>" .$user['email'] . "</td>";
			echo "</tr>";
		}
	?>
	</table>
    </div>
    </div>
    </div>
</div>
</div>
</div>


 
<?php
session_start();
$pageTitle = "Hem";
$section = "Hem";
include('../layout/Header.php');

?>
<div class="container">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation" class="active"><a href="Home.php">Hem</a></li>
        <li role="presentation"><a href="Profil.php">Om</a></li>
        <li role="presentation"><a href="../kontakt/Contact.php">Kontakt</a></li>
        <li role="presentation"><a href="../layout/logout.php">Logga ut</a></li>
    </ul>
    <div class="jumbotron">
        <h3><?php echo " Welcome ".$_SESSION['username']; ?></h3>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Nytt meddelande
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
        
    </div>
    </div>
    </div>
<?php if($_SESSION['profession']==1 || $_SESSION['profession']==2):?>
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Skriv nytt Meddelande
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
        <textarea class="form-control" rows="10"></textarea>
    </div>
    </div>
    </div>
<?php endif; ?>
<?php if($_SESSION['profession']==2 || $_SESSION['profession']==1):?>
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Ändra/Ta bort Meddelande
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
        
    </div>
    </div>
    </div>
    </div>
<?php endif; ?>
</div>
</div>


 
<?php
session_start();
$pageTitle = "Kontakt";
$section = "Kontakt";
include('../layout/Header.php');


?>
<div class="container">
   <ul class="nav nav-pills nav-justified">
        <li role="presentation"><a href="../om/Home.php">Hem</a></li>
        <li role="presentation"><a href="../om/Profil.php">Om</a></li>
        <li class="dropdown active" role="presentation"><a href="Contact.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kontakt <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="bokning.php">Boka rum</a></li>
            <li><a href="#">Forum</a></li>
            <li><a href="#">Enkät</a></li>
          </ul>
       </li>
        <li role="presentation"><a href="../layout/logout.php">Logga ut</a></li>
   </ul>
   <div class="jumbotron">
     
    </div>
</div>


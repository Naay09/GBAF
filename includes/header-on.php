<?php
session_start();
?>

<header>
    <a href="index.php" class="head-left"><img class="logo" src="img/logo-gbaf.png"></a>
            
        <nav class="head-right">

            <a href="#" class="welcome"><p>Bienvenue <?php echo $_SESSION['firstname']; ?></p></a>

            <a href="account.php">Mon Compte</a>    
            
            <a href="logoff-process.php">Deconnexion</a>
            
        </nav>
</header>
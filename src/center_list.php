<?php

require_once '../repository/DBManager.php';

session_start();

$dbManager = new DBManager();


if (isset($_GET['sport_id'])) {
    $sport_id = $_GET['sport_id'];
    if($sport_id == -1){
        header('Location: center_list.php');
        exit(0);
    }
    $centers = $dbManager->getCentersBySportId($sport_id);
} else {
    $centers = $dbManager->getAllCenters();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sport Space</title>
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg" style="background-color: #E3B04B; color: black;">
    <div class="container px-5">
        <a class="navbar-brand" href="index.php">Sport Space</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="center_list.php">Liste des Centres</a></li>
                <?php
                if(isset($_SESSION['username']) && isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
                    echo '<li class="nav-item"><a class="nav-link" href="mesreservations.php">Mes Réservations</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                }else{
                    echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                }
                ?>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row gx-4 gx-lg-5 m-5">
        <form method="get" class="form-inline" style="justify-content: end">
            <div class="justify-content-between" style="display: flex">
                <div class="col-md-4 mb-3" style="padding: 0">
                    <select class="form-control" style="height: fit-content" id="sport_select" name="sport_id">
                        <option value="-1">Charger Tous</option>
                        <?php
                        $sports = $dbManager->getAllSports();
                        foreach ($sports as $sport) {
                            echo '<option value="' . $sport->getSportId() . '">' . $sport->getNomSport() . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3" style="margin: auto; padding-right: 0">
                    <button type="submit" class="btn" style="display: inline-grid;background-color: #215294; color: white">Filtrer</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row gx-4 gx-lg-5 m-5">

    <?php

        foreach ($centers as $center){
            $sports = $dbManager->getAllSportsByCenter($center->getId());
    ?>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $center->getName()?></h2>
                        <p class="card-text">
                            <?php echo $center->getAddress()?>
                        </p>
                        <ul>
                            <?php
                            foreach ($sports as $sport){
                                echo '<li>'.$sport->getNomSport().'</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="card-footer"><a class="btn btn-sm" style="background-color: #215294; color: white" href="reservation.php?center_id=<?php echo $center->getId()?>">Réserver</a></div>
                </div>
            </div>
    <?php

        }

    ?>
    </div>
</div>
</body>
<?php

require_once '../config/DatabaseConfiguration.php';
require_once '../src/class/Center.php';
require_once '../src/class/Court.php';
require_once '../src/class/Sport.php';
require_once '../src/class/User.php';
require_once '../src/class/Reservation.php';

class DBManager {
    private $pdo;

    public function getConnection(): void{
        $databaseConfig = new \config\DatabaseConfiguration();
        $host = $databaseConfig->getHost();
        $dbname = $databaseConfig->getDbname();
        $username = $databaseConfig->getUsername();
        $password = $databaseConfig->getPassword();

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $username, $password, $options);
    }

    public function usernameExists($username): bool {
        $this->getConnection();

        $sql = "SELECT COUNT(*) FROM User WHERE username=:username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $this->closeConnection();
        return $stmt->fetchColumn() > 0;
    }

    public function insertUser(User $user): void {
        try{
            $this->getConnection();
            $stmt = $this->pdo->prepare("INSERT INTO User(nom, prenom, adresse_mail, age, numero_telephone, username, password) VALUES (:nom, :prenom, :adresse_mail, :age, :numero_telephone, :username, :password)");

            $stmt->bindParam('nom', $user->getNom());
            $stmt->bindParam('prenom', $user->getPrenom());
            $stmt->bindParam('adresse_mail', $user->getAdresseMail());
            $stmt->bindParam('age', $user->getAge());
            $stmt->bindParam('numero_telephone', $user->getNumeroTelephone());
            $stmt->bindParam('username', $user->getUsername());
            $stmt->bindParam('password', $user->getPassword());

            $stmt->execute();
        }catch (PDOException $exp){
            error_log($exp);
        }

    }

    public function verifyUser($username, $password): bool {
        $this->getConnection();

        $sql = "SELECT * FROM User WHERE username=:username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->closeConnection();
        return $user && $password == $user['password'];
    }

    public function getAllCenters() :array {
        $this->getConnection();

        $query = "SELECT * FROM Center";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $centers = null;
        if($result){
            $centers = array();
            foreach ($result as $r){
                $centers[] = $this->arrayToCenter($r);
            }
        }

        $this->closeConnection();
        return $centers;
    }

    public function getCourtsByCenter(Center $center): array {
        $this->getConnection();

        $query = "SELECT * FROM Court WHERE center_id = :center_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":center_id", $center->getId());
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $courts = null;
        if($result){
            $courts = array();
            foreach ($result as $r){
                $courts[] = $this->arrayToCourt($r);
            }
        }

        $this->closeConnection();
        return $courts;
    }

    public function getCenterById($center_id): ?Center {
        $this->getConnection();

        $query = "SELECT * FROM Center WHERE center_id = :center_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":center_id", $center_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->closeConnection();
        return $this->arrayToCenter($result);
    }

    public function getCourtById($court_id): ?Court {
        $this->getConnection();
        $query = "SELECT * FROM Court WHERE court_id = :court_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":court_id", $court_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->closeConnection();
        return $this->arrayToCourt($result);
    }

    public function existsReservation(Reservation $reservation): bool {
        $this->getConnection();
        $court_id = $reservation->getCourt()->getId();
        $username = $reservation->getUser()->getUsername();
        $reservation_debut = $reservation->getReservationDebut();

        $query = "SELECT COUNT(*) FROM Reservations WHERE court_id = :court_id AND reservation_debut = :reservation_debut AND username = :username";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":court_id", $court_id);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":reservation_debut", $reservation_debut);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        $this->closeConnection();
        return $result > 0;
    }

    public function insertReservation(Reservation $reservation): void {
        try{
            $this->getConnection();

            $court_id = $reservation->getCourt()->getId();
            $username = $reservation->getUser()->getUsername();
            $reservation_debut = $reservation->getReservationDebut();
            $reservation_fin = $reservation->getReservationFin();
            $nombre_de_personnes = $reservation->getNombreDePersonnes();

            $query = "INSERT INTO Reservations (username, court_id, reservation_debut, reservation_fin, nombre_de_personnes) VALUES (:username, :court_id, :reservation_debut, :reservation_fin, :nombre_de_personnes)";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":court_id", $court_id);
            $stmt->bindParam(":reservation_debut", $reservation_debut);
            $stmt->bindParam(":reservation_fin", $reservation_fin);
            $stmt->bindParam(":nombre_de_personnes", $nombre_de_personnes);
            $stmt->execute();

            $this->closeConnection();
        }catch (PDOException $exp){
            error_log($exp);
        }

    }

    public function deleteReservationById($reservation_id): void
    {
        try{
            $this->getConnection();
            $query = "DELETE FROM Reservations WHERE id = :reservation_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":reservation_time", $reservation_id);
            $stmt->execute();

            $this->closeConnection();
        }catch (PDOException $exp){
            error_log($exp);
        }
    }

    public function getAllReservationsByUser($username): array {
        $this->getConnection();

        $query = "SELECT * FROM Reservations WHERE username = :username";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $reservations = null;

        if($result){
            $reservations = array();
            foreach ($result as $r){
                $reservations[] = $this->arrayToReservation($r);
            }
        }

        $this->closeConnection();
        return $reservations;
    }

    public function getUserByUsername($username): ?User {
        $this->getConnection();

        $query = "SELECT nom, prenom, adresse_mail, age, numero_telephone, username FROM User WHERE username = :username";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->closeConnection();
        return $this->arrayToUser($result);
    }

    private function getSportById($sport_id): ?Sport {
        $this->getConnection();

        $query = "SELECT * FROM Sport WHERE sport_id = :sport_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":sport_id", $sport_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->closeConnection();
        return $this->arrayToSport($result);
    }

    private function arrayToSport($array): ?Sport {
        $sport = null;
        if($array){
            $sport = new Sport(
                $array['sport_id'],
                $array['nom_sport']
            );
        }
        return $sport;
    }

    private function arrayToCenter($array): ?Center {
        $center = null;
        if($array){
            $center = new Center(
                $array['center_id'],
                $array['center_name'],
                $array['center_address'],
                array()
            );
        }
        return $center;
    }

    private function arrayToCourt($array): ?Court {
        $court = null;

        if($array){
            $sport = null;
            if($array['sport_id']){
                $sport = $this->getSportById($array['sport_id']);
            }
            $center = null;
            if($array['center_id']){
                $center = $this->getCenterById($array['center_id']);
            }
            $court = new Court(
                $array['court_id'],
                $sport,
                $center,
                $array['prix_unitaire_par_heure']
            );
        }

        return $court;
    }

    public function arrayToUser($array): ?User {
        $user = null;
        if($array){
            $user = new User(
                $array['nom'],
                $array['prenom'],
                $array['adresse_mail'],
                $array['age'],
                $array['numero_telephone'],
                $array['username'],
                ''
            );
        }

        return $user;
    }

    public function arrayToReservation($array): ?Reservation {
        $reservation= null;
        if($array){
            $user = null;
            if($array['username']){
                $user = $this->getUserByUsername($array['username']);
            }
            $court = null;
            if($array['court_id']){
                $court = $this->getCourtById($array['court_id']);
            }
            $reservation = new Reservation(
                $user,
                $court,
                $array['reservation_debut'],
                $array['reservation_fin'],
                $array['nombre_de_personnes']
            );
        }

        return $reservation;
    }

    public function closeConnection(): void {
        $this->pdo = null;
    }

    public function getAllSportsByCenter($center_id): array
    {
        $this->getConnection();
        $query = "SELECT DISTINCT Sport.*
                    FROM Sport
                    INNER JOIN Court ON Sport.sport_id = Court.sport_id
                    WHERE Court.center_id = :center_id";


        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":center_id", $center_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sports = null;
        if($result){
            $sports = array();
            foreach ($result as $r){
                $sports [] = $this->arrayToSport($r);
            }
        }

        $this->closeConnection();
        return $sports;
    }

    public function getAllSports(): array
    {
        $this->getConnection();

        $query = "SELECT * FROM Sport";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sports = null;
        if($result){
            $sports = array();
            foreach ($result as $r){
                $sports [] = $this->arrayToSport($r);
            }
        }

        $this->closeConnection();
        return $sports;
    }

    public function getCentersBySportId($sport_id): array
    {
        $this->getConnection();

        $query = "SELECT DISTINCT c.center_id, c.center_name, c.center_address
                                FROM Court ct
                                INNER JOIN Center c ON ct.center_id = c.center_id
                                WHERE ct.sport_id = :sport_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":sport_id", $sport_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $center = null;
        if($result){
            $center = array();
            foreach ($result as $r){
                $center [] = $this->arrayToCenter($r);
            }
        }

        $this->closeConnection();
        return $center;
    }

    public function checkAndMakeReservation($reservation_debut, $reservation_fin, $nombre_de_personnes, $username, $center_id, $sport_id): bool
    {
        $this->getConnection();

        // Check if there is a court available for the reservation period
        $stmt = $this->pdo->prepare("SELECT court_id 
                            FROM Court 
                            WHERE sport_id = :sport_id 
                                AND center_id = :center_id 
                                AND court_id NOT IN (
                                    SELECT court_id FROM Reservations 
                                    WHERE (reservation_debut BETWEEN :reservation_debut AND :reservation_fin)
                                )");
        $stmt->bindParam(':sport_id', $sport_id, PDO::PARAM_INT);
        $stmt->bindParam(':center_id', $center_id, PDO::PARAM_INT);
        $stmt->bindParam(':reservation_debut', $reservation_debut);
        $stmt->bindParam(':reservation_fin', $reservation_fin);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result){
            $court_id = $result['court_id'];
            var_dump($court_id);
            // Make the reservation
            $stmt = $this->pdo->prepare("INSERT INTO Reservations 
                            (username, court_id, reservation_debut, reservation_fin, nombre_de_personnes) 
                            VALUES (:username, :court_id, :reservation_debut, :reservation_fin, :nombre_de_personnes)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':court_id', $court_id);
            $stmt->bindParam(':reservation_debut', $reservation_debut);
            $stmt->bindParam(':reservation_fin', $reservation_fin);
            $stmt->bindParam(':nombre_de_personnes', $nombre_de_personnes);
            $stmt->execute();

            $this->closeConnection();
            return true;
        }

        $this->closeConnection();
        return false;
    }


}
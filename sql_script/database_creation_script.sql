CREATE TABLE User (
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse_mail VARCHAR(100),
    age INT,
    numero_telephone VARCHAR(20),
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100)
);

CREATE TABLE Sport (
    sport_id INT PRIMARY KEY,
    nom_sport VARCHAR(50)
);

CREATE TABLE Center (
    center_id INT PRIMARY KEY,
    center_name VARCHAR(50),
    center_address VARCHAR(200)
);

CREATE TABLE Court (
    court_id INT PRIMARY KEY,
    sport_id INT,
    center_id INT,
    prix_unitaire_par_heure DECIMAL(10,2),
    FOREIGN KEY (sport_id) REFERENCES Sport(sport_id),
    FOREIGN KEY (center_id) REFERENCES Center(center_id)
);

CREATE TABLE Reservations (
    username VARCHAR(50),
    court_id INT,
    reservation_debut TIMESTAMP,
    reservation_fin TIMESTAMP,
    nombre_de_personnes INT,
    FOREIGN KEY (court_id) REFERENCES Court(court_id),
    FOREIGN KEY(username) REFERENCES User(username),
    PRIMARY KEY (username, court_id, reservation_debut)
);


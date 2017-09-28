CREATE TABLE Utilisateur(
    IdUser INTEGER NOT NULL AUTO_INCREMENT,
    Username VARCHAR(25),
    MDP VARCHAR(50),
    email VARCHAR(25),
    icon BLOB,
    admin tinyint,
    PRIMARY KEY(IdUser)
);

CREATE TABLE Performance(
    IdGrille INTEGER NOT NULL AUTO_INCREMENT,
    DateResolution DATE,
    TempsResolu Time,
    Niveau VARCHAR(25),
    PRIMARY KEY(IdGrille)
);

CREATE TABLE Concours(
    IdConcours INTEGER NOT NULL AUTO_INCREMENT,
    Grille INTEGER,
    DateConcours DateTime,
    PRIMARY KEY(IdConcours)
);

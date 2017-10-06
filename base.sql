#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        IdUser   int (11) Auto_increment  NOT NULL ,
        Username Varchar (25) ,
        MDP      Varchar (25) ,
        email    Varchar (25) ,
        Icon     Bool ,
        Admin    Bool ,
        IdGrille Int ,
        PRIMARY KEY (IdUser ) ,
        UNIQUE (Username )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Concours
#------------------------------------------------------------

CREATE TABLE Concours(
        IdConcours int (11) Auto_increment  NOT NULL ,
        IdGrille   Int ,
        PRIMARY KEY (IdConcours )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Performances
#------------------------------------------------------------

CREATE TABLE Performances(
        IdGrille       int (11) Auto_increment  NOT NULL ,
        DateResolution Date ,
        TempsResolu    Int ,
        Niveau         Varchar (25) ,
        PRIMARY KEY (IdGrille )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Participe
#------------------------------------------------------------

CREATE TABLE Participe(
        Temps      Time ,
        Classement Int ,
        IdUser     Int NOT NULL ,
        IdConcours Int NOT NULL ,
        PRIMARY KEY (IdUser ,IdConcours )
)ENGINE=InnoDB;

ALTER TABLE Utilisateur ADD CONSTRAINT FK_Utilisateur_IdGrille FOREIGN KEY (IdGrille) REFERENCES Performances(IdGrille);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_IdUser FOREIGN KEY (IdUser) REFERENCES Utilisateur(IdUser);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_IdConcours FOREIGN KEY (IdConcours) REFERENCES Concours(IdConcours);

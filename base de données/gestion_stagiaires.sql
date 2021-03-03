drop database if exists gestion_stagiaire;/*ceci va supprimer gestion_stagiaire si elle existe déjà */

create database if not exists  gestion_stagiaire ;/*ceci permet de créer gestion_stagiaire si elle          n'existe pas */

use gestion_stagiaire ;


create table stagiaire(
    idStagiaire int(4) auto_increment primary key ,
    nom varchar (50),
    prenom varchar (50),
    civilite varchar (1),
    photo varchar (100),
    idFiliere int(4)
);


create table filiere(
    idFiliere int(4) auto_increment primary key ,
    nomFiliere varchar (50),
    niveau varchar (50)
);


create table utilisateur(
    idUtilisateur int(4) auto_increment primary key ,
    login varchar (50),
    email varchar (225),
    role varchar (50), /*visiteur ou administrateur*/
    etat int (1), /*1:activé, 0:desactivé*/
    pwd varchar(225)
);

Alter table stagiaire add constraint  foreign key(idFiliere) references filiere(idFiliere);

INSERT INTO filiere(nomFiliere, niveau) VALUES
('SRIT','B'),
('RTEL','BT'),
('SIGL','L1'),
('TWIN','L2'),
('MBDS','M1'),
('INFO','M2');



INSERT INTO utilisateur(login, email, role, etat, pwd) VALUES
('ramon', 'ramon@gmail.com', 'ADMIN',1, md5('1234')),
('soro', 'soro@gmail.com', 'VISITEUR',0, md5('1234')),
('user1', 'user1@gmail.com', 'VISITEUR',1, md5('1234'));

INSERT INTO stagiaire(nom, prenom, civilite, photo, idFiliere) VALUES
('SORO', 'RAMON', 'M', 'ramon1.jpg', 1),
('SANVI', 'LEA', 'F', 'ramon2.jpg', 2),
('VALRON', 'KARTESS', 'M', 'ramon3.jpg', 3),
('SORO', 'BEKER', 'M', 'ramon4.jpg', 4),
('YEO', 'ZELIKA', 'F', 'ramon5.jpg', 5),
('KOFFI', 'ROLI', 'M', 'ramon6.jpg', 6),

('SORO', 'RAMON', 'M', 'ramon1.jpg', 1),
('SANVI', 'LEA', 'F', 'ramon2.jpg', 2),
('VALRON', 'KARTESS', 'M', 'ramon3.jpg', 3),
('SORO', 'BEKER', 'M', 'ramon4.jpg', 4),
('YEO', 'ZELIKA', 'F', 'ramon5.jpg', 5),
('KOFFI', 'ROLI', 'M', 'ramon6.jpg', 6);






select * from filiere ;
select * from stagiaire ;
select * from utilisateur ;




/* User: 1803982879 Password: mypassword */
DROP DATABASE GRU_H6_dub16;

CREATE DATABASE GRU_H6_dub16;

USE GRU_H6_dub16;

CREATE TABLE Medlimur(
ID INT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nafn VARCHAR(255),
kennitala CHAR(10) UNIQUE KEY,
simi CHAR(7)
);

CREATE TABLE Vidburdur(
ID INT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
heiti VARCHAR(255),
dagsetning DATE,
ummaeli TEXT,
myndURL VARCHAR(255)
);

CREATE TABLE Admin(
ID INT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
medlimur_ID INT(3) NOT NULL,
FOREIGN KEY (medlimur_ID) REFERENCES Medlimur(ID)
);

CREATE TABLE Skraning(
ID INT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
vidburdur_id INT(3) NOT NULL,
medlimur_id INT(3) NOT NULL,
FOREIGN KEY (vidburdur_id) REFERENCES Vidburdur(ID),
FOREIGN KEY (medlimur_ID) REFERENCES Medlimur(ID)
);

/* Sample gögn */
INSERT INTO Vidburdur(heiti, dagsetning, ummaeli, myndURL)
VALUES
('Íspartý', '2015-11-25', 'Sagði einhver ís? það er allavegana íspartý hjá Dub16 í tilefni 20 ára afmæli Kjörísar. Láttu sjá þig.', 'img/events/icecream.jpg'),
('Star Wars Bíóferð', '2015-12-7', 'Hver er ekki til í bíó hvar og hvenær sem er? Bara að láta þig vita að það styttist í Star Wars 7 og er Dub16 með sér sýningu í Eigilshöll. Ef þú ert Star Wars aðdáandi þá er þetta eitthvað fyrir þig. <iframe width="560" height="315" src="https://www.youtube.com/embed/sGbxmsDFVnE" frameborder="0" allowfullscreen></iframe>', 'img/events/starwars.jpg'),
('JólaLAN', '2015-12-27','Það verður jólalan í desember þegar skólinn hjá öllum er búinn og ég veit ekki hvað dagksráin var að fá sér í morgunmat en það er allavegana ekki 22. maí það get ég sagt þér. Það verður 19 til 22 desember. ekki láta þig vanta.', 'img/events/lan.jpg'),
('Bingó', '2015-11-20','Bingó!! Það verður bingó veitingar og vinningar og bara allt. Stærsti vinningurinn er ný apple borðtölva frá epli. Það væri ekki leiðinlegt að fá eina þannig beint í vasann.', 'img/events/bingo.jpg');

INSERT INTO Medlimur(nafn, kennitala, simi)
VALUES
('Guðni Natan Gunnarsson', '1803982879', '6952452');


INSERT INTO Admin(medlimur_ID)
VALUES
(1);

INSERT INTO Skraning(vidburdur_id, medlimur_id)
VALUES
(1, 1);


SELECT Admin.ID 
FROM ADMIN
INNER JOIN Medlimur
ON Admin.medlimur_id = Medlimur.ID
WHERE Medlimur.Kennitala = "1803982879";

SELECT * FROM medlimur;

SELECT * FROM vidburdur;


SELECT Skraning.ID, Skraning.vidburdur_id, Skraning.medlimur_id, Vidburdur.heiti  FROM Skraning INNER JOIN Vidburdur ON Vidburdur.id = Skraning.vidburdur_id  INNER JOIN Medlimur ON Medlimur.id =  Skraning.medlimur_id WHERE Medlimur.kennitala = '1803982879';

SELECT id , heiti FROM Vidburdur;

SELECT id , heiti FROM Vidburdur WHERE dagsetning > CURDATE();
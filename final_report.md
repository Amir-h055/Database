# Report - COVID 19 - Final Project

## PHP Web Application

Our UI can be used by visiting the following link:

http://353-env.eba-29hvyfsw.us-east-1.elasticbeanstalk.com/client/

## 1 - Concept ER Diagram

![ER diagram](/home/nathan/school/COMP_353/projects/COMP_351_Warmup/ERdiagram.svg)

## 2 - Constraints

All the constraints are shown in the diagram

## 3 - Convert to a relational DB scheme

Relations obtained from E/R diagram

```
Person(_passportNumOrSSN_, medicare, telephone, address, LastName, firstName, city, province,
    postalCode, citizenship, email, dateOfBirth);
  Infection(_dateInfection_, _passportNumOrSSN_, type);
  AgeGroup(_ageRange_);
  CurrentAgeGroup(_ageRange_, _province_)
  Vaccination(_passportNumOrSSN_, _doseNumber_, date)
  PersonAgeGroup(_ageRange_, _passportNumOrSSN_);
  VaccinationDrug(_name_);
  DrugHistory(_name_, _date_, status)
  VaccinationDoneWith(_passportNumOrSSN_, _doseNumber_, _name_);
  VaccinationDoneAt(_passportNumOrSSN_, _doseNumber_, _name_, _address_);
  VaccinationDoneBy(_passportNumOrSSN_, _doseNumber_, _EID_)
  HealthFacility(_name_, _address_,telephone, webAddress, type, city, province,
    postalCode);
  Employee(_EID_, SSN)
  Manager(_EID_)
  Manages(_EID_, _name_, _address_)
  JobHistory(_EID_, _name_, _address_, _startDate_, endDate)
  VaccineStored(_nameHSO_, _address_, _nameDrug_, count)
  vaccineShipment(_nameHSO_, _address_, _nameDrug_, _date_, count)
  VaccineTransfer(_nameHSOFrom_, _nameHSOTo_, _addressFrom_, _addressTo_,
    _date_, count)
```

We need to put this design in BCNF, so let's look at each relation one by one
and make it BCNF. We would like to point out that functional depencies are
somewhat arbitrary, meaning that we can define what they are since they were
not defined in the handout of the project.

---

Let's first discard all of the 1 or 2 attributes relations since it is proven
that such relation are in BCNF

`AgeGroup`, `CurrentAgeGroup`, `PersonAgeGroup`, `VaccinationDrug`, `Manager` are all
good. Let's look at the others

---

```
Person(_passportNumOrSSN_,medicare, telephone, address, LastName, firstName, city, province, postalCode, citizenship, email, dateOfBirth);
```

We assumed that 2 people with the same name could live at the same place. Which
means the complete address and complete name is not enough to uniquely determine
a person; complete address and complete name is not enough to uniquely
determine a telephone (like with 411)

List of functional depencies:
`passportNumOrSSN` -> all other attributes
`medicare` -> all other attributes
`address`, `city`, `province` -> `postalCode`

We thus decompose our initial relation as such:

```
Person(_passportNumOrSSN_,medicare, telephone, address, LastName, firstName, city, province, citizenship, email, dateOfBirth);

PostalCode(address, city, province, postalCode)
```

Now all non-trivial FD are superkey

---

`Infection(_dateInfection_, _passportNumOrSSN_, type)`

List of major FD:
`date`, `passportNumOrSSN` -> `type`

This relation is BCNF

---

`Vaccination(_passportNumOrSSN_, _doseNumber_, date)`

List of major FD:
`passportNumOrSSN`, `doseNumber` -> `date`

This relation is BCNF

---

`DrugHistory(_name_, _date_, status)`

List of major FD:
`name`, `date` -> `status`

This relation is BCNF

---

`VaccinationDoneWith(_passportNumOrSSN_, _doseNumber_, _name_);`

List of major FD:
`passportNumOrSSN`, `doseNumber` -> `name`

This relation if BCNF

`VaccinationDoneBy` and `VaccinationDoneAt` are pretty similar and are both in\
 BCNF

---

```
HealthFacility(_name_, _address_,telephone, webAddress, type, city, province, postalCode);

Employee(_EID_, SSN)
```

Those two relations are similar to `Person`, the badly behaving FD is the one
with the postal code, this means that both of them needs their postal code
removed.

`HealthFacility(_name_, _address_,telephone, webAddress, type, city, province);`
`Employee(_EID_, SSN)`

---

All those:

```
Manages(_EID_, _name_, _address_)

JobHistory(_EID_, _name_, _address_, _startDate_, endDate)

VaccineStored(_nameHSO_, _address_, _nameDrug_, count)

VaccineShipment(_nameHSO_, _address_, _nameDrug_, _date_, count)

VaccineTransfer(_nameHSOFrom_, _nameHSOTo_, _addressFrom_, _addressTo_, _date_, count)
```

Are similar to previous tables that are mostly made up of key and all FD
have superkey on their right side thus they are all in BCNF.

---

The final set of relation is thus:

```
  Person(_passportNumOrSSN_, medicare, telephone, address, LastName, firstName,
    city, province, citizenship, email, dateOfBirth);
  Infection(_dateInfection_, _passportNumOrSSN_, type);
  AgeGroup(_ageRange_);
  CurrentAgeGroup(_ageRange_, _province_)
  Vaccination(_passportNumOrSSN_, _doseNumber_, date)
  PersonAgeGroup(_ageRange_, _passportNumOrSSN_);
  VaccinationDrug(_name_);
  DrugHistory(_name_, _date_, status)
  VaccinationDoneWith(_passportNumOrSSN_, _doseNumber_, _name_);
  VaccinationDoneAt(_passportNumOrSSN_, _doseNumber_, _name_, _address_);
  VaccinationDoneBy(_passportNumOrSSN_, _doseNumber_, _EID_)
  HealthFacility(_name_, _address_,telephone, webAddress, type, city, province);
  Employee(_EID_, SSN)
  Manager(_EID_)
  Manages(_EID_, name, address)
  JobHistory(_EID_, _name_, _address_, _startDate_, endDate)
  VaccineStored(_nameHSO_, _address_, _nameDrug_, count)
  VaccineShipment(_nameHSO_, _address_, _nameDrug_, _date_, count)
  VaccineTransfer(_nameHSOFrom_, _nameHSOTo_, _addressFrom_, _addressTo_,
    _nameDrug_, _date_, count)
  PostalCode(address, city, province, postalCode)
```

---

Foreign Keys and referential constraints shown in the scripts that create
the SQL table for the design

## 4 - Is the DB in BCNF

yes! Explanation at 3

## 5 - Not necessary (DB is in BCNF)



## SQL Table Declarations

```SQL
CREATE DATABASE PROJECT;
use PROJECT;


CREATE TABLE PROJECT.AgeGroup (
  ageGroupID INT,
  ageRange VARCHAR(20),
  PRIMARY KEY (ageGroupID)
);

CREATE TABLE PROJECT.VaccinationDrug (
  name VARCHAR(20),
  PRIMARY KEY (name)
);

CREATE TABLE PROJECT.Province (
  provinceID INT,
  name VARCHAR(100),
  currentAgeGroupID INT,
  PRIMARY KEY (provinceID), 
  FOREIGN KEY (currentAgeGroupID) REFERENCES AgeGroup(ageGroupID)
);

CREATE TABLE PROJECT.VariantType (
  variantTypeID INT,
  name VARCHAR(100),
  PRIMARY KEY (variantTypeID)
);

CREATE TABLE PROJECT.Person (
  passportNumOrSSN VARCHAR(10),
  medicaidNum  VARCHAR(10),
  telephone VARCHAR(13),
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  ageGroupID INT,
  provinceID INT,
  citizenship BOOLEAN,
  email VARCHAR(255),
  dateOfBirth DATE,
  PRIMARY KEY(passportNumOrSSN),
  FOREIGN KEY (ageGroupID) REFERENCES AgeGroup(ageGroupID),
  FOREIGN KEY (provinceID) REFERENCES Province(provinceID)
);

CREATE TABLE PROJECT.Infection (
  dateInfection DATE,
  passportNumOrSSN VARCHAR(10),
  variantTypeID INT,
  PRIMARY KEY(passportNumOrSSN, dateInfection),
  FOREIGN KEY (variantTypeID) REFERENCES VariantType(variantTypeID),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);


CREATE TABLE PROJECT.HealthFacility (
  name VARCHAR(50),
  address VARCHAR(100),
  city VARCHAR(255),
  provinceID int,
  telephone VARCHAR(13),
  webAddress VARCHAR(100),
  type VARCHAR(8),
  PRIMARY KEY (name, address),
  FOREIGN KEY (provinceID) REFERENCES Province(provinceID)
);



CREATE TABLE PROJECT.DrugHistory (
  Dname VARCHAR(20),
  date DATE,
  status VARCHAR(100),
  PRIMARY KEY (Dname, date),
  FOREIGN KEY (Dname) REFERENCES VaccinationDrug(name)
);


CREATE TABLE PROJECT.Employee (
  EID VARCHAR(10),
  SSN VARCHAR(10),
  PRIMARY KEY (EID),
  FOREIGN KEY (SSN) REFERENCES Person(passportNumOrSSN)
);


CREATE TABLE PROJECT.Vaccination (
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  date DATE,
  EID VARCHAR(10),
  name VARCHAR(20),
  Hname VARCHAR(50),
  address VARCHAR(100),
  PRIMARY KEY (passportNumOrSSN, doseNumber),
  FOREIGN KEY (name) REFERENCES VaccinationDrug(name),
  FOREIGN KEY (EID) REFERENCES Employee(EID),
  FOREIGN KEY (Hname,address) REFERENCES HealthFacility(name,address),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);

CREATE TABLE PROJECT.Managers (
  EID VARCHAR(10),
  name VARCHAR(50),
  address VARCHAR(100),
  startDate DATE,
  endDate DATE,
  PRIMARY KEY (EID),
  FOREIGN KEY (EID) REFERENCES Employee(EID),
  FOREIGN KEY (name, address) REFERENCES HealthFacility(name, address)
);

CREATE TABLE PROJECT.JobHistory (
  EID VARCHAR(10), 
  name VARCHAR(50),
  address VARCHAR(100), 
  startDate DATE,
  endDate DATE,
  PRIMARY KEY (EID, name, address, startDate),
  FOREIGN KEY (EID) REFERENCES Employee(EID),
  FOREIGN KEY (name, address) REFERENCES HealthFacility(name, address)
);

CREATE TABLE PROJECT.VaccineStored (
  nameHSO VARCHAR(50), 
  address VARCHAR(100), 
  nameDrug VARCHAR(20), 
  count INT,
  PRIMARY KEY (nameHSO, address, nameDrug),
  FOREIGN KEY (nameHSO, address) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES VaccinationDrug(name)
);

CREATE TABLE PROJECT.VaccineShipment (
  nameHSO VARCHAR(50), 
  address VARCHAR(100), 
  nameDrug VARCHAR(20),
  date DATE,
  count INT,
  PRIMARY KEY (nameHSO, address, nameDrug, date),
  FOREIGN KEY (nameHSO, address) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES VaccinationDrug(name)
);

CREATE TABLE PROJECT.VaccineTransfer (
  nameHSOFrom VARCHAR(50), 
  nameHSOTo VARCHAR(50), 
  addressFrom VARCHAR(100), 
  addressTo VARCHAR(100), 
  nameDrug VARCHAR(20),
  date DATE,
  count INT,
  PRIMARY KEY (nameHSOFrom,nameHSOTo, addressFrom, addressTo, nameDrug, date),
  FOREIGN KEY (nameHSOFrom, addressFrom) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameHSOTo, addressTo) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES VaccinationDrug(name)
);

CREATE TABLE PROJECT.PostalCode (
  address VARCHAR(100), 
  city VARCHAR(100),
  provinceID int,
  postalCode VARCHAR(6),
  PRIMARY KEY (address, city, provinceID),
  FOREIGN KEY (provinceID) REFERENCES Province(provinceID)
);
```

## SQL Code to Populate Relations

```SQL
use PROJECT;

INSERT  INTO AgeGroup VALUES (0, "0-0");
INSERT  INTO AgeGroup VALUES (1, "80+");
INSERT  INTO AgeGroup VALUES (2, "70-79");
INSERT  INTO AgeGroup VALUES (3, "60-69");
INSERT  INTO AgeGroup VALUES (4, "50-59");
INSERT  INTO AgeGroup VALUES (5, "40-49");
INSERT  INTO AgeGroup VALUES (6, "30-39");
INSERT  INTO AgeGroup VALUES (7, "18-29");
INSERT  INTO AgeGroup VALUES (8, "12-17");
INSERT  INTO AgeGroup VALUES (9, "5-11");
INSERT  INTO AgeGroup VALUES (10, "0-4");

INSERT INTO VaccinationDrug VALUES ("Pfizer");
INSERT INTO VaccinationDrug VALUES ("Moderna");
INSERT INTO VaccinationDrug VALUES ("AstraZeneca");
INSERT INTO VaccinationDrug VALUES ("Johnson & Johnson");
INSERT INTO VaccinationDrug VALUES ("RBD-Dimer");
INSERT INTO VaccinationDrug VALUES ("Covaxin");
INSERT INTO VaccinationDrug VALUES ("Ad5-nCoV");
INSERT INTO VaccinationDrug VALUES ("CIGB-66");
INSERT INTO VaccinationDrug VALUES ("KoviVac");
INSERT INTO VaccinationDrug VALUES ("EpiVacCorona");

INSERT  INTO Province VALUES ('1', "NL", '4');
INSERT  INTO Province VALUES ('2', "PE", '5');
INSERT  INTO Province VALUES ('3', "NS", '6');
INSERT  INTO Province VALUES ('4', "NB", '3');
INSERT  INTO Province VALUES ('5', "QC", '8');
INSERT  INTO Province VALUES ('6', "ON", '1');
INSERT  INTO Province VALUES ('7', "MB", '2');
INSERT  INTO Province VALUES ('8', "SK", '9');
INSERT  INTO Province VALUES ('9', "AB", '4');
INSERT  INTO Province VALUES ('10', "BC", '6');
INSERT  INTO Province VALUES ('11', "YT", '7');
INSERT  INTO Province VALUES ('12', "NT", '8');
INSERT  INTO Province VALUES ('13', "NU", '4');

INSERT INTO VariantType VALUES(1, "ALPHA");
INSERT INTO VariantType VALUES(2, "LAMBDA");
INSERT INTO VariantType VALUES(3, "DELTA");
INSERT INTO VariantType VALUES(0, "UMKNOWN");

INSERT INTO Person VALUES ("5418600012", "1936638 14", "(514)482-4299", "Annabel", "Dodson",
  "6860 Fielding", "Montreal", 7, 5, TRUE,
  "annabel.dodson@gmail.com", "1996-08-06");
INSERT INTO Person VALUES ("7198638080", "1362899 55","(514)366-4286", "Zachary", "Rutledge",
  "902 Tittley", "Montreal", 6, 5, TRUE,
  "Zachary.Rutledge@gmail.com", "1986-08-12");
INSERT INTO Person VALUES ("5867167004", "0243401 87", "(514)767-5030", "Alister", "Wiggins",
  "6818 Lamont", "Montreal", 6, 5, TRUE, "Alister.Wiggins@gmail.com",
  "1987-08-27"); 
INSERT INTO Person VALUES ("9415548075", "2054252 15", "(514)525-4731", "Osman", "Vaughn", 
  "1720 Bourbonniere", "Montreal", 8, 5, TRUE,
  "Osman.Vaughn@gmail.com", "2007-09-08"); 
INSERT INTO Person VALUES ("9052864070", "1643994 57", "(514)768-9102", "Bear", "Melton",
  "5962 Jogues", "Montreal", 5, 5, TRUE, "Bear.Melton@gmail.com",
  "1976-09-13"); 
INSERT INTO Person VALUES ("9826293018", "4105748 51", "(613)733-8502", "Lulu", "Fisher",
  "927 Rand", "Gatineau", 5, 5, TRUE, "Lulu.Fisher@gmail.com",
  "1976-09-27"); 
INSERT INTO Person VALUES ("2055054040", "4990628 77", "(819)503-3196", "Collette", "Zavala",
  "60 Du Blizzard", "Gatineau", 3, 5, TRUE,
  "Collette.Zavala@gmail.com", "1956-09-29"); 
INSERT INTO Person VALUES ("7247613020", "3234394 08", "(819)408-0531", "Angela", "Dodson",
  "1175 De L'Esplanade", "Sherbrooke", 3, 5, TRUE,
  "Angela.Dodson@gmail.com", "1956-10-15"); 
INSERT INTO Person VALUES ("7976980046", "9109123 89", "(819)566-0668", "Annabel", "Crouch",
  "1812 Dunant", "Sherbrooke", 1, 5, TRUE,
  "Annabel.Crouch@gmail.com", "1936-10-18"); 
INSERT INTO Person VALUES ("6623218089", "0451174 26", "(418)547-8256", "Nyle", "Sparrow",
  "3937 Soucy", "Jonquière", 1, 5, TRUE, "Nyle.Sparrow@gmail.com",
  "1936-12-08"); 

 
INSERT INTO Person VALUES ("4030141599", "6202715 46","(418)640-9486", "Elizabeth",
  "Jernigan", "4884 Boulevard Cremazie",  
  "Quebec",7, 5, TRUE, "eliJer@gmail.com", "1996-04-18");
INSERT INTO Person VALUES ("3559893762", "8331149 83", "(418)299-4800", "William",  
"Blackman", "3619 avenue de Port-Royal",  
"Bonaventure",6, 5, TRUE, "wilBlack@gmail.com", "1991-07-01");
INSERT INTO Person VALUES ("8133950202", "2597807 10", "(514)481-2566", "Carol",  
"Williams", "6767 ch de la Côte-Saint-Luc",  
"Côte Saint-Luc",6, 5, TRUE, "carWill@gmail.com", "1984-03-01");
INSERT INTO Person VALUES ("5594746088", "2967560 35", "(514)484-4049", "Gary",  
"Smith", "3472 Av Westmore", 
"Montreal",4, 5,  TRUE, "garySmi@gmail.com", "1967-06-12");
INSERT INTO Person VALUES ("3050347011", "7495078 77", "(514)485-1864", "Ted",  
"Johnson", "621 Côte Murray", 
"Westmount",7,  5, TRUE, "tedJohn@gmail.com","1998-09-23");
INSERT INTO Person VALUES ("6901680262", "1457287 34", "(514)642-6526", "Ronald",  
"Smith", "16226 Rue Bureau",  
"Pointe-Aux-Trembles",7, 5, TRUE, "ronSmi@gmail.com","1995-06-14");
INSERT INTO Person VALUES ("2826175309", "0568018 19", "(514)483-4346", "Adam",  
"Smith", "4840 Bonavista", 
"Montreal",7, 5,  TRUE, "adaSmi@gmail.com", "1995-08-12");
INSERT INTO Person VALUES ("0883386538", "5489390 84", "(514)486-4899", "Wayne",  
"Johnson", "999 Old Orchard", 
"Montreal",6, 5,  TRUE, "wayJon@gmail.com","1984-07-16");
INSERT INTO Person VALUES ("3909862653", "5433470 85", "(514)767-3102", "Sylvain",  
"Williams", "1477 Rue Fayolle", 
"Verdun",5, 5,  TRUE, "sylWill@gmail.com","1978-11-14");
INSERT INTO Person VALUES ("5025223450", "6335938 64", "(514)597-0058", "Michel",  
"Johnson", "850 Av Lachine", 
"Montreal",7, 5,  TRUE, "micJohn@gmail.com","1996-09-13");


INSERT INTO Infection VALUES ("2021-03-16","5418600012", 1);
INSERT INTO Infection VALUES ("2021-04-18","5418600012", 2); 
INSERT INTO Infection VALUES ("2021-03-25","7198638080", 3); 
INSERT INTO Infection VALUES ("2021-04-02","5867167004", 1); 
INSERT INTO Infection VALUES ("2021-04-07","9415548075", 3); 
INSERT INTO Infection VALUES ("2021-04-30","9052864070", 1); 
INSERT INTO Infection VALUES ("2021-05-05","9826293018", 1); 
INSERT INTO Infection VALUES ("2021-05-20","2055054040", 3); 
INSERT INTO Infection VALUES ("2021-05-21","7247613020", 3); 
INSERT INTO Infection VALUES ("2021-06-18","7976980046", 1); 
INSERT INTO Infection VALUES ("2021-07-22","6623218089", 0); 


INSERT INTO HealthFacility VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Montreal", 5, "(514)252-4141",
  "www.so.com", "SPECIAL"); 
INSERT INTO HealthFacility VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Montreal", 5,  "(514)340-8222",
   "www.gjw.com", "HOSPITAL"); 
INSERT INTO HealthFacility VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Gatineau", 5, "(819)966-6100",
  "www.hg.com", "HOSPITAL"); 
INSERT INTO HealthFacility VALUES ("CHUS", "300 Rue King E", "Sherbrooke", 5, 
  "www.chus.com", "(819)346-1110", "HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Montreal", 5, "(514)384-2000", "www.hopitalFleury.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Richardson", "5425, Avenue Bessborough",
  "Montreal", 5,"(514)484-7878", "www.hopitalRichardson.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Rivière-des-Prairies",
  "7070, boulevard Perras", "Montreal", 5, "(514)323-7260",
  "www.hopitalRP.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "LaSalle", 5, "(514)362-8000", "www.hopitalLasalle.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Verdun", 5, "(514)362-1100", "www.hopitalVerdun.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Sainte-Anne-de-Bellevue", 5,
  "(514)457-3440", "www.hopitalSaintAnne.com","HOSPITAL");

INSERT INTO DrugHistory VALUES ("Pfizer", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("Moderna", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("AstraZeneca", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("Johnson & Johnson", "2021-06-21", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("RBD-Dimer", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("Covaxin", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("Ad5-nCoV", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("CIGB-66", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("KoviVac", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("EpiVacCorona", "2021-01-01", "SUSPENDED");

INSERT INTO Employee VALUES ("2314904771","4030141599");
INSERT INTO Employee VALUES ("4091939153","3559893762");
INSERT INTO Employee VALUES ("6296074483","8133950202");
INSERT INTO Employee VALUES ("1988238722","5594746088");
INSERT INTO Employee VALUES ("9654156685","3050347011");
INSERT INTO Employee VALUES ("0426670356","6901680262");
INSERT INTO Employee VALUES ("2589272564","2826175309");
INSERT INTO Employee VALUES ("4278243142","0883386538");
INSERT INTO Employee VALUES ("2221453161","3909862653");
INSERT INTO Employee VALUES ("7034521288","5025223450");

INSERT INTO Vaccination VALUES ("5418600012", 1, "2021-01-16", "6296074483", "AstraZeneca", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("5418600012", 2, "2021-05-16", "2589272564", "Pfizer", "Hôpital Fleury", "2180, rue Fleury Est"); 
INSERT INTO Vaccination VALUES ("7198638080", 1, "2021-04-25", "4278243142", "Pfizer", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("5867167004", 1, "2021-05-02", "2221453161", "AstraZeneca", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("9415548075", 1, "2021-05-07", "7034521288", "Pfizer", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT INTO Vaccination VALUES ("9052864070", 1, "2021-01-30", "7034521288", "KoviVac", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("9826293018", 1, "2021-06-05", "6296074483", "KoviVac", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("2055054040", 1, "2021-06-20", "6296074483", "Moderna", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT INTO Vaccination VALUES ("7247613020", 1, "2021-06-21", "6296074483", "AstraZeneca", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants"); 
INSERT INTO Vaccination VALUES ("7976980046", 1, "2021-07-18", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 

INSERT INTO Vaccination VALUES ("4030141599", 1, "2021-07-17", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("3559893762", 1, "2021-07-19", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("3559893762", 2, "2021-07-20", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 


INSERT INTO Managers VALUES ("2314904771", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("4091939153", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("6296074483", "Hopital de Gatineau", "909 Boulevard la Vérendrye O", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("1988238722", "CHUS", "300 Rue King E", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("0426670356", "Hôpital Richardson", "5425, Avenue Bessborough", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("2589272564", "Hôpital Rivière-des-Prairies", "7070, boulevard Perras", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("4278243142", "Hôpital de Lasalle", "8585, Terrasse Champlain", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("2221453161", "Hôpital de Verdun", "4000, boul. Lasalle", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("7034521288", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants", "2018-04-16", NULL);

INSERT INTO JobHistory VALUES ("2314904771", "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("4091939153", "Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("6296074483", "Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("1988238722", "CHUS", "300 Rue King E", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est",
  "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("0426670356", "Hôpital Richardson",
  "5425, Avenue Bessborough", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("2589272564", "Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("4278243142", "Hôpital de Lasalle",
  "8585, Terrasse Champlain", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("2221453161", "Hôpital de Verdun", 
  "4000, boul. Lasalle", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("7034521288", "Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "2019-01-01", NULL);

INSERT INTO VaccineStored VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("CHUS", "300 Rue King E", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", 2000);

INSERT INTO VaccineShipment VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", "2021-01-23", 100);

INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Richardson", 
  "4545 Avenue Pierre-De Coubertin", "5425, Avenue Bessborough", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Rivière-des-Prairies", 
  "4545 Avenue Pierre-De Coubertin", "7070, boulevard Perras", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Lasalle",
  "4545 Avenue Pierre-De Coubertin", "8585, Terrasse Champlain", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Verdun",
  "4545 Avenue Pierre-De Coubertin", "4000, boul. Lasalle", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Sainte-Anne",
  "4545 Avenue Pierre-De Coubertin", "305, boulevard des Anciens-Combattants",
  "Pfizer", "2021-01-20", 100);


INSERT INTO PostalCode VALUES ("6860 Fielding", "Montreal", 5, "H4V1P2");
INSERT INTO PostalCode VALUES ("902 Tittley", "Montreal",5,"H8R3X3");
INSERT INTO PostalCode VALUES ("6818 Lamont", "Montreal",5,"H7L4X8");
INSERT INTO PostalCode VALUES ("1720 Bourbonniere", "Montreal",5,"H1W3N1");
INSERT INTO PostalCode VALUES ("5962 Jogues", "Montreal",5,"J8Y4E3");
INSERT INTO PostalCode VALUES ("927 Rand", "Gatineau",5,"K1V6X4");
INSERT INTO PostalCode VALUES ("60 Du Blizzard", "Gatineau",5,"J9A0C8");
INSERT INTO PostalCode VALUES ("1175 De L'Esplanade", "Sherbrooke",5,"J1H1S9");
INSERT INTO PostalCode VALUES ("1812 Dunant", "Sherbrooke",5,"J1H1Y9");
INSERT INTO PostalCode VALUES ("3937 Soucy", "Jonquière",5,"G7X8T1");
INSERT INTO PostalCode VALUES ("4884 Boulevard Cremazie","Quebec", 5,"H2M0B0");
INSERT INTO PostalCode VALUES ("3619 avenue de Port-Royal","Bonaventure", 5,"J9J1C8");
INSERT INTO PostalCode VALUES ("6767 ch de la Côte-Saint-Luc","Côte Saint-Luc", 5,"H4V2Z6");
INSERT INTO PostalCode VALUES ("3472 Av Westmore", "Montreal",5,"H4V4Z6");
INSERT INTO PostalCode VALUES ("621 Côte Murray","Westmount",5,"H4V2Y6");
INSERT INTO PostalCode VALUES ("16226 Rue Bureau","Pointe-Aux-Trembles", 5,"H1A1Z1");
INSERT INTO PostalCode VALUES ("4840 Bonavista", "Montreal", 5,"G0C1E0");
INSERT INTO PostalCode VALUES ("999 Old Orchard", "Montreal", 5,"G0C1E8");
INSERT INTO PostalCode VALUES ("1477 Rue Fayolle", "Verdun", 5,"G3F1E0");
INSERT INTO PostalCode VALUES ("850 Av Lachine", "Montreal", 5,"G6C1Y0");
INSERT INTO PostalCode VALUES ("4545 Avenue Pierre-De Coubertin", "Montreal", 5,"G7Q2V0");
INSERT INTO PostalCode VALUES ("3755 Chemin de la Côte-Sainte-Catherine", "Montreal", 5,"G0S5R0");
INSERT INTO PostalCode VALUES ("909 Boulevard la Vérendrye O", "Gatineau", 5,"G5S2V0");
INSERT INTO PostalCode VALUES ("300 Rue King E", "Sherbrooke", 5,"G0S2V4");
INSERT INTO PostalCode VALUES ("2180, rue Fleury Est","Montreal", 5,"G0S2V0");
INSERT INTO PostalCode VALUES ("5425, Avenue Bessborough","Montreal", 5,"M4G3H9");
INSERT INTO PostalCode VALUES ("7070, boulevard Perras", "Montreal", 5,"H1E1A4");
INSERT INTO PostalCode VALUES ("8585, Terrasse Champlain","LaSalle", 5,"H3N2L1");
INSERT INTO PostalCode VALUES ("4000, boul. Lasalle","Verdun", 5,"H4G1J8");
INSERT INTO PostalCode VALUES ("305, boulevard des Anciens-Combattants", "Sainte-Anne-de-Bellevue", 5,"H9X1Y9");
```

## SQL DDL and DML required commands

### Query 1

##### Create a Person

```sql
-- Insert the person
INSERT INTO Person VALUES (passportNumOrSSN, medicaidNum, telephone, firstName, lastName, address, city, province, citizenship, email, dateOfBirth);

-- Check if the postal code tuple exist with
SELECT * FROM PostalCode WHERE address = "x" AND city = "y" AND province = "z" AND postalCode = "a";

-- If the query does no return anything, then insert the postal code
INSERT INTO PostalCode VALUES (address, city, province, postalCode);

-- Also add the various infections
INSERT INTO Infection VALUES (dateInfection, passportNumOrSSN, variantID);
```

Showing the output of this query is deemed not necessary

#### Delete a Person

```SQL
DELETE FROM Person WHERE passportNumOrSSN = "x";
DELETE FROM Infection WHERE passportNumOrSSN = "x";
-- No need to delete any postal code
```

Showing the output of this query is deemed not necessary

#### Edit a Person

```sql
UPDATE Person
SET column_name = value
WHERE passportNumOrSSN = "x";

-- To edit a postalCode, if there is a change in address
UPDATE PostalCode SET column_name = value WHERE address = "x" AND city = "y" AND province = "z";

-- To edit an infection
UPDATE Infection
SET column_name = value
WHERE passportNumOrSSN = "x" AND date = "d";
```

Showing the output of this query is deemed not necessary

#### Display a person

```sql
SELECT Person.*, PostalCode.postalCode
FROM Person, PostalCode
WHERE Person.passportNumOrSSN = "x" AND Person.address = PostalCode.address AND
    Person.city = PostalCode.city AND Person.province = PostalCode.province;
```

**Sample output (of displaying multiple persons)**

| passportNumOrSSN | medicaidNum | telephone | firstName | lastName | address | city | ageGroupID | provinceID | citizenship | email | dateOfBirth |
| ---------------- | ----------- | --------- | --------- | -------- | ------- | ---- | ---------- | ---------- | ----------- | ----- | ----------- |
|0883386538|5489390 84|(514)486-4899|Wayne|Johnson|999 Old Orchard|Montreal|5|5|1|wayJon@gmail.com|1984-07-16|
|2055054040|4990628 77|(819)503-3196|Collette|Zavala|60 Du Blizzard|Gatineau|3|5|1|Collette.Zavala@gmail.com|1956-09-29|
|2826175309|0568018 19|(514)483-4346|Adam|Smith|4840 Bonavista|Montreal|7|5|1|adaSmi@gmail.com|1995-08-12|
|3050347011|7495078 77|(514)485-1864|Ted|Johnson|621 Côte Murray|Westmount|7|5|1|tedJohn@gmail.com|1998-09-23|
|3559893762|8331149 83|(418)299-4800|William|Blackman|3619 avenue de Port-Royal|Bonaventure|6|5|  1|wilBlack@gmail.com| 1991-07-01|

### Query 2

##### Create a Public Health Worker

```sql
INSERT INTO Employee VALUES ("2314904771","4030141599"); ##########  SSN should exist in Person

-- Check if the postal code tuple exist with
SELECT * FROM PostalCode WHERE address = "x" AND city = "y" AND province = "z" AND postalCode = "a";

-- If the query does no return anything, then insert the postal code
INSERT INTO PostalCode VALUES (address, city, province, postalCode);
```

Showing the output of this query is deemed not necessary

##### Delete a Public Health Worker

```sql
DELETE FROM Employee WHERE EID = '5418600012';
-- No need to delete any postal code
```

Showing the output of this query is deemed not necessary

##### Edit a Public Health Worker

```sql
UPDATE Employee ######################
SET email = "newemail@email.com", citizenship = FALSE
WHERE EID = "2314904771";

-- To edit a postalCode, if there is a change in address
UPDATE PostalCode SET column_name = value WHERE address = "x" AND city = "y" AND province = "z";
```

Showing the output of this query is deemed not necessary

##### Display a Public Health Worker

Query

```sql
####   recheck the output table on report###################
SELECT Person.*, Employee.EID, Province.name, PostalCode.postalCode
FROM Person, Employee, PostalCode, Province
WHERE EID = "0426670356"
AND Employee.SSN = Person.passportNumOrSSN
AND Person.provinceID = Province.provinceID
AND Person.address = PostalCode.address
AND Person.city = PostalCode.city
AND Person.provinceID = PostalCode.provinceID;
```

Results
| EID | SSN | medicare | firstName | lastName | postalCode | dateOfBirth | telephone | address | city | provinceID | citizenship | email |
| --------- | ---------- | ---------- | --------- | -------- | ---------- | ----------- | ------------- | ---------------- | ------------------- | ---------- | ----------- | ---------------- |
| 426670356 | 6901680262 | 1457287 34 | Ronald | Smith | H1A 1Z1 | 1995-06-14 | (514)642-6526 | 16226 Rue Bureau | Pointe-Aux-Trembles | QC | 1 | ronSmi@gmail.com |

### Query 3

#### Create a Health Facility

```SQL
-- Insert the health facility
INSERT INTO HealthFacility VALUES ('Hname','HAddress','Hcity', 1, '0123486789', 'www.hname.ca', 'Hospital');

-- Check if the postal code tuple exist with
SELECT * FROM PostalCode WHERE address = "x" AND city = "y" AND province = "z" AND postalCode = "a";

-- If the query does no return anything, then insert the postal code
INSERT INTO PostalCode VALUES (address, city, province, postalCode);
```

Showing the output of this query is deemed not necessary

#### Delete a Health Facility

```SQL
DELETE FROM HealthFacility
WHERE name ='Hname' AND address ='HAddress';
-- No need to delete any postal code
```

Showing the output of this query is deemed not necessary

#### Edit a Health Facility

```SQL
UPDATE HealthFacility
SET telephone = '123456789'
WHERE name ='Hname' AND address ='HAddress';

-- To edit a postalCode, if there is a change in address
UPDATE PostalCode SET column_name = value WHERE address = "x" AND city = "y" AND province = "z";
```

Showing the output of this query is deemed not necessary

#### Display a Health Facility

```sql
SELECT HF.*, PC.postalCode
FROM HealthFacility as HF, PostalCode as PC
WHERE HF.name = 'Hname' AND HF = 'HAddress' AND HF.address = PC.address AND HF.city = PC.city AND HF.provinceID = PC.provinceID; ;
```

**Sample output (of displaying multiple health facilities)**

| name | address | city | provinceID | telephone | webAddress | type | postalCode |
| ---- | ------- | ---- | ---------- | --------- | ---------- | ---- | ---------- |
|CHUS                        |300 Rue King E                         |Sherbrooke             |         5|(819)346-1110|www.chus.com             |HOSPITAL|G0S2V4    |
|Hopital de Gatineau         |909 Boulevard la Vérendrye O           |Gatineau               |         5|(819)966-6100|www.hg.com               |HOSPITAL|G5S2V0    |
|Hôpital de Lasalle          |8585, Terrasse Champlain               |LaSalle                |         5|(514)362-8000|www.hopitalLasalle.com   |HOSPITAL|H3N2L1    |
|Hôpital de Sainte-Anne      |305, boulevard des Anciens-Combattants |Sainte-Anne-de-Bellevue|         5|(514)457-3440|www.hopitalSaintAnne.com |HOSPITAL|H9X1Y9    |
|Hôpital de Verdun           |4000, boul. Lasalle                    |Verdun                 |         5|(514)362-1100|www.hopitalVerdun.com    |HOSPITAL|H4G1J8    |

### Query 4

#### Create a Vaccination Type

```SQl
INSERT INTO VaccinationDrug VALUES ('VACCINE');
```

Showing the output of this query is deemed not necessary

#### Delete a Vaccination Type

```SQL
DELETE FROM VaccinationDrug
WHERE name = 'VACCINE';
```

Showing the output of this query is deemed not necessary

#### Edit a Vaccination Type

```SQL
UPDATE VaccinationDrug
SET name = 'EDITVACCINE'
WHERE name = 'VACCINE';
```

Showing the output of this query is deemed not necessary

#### Display a Vaccination Type

```SQl
SELECT * FROM VaccinationDrug
WHERE name = 'name';
```

**Sample output (of displaying multiple vaccination type)**

| name         |
| ------------ |
| Ad5-nCoV     |
| AstraZeneca  |
| CIGB-66      |
| Covaxin      |
| EpiVacCorona |

### Query 5

#### Create a variant type

```sql
INSERT INTO VariantType VALUES (id, "name");
```

Showing the output of this query is deemed not necessary

#### Delete a variant type

```sql
DELETE FROM VariantType WHERE variantTypeID = x;
```

Showing the output of this query is deemed not necessary

#### Edit a variant type

```sql
UPDATE VariantType
SET column_name = value
WHERE variantTypeID = x;
```

Showing the output of this query is deemed not necessary

#### Display a variant type

```sql
SELECT *
FROM VariantType
WHERE variantTypeID = x;
```

**Sample output (of displaying multiple variant type)**

| variantTypeID | name    |
| ------------- | ------- |
| 0             | UMKNOWN |
| 1             | ALPHA   |
| 2             | LAMBDA  |
| 3             | DELTA   |

### Query 6

##### Create a Group Age

```sql
INSERT AgeGroup VALUES (2, "70-79");
```

Showing the output of this query is deemed not necessary

##### Delete a Group Age

```sql
DELETE FROM AgeGroup WHERE ageGroupID = 2;
```

**Note:** This query may result in an MySQL error because relations Person and ProvinceCurrentAgeGroup have a foreign key that references AgeGroup.

Showing the output of this query is deemed not necessary

##### Edit a Group Age

```sql
UPDATE AgeGroup
SET ageRange = "80-90"
WHERE ageGroupID = "1";
```

Showing the output of this query is deemed not necessary

##### Display a Group Age

Query

```sql
SELECT * FROM AgeGroup WHERE ageGroupID = "1";
```

Results
| 2 | 70-79 |
| ---------- | -------- |
| ageGroupID | ageRange |

### Query 7

#### Add a province

```SQL
INSERT INTO Province VALUES(id, "name", ageGroupID);
```

Showing the output of this query is deemed not necessary

#### Delete a province

```SQL
DELETE FROM Province WHERE provinceID = id;
```

Showing the output of this query is deemed not necessary

#### Edit a province

```SQL
UPDATE Province
SET attribute = value
WHERE provinceID = id;
```

Showing the output of this query is deemed not necessary

### Query 8

#### Set a new Group Age for a Province

```SQL
UPDATE Province
SET currentAgeGroupID = ageID
WHERE provinceID = id;
```

Showing the output of this query is deemed not necessary

### Query 9

#### Receive a shipment of vaccines and add it to the inventory in a specific location

Add a vaccine shipment to the DB

```SQL
INSERT INTO VaccineShipment VALUES("nameHSO", "address", "nameDrug", date, count);
```

Then add the shipment to the hospital inventory

First check if there is such vaccine at the hospital

```sql
SELECT *
FROM VaccineStored
WHERE nameDrug = "name"
AND nameHSO = "nameHSO"
AND address = "address"
AND date = "date";
```

If the query is empty, do this

```sql
INSERT INTO VaccineStored VALUES ("nameHSO", "address", "nameDrug", count);
```

Else increase the old value

```sql
UPDATE VaccineStored SET count = count + shipmentCount WHERE nameDrug = "nameDrug" AND nameHSO = "nameHSO" and address = "address";
```

Showing the output of this query is deemed not necessary

### Query 10

Transfer vaccines from one location to another location.
**Note:** This example demonstrates transferring 500 doses of Pfizer from Hopital Hopital de Gatineau to Hopital de Verdun

```sql
UPDATE VaccineStored
SET count = count - 500
WHERE nameHSO = "Hopital de Gatineau"
AND address = "909 Boulevard la Vérendrye O"
AND nameDrug = "Pfizer"
and count >= 500;
```

The query above will only decrement the number of doses if adequate amount is available at the origin hospital. We can use the PHP mysql_affected_rows() to verify if the query did execute. If yes, we can execute the following two queries:

```sql
    UPDATE VaccineStored
    SET count = count + 500
    WHERE nameHSO = "Hopital de Verdun"
    AND address = "4000, boul. Lasalle"
    AND nameDrug = "Pfizer";
```

```sql
    INSERT VaccineTransfer VALUES ("Hopital de Gatineau", "Hopital de Verdun",
  "909 Boulevard la Vérendrye O", "4000, boul. Lasalle", "Pfizer",
  "2021-01-20", 500);
```

Showing the output of this query is deemed not necessary

### Query 11

#### Perform a vaccine to a person

Verify if person has already received 2 doses

```SQL
SELECT * FROM Vaccination WHERE passportNumOrSSN = '?' and doseNumber = 2;
```

Verify that Employee actually works at health facility

```SQL
SELECT * FROM JobHistory WHERE EID = '?' AND name = '?' AND address = '?';
```

Verify that the vaccine being administered is available at the Health Facility

```SQL
UPDATE VaccineStored SET count = count - 1 WHERE nameHSO = '?' AND address = '?' AND nameDrug = '?' and count >= 1;
```

If affected rows of previous query >= 1, the vaccine was available and quantity was removed.

Create Vaccination record

```SQL
INSERT INTO Vaccination VALUES ('p1', '1', '2021-07-07', 'E1EID', 'Pfizer', 'Hname', 'HAddress');
```

Showing the output of this query is deemed not necessary

### Query 12

#### Get details of all the people who got vaccinated only one dose and are of group ages 1 to 3

```SQL
SELECT Person.firstName, Person.lastName, Person.dateOfBirth, Person.email,
Person.telephone, Person.city,Vaccination.date,Vaccination.name,
CASE WHEN EXISTS(
		SELECT  *
		FROM Infection
		WHERE Person.passportNumOrSSN = Infection.passportNumOrSSN
	) THEN 'Yes' ELSE 'No' END as WasInfected
FROM Person JOIN Vaccination on Person.passportNumOrSSN=Vaccination.passportNumOrSSN
LEFT JOIN Infection ON Person.passportNumOrSSN=Infection.passportNumOrSSN
WHERE ageGroupID BETWEEN 1 AND 3
AND Person.passportNumOrSSN in (
	SELECT passportNumOrSSN
	FROM Vaccination
	GROUP BY Vaccination.passportNumOrSSN
	HAVING COUNT(Vaccination.passportNumOrSSN)=1
);
```

**Results**

|firstName|lastName|dateOfBirth|email                  |telephone    |city      |date      |name       |WasInfected|
| ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
|Angela   |Dodson  | 1956-10-15|Angela.Dodson@gmail.com|(819)408-0531|Sherbrooke|2021-06-21|AstraZeneca|Yes        |

### Query 13

#### Get details of all the people who live in the city of Montréal and who got vaccinated at least two doses of different types of vaccines.

```SQL
SELECT firstName, lastName, dateOfBirth, email, telephone, city, Vaccination.date, Vaccination.name,
	CASE WHEN EXISTS(
		SELECT  *
		FROM Infection
		WHERE Person.passportNumOrSSN = Infection.passportNumOrSSN
	) THEN 'Yes' ELSE 'No' END as WasInfected
FROM Person,
		(
			SELECT Person.passportNumOrSSN as p, COUNT(DISTINCT(Vaccination.name)) as c
			FROM Vaccination, Person
			WHERE Person.passportNumOrSSN = Vaccination.passportNumOrSSN
			GROUP BY Person.passportNumOrSSN
		) as DV, Vaccination
WHERE Person.city = "Montreal" AND DV.p = Person.passportNumOrSSN AND DV.c > 1 AND
	Vaccination.passportNumOrSSN = Person.passportNumOrSSN;
```

**Results**

|firstName|lastName|dateOfBirth|email                   |telephone    |city    |date      |name       |WasInfected|
| ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
|Annabel  |Dodson  | 1996-08-06|annabel.dodson@gmail.com|(514)482-4299|Montreal|2021-01-16|AstraZeneca|Yes        |
|Annabel  |Dodson  | 1996-08-06|annabel.dodson@gmail.com|(514)482-4299|Montreal|2021-05-16|Pfizer     |Yes        |

### Query 14

Query

```sql
SELECT firstName, lastName, dateOfBirth, email, telephone, city, Vaccination.date, Vaccination.name,  count(Person.passportNumOrSSN) AS 'Number of times infected'
FROM Person,
		(
			SELECT passportNumOrSSN as p, COUNT(DISTINCT Infection.variantTypeID) as c
			FROM Infection
			GROUP BY passportNumOrSSN
		) as CI, Vaccination
WHERE Person.passportNumOrSSN = CI.p
AND CI.c >= 2
AND Person.passportNumOrSSN = Vaccination.passportNumOrSSN;
```

**Results**

|firstName|lastName|dateOfBirth|email                   |telephone    |city    |date      |name       |Number of times infected|
| ---------------- | --------- | -------- | ----------- | ------------------------ | ------------- | -------- | ------------------------------------------ | ----------------------- |
|Annabel  |Dodson  | 1996-08-06|annabel.dodson@gmail.com|(514)482-4299|Montreal|2021-01-16|AstraZeneca|                       2|

### Query 15

#### Give a report of the inventory of vaccines in each province. The report should include for each province and for each type of vaccine, the total number of vaccines available in the province. The report should be displayed in ascending
order by province then by descending order of number of vaccines in the
inventory

```SQL
SELECT Province.name,VaccineStored.nameDrug,SUM(VaccineStored.count) AS total
FROM Province,HealthFacility,VaccineStored
WHERE Province.provinceID = HealthFacility.provinceID
AND HealthFacility.name = VaccineStored.nameHSO
AND HealthFacility.address = VaccineStored.address
group by Province.name, VaccineStored.nameDrug
order by Province.name asc, total desc;
```

**Results**

|name|nameDrug   |total|
| ---- | ---- | ---- |
|QC  |Pfizer     |19700|
|QC  |Ad5-nCoV   |  300|
|QC  |CIGB-66    |  300|
|QC  |KoviVac    |  150|
|QC  |AstraZeneca|  146|


### Query 16

#### Give a report of the population’s vaccination by province between January 1 st 2021 and July 22 nd 2021

```SQL
SELECT Province.name, Vaccination.name,
COUNT(DISTINCT(Vaccination.passportNumOrSSN)) 

FROM Vaccination, HealthFacility, Province

WHERE Vaccination.Hname = HealthFacility.name
AND Vaccination.address = HealthFacility.address
AND	HealthFacility.provinceID = Province.provinceID
AND date >= "2021-01-01" AND date <= "2021-07-22"

GROUP BY Province.name, Vaccination.name;
```

**Results**

|name|name       |vaccination|
| ---- | ---- | ---- |
|QC  |AstraZeneca|                                            3|
|QC  |KoviVac    |                                            2|
|QC  |Moderna    |                                            4|
|QC  |Pfizer     |                                            3|



### Query 17

#### Give a report by city in Québec the total number of vaccines received in each city between January 1 st 2021 and July 22 nd 2021

```SQL
SELECT hf.city, SUM(vs.count) AS 'Count Recived'
FROM HealthFacility hf, VaccineShipment vs , Province
WHERE hf.name = vs.nameHSO AND hf.address  = vs.address
AND hf.provinceID = Province.provinceID
AND Province.name = 'QC'
AND vs.date BETWEEN '2021-01-01' AND '2021-07-22'
GROUP BY hf.city;

```

**Results**

|city                   |Count Recived|
| ---- | ---- |
|LaSalle                |          100|
|Sainte-Anne-de-Bellevue|          100|
|Verdun                 |          100|
|Montreal               |          200|

### Query 18

Qeury

```sql
SELECT
    h.name,
    h.address,
    h.type,
    h.telephone,
    COUNT(DISTINCT j.EID) AS employeeCount,
    COALESCE(vs.totalShipments, 0) AS totalShipments,
    COALESCE(vs.totalDosesShipped, 0) AS totalDosesShipped,
    COALESCE(vtFrom.totalTransfersFrom, 0) AS totalTransfersFrom,
    COALESCE(vtFrom.totalDosesFrom, 0) AS totalDosesFrom,
    COALESCE(vtTo.totalTransfersTo, 0) AS totalTransfersTo,
    COALESCE(vtTo.totalDosesTo, 0) AS totalDosesTo,
    v.totalVaccinesByType,
    COALESCE(vac.totalPeopleVaccinated, 0) as totalPeopleVaccinated,
    COALESCE(vac.totalDosesGiven, 0) as totalDosesGiven
FROM
    HealthFacility h
        LEFT JOIN
    JobHistory j ON j.address = h.address
        AND j.name = h.name
        LEFT JOIN
    (SELECT
        nameHSO AS name,
            address,
            COUNT(DISTINCT nameHSO, address, nameDrug, date) AS totalShipments,
            SUM(COUNT) AS totalDosesShipped
    FROM
        VaccineShipment
    GROUP BY nameHSO , address) vs ON vs.name = h.name
        AND vs.address = h.address
        LEFT JOIN
    (SELECT
        nameHSOFrom,
            addressFrom,
            COUNT(DISTINCT nameHSOFrom, nameHSOTo, addressFrom, addressTo, nameDrug, date) AS totalTransfersFrom,
            SUM(count) AS totalDosesFrom
    FROM
        VaccineTransfer
    GROUP BY nameHSOFROM , addressFROM) vtFrom ON vtFrom.nameHSOFrom = h.name
        AND vtFrom.addressFrom = h.address
        LEFT JOIN
    (SELECT
        nameHSOTo,
            addressTo,
            COUNT(DISTINCT nameHSOFrom, nameHSOTo, addressFrom, addressTo, nameDrug, date) AS totalTransfersTo,
            SUM(COUNT) AS totalDosesTo
    FROM
        VaccineTransfer
    GROUP BY nameHSOTo , addressTo) vtTo ON vtTo.nameHSOTo = h.name
        AND vtTo.addressTo = h.address
        LEFT JOIN
    (SELECT
        nameHSO AS name,
            address,
            GROUP_CONCAT(nameDrug, ': ', count) totalVaccinesByType
    FROM
        VaccineStored
    GROUP BY nameHSO , address) v ON v.name = h.name
        AND v.address = h.address
	LEFT JOIN
    (SELECT
    Hname AS name,
    address,
    COUNT(DISTINCT passportNumOrSSN) AS totalPeopleVaccinated,
    COUNT(DISTINCT passportNumOrSSN, doseNumber) AS totalDosesGiven
FROM
    Vaccination
GROUP BY Hname , address) vac
ON vac.name = h.name
AND vac.address = h.address
WHERE
    h.city = 'Montreal'
        AND j.endDate IS NULL
GROUP BY h.name , h.address;
```

Results
| name | address | type | telephone | employeeCount | totalShipments | totalDosesShipped | totalTransfersFrom | totalDosesFrom | totalTransfersTo | totalDosesTo | totalVaccinesByType | totalPeopleVaccinated | totalDosesGiven |
| ------------------------------ | ---------------------------------------- | -------- | ------------- | ------------- | -------------- | ----------------- | ------------------ | -------------- | ---------------- | ------------ | -------------------------- | --------------------- | --------------- |
| H√¥pital Fleury | 2180, rue Fleury Est | HOSPITAL | (514)384-2000 | 1 | 0 | 0 | 0 | 0 | 0 | 0 | Pfizer: 2000 | 1 | 1 |
| H√¥pital Richardson | 5425, Avenue Bessborough | HOSPITAL | (514)484-7878 | 2 | 3 | 600 | 1 | 100 | 1 | 100 | Pfizer: 2000 | 2 | 2 |
| H√¥pital Rivi√®re-des-Prairies | 7070, boulevard Perras | HOSPITAL | (514)323-7260 | 1 | 1 | 100 | 0 | 0 | 1 | 100 | Pfizer: 2000 | 0 | 0 |
| Jewish General Hospital | 3755 Chemin de la C√¥te-Sainte-Catherine | HOSPITAL | www.gjw.com | 1 | 0 | 0 | 0 | 0 | 0 | 0 | Pfizer: 2000 | 3 | 3 |
| Olympic Stadium | 4545 Avenue Pierre-De Coubertin | SPECIAL | (514)252-4141 | 1 | 0 | 0 | 4 | 400 | 1 | 350 | Moderna: 1500,Pfizer: 2000 | 3 | 3 |

### Query 19

#### Give a list of all public health workers in a specific facility

```SQL
SELECT HealthFacility.name, Person.*, Employee.EID , PostalCode.postalCode
FROM HealthFacility,Employee,JobHistory,PostalCode, Person
WHERE
	Employee.SSN = Person.passportNumOrSSN
	AND Person.address = PostalCode.address
	AND Person.city= PostalCode.city
	AND Person.provinceID = PostalCode.provinceID
    AND HealthFacility.name = JobHistory.name
    AND HealthFacility.address = JobHistory.address
    AND JobHistory.EID = Employee.EID
  ORDER BY HealthFacility.name;
```

**Results (Employee at the CHUS)**

|name                        |passportNumOrSSN|medicaidNum|telephone    |firstName|lastName|address                     |city               |ageGroupID|provinceID|citizenship|email             |dateOfBirth|EID       |postalCode|startDate |endDate|
| ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
|CHUS                        |5594746088      |2967560 35 |(514)484-4049|Gary     |Smith   |3472 Av Westmore            |Montreal           |         4|         5|          1|garySmi@gmail.com | 1967-06-12|1988238722|H4V4Z6    |2019-01-01|       |


### Query 20

#### Give a list of all public health workers in Québec who never been vaccinated or who have been vaccinated only one dose for Covid-19

```SQL
SELECT e.EID, Person.firstName, Person.lastName, Person.dateOfBirth, Person.telephone, Person.city , Person.email, JobHistory.name
FROM Person, Province, Employee e,
 (
 	SELECT DISTINCT(EV.ssn) as ssn
	FROM (
		SELECT e.SSN as ssn, COUNT(e.SSN) as c
		FROM Employee e, Vaccination v
		WHERE e.SSN  = v.passportNumOrSSN
		GROUP BY(e.SSN)
		) AS EV
	WHERE EV.c > 1
 ) as FV, JobHistory
WHERE e.SSN NOT IN (FV.ssn)
AND e.EID = JobHistory.EID
AND Person.passportNumOrSSN= e.SSN
AND Province.name = 'QC'
AND Province.provinceID=Person.provinceID;
```

**Results**

|EID       |firstName|lastName|dateOfBirth|telephone    |city               |email             |name                        |
| ---- | ---- | ---- | ---- | ---- | ---- | ---- | ---- |
|4278243142|Wayne    |Johnson | 1984-07-16|(514)486-4899|Montreal           |wayJon@gmail.com  |Hôpital de Lasalle          |
|2589272564|Adam     |Smith   | 1995-08-12|(514)483-4346|Montreal           |adaSmi@gmail.com  |Hôpital Rivière-des-Prairies|
|9654156685|Ted      |Johnson | 1998-09-23|(514)485-1864|Westmount          |tedJohn@gmail.com |Hôpital Fleury              |
|2221453161|Sylvain  |Williams| 1978-11-14|(514)767-3102|Verdun             |sylWill@gmail.com |Hôpital de Verdun           |
|2314904771|Elizabeth|Jernigan| 1996-04-18|(418)640-9486|Quebec             |eliJer@gmail.com  |Olympic Stadium             |

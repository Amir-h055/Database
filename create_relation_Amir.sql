CREATE DATABASE PROJECT;
use PROJECT;

CREATE TABLE PROJECT.AgeGroup (
ageGroupID int,
  ageRange VARCHAR(20),
  PRIMARY KEY (ageGroupID)
);


CREATE TABLE PROJECT.Person (
  passportNumOrSSN VARCHAR(10),
  medicaidNum  VARCHAR(10),
  telephone VARCHAR(13),
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  ageGroupID int,
  province VARCHAR(3),
    ###
  citizenship BOOLEAN,
  email VARCHAR(255),
  dateOfBirth DATE,
  PRIMARY KEY(passportNumOrSSN),
    FOREIGN KEY (ageGroupID) REFERENCES AgeGroup(ageGroupID)

);

CREATE TABLE PROJECT.Infection (
  dateInfection DATE,
  passportNumOrSSN VARCHAR(10),
  type VARCHAR(100),
  PRIMARY KEY(passportNumOrSSN, dateInfection),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);



########################################################

CREATE TABLE PROJECT.VaccinationDrug (
  name VARCHAR(20),
  PRIMARY KEY (name)
);

CREATE TABLE PROJECT.HealthFacility (
  name VARCHAR(50),
  address VARCHAR(100),
  city VARCHAR(255),
  province VARCHAR(3),
  telephone VARCHAR(13),
  webAddress VARCHAR(100),
  type VARCHAR(8),
  PRIMARY KEY (name, address)
);



CREATE TABLE PROJECT.CurrentAgeGroup (
  ageGroupID int,
  province VARCHAR(3),
  PRIMARY KEY (province),
  FOREIGN KEY (ageGroupID) REFERENCES AgeGroup(ageGroupID)
);

CREATE TABLE PROJECT.DrugHistory (
  Dname VARCHAR(20),
  date DATE,
  ###chek in (Safe & Sus)
  status VARCHAR(100),
  PRIMARY KEY (Dname, date),
  FOREIGN KEY (Dname) REFERENCES VaccinationDrug(name)
);
####################################


CREATE TABLE PROJECT.Employee (
  EID VARCHAR(10),
  SSN VARCHAR(10),
  medicare VARCHAR(100),
  firstName VARCHAR(100),
  lastName VARCHAR(100), 
  dateOfBirth DATE,
  telephone VARCHAR(13),
  address VARCHAR(100), 
  city VARCHAR(100),
  province VARCHAR(3),
  citizenship BOOLEAN, 
  email VARCHAR(100),
  PRIMARY KEY (EID)
);


CREATE TABLE PROJECT.Vaccination (
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  date DATE,
  EID VARCHAR(10),
  name VARCHAR(50),
  Hname VARCHAR(50),
  address VARCHAR(100),
  PRIMARY KEY (passportNumOrSSN, doseNumber),
  FOREIGN KEY (name) REFERENCES VaccinationDrug(name),
  FOREIGN KEY (EID) REFERENCES Employee(EID),
  FOREIGN KEY (Hname,address) REFERENCES HealthFacility(name,address),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);
##########################################


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
  province VARCHAR(3),
  postalCode VARCHAR(6),
  PRIMARY KEY (address, city, province)
);
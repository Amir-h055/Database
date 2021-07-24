CREATE DATABASE WARMUP;

USE WARMUP;

CREATE TABLE WARMUP.Person (
  medicaidNum  VARCHAR(10),
  telephone VARCHAR(13),
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(3),
  postalCode VARCHAR(6),
  citizenship BOOLEAN,
  email VARCHAR(255),
  dateOfBirth DATE,
  PRIMARY KEY(medicaidNum)
);

CREATE TABLE WARMUP.Infection (
  dateInfection DATE,
  medicaidNum VARCHAR(10),
  PRIMARY KEY(dateInfection),
  FOREIGN KEY (medicaidNum) REFERENCES Person(medicaidNum)
);

CREATE TABLE WARMUP.AgeGroup (
  ageRange VARCHAR(20),
  isCurrent BOOLEAN,
  PRIMARY KEY (ageRange)
);

CREATE TABLE WARMUP.Vaccination (
  medicaidNumber VARCHAR(10),
  doseNumber INT,
  date DATE,
  PRIMARY KEY (doseNumber),
  FOREIGN KEY (medicaidNumber) REFERENCES Person(medicaidNum)
);

CREATE TABLE WARMUP.PersonAgeGroup (
  ageRange VARCHAR(20),
  medicaidNum VARCHAR(10),
  FOREIGN KEY (medicaidNum) REFERENCES Person(medicaidNum),
  FOREIGN KEY (ageRange) REFERENCES AgeGroup(ageRange)
);  

CREATE TABLE WARMUP.VaccinationDrug (
  name VARCHAR(100),
  status VARCHAR(50),
  dateLastStatus DATE,
  PRIMARY KEY (name)
);

CREATE TABLE WARMUP.HealthFacility (
  name VARCHAR(100),
  address VARCHAR(100),
  phoneNumber VARCHAR(13),
  webAddress VARCHAR(100),
  type VARCHAR(8),
  PRIMARY KEY (name, address)
);

CREATE TABLE WARMUP.VaccinationDoneWith (
  medicaidNum VARCHAR(10),
  doseNumber INT,
  name VARCHAR(100),
  FOREIGN KEY (medicaidNum) REFERENCES Person(medicaidNum),
  FOREIGN KEY (name) REFERENCES VaccinationDrug(name),
  FOREIGN KEY (doseNumber) REFERENCES Vaccination(doseNumber)
);

CREATE TABLE WARMUP.VaccinationDoneAt (
  medicaidNum VARCHAR(10),
  doseNumber INT,
  name VARCHAR(100),
  address VARCHAR(100),
  FOREIGN KEY (medicaidNum) REFERENCES Person(medicaidNum),
  FOREIGN KEY (doseNumber) REFERENCES Vaccination(doseNumber),
  FOREIGN KEY (name,address) REFERENCES HealthFacility(name,address)
);

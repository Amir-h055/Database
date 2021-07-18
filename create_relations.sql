CREATE TABLE Person (
  medicaidNum  VARCHAR(20),
  telephone VARCHAR(13),
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(3),
  postalCode VARCHAR(6),
  citizenship BOOLEAN,
  email VARCHAR(255),
  PRIMARY KEY(medicaidNum)
);

CREATE TABLE Infection (
  dateInfection DATE,
  medicaidNum VARCHAR(20),
  PRIMARY KEY(dateInfection, medicaidNum)
);

CREATE TABLE AgeGroup (
  ageRange VARCHAR(20),
  isCurrent BOOLEAN,
  PRIMARY KEY (ageRange)
);

CREATE TABLE PersonAgeGroup (
  ageRange VARCHAR(20),
  medicaidNum VARCHAR(20),
  PRIMARY KEY(ageRange, medicaidNum)
);  

CREATE TABLE VaccinationDrug (
  name VARCHAR(100),
  status VARCHAR(50),
  dateLastStatus DATE,
  PRIMARY KEY (name)
);

CREATE TABLE VaccinationDoneWith (
  medicaidNum VARCHAR(20),
  doseNumber INT,
  name VARCHAR(100),
  PRIMARY KEY (medicaidNum, doseNumber, name)
);

CREATE TABLE VaccinationDoneAt (
  medicaidNum VARCHAR(20),
  doseNumber INT,
  name VARCHAR(100),
  address VARCHAR(100),
  PRIMARY KEY(medicaidNum, doseNumber, name, address)
);

CREATE TABLE HealthFacility (
  name VARCHAR(100),
  address VARCHAR(100),
  phoneNumber VARCHAR(13),
  webAddress VARCHAR(100),
  type VARCHAR(8),
  PRIMARY KEY (name, address)
);

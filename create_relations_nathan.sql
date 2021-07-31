CREATE DATABASE PROJECT;

CREATE TABLE Person (
  passportNumOrSSN VARCHAR(10),
  medicaidNum  VARCHAR(10),
  telephone VARCHAR(13),
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(3),
  citizenship BOOLEAN,
  email VARCHAR(255),
  dateOfBirth DATE,
  PRIMARY KEY(passportNumOrSSN)
);

CREATE TABLE Infection (
  dateInfection DATE,
  passportNumOrSSN VARCHAR(10),
  type VARCHAR(100),
  PRIMARY KEY(passportNumOrSSN, dateInfection),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);

CREATE TABLE AgeGroup (
  ageRange VARCHAR(20),
  PRIMARY KEY (ageRange)
);

CREATE TABLE Vaccination (
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  date DATE,
  PRIMARY KEY (passportNumOrSSN, doseNumber),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN)
);

CREATE TABLE PersonAgeGroup (
  ageRange VARCHAR(20),
  passportNumOrSSN VARCHAR(10),
  PRIMARY KEY (ageRange, passportNumOrSSN),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN),
  FOREIGN KEY (ageRange) REFERENCES AgeGroup(ageRange)
);  

CREATE TABLE VaccinationDrug (
  name VARCHAR(100),
  PRIMARY KEY (name)
);

CREATE TABLE HealthFacility (
  name VARCHAR(100),
  address VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(3),
  phoneNumber VARCHAR(13),
  webAddress VARCHAR(100),
  telephone VARCHAR(13),
  type VARCHAR(8),
  PRIMARY KEY (name, address)
);

CREATE TABLE VaccinationDoneWith (
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  name VARCHAR(100),
  PRIMARY KEY (passportNumOrSSN, doseNumber, name),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN),
  FOREIGN KEY (name) REFERENCES VaccinationDrug(name),
  FOREIGN KEY (doseNumber) REFERENCES Vaccination(doseNumber)
);

CREATE TABLE VaccinationDoneAt (
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  name VARCHAR(100),
  address VARCHAR(100),
  PRIMARY KEY (passportNumOrSSN, doseNumber, name, address),
  FOREIGN KEY (passportNumOrSSN) REFERENCES Person(passportNumOrSSN),
  FOREIGN KEY (doseNumber) REFERENCES Vaccination(doseNumber),
  FOREIGN KEY (name,address) REFERENCES HealthFacility(name,address)
);

CREATE TABLE CurrentAgeGroup {
  ageRange VARCHAR(20),
  province VARCHAR(3),
  PRIMARY KEY (ageRange),
  FOREIGN KEY (ageRange) REFERENCES AgeGroup(ageRange)
}

CREATE TABLE DrugHistory {
  name VARCHAR(100),
  date DATE,
  status VARCHAR(100),
  PRIMARY KEY (name, date),
  FOREIGN KEY (name) REFERENCES VaccinationDrug(name)
}

CREATE TABLE VaccinationDoneBy {
  passportNumOrSSN VARCHAR(10),
  doseNumber INT,
  EID VARCHAR(10),
  PRIMARY KEY (passportNumOrSSN, doseNumber),
  FOREIGN KEY (passportNumOrSSN) Person(passportNumOrSSN),
  FOREIGN KEY (doseNumber) Vaccination(doseNumber),
  FOREIGN KEY (EID) Employee(EID)
}

CREATE TABLE Employee {
  EID VARCHAR(10),
  SSN VARCHAR(10),
  firstName VARCHAR(100),
  lastName VARCHAR(100), 
  medicare VARCHAR(100),
  dateOfBirth DATE,
  telephone VARCHAR(13),
  address VARCHAR(100), 
  city VARCHAR(100),
  province VARCHAR(3),
  citizenship BOOLEAN, 
  email VARCHAR(100),
  PRIMARY KEY (EID)
}

CREATE TABLE Manager {
  EID VARCHAR(10),
  PRIMARY KEY (EID),
  FOREIGN KEY (EID) Employee(EID)
}

CREATE TABLE Manages {
  EID VARCHAR(10),
  name VARCHAR(100),
  address VARCHAR(100),
  PRIMARY KEY (EID),
  FOREIGN KEY (EID) REFERENCES Manager(EID),
  FOREIGN KEY (name, address) REFERENCES HealthFacility(name, address)
}

CREATE TABLE JobHistory {
  EID VARCHAR(10), 
  name VARCHAR(100),
  address VARCHAR(100), 
  startDate DATE,
  endDate DATE,
  PRIMARY KEY (EID, name, address, startDate),
  FOREIGN KEY (EID) REFERENCES Employee(EID),
  FOREIGN KEY (name, address) REFERENCES HealthFacility(name, address)
}

CREATE TABLE VaccineStored {
  nameHSO VARCHAR(100), 
  address VARCHAR(100), 
  nameDrug VARCHAR(100), 
  count INT,
  PRIMARY KEY (nameHSO, address, nameDrug),
  FOREIGN KEY (nameHSO, address) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES Vaccination(name)
}

CREATE TABLE VaccineShipment {
  nameHSO VARCHAR(100), 
  address VARCHAR(100), 
  nameDrug VARCHAR(100),
  date DATE,
  count INT,
  PRIMARY KEY (nameHSO, address, nameDrug, date),
  FOREIGN KEY (nameHSO, address) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES Vaccination(name)
}

CREATE TABLE VaccineTransfer {
  nameHSOFrom VARCHAR(100), 
  nameHSOTo VARCHAR(100), 
  addressFrom VARCHAR(100), 
  addressTo VARCHAR(100), 
  nameDrug VARCHAR(100),
  date DATE,
  count INT,
  PRIMARY KEY (nameHSOFrom,nameHSOTo, addressFrom, addressTo, nameDrug, date),
  FOREIGN KEY (nameHSOFrom, addressFrom) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameHSOTo, addressTo) REFERENCES HealthFacility(name, address),
  FOREIGN KEY (nameDrug) REFERENCES Vaccination(name)
}

CREATE TABLE PostalCode {
  address VARCHAR(100), 
  city VARCHAR(100),
  province VARCHAR(3),
  postalCode VARCHAR(6),
  PRIMARY KEY (address, city, province)
}

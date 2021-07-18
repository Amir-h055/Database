CREATE TABLE Person(
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

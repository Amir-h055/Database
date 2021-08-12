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

#### Delete a Person

```SQL
DELETE FROM Person WHERE passportNumOrSSN = "x";
DELETE FROM Infection WHERE passportNumOrSSN = "x";
-- No need to delete any postal code
```

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

#### Display a person

```sql
SELECT Person.*, PostalCode.postalCode
FROM Person, PostalCode
WHERE Person.passportNumOrSSN = "x" AND Person.address = PostalCode.address AND
    Person.city = PostalCode.city AND Person.province = PostalCode.province;
```

### Query 2

##### Create a Public Health Worker

```sql
INSERT INTO Employee VALUES ("2314904771","4030141599"); ##########  SSN should exist in Person

-- Check if the postal code tuple exist with
SELECT * FROM PostalCode WHERE address = "x" AND city = "y" AND province = "z" AND postalCode = "a";

-- If the query does no return anything, then insert the postal code
INSERT INTO PostalCode VALUES (address, city, province, postalCode);
```

##### Delete a Public Health Worker

```sql
DELETE FROM Employee WHERE EID = '5418600012';
-- No need to delete any postal code
```

##### Edit a Public Health Worker

```sql
UPDATE Employee ######################
SET email = "newemail@email.com", citizenship = FALSE
WHERE EID = "2314904771";

-- To edit a postalCode, if there is a change in address
UPDATE PostalCode SET column_name = value WHERE address = "x" AND city = "y" AND province = "z";
```

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

#### Delete a Health Facility

```SQL
DELETE FROM HealthFacility
WHERE name ='Hname' AND address ='HAddress';
-- No need to delete any postal code
```

#### Edit a Health Facility

```SQL
UPDATE HealthFacility
SET telephone = '123456789'
WHERE name ='Hname' AND address ='HAddress';

-- To edit a postalCode, if there is a change in address
UPDATE PostalCode SET column_name = value WHERE address = "x" AND city = "y" AND province = "z";
```

#### Display a Health Facility

```sql
SELECT *, PostalCode.postalCode
FROM HealthFacility as HF, PostalCode as PC
WHERE HF.name = 'Hname' AND HF = 'HAddress' AND HF.address = PC.address AND HF.city = PC.city AND HF.province = PC.province; ;
```

### Query 4

#### Create a Vaccination Type

```SQl
INSERT INTO VaccinationDrug VALUES ('VACCINE');
```

#### Delete a Vaccination Type

```SQL
DELETE FROM VaccinationDrug
WHERE name = 'VACCINE';
```

#### Edit a Vaccination Type

```SQL
UPDATE VaccinationDrug
SET name = 'EDITVACCINE'
WHERE name = 'VACCINE';
```

#### Display a Vaccination Type

```SQl
SELECT * FROM VaccinationDrug
WHERE name = 'name';
```

### Query 5

#### Create a variant type

```sql
INSERT INTO VariantType VALUES (id, "name");
```

#### Delete a variant type

```sql
DELETE FROM VariantType WHERE variantTypeID = x;
```

#### Edit a variant type

```sql
UPDATE VariantType
SET column_name = value
WHERE variantTypeID = x;
```

#### Display a variant type

```sql
SELECT *
FROM VariantType
WHERE variantTypeID = x;
```

### Query 6

##### Create a Group Age

```sql
INSERT AgeGroup VALUES (2, "70-79");
```

##### Delete a Group Age

```sql
DELETE FROM AgeGroup WHERE ageGroupID = 2;
```

**Note:** This query may result in an MySQL error because relations Person and ProvinceCurrentAgeGroup have a foreign key that references AgeGroup.

##### Edit a Group Age

```sql
UPDATE AgeGroup
SET ageRange = "80-90"
WHERE ageGroupID = "1";
```

##### Display a Group Age

Query

```sql
SELECT * FROM AgeGroup WHERE ageGroupID = "1";
```

Results
| ageGroupID | ageRange |
| ---------- | -------- |
| 2 | 70-79 |

### Query 7

#### Add a province

```SQL
INSERT INTO Province VALUES(id, "name", ageGroupID);
```

#### Delete a province

```SQL
DELETE FROM Province WHERE provinceID = id;
```

#### Edit a province

```SQL
UPDATE Province
SET attribute = value
WHERE provinceID = id;
```

### Query 8

#### Set a new Group Age for a Province

```SQL
UPDATE Province
SET currentAgeGroupID = ageID
WHERE provinceID = id;
```

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

### Query 14

Query

```sql
SELECT firstName, lastName, dateOfBirth, email, telephone, city, Vaccination.date, vaccination.name,  count(Person.passportNumOrSSN) AS 'Number of times infected'
FROM Person,
		(
			SELECT passportNumOrSSN as p, COUNT(DISTINCT infection.variantTypeID) as c
			FROM Infection
			GROUP BY passportNumOrSSN
		) as CI, Vaccination
WHERE Person.passportNumOrSSN = CI.p
AND CI.c >= 2
AND Person.passportNumOrSSN = Vaccination.passportNumOrSSN;
```

Results
| passportNumOrSSN | firstName | lastName | dateOfBirth | email | telephone | city | vaccinations | numberVariantInfections | variants |
| ---------------- | --------- | -------- | ----------- | ------------------------ | ------------- | -------- | ------------------------------------------ | ----------------------- | ------------ |
| 5418600012 | Annabel | Dodson | 1996-08-06 | annabel.dodson@gmail.com | (514)482-4299 | Montreal | 2021-01-16: AstraZeneca,2021-05-16: Pfizer | 2 | ALPHA,LAMBDA |

### Query 15

#### Give a report of the inventory of vaccines in each province. The report should include for each province and for each type of vaccine, the total number of

vaccines available in the province. The report should be displayed in ascending
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

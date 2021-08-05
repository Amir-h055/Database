## Query 2

##### Create a Public Health Worker

```sql
INSERT Employee VALUES ("2314904771","4030141599", "6202715 46", "Elizabeth",
  "Jernigan", "H2P 1Z7", "1996-04-18", "(418)640-9486", "4884 Boulevard Cremazie",
  "Quebec", "QC", TRUE, "eliJer@gmail.com");
```

##### Delete a Public Health Worker

```sql
DELETE FROM Employee WHERE EID = '5418600012';
```

##### Edit a Public Health Worker

```sql
UPDATE Employee
SET email = "newemail@email.com", citizenship = FALSE
WHERE EID = "2314904771";
```

##### Display a Public Health Worker

Query

```sql
SELECT * FROM Employee WHERE EID = "0426670356";
```

Results
|EID |SSN |medicare |firstName|lastName|postalCode|dateOfBirth|telephone |address |city |provinceID|citizenship|email |
|---------|----------|----------|---------|--------|----------|-----------|-------------|----------------|-------------------|----------|-----------|----------------|
|426670356|6901680262|1457287 34|Ronald |Smith |H1A 1Z1 |1995-06-14 |(514)642-6526|16226 Rue Bureau|Pointe-Aux-Trembles|QC |1 |ronSmi@gmail.com|

## Query 6

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
|ageGroupID|ageRange |
|----------|----------|
|2 |70-79 |

## Query 10

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

## Query 14

Query

```sql
SELECT
    p.passportNumOrSSN,
    p.firstName,
    p.lastName,
    p.dateOfBirth,
    p.email,
    p.telephone,
    p.city,
    GROUP_CONCAT(DISTINCT v.date, ': ', v.name) AS vaccinations,
    COUNT(DISTINCT (i.type)) AS numberVariantInfections,
    GROUP_CONCAT(DISTINCT i.type) AS variants
FROM
    Person p
        LEFT JOIN
    Vaccination v ON v.passportNumOrSSN = p.passportNumOrSSN
        LEFT JOIN
    Infection i ON i.passportNumOrSSN = p.passportNumOrSSN
WHERE
    p.passportNumOrSSN IN (SELECT
            passportNumOrSSN
        FROM
            Vaccination)
        AND p.passportNumOrSSN IN (SELECT
            passportNumOrSSN
        FROM
            Infection
        GROUP BY passportNumOrSSN
        HAVING COUNT(DISTINCT (type)) >= 2);
```

Results
|passportNumOrSSN|firstName |lastName|dateOfBirth|email |telephone |city |vaccinations |numberVariantInfections|variants |
|----------------|----------|--------|-----------|------------------------|-------------|--------|------------------------------------------|-----------------------|------------|
|5418600012 |Annabel |Dodson |1996-08-06 |annabel.dodson@gmail.com|(514)482-4299|Montreal|2021-01-16: AstraZeneca,2021-05-16: Pfizer|2 |ALPHA,LAMBDA|

## Query 18

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
|name |address |type |telephone |employeeCount|totalShipments|totalDosesShipped|totalTransfersFrom|totalDosesFrom|totalTransfersTo|totalDosesTo|totalVaccinesByType |totalPeopleVaccinated|totalDosesGiven|
|------------------------------|----------------------------------------|--------|-------------|-------------|--------------|-----------------|------------------|--------------|----------------|------------|--------------------------|---------------------|---------------|
|H√¥pital Fleury |2180, rue Fleury Est |HOSPITAL|(514)384-2000|1 |0 |0 |0 |0 |0 |0 |Pfizer: 2000 |1 |1 |
|H√¥pital Richardson |5425, Avenue Bessborough |HOSPITAL|(514)484-7878|2 |3 |600 |1 |100 |1 |100 |Pfizer: 2000 |2 |2 |
|H√¥pital Rivi√®re-des-Prairies|7070, boulevard Perras |HOSPITAL|(514)323-7260|1 |1 |100 |0 |0 |1 |100 |Pfizer: 2000 |0 |0 |
|Jewish General Hospital |3755 Chemin de la C√¥te-Sainte-Catherine|HOSPITAL|www.gjw.com |1 |0 |0 |0 |0 |0 |0 |Pfizer: 2000 |3 |3 |
|Olympic Stadium |4545 Avenue Pierre-De Coubertin |SPECIAL |(514)252-4141|1 |0 |0 |4 |400 |1 |350 |Moderna: 1500,Pfizer: 2000|3 |3 |

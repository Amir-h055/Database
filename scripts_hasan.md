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

## Query 1

##### Create a Person

```sql
-- Insert the person
INSERT INTO Person VALUES (passportNumOrSSN, medicaidNum, telephone, firstName, lastName, address, city, province, citizenship, email, dateOfBirth);

-- Check if the postal code tuple exist with
SELECT * FROM PostalCode WHERE address = "x" AND city = "y" AND province = "z" AND postalCode = "a";

-- If the query does no return anything, then insert the postal code
INSERT INTO PostalCode VALUES (address, city, province, postalCode);
  
-- Also add the various infections  
INSERT INTO Infection VALUES (dateInfection, passportNumOrSSN, type);
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


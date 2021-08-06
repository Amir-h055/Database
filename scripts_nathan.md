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

## Query 5

#### Create a variant type

```sql
INSERT INTO VariantType VALUES (id, "name");
```

#### Delete a variant type

```sql
DELETE FROM VarianType WHERE variantTypeID = x;
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

## Query 9

#### Receive a shipment of vaccines and add it to the inventory in a specific location
## Query 13

#### Get details of all the people who live in the city of Montréal and who got vaccinated at least two doses of different types of vaccines.
## Query 17

#### Give a report by city in Québec the total number of vaccines received in each city between January 1 st 2021 and July 22nd 2021
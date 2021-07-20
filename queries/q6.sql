SELECT city, COUNT(medicaidNum)
FROM Person, Vaccination
WHERE province = "QC" AND
      Person.medicaidNum = Vaccination.medicaidNumber
GROUP BY city;

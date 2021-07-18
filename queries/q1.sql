SELECT Person.firstName, Person.lastName, Person.dateOfBirth, Person.email,
  Person.telephone, Person.city, Vaccination.date, VaccinationDoneWith.name,
  CASE 
    WHEN InfectionCount.cnt > 0 THEN 'True'
    ELSE 'False' 
  END AS wasInfected
FROM Person,PersonAgeGroup, Vaccination, VaccinationDoneWith, 
     (SELECT medicaidNum, COUNT(medicaidNum) AS cnt
      FROM Infection GROUP BY medicaidNum) AS InfectionCount
WHERE Person.medicaidNum = Vaccination.medicaidNumber AND
      Person.medicaidNum = PersonAgeGroup.medicaidNum AND
      Person.medicaidNum = VaccinationDoneWith.medicaidNum AND
      Person.medicaidNum = InfectionCount.medicaidNum AND
      VaccinationDoneWith.doseNumber = 1 AND
      Vaccination.doseNumber = 1 AND
      (ageRange = "80+" OR ageRange = "70-79" OR ageRange = "60-69" OR
       ageRange = "50-59" OR ageRange = "40-49" OR ageRange = "30-39" OR
       ageRange = "18-29");

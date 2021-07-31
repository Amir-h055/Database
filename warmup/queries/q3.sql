SELECT firstName, lastName, dateOfBirth, email, telephone, city, date,
      VaccinationDoneWith.name, ageRange
FROM Person, Vaccination, VaccinationDoneAt, VaccinationDoneWith, PersonAgeGroup
WHERE Person.medicaidNum = Vaccination.medicaidNumber AND
      Person.medicaidNum = VaccinationDoneAt.medicaidNum AND
      Person.medicaidNum = VaccinationDoneWith.medicaidNum AND
      Person.medicaidNum = PersonAgeGroup.medicaidNum AND
      Vaccination.doseNumber = VaccinationDoneWith.doseNumber AND
      Vaccination.doseNumber = VaccinationDoneAt.doseNumber AND
      VaccinationDoneAt.doseNumber = VaccinationDoneWith.doseNumber AND
      Vaccination.date >= "2021-01-01" AND
      Vaccination.date <= "2021-01-31" AND
      VaccinationDoneAt.name = "Olympic Stadium";

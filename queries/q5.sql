SELECT firstName, lastName, dateOfBirth, email, telephone, city, Vaccination.date,
       VaccinationDoneWith.name, VaccinationDrug.dateLastStatus
FROM Person, Vaccination, VaccinationDoneWith, VaccinationDrug
WHERE VaccinationDoneWith.name = VaccinationDrug.name AND
      Person.medicaidNum = VaccinationDoneWith.medicaidNum AND
      Person.medicaidNum = Vaccination.medicaidNumber AND
      Vaccination.medicaidNumber = VaccinationDoneWith.medicaidNum AND
      Vaccination.doseNumber = VaccinationDoneWith.doseNumber AND
      VaccinationDrug.status = "SUSPENDED";

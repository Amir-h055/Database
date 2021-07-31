SELECT VaccinationDoneWith.name, dateLastStatus, status,
       COUNT(VaccinationDoneWith.name) as countVaccinated
FROM Vaccination, VaccinationDoneWith, VaccinationDrug
WHERE Vaccination.medicaidNumber = VaccinationDoneWith.medicaidNum AND
      VaccinationDoneWith.name = VaccinationDrug.name
GROUP BY VaccinationDoneWith.name;

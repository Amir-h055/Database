INSERT Person VALUES ("5418600 12", "(514)482-4299", "Annabel", "Dodson",
  "6860 Fielding", "Montreal", "QC", "H4V1P2", TRUE,
  "annabel.dodson@gmail.com", "1996-08-06");

INSERT Person VALUES ("7198638 80", "(514)366-4286", "Zachary", "Rutledge",
  " 902 Tittley", "Montreal", "QC", "H8R3X3", TRUE,
  "Zachary.Rutledge@gmail.com", "1986-08-12");

INSERT Person VALUES ("5867167 04", "(514)767-5030", "Alister", "Wiggins",
  "6818 Lamont", "Montreal", "QC", "H4E2T9", TRUE, "Alister.Wiggins@gmail.com",
  "1987-08-27"); 

INSERT Person VALUES ("9415548 75", "(514)525-4731", "Osman", "Vaughn", 
  " 1720 Bourbonniere", "Montreal", "QC", "H1W3N4", TRUE,
  "Osman.Vaughn@gmail.com", "2007-09-08"); 

INSERT Person VALUES ("9052864 70", "(514)768-9102", "Bear", "Melton",
  "5962 Jogues", "Montreal", "QC", "H4E2W3", TRUE, "Bear.Melton@gmail.com",
  "1976-09-13"); 

INSERT Person VALUES ("9826293 18", "(613)733-8502", "Lulu", "Fisher",
  "927 Rand", "Gatineau", "QC", "J9J1C8", TRUE, "Lulu.Fisher@gmail.com",
  "1976-09-27"); 

INSERT Person VALUES ("2055054 40", "(819)503-3196", "Collette", "Zavala",
  "60 Du Blizzard", "Gatineau", "QC", "J9A0C8", TRUE,
  "Collette.Zavala@gmail.com", "1956-09-29"); 

INSERT Person VALUES ("7247613 20", "(819)408-0531", "Angela", "Dodson",
  "1175 De L'Esplanade", "Sherbrooke", "QC", "J1H1S9", TRUE,
  "Angela.Dodson@gmail.com", "1956-10-15"); 

INSERT Person VALUES ("7976980 46", "(819)566-0668", "Annabel", "Crouch",
  "1812 Dunant", "Sherbrooke", "QC", "J1H6L4", TRUE,
  "Annabel.Crouch@gmail.com", "1936-10-18"); 

INSERT Person VALUES ("6623218 89", "(418)547-8256", "Nyle", "Sparrow",
  "3937 Soucy", "Jonquière", "QC", "G7X8T1", TRUE, "Nyle.Sparrow@gmail.com",
  "1936-12-08"); 
  

INSERT Infection VALUES ("2021-03-16","5418600 12"); 
INSERT Infection VALUES ("2021-03-25","7198638 80"); 
INSERT Infection VALUES ("2021-04-02","5867167 04"); 
INSERT Infection VALUES ("2021-04-07","9415548 75"); 
INSERT Infection VALUES ("2021-04-30","9052864 70"); 
INSERT Infection VALUES ("2021-05-05","9826293 18"); 
INSERT Infection VALUES ("2021-05-20","2055054 40"); 
INSERT Infection VALUES ("2021-05-21","7247613 20"); 
INSERT Infection VALUES ("2021-06-18","7976980 46"); 
INSERT Infection VALUES ("2021-07-22","6623218 89"); 


INSERT AgeGroup VALUES ("80+", TRUE);
INSERT AgeGroup VALUES ("70-79", TRUE);
INSERT AgeGroup VALUES ("60-69", TRUE);
INSERT AgeGroup VALUES ("50-59", TRUE);
INSERT AgeGroup VALUES ("40-49", TRUE);
INSERT AgeGroup VALUES ("30-39", TRUE);
INSERT AgeGroup VALUES ("18-29", TRUE);
INSERT AgeGroup VALUES ("12-17", TRUE);
INSERT AgeGroup VALUES ("5-11", TRUE);
INSERT AgeGroup VALUES ("0-4", TRUE);

INSERT Vaccination VALUES ("5418600 12", 1, "2021-04-16"); 
INSERT Vaccination VALUES ("5418600 12", 2, "2021-05-16"); 
INSERT Vaccination VALUES ("7198638 80", 1, "2021-04-25"); 
INSERT Vaccination VALUES ("5867167 04", 1, "2021-05-02"); 
INSERT Vaccination VALUES ("9415548 75", 1, "2021-05-07"); 
INSERT Vaccination VALUES ("9052864 70", 1, "2021-05-30"); 
INSERT Vaccination VALUES ("9826293 18", 1, "2021-06-05"); 
INSERT Vaccination VALUES ("2055054 40", 1, "2021-06-20"); 
INSERT Vaccination VALUES ("7247613 20", 1, "2021-06-21"); 
INSERT Vaccination VALUES ("7976980 46", 1, "2021-07-18"); 

INSERT PersonAgeGroup VALUES ("18-29","5418600 12"); 
INSERT PersonAgeGroup VALUES ("30-39","7198638 80"); 
INSERT PersonAgeGroup VALUES ("30-39","5867167 04"); 
INSERT PersonAgeGroup VALUES ("12-17","9415548 75"); 
INSERT PersonAgeGroup VALUES ("40-49","905286 470"); 
INSERT PersonAgeGroup VALUES ("40-49","9826293 18"); 
INSERT PersonAgeGroup VALUES ("60-69","2055054 40"); 
INSERT PersonAgeGroup VALUES ("60-69","7247613 20"); 
INSERT PersonAgeGroup VALUES ("80+","7976980 46"); 
INSERT PersonAgeGroup VALUES ("80+","6623218 89");

INSERT VaccinationDrug VALUES ("Pfizer", "SAFE", "2020-06-21");
INSERT VaccinationDrug VALUES ("Moderna", "SAFE", "2020-06-21");
INSERT VaccinationDrug VALUES ("AstraZeneca", "SAFE", "2020-06-21");
INSERT VaccinationDrug VALUES ("Johnson & Johnson", "SAFE", "2020-06-21");

INSERT VaccinationDoneWith VALUES ("5418600 12", 1, "Pfizer"); 
INSERT VaccinationDoneWith VALUES ("5418600 12", 2, "Moderna"); 
INSERT VaccinationDoneWith VALUES ("7198638 80", 1, "Pfizer"); 
INSERT VaccinationDoneWith VALUES ("5867167 04", 1, "Moderna"); 
INSERT VaccinationDoneWith VALUES ("9415548 75", 1, "Pfizer"); 
INSERT VaccinationDoneWith VALUES ("9052864 70", 1, "Pfizer"); 
INSERT VaccinationDoneWith VALUES ("9826293 18", 1, "AstraZeneca"); 
INSERT VaccinationDoneWith VALUES ("2055054 40", 1, "AstraZeneca"); 
INSERT VaccinationDoneWith VALUES ("7247613 20", 1, "Johnson & Johnson"); 
INSERT VaccinationDoneWith VALUES ("7976980 46", 1, "Johnson & Johnson"); 

INSERT VaccinationDoneAt VALUES ("5418600 12", 1, "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin, Montréal, QC H1V 0B2"); 

INSERT VaccinationDoneAt VALUES ("5418600 12", 2, "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin, Montréal, QC H1V 0B2"); 

INSERT VaccinationDoneAt VALUES ("7198638 80", 1, "Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine, Montréal, QC H3T 1E2"); 

INSERT VaccinationDoneAt VALUES ("5867167 04", 1, "Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine, Montréal, QC H3T 1E2"); 

INSERT VaccinationDoneAt VALUES ("9415548 75", 1, "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin, Montréal, QC H1V 0B2"); 

INSERT VaccinationDoneAt VALUES ("9052864 70", 1, "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin, Montréal, QC H1V 0B2"); 

INSERT VaccinationDoneAt VALUES ("9826293 18", 1, "Hopital de Gatineau",
  "909 Boulevard la Vérendrye O, Gatineau, QC J8P 7H2"); 

INSERT VaccinationDoneAt VALUES ("2055054 40", 1, "Hopital de Gatineau",
  "909 Boulevard la Vérendrye O, Gatineau, QC J8P 7H2"); 

INSERT VaccinationDoneAt VALUES ("7247613 20", 1, "CHUS",
  "300 Rue King E, Sherbrooke, QC J1G 1B1"); 

INSERT VaccinationDoneAt VALUES ("7976980 46", 1, "CHUS",
  "300 Rue King E, Sherbrooke, QC J1G 1B1"); 

INSERT HealthFacility VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin, Montréal, QC H1V 0B2", "(514)252-4141",
  "www.so.com", "SPECIAL"); 

INSERT HealthFacility VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine, Montréal, QC H3T 1E2",
  "(514)340-8222", "www.gjw.com", "HOSPITAL"); 

INSERT HealthFacility VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O, Gatineau, QC J8P 7H2", "(819)966-6100",
  "www.hg.com", "HOSPITAL"); 

INSERT HealthFacility VALUES ("CHUS",
  "300 Rue King E, Sherbrooke, QC J1G 1B1", "(819)346-1110", "www.chus.com",
  "HOSPITAL");

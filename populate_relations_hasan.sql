-- This file will populate the MySQL database created with the relations defined in file create_relation_Amir.sql
use PROJECT;

INSERT AgeGroup VALUES (1, "80+");
INSERT AgeGroup VALUES (2, "70-79");
INSERT AgeGroup VALUES (3, "60-69");
INSERT AgeGroup VALUES (4, "50-59");
INSERT AgeGroup VALUES (5, "40-49");
INSERT AgeGroup VALUES (6, "30-39");
INSERT AgeGroup VALUES (7, "18-29");
INSERT AgeGroup VALUES (8, "12-17");
INSERT AgeGroup VALUES (9, "5-11");
INSERT AgeGroup VALUES (10, "0-4");

INSERT ProvinceCurrentAgeGroup VALUES ("NL", 4);
INSERT ProvinceCurrentAgeGroup VALUES ("PE", 5);
INSERT ProvinceCurrentAgeGroup VALUES ("NS", 6);
INSERT ProvinceCurrentAgeGroup VALUES ("NB", 3);
INSERT ProvinceCurrentAgeGroup VALUES ("QC", 8);
INSERT ProvinceCurrentAgeGroup VALUES ("ON", 1);
INSERT ProvinceCurrentAgeGroup VALUES ("MB", 2);
INSERT ProvinceCurrentAgeGroup VALUES ("SK", 9);
INSERT ProvinceCurrentAgeGroup VALUES ("AB", 4);
INSERT ProvinceCurrentAgeGroup VALUES ("BC", 6);
INSERT ProvinceCurrentAgeGroup VALUES ("YT", 7);
INSERT ProvinceCurrentAgeGroup VALUES ("NT", 8);
INSERT ProvinceCurrentAgeGroup VALUES ("NU", 4);

INSERT Person VALUES ("5418600012", "1936638 14", "(514)482-4299", "Annabel", "Dodson",
  "6860 Fielding", "Montreal", 7, "QC", TRUE,
  "annabel.dodson@gmail.com", "1996-08-06");
INSERT Person VALUES ("7198638080", "1362899 55","(514)366-4286", "Zachary", "Rutledge",
  "902 Tittley", "Montreal", 6, "QC", TRUE,
  "Zachary.Rutledge@gmail.com", "1986-08-12");
INSERT Person VALUES ("5867167004", "0243401 87", "(514)767-5030", "Alister", "Wiggins",
  "6818 Lamont", "Montreal", 6, "QC", TRUE, "Alister.Wiggins@gmail.com",
  "1987-08-27"); 
INSERT Person VALUES ("9415548075", "2054252 15", "(514)525-4731", "Osman", "Vaughn", 
  "1720 Bourbonniere", "Montreal", 8, "QC", TRUE,
  "Osman.Vaughn@gmail.com", "2007-09-08"); 
INSERT Person VALUES ("9052864070", "1643994 57", "(514)768-9102", "Bear", "Melton",
  "5962 Jogues", "Montreal", 5, "QC", TRUE, "Bear.Melton@gmail.com",
  "1976-09-13"); 
INSERT Person VALUES ("9826293018", "4105748 51", "(613)733-8502", "Lulu", "Fisher",
  "927 Rand", "Gatineau", 5, "QC", TRUE, "Lulu.Fisher@gmail.com",
  "1976-09-27"); 
INSERT Person VALUES ("2055054040", "4990628 77", "(819)503-3196", "Collette", "Zavala",
  "60 Du Blizzard", "Gatineau", 3, "QC", TRUE,
  "Collette.Zavala@gmail.com", "1956-09-29"); 
INSERT Person VALUES ("7247613020", "3234394 08", "(819)408-0531", "Angela", "Dodson",
  "1175 De L'Esplanade", "Sherbrooke", 3, "QC", TRUE,
  "Angela.Dodson@gmail.com", "1956-10-15"); 
INSERT Person VALUES ("7976980046", "9109123 89", "(819)566-0668", "Annabel", "Crouch",
  "1812 Dunant", "Sherbrooke", 1, "QC", TRUE,
  "Annabel.Crouch@gmail.com", "1936-10-18"); 
INSERT Person VALUES ("6623218089", "0451174 26", "(418)547-8256", "Nyle", "Sparrow",
  "3937 Soucy", "Jonquière", 1, "QC", TRUE, "Nyle.Sparrow@gmail.com",
  "1936-12-08"); 

INSERT Infection VALUES ("2021-03-16","5418600012", "ALPHA"); 
INSERT Infection VALUES ("2021-03-25","7198638080", "DELTA"); 
INSERT Infection VALUES ("2021-04-02","5867167004", "ALPHA"); 
INSERT Infection VALUES ("2021-04-07","9415548075", "DELTA"); 
INSERT Infection VALUES ("2021-04-30","9052864070", "ALPHA"); 
INSERT Infection VALUES ("2021-05-05","9826293018", "ALPHA"); 
INSERT Infection VALUES ("2021-05-20","2055054040", "DELTA"); 
INSERT Infection VALUES ("2021-05-21","7247613020", "DELTA"); 
INSERT Infection VALUES ("2021-06-18","7976980046", "ALPHA"); 
INSERT Infection VALUES ("2021-07-22","6623218089", "UNKNOWN"); 

INSERT VaccinationDrug VALUES ("Pfizer");
INSERT VaccinationDrug VALUES ("Moderna");
INSERT VaccinationDrug VALUES ("AstraZeneca");
INSERT VaccinationDrug VALUES ("Johnson & Johnson");
INSERT VaccinationDrug VALUES ("RBD-Dimer");
INSERT VaccinationDrug VALUES ("Covaxin");
INSERT VaccinationDrug VALUES ("Ad5-nCoV");
INSERT VaccinationDrug VALUES ("CIGB-66");
INSERT VaccinationDrug VALUES ("KoviVac");
INSERT VaccinationDrug VALUES ("EpiVacCorona");

INSERT HealthFacility VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Montreal", "QC", "(514)252-4141",
  "www.so.com", "SPECIAL"); 
INSERT HealthFacility VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Montreal", "QC", "www.gjw.com",
  "(514)340-8222", "HOSPITAL"); 
INSERT HealthFacility VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Gatineau", "QC", "(819)966-6100",
  "www.hg.com", "HOSPITAL"); 
INSERT HealthFacility VALUES ("CHUS", "300 Rue King E", "Sherbrooke", "QC", 
  "www.chus.com", "(819)346-1110", "HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Montreal", "QC", "(514)384-2000", "www.hopitalFleury.com","HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital Richardson", "5425, Avenue Bessborough",
  "Montreal", "QC","(514)484-7878", "www.hopitalRichardson.com","HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital Rivière-des-Prairies",
  "7070, boulevard Perras", "Montreal", "QC", "(514)323-7260",
  "www.hopitalRP.com","HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "LaSalle", "QC", "(514)362-8000", "www.hopitalLasalle.com","HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Verdun", "QC", "(514)362-1100", "www.hopitalVerdun.com","HOSPITAL");
INSERT HealthFacility VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Sainte-Anne-de-Bellevue", "QC",
  "(514)457-3440", "www.hopitalSaintAnne.com","HOSPITAL");

INSERT DrugHistory VALUES ("Pfizer", "2020-06-21", "SAFE");
INSERT DrugHistory VALUES ("Moderna", "2020-06-21", "SAFE");
INSERT DrugHistory VALUES ("AstraZeneca", "2020-06-21", "SAFE");
INSERT DrugHistory VALUES ("Johnson & Johnson", "2021-06-21", "SUSPENDED");
INSERT DrugHistory VALUES ("RBD-Dimer", "2021-01-01", "SUSPENDED");
INSERT DrugHistory VALUES ("Covaxin", "2021-01-01", "SUSPENDED");
INSERT DrugHistory VALUES ("Ad5-nCoV", "2021-01-01", "SUSPENDED");
INSERT DrugHistory VALUES ("CIGB-66", "2021-01-01", "SUSPENDED");
INSERT DrugHistory VALUES ("KoviVac", "2021-01-01", "SUSPENDED");
INSERT DrugHistory VALUES ("EpiVacCorona", "2021-01-01", "SUSPENDED");

INSERT Employee VALUES ("2314904771","4030141599", "6202715 46", "Elizabeth",
  "Jernigan", "H2P 1Z7", "1996-04-18", "(418)640-9486", "4884 Boulevard Cremazie",
  "Quebec", "QC", TRUE, "eliJer@gmail.com");
INSERT Employee VALUES ("4091939153","3559893762", "8331149 83", "William",
  "Blackman", "G0C 1E0", "1991-07-01", "(418)299-4800", "3619 avenue de Port-Royal",
  "Bonaventure", "QC", TRUE, "wilBlack@gmail.com");
INSERT Employee VALUES ("6296074483","8133950202", "2597807 10", "Carol",
  "Williams", "H4V 2Z6", "1984-03-01", "(514)481-2566", "6767 ch de la Côte-Saint-Luc",
  "Côte Saint-Luc", "QC", TRUE, "carWill@gmail.com");
INSERT Employee VALUES ("1988238722","5594746088", "2967560 35", "Gary",
  "Smith", "H4B 1R9", "1967-06-12", "(514)484-4049", "3472 Av Westmore", "Montreal", "QC",
  TRUE, "garySmi@gmail.com");
INSERT Employee VALUES ("9654156685","3050347011", "7495078 77", "Ted",
  "Johnson", "H4C 3B1","1998-09-23", "(514)485-1864", "621 Côte Murray", "Westmount",
  "QC", TRUE, "tedJohn@gmail.com");
INSERT Employee VALUES ("0426670356","6901680262", "1457287 34", "Ronald",
  "Smith", "H1A 1Z1","1995-06-14", "(514)642-6526", "16226 Rue Bureau",
  "Pointe-Aux-Trembles", "QC", TRUE, "ronSmi@gmail.com");
INSERT Employee VALUES ("2589272564","2826175309", "0568018 19", "Adam",
  "Smith", "H3W 2C8", "1995-08-12", "(514)483-4346", "4840 Bonavista", "Montreal", "QC",
  TRUE, "adaSmi@gmail.com");
INSERT Employee VALUES ("4278243142","0883386538", "5489390 84", "Wayne",
  "Johnson","H4A 3A3" ,"1984-07-16", "(514)486-4899", "999 Old Orchard", "Montreal", "QC",
  TRUE, "wayJon@gmail.com");
INSERT Employee VALUES ("2221453161","3909862653", "5433470 85", "Sylvain",
  "Williams","H4H 2S4" ,"1978-11-14", "(514)767-3102", "1477 Rue Fayolle", "Verdun", "QC",
  TRUE, "sylWill@gmail.com");
INSERT Employee VALUES ("7034521288","5025223450", "6335938 64", "Michel",
  "Johnson","J4& 0J1" ,"1996-09-13", "(514)597-0058", "850 Av Lachine", "Montreal", "QC",
  TRUE, "micJohn@gmail.com");

INSERT Vaccination VALUES ("5418600012", 1, "2021-01-16", "6296074483", "AstraZeneca", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT Vaccination VALUES ("5418600012", 2, "2021-05-16", "2589272564", "Pfizer", "Hôpital Fleury", "2180, rue Fleury Est"); 
INSERT Vaccination VALUES ("7198638080", 1, "2021-04-25", "4278243142", "Pfizer", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT Vaccination VALUES ("5867167004", 1, "2021-05-02", "2221453161", "AstraZeneca", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT Vaccination VALUES ("9415548075", 1, "2021-05-07", "7034521288", "Pfizer", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT Vaccination VALUES ("9052864070", 1, "2021-01-30", "7034521288", "KoviVac", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT Vaccination VALUES ("9826293018", 1, "2021-06-05", "6296074483", "KoviVac", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT Vaccination VALUES ("2055054040", 1, "2021-06-20", "6296074483", "Moderna", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT Vaccination VALUES ("7247613020", 1, "2021-06-21", "6296074483", "AstraZeneca", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants"); 
INSERT Vaccination VALUES ("7976980046", 1, "2021-07-18", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 

INSERT Managers VALUES ("2314904771", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin", "2018-04-16", NULL);
INSERT Managers VALUES ("4091939153", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine", "2018-04-16", NULL);
INSERT Managers VALUES ("6296074483", "Hopital de Gatineau", "909 Boulevard la Vérendrye O", "2018-04-16", NULL);
INSERT Managers VALUES ("1988238722", "CHUS", "300 Rue King E", "2018-04-16", NULL);
INSERT Managers VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est", "2018-04-16", NULL);
INSERT Managers VALUES ("0426670356", "Hôpital Richardson", "5425, Avenue Bessborough", "2018-04-16", NULL);
INSERT Managers VALUES ("2589272564", "Hôpital Rivière-des-Prairies", "7070, boulevard Perras", "2018-04-16", NULL);
INSERT Managers VALUES ("4278243142", "Hôpital de Lasalle", "8585, Terrasse Champlain", "2018-04-16", NULL);
INSERT Managers VALUES ("2221453161", "Hôpital de Verdun", "4000, boul. Lasalle", "2018-04-16", NULL);
INSERT Managers VALUES ("7034521288", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants", "2018-04-16", NULL);

INSERT JobHistory VALUES ("2314904771", "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "2019-01-01", NULL); 
INSERT JobHistory VALUES ("4091939153", "Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "2019-01-01", NULL); 
INSERT JobHistory VALUES ("6296074483", "Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "2019-01-01", NULL); 
INSERT JobHistory VALUES ("1988238722", "CHUS", "300 Rue King E", "2019-01-01", NULL);
INSERT JobHistory VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est",
  "2019-01-01", NULL);
INSERT JobHistory VALUES ("0426670356", "Hôpital Richardson",
  "5425, Avenue Bessborough", "2019-01-01", NULL);
INSERT JobHistory VALUES ("2589272564", "Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "2019-01-01", NULL);
INSERT JobHistory VALUES ("4278243142", "Hôpital de Lasalle",
  "8585, Terrasse Champlain", "2019-01-01", NULL);
INSERT JobHistory VALUES ("2221453161", "Hôpital de Verdun", 
  "4000, boul. Lasalle", "2019-01-01", NULL);
INSERT JobHistory VALUES ("7034521288", "Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "2019-01-01", NULL);

INSERT VaccineStored VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Pfizer", 2000); 
INSERT VaccineStored VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Pfizer", 2000); 
INSERT VaccineStored VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Pfizer", 2000); 
INSERT VaccineStored VALUES ("CHUS", "300 Rue King E", "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", 2000);
INSERT VaccineStored VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", 2000);

INSERT VaccineShipment VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", "2021-01-23", 100);
INSERT VaccineShipment VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", "2021-01-23", 100);
INSERT VaccineShipment VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", "2021-01-23", 100);
INSERT VaccineShipment VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", "2021-01-23", 100);
INSERT VaccineShipment VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", "2021-01-23", 100);

INSERT VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Richardson", 
  "4545 Avenue Pierre-De Coubertin", "5425, Avenue Bessborough", "Pfizer",
  "2021-01-20", 100);
INSERT VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Rivière-des-Prairies", 
  "4545 Avenue Pierre-De Coubertin", "7070, boulevard Perras", "Pfizer",
  "2021-01-20", 100);
INSERT VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Lasalle",
  "4545 Avenue Pierre-De Coubertin", "8585, Terrasse Champlain", "Pfizer",
  "2021-01-20", 100);
INSERT VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Verdun",
  "4545 Avenue Pierre-De Coubertin", "4000, boul. Lasalle", "Pfizer",
  "2021-01-20", 100);
INSERT VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Sainte-Anne",
  "4545 Avenue Pierre-De Coubertin", "305, boulevard des Anciens-Combattants",
  "Pfizer", "2021-01-20", 100);
-- This file will populate the MySQL database created with the relations defined in file create_relation_Amir.sql
use PROJECT;

INSERT  INTO AgeGroup VALUES (0, "0-0");
INSERT  INTO AgeGroup VALUES (1, "80+");
INSERT  INTO AgeGroup VALUES (2, "70-79");
INSERT  INTO AgeGroup VALUES (3, "60-69");
INSERT  INTO AgeGroup VALUES (4, "50-59");
INSERT  INTO AgeGroup VALUES (5, "40-49");
INSERT  INTO AgeGroup VALUES (6, "30-39");
INSERT  INTO AgeGroup VALUES (7, "18-29");
INSERT  INTO AgeGroup VALUES (8, "12-17");
INSERT  INTO AgeGroup VALUES (9, "5-11");
INSERT  INTO AgeGroup VALUES (10, "0-4");

INSERT INTO VaccinationDrug VALUES ("Pfizer");
INSERT INTO VaccinationDrug VALUES ("Moderna");
INSERT INTO VaccinationDrug VALUES ("AstraZeneca");
INSERT INTO VaccinationDrug VALUES ("Johnson & Johnson");
INSERT INTO VaccinationDrug VALUES ("RBD-Dimer");
INSERT INTO VaccinationDrug VALUES ("Covaxin");
INSERT INTO VaccinationDrug VALUES ("Ad5-nCoV");
INSERT INTO VaccinationDrug VALUES ("CIGB-66");
INSERT INTO VaccinationDrug VALUES ("KoviVac");
INSERT INTO VaccinationDrug VALUES ("EpiVacCorona");

INSERT  INTO Province VALUES ('1', "NL", '4');
INSERT  INTO Province VALUES ('2', "PE", '5');
INSERT  INTO Province VALUES ('3', "NS", '6');
INSERT  INTO Province VALUES ('4', "NB", '3');
INSERT  INTO Province VALUES ('5', "QC", '8');
INSERT  INTO Province VALUES ('6', "ON", '1');
INSERT  INTO Province VALUES ('7', "MB", '2');
INSERT  INTO Province VALUES ('8', "SK", '9');
INSERT  INTO Province VALUES ('9', "AB", '4');
INSERT  INTO Province VALUES ('10', "BC", '6');
INSERT  INTO Province VALUES ('11', "YT", '7');
INSERT  INTO Province VALUES ('12', "NT", '8');
INSERT  INTO Province VALUES ('13', "NU", '4');

INSERT INTO VariantType VALUES(1, "ALPHA");
INSERT INTO VariantType VALUES(2, "LAMBDA");
INSERT INTO VariantType VALUES(3, "DELTA");
INSERT INTO VariantType VALUES(0, "UMKNOWN");

INSERT INTO Person VALUES ("5418600012", "1936638 14", "(514)482-4299", "Annabel", "Dodson",
  "6860 Fielding", "Montreal", 7, 5, TRUE,
  "annabel.dodson@gmail.com", "1996-08-06");
INSERT INTO Person VALUES ("7198638080", "1362899 55","(514)366-4286", "Zachary", "Rutledge",
  "902 Tittley", "Montreal", 6, 5, TRUE,
  "Zachary.Rutledge@gmail.com", "1986-08-12");
INSERT INTO Person VALUES ("5867167004", "0243401 87", "(514)767-5030", "Alister", "Wiggins",
  "6818 Lamont", "Montreal", 6, 5, TRUE, "Alister.Wiggins@gmail.com",
  "1987-08-27"); 
INSERT INTO Person VALUES ("9415548075", "2054252 15", "(514)525-4731", "Osman", "Vaughn", 
  "1720 Bourbonniere", "Montreal", 8, 5, TRUE,
  "Osman.Vaughn@gmail.com", "2007-09-08"); 
INSERT INTO Person VALUES ("9052864070", "1643994 57", "(514)768-9102", "Bear", "Melton",
  "5962 Jogues", "Montreal", 5, 5, TRUE, "Bear.Melton@gmail.com",
  "1976-09-13"); 
INSERT INTO Person VALUES ("9826293018", "4105748 51", "(613)733-8502", "Lulu", "Fisher",
  "927 Rand", "Gatineau", 5, 5, TRUE, "Lulu.Fisher@gmail.com",
  "1976-09-27"); 
INSERT INTO Person VALUES ("2055054040", "4990628 77", "(819)503-3196", "Collette", "Zavala",
  "60 Du Blizzard", "Gatineau", 3, 5, TRUE,
  "Collette.Zavala@gmail.com", "1956-09-29"); 
INSERT INTO Person VALUES ("7247613020", "3234394 08", "(819)408-0531", "Angela", "Dodson",
  "1175 De L'Esplanade", "Sherbrooke", 3, 5, TRUE,
  "Angela.Dodson@gmail.com", "1956-10-15"); 
INSERT INTO Person VALUES ("7976980046", "9109123 89", "(819)566-0668", "Annabel", "Crouch",
  "1812 Dunant", "Sherbrooke", 1, 5, TRUE,
  "Annabel.Crouch@gmail.com", "1936-10-18"); 
INSERT INTO Person VALUES ("6623218089", "0451174 26", "(418)547-8256", "Nyle", "Sparrow",
  "3937 Soucy", "Jonquière", 1, 5, TRUE, "Nyle.Sparrow@gmail.com",
  "1936-12-08"); 

INSERT INTO Person VALUES ("4030141599", "6202715 46","(418)640-9486", "Elizabeth",
  "Jernigan",   "4884 Boulevard Cremazie",
  "Quebec",5, 5, TRUE, "eliJer@gmail.com","1996-04-18",);
INSERT INTO Person VALUES ("3559893762", "8331149 83","(418)299-4800", "William",
  "Blackman",  "3619 avenue de Port-Royal",
  "Bonaventure",5, 5, TRUE, "wilBlack@gmail.com", "1991-07-01");
INSERT INTO Person VALUES ("8133950202", "2597807 10", "Carol","(514)481-2566",
  "Williams",  "6767 ch de la Côte-Saint-Luc",
  "Côte Saint-Luc",5, 5, TRUE, "carWill@gmail.com", "1984-03-01");

INSERT INTO Infection VALUES ("2021-03-16","5418600012", 1);
INSERT INTO Infection VALUES ("2021-04-18","5418600012", 2); 
INSERT INTO Infection VALUES ("2021-03-25","7198638080", 3); 
INSERT INTO Infection VALUES ("2021-04-02","5867167004", 1); 
INSERT INTO Infection VALUES ("2021-04-07","9415548075", 3); 
INSERT INTO Infection VALUES ("2021-04-30","9052864070", 1); 
INSERT INTO Infection VALUES ("2021-05-05","9826293018", 1); 
INSERT INTO Infection VALUES ("2021-05-20","2055054040", 3); 
INSERT INTO Infection VALUES ("2021-05-21","7247613020", 3); 
INSERT INTO Infection VALUES ("2021-06-18","7976980046", 1); 
INSERT INTO Infection VALUES ("2021-07-22","6623218089", 0); 


INSERT INTO HealthFacility VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Montreal", 5, "(514)252-4141",
  "www.so.com", "SPECIAL"); 
INSERT INTO HealthFacility VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Montreal", 5,  "(514)340-8222",
   "www.gjw.com", "HOSPITAL"); 
INSERT INTO HealthFacility VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Gatineau", 5, "(819)966-6100",
  "www.hg.com", "HOSPITAL"); 
INSERT INTO HealthFacility VALUES ("CHUS", "300 Rue King E", "Sherbrooke", 5, 
  "www.chus.com", "(819)346-1110", "HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Montreal", 5, "(514)384-2000", "www.hopitalFleury.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Richardson", "5425, Avenue Bessborough",
  "Montreal", 5,"(514)484-7878", "www.hopitalRichardson.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital Rivière-des-Prairies",
  "7070, boulevard Perras", "Montreal", 5, "(514)323-7260",
  "www.hopitalRP.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "LaSalle", 5, "(514)362-8000", "www.hopitalLasalle.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Verdun", 5, "(514)362-1100", "www.hopitalVerdun.com","HOSPITAL");
INSERT INTO HealthFacility VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Sainte-Anne-de-Bellevue", 5,
  "(514)457-3440", "www.hopitalSaintAnne.com","HOSPITAL");

INSERT INTO DrugHistory VALUES ("Pfizer", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("Moderna", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("AstraZeneca", "2020-06-21", "SAFE");
INSERT INTO DrugHistory VALUES ("Johnson & Johnson", "2021-06-21", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("RBD-Dimer", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("Covaxin", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("Ad5-nCoV", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("CIGB-66", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("KoviVac", "2021-01-01", "SUSPENDED");
INSERT INTO DrugHistory VALUES ("EpiVacCorona", "2021-01-01", "SUSPENDED");

INSERT INTO Employee VALUES ("2314904771","4030141599", "6202715 46", "Elizabeth",
  "Jernigan", "1996-04-18", "(418)640-9486", "4884 Boulevard Cremazie",
  "Quebec", 5, TRUE, "eliJer@gmail.com");
INSERT INTO Employee VALUES ("4091939153","3559893762", "8331149 83", "William",
  "Blackman", "1991-07-01", "(418)299-4800", "3619 avenue de Port-Royal",
  "Bonaventure", 5, TRUE, "wilBlack@gmail.com");
INSERT INTO Employee VALUES ("6296074483","8133950202", "2597807 10", "Carol",
  "Williams", "1984-03-01", "(514)481-2566", "6767 ch de la Côte-Saint-Luc",
  "Côte Saint-Luc", 5, TRUE, "carWill@gmail.com");
INSERT INTO Employee VALUES ("1988238722","5594746088", "2967560 35", "Gary",
  "Smith", "1967-06-12", "(514)484-4049", "3472 Av Westmore", "Montreal", 5,
  TRUE, "garySmi@gmail.com");
INSERT INTO Employee VALUES ("9654156685","3050347011", "7495078 77", "Ted",
  "Johnson","1998-09-23", "(514)485-1864", "621 Côte Murray", "Westmount",
  5, TRUE, "tedJohn@gmail.com");
INSERT INTO Employee VALUES ("0426670356","6901680262", "1457287 34", "Ronald",
  "Smith","1995-06-14", "(514)642-6526", "16226 Rue Bureau",
  "Pointe-Aux-Trembles", 5, TRUE, "ronSmi@gmail.com");
INSERT INTO Employee VALUES ("2589272564","2826175309", "0568018 19", "Adam",
  "Smith", "1995-08-12", "(514)483-4346", "4840 Bonavista", "Montreal", 5,
  TRUE, "adaSmi@gmail.com");
INSERT INTO Employee VALUES ("4278243142","0883386538", "5489390 84", "Wayne",
  "Johnson","1984-07-16", "(514)486-4899", "999 Old Orchard", "Montreal", 5,
  TRUE, "wayJon@gmail.com");
INSERT INTO Employee VALUES ("2221453161","3909862653", "5433470 85", "Sylvain",
  "Williams","1978-11-14", "(514)767-3102", "1477 Rue Fayolle", "Verdun", 5,
  TRUE, "sylWill@gmail.com");
INSERT INTO Employee VALUES ("7034521288","5025223450", "6335938 64", "Michel",
  "Johnson","1996-09-13", "(514)597-0058", "850 Av Lachine", "Montreal", 5,
  TRUE, "micJohn@gmail.com");

INSERT INTO Vaccination VALUES ("5418600012", 1, "2021-01-16", "6296074483", "AstraZeneca", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("5418600012", 2, "2021-05-16", "2589272564", "Pfizer", "Hôpital Fleury", "2180, rue Fleury Est"); 
INSERT INTO Vaccination VALUES ("7198638080", 1, "2021-04-25", "4278243142", "Pfizer", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("5867167004", 1, "2021-05-02", "2221453161", "AstraZeneca", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("9415548075", 1, "2021-05-07", "7034521288", "Pfizer", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT INTO Vaccination VALUES ("9052864070", 1, "2021-01-30", "7034521288", "KoviVac", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine"); 
INSERT INTO Vaccination VALUES ("9826293018", 1, "2021-06-05", "6296074483", "KoviVac", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("2055054040", 1, "2021-06-20", "6296074483", "Moderna", "Hôpital Richardson", "5425, Avenue Bessborough"); 
INSERT INTO Vaccination VALUES ("7247613020", 1, "2021-06-21", "6296074483", "AstraZeneca", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants"); 
INSERT INTO Vaccination VALUES ("7976980046", 1, "2021-07-18", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 

INSERT INTO Vaccination VALUES ("4030141599", 1, "2021-07-17", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("3559893762", 1, "2021-07-19", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 
INSERT INTO Vaccination VALUES ("3559893762", 2, "2021-07-20", "2314904771", "Moderna", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin"); 


INSERT INTO Managers VALUES ("2314904771", "Olympic Stadium", "4545 Avenue Pierre-De Coubertin", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("4091939153", "Jewish General Hospital", "3755 Chemin de la Côte-Sainte-Catherine", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("6296074483", "Hopital de Gatineau", "909 Boulevard la Vérendrye O", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("1988238722", "CHUS", "300 Rue King E", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("0426670356", "Hôpital Richardson", "5425, Avenue Bessborough", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("2589272564", "Hôpital Rivière-des-Prairies", "7070, boulevard Perras", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("4278243142", "Hôpital de Lasalle", "8585, Terrasse Champlain", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("2221453161", "Hôpital de Verdun", "4000, boul. Lasalle", "2018-04-16", NULL);
INSERT INTO Managers VALUES ("7034521288", "Hôpital de Sainte-Anne", "305, boulevard des Anciens-Combattants", "2018-04-16", NULL);

INSERT INTO JobHistory VALUES ("2314904771", "Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("4091939153", "Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("6296074483", "Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "2019-01-01", NULL); 
INSERT INTO JobHistory VALUES ("1988238722", "CHUS", "300 Rue King E", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("9654156685", "Hôpital Fleury", "2180, rue Fleury Est",
  "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("0426670356", "Hôpital Richardson",
  "5425, Avenue Bessborough", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("2589272564", "Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("4278243142", "Hôpital de Lasalle",
  "8585, Terrasse Champlain", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("2221453161", "Hôpital de Verdun", 
  "4000, boul. Lasalle", "2019-01-01", NULL);
INSERT INTO JobHistory VALUES ("7034521288", "Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "2019-01-01", NULL);

INSERT INTO VaccineStored VALUES ("Olympic Stadium",
  "4545 Avenue Pierre-De Coubertin", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("Jewish General Hospital",
  "3755 Chemin de la Côte-Sainte-Catherine", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("Hopital de Gatineau",
  "909 Boulevard la Vérendrye O", "Pfizer", 2000); 
INSERT INTO VaccineStored VALUES ("CHUS", "300 Rue King E", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Fleury", "2180, rue Fleury Est",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", 2000);
INSERT INTO VaccineStored VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", 2000);

INSERT INTO VaccineShipment VALUES ("Hôpital Richardson",
  "5425, Avenue Bessborough", "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital Rivière-des-Prairies", 
  "7070, boulevard Perras", "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Lasalle", "8585, Terrasse Champlain",
  "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Verdun", "4000, boul. Lasalle",
  "Pfizer", "2021-01-23", 100);
INSERT INTO VaccineShipment VALUES ("Hôpital de Sainte-Anne",
  "305, boulevard des Anciens-Combattants", "Pfizer", "2021-01-23", 100);

INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Richardson", 
  "4545 Avenue Pierre-De Coubertin", "5425, Avenue Bessborough", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital Rivière-des-Prairies", 
  "4545 Avenue Pierre-De Coubertin", "7070, boulevard Perras", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Lasalle",
  "4545 Avenue Pierre-De Coubertin", "8585, Terrasse Champlain", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Verdun",
  "4545 Avenue Pierre-De Coubertin", "4000, boul. Lasalle", "Pfizer",
  "2021-01-20", 100);
INSERT INTO VaccineTransfer VALUES ("Olympic Stadium", "Hôpital de Sainte-Anne",
  "4545 Avenue Pierre-De Coubertin", "305, boulevard des Anciens-Combattants",
  "Pfizer", "2021-01-20", 100);


INSERT INTO PostalCode VALUES ("6860 Fielding", "Montreal", 5, "H4V1P2");
INSERT INTO PostalCode VALUES ("902 Tittley", "Montreal",5,"H8R3X3");
INSERT INTO PostalCode VALUES ("6818 Lamont", "Montreal",5,"H7L4X8");
INSERT INTO PostalCode VALUES ("1720 Bourbonniere", "Montreal",5,"H1W3N1");
INSERT INTO PostalCode VALUES ("5962 Jogues", "Montreal",5,"J8Y4E3");
INSERT INTO PostalCode VALUES ("927 Rand", "Gatineau",5,"K1V6X4");
INSERT INTO PostalCode VALUES ("60 Du Blizzard", "Gatineau",5,"J9A0C8");
INSERT INTO PostalCode VALUES ("1175 De L'Esplanade", "Sherbrooke",5,"J1H1S9");
INSERT INTO PostalCode VALUES ("1812 Dunant", "Sherbrooke",5,"J1H1Y9");
INSERT INTO PostalCode VALUES ("3937 Soucy", "Jonquière",5,"G7X8T1");
INSERT INTO PostalCode VALUES ("4884 Boulevard Cremazie","Quebec", 5,"H2M0B0");
INSERT INTO PostalCode VALUES ("3619 avenue de Port-Royal","Bonaventure", 5,"J9J1C8");
INSERT INTO PostalCode VALUES ("6767 ch de la Côte-Saint-Luc","Côte Saint-Luc", 5,"H4V2Z6");
INSERT INTO PostalCode VALUES ("3472 Av Westmore", "Montreal",5,"H4V4Z6");
INSERT INTO PostalCode VALUES ("621 Côte Murray","Westmount",5,"H4V2Y6");
INSERT INTO PostalCode VALUES ("16226 Rue Bureau","Pointe-Aux-Trembles", 5,"H1A1Z1");
INSERT INTO PostalCode VALUES ("4840 Bonavista", "Montreal", 5,"G0C1E0");
INSERT INTO PostalCode VALUES ("999 Old Orchard", "Montreal", 5,"G0C1E8");
INSERT INTO PostalCode VALUES ("1477 Rue Fayolle", "Verdun", 5,"G3F1E0");
INSERT INTO PostalCode VALUES ("850 Av Lachine", "Montreal", 5,"G6C1Y0");
INSERT INTO PostalCode VALUES ("4545 Avenue Pierre-De Coubertin", "Montreal", 5,"G7Q2V0");
INSERT INTO PostalCode VALUES ("3755 Chemin de la Côte-Sainte-Catherine", "Montreal", 5,"G0S5R0");
INSERT INTO PostalCode VALUES ("909 Boulevard la Vérendrye O", "Gatineau", 5,"G5S2V0");
INSERT INTO PostalCode VALUES ("300 Rue King E", "Sherbrooke", 5,"G0S2V4");
INSERT INTO PostalCode VALUES ("2180, rue Fleury Est","Montreal", 5,"G0S2V0");
INSERT INTO PostalCode VALUES ("5425, Avenue Bessborough","Montreal", 5,"M4G3H9");
INSERT INTO PostalCode VALUES ("7070, boulevard Perras", "Montreal", 5,"H1E1A4");
INSERT INTO PostalCode VALUES ("8585, Terrasse Champlain","LaSalle", 5,"H3N2L1");
INSERT INTO PostalCode VALUES ("4000, boul. Lasalle","Verdun", 5,"H4G1J8");
INSERT INTO PostalCode VALUES ("305, boulevard des Anciens-Combattants", "Sainte-Anne-de-Bellevue", 5,"H9X1Y9");

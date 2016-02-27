Grama Andrei 322 AA 

						Gestiunea Unei Farmacii

Acest site este dedicat celor care doresc sa achizitoneze medicamente pe baza unei retete. Intreaga gestiune se face de catre Administrator. Acesta are posibilitatea de adauga, edita si sterge elemente din tabelele medicamente sau clienti.	

Baza de date contine 6 tabele.

1.Medicament( id_medicament, Denumire, Producator, Mod_administrare, Stoc, Pret, id_efect)

2.Client(id_client, Nume, Prenume, Sex, Varsta, Greutate)

3.Reteta(id_reteta, id_client, diagnostic, data_eliberarii)

4.Factura(id_factura, id_client, data, plata, id_efect)

5.Efect_secundar(id_efect, Efect)

6.Medicament/Reteta(id_reteta, id_medicament)

1.Tabela Medicament:
-id_med - primary key , autoincrement
-se stocheaza medicamentele
-id_efect Foreign key

2.Tabela Client:
- id_client - primary key, autoincrement
- se stocheaza clientii
- Sex - caracter de lungime 1

3.Tabela reteta:
- id_reteta primary key - autoincrement
- id_client foreign key

4.Tabela Factura:
-id_factura -primary key, autoincrement
-id_client foreign key 

5.Tabela Efect_secundar:
-id_efect primary key

6.Tabela de legatura Medicament/Reteta:
-id_reteta primary key, id_medicament foreign key

Relatii tabele:

1: 1-1 Factura - Client

2: 1-1 Client - Reteta

3: Many-Many Medicament - Reteta cu ajutoru tabelei de legatura Medicament/Reteta

4: 1-1 Medicament - Efect secundar

Functii implementate Insert, Update Delete pentru tabelele Medicament si Clienti.

Am combinat HTML si CSS in mare parte pentru interfata si am introdus elementele din baza de date prin php. Nu este o structura specifica: exista fisiere ce contin numai cod php, exista fisiere ce contin numai cod HTML si exista fisiere ce contin structuri mixte.

Este adaugata o pagina de contact in care se poate transmite numele, prenumele, emailul si un mesaj ce vor fi salvate intr-un fisier text.







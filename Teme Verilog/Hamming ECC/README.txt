--------------------README----------------

Student:Grama Andrei 322AA
Tema 1: Hamming

Hamming Encoder:

1.Nu am mai inițializat un vector auxiliar, ci am realizat calculele direct in vectorul output.

2.Am utilizat operatorul '+', deoarece efectuez operații pe un singur bit si  '+' 
	este similar cu operatorul '^' deja implementat în verilog.

3.Pentru a calcula biții de paritate 1, 2, 4, 8 și respectiv 16 care reprezintă paritatea celorlați
	15 biți. Calculul a fost efectuat după modelul:
		Bitul 'p1' depinde de biți: p3, p5, p7, p9, p11, p13, p15;
								   (d1, d2, d4, d5, d7,  d9,  d11)
		
		Bitul 'p2' depinde de biți: p3, p6, p7, p10, p11, p14, p15.
		
		Bitul 'p4' depinde de biți: p5, p6, p7, p12, p13, p14, p15.
		
		Bitul 'p8' depinde de biți: p9, p10, p11, p12, p13, p14, p15.
		
		Bitul 'p16' depinde de toți biții 1-15.

Hamming Decoder:

1.La primul pas inițializez un vector 'p' în care voi stoca o copie a inputului și un vector 'sum' în 
	care voi căuta poziția erorii.

2.Calculez biții de paritate 1, 2, 4, 8 și 16, în același fel ca la encoder.

3.Încep să caut bitul/biții greșiți prin verificarea biților calculați cu cei din input:
	3.1 Dacă biții diferă, incrementez suma cu poziția bitului respectiv.
	3.2 După ce am verificat biții 1, 2, 4 și 8 verific dacă suma a fost modificată
	 	și daca răspunsul este da, înseamnă că am găsit o eroare ceea ce face ca
	 	error să treaca în '1'.

4.Verific dacă am găsit o greșeală:
	4.1 Dacă am găsit o greșeală, salvez poziția bitului ce a fost calculată în vectorul suma.
	4.2 Corectez bitul greșit.
	4.3 Verific dacă bitul de paritate 16 calculat este identic cu cel din input:
		 4.3.1 Dacă răspunsul este da, înseamnă că am depistat a doua greșeală, unde incrementez
		 	uncorrectable = 1, poziția erorii inițiale o sterg, deci error_index = 0, și afișez
		 	inputul fără modificări.
		 4.3.2 Dacă răspunsul este nu, merg mai departe.

5.Verific dacă a fost găsită o eroare până acum și dacă bitul de paritate 16 calculat este 
	identic cu cel transmis în imput:
	5.1 Dacă răspunsul este da, afișez inputul fără modificări deoarece este corect.
	5.2 Dacă răspunsul este nu, înseamnă că bitul 16 transmis nu corespunde cu cel calculat,
		ceea ce înseamnă că am descoperit o eroare unde:
		5.3.1 Corectez bitul 16 de paritate.
		5.3.2 Error trece in '1'.

6.Verific dacă a fost identificată o singură eroare și dacă răspunsul este da, afișez vectorul calculat.
`timescale 1ns / 1ps

module process(
	input clk,				// clock 
	input [23:0] in_pix,	// valoarea pixelului de pe pozitia [in_row, in_col] din imaginea de intrare (R 23:16; G 15:8; B 7:0)
	output reg [5:0] row, col, 	// selecteaza un rand si o coloana din imagine
	output reg out_we, 			// activeaza scrierea pentru imaginea de iesire (write enable)
	output reg [23:0] out_pix,	// valoarea pixelului care va fi scrisa in imaginea de iesire pe pozitia [out_row, out_col] (R 23:16; G 15:8; B 7:0)
	output reg mirror_done,		// semnaleaza terminarea actiunii de oglindire (activ pe 1)
	output reg gray_done,		// semnaleaza terminarea actiunii de transformare in grayscale (activ pe 1)
	output reg filter_done);	// semnaleaza terminarea actiunii de aplicare a filtrului de sharpness (activ pe 1)


reg [23:0] superior, inferior, aux, max, min, test;
reg [4:0] next_state, state ;
reg [5:0] linie, coloana, next_coloana, next_linie;
reg [2:0] incrementare, decrementare;
reg [23:0] matrice_veche[2:0][63:0];
reg [64:0] matrice_noua[2:0][63:0];
reg [23:0] linie_anterioara;
reg [63:0] i, j, k;
reg [23:0] sharp[8:0];


initial 
begin
	aux = 0;
	state = 0;
	linie = 0;
	coloana = 0;
	out_we = 0;
	mirror_done = 0;
	gray_done = 0;
	filter_done = 0;
	next_state = 0;
	linie = 0;
	coloana = 0;
	next_linie = 0;
	next_coloana = 0;
end

always @(posedge clk) 
begin
	state <= next_state;
	linie <= next_linie;
	coloana <= next_coloana;
end

always @(*)
begin
out_we = 0;
	case(state)
		0:							//citesc elementul inferior la a doua iteratie
		begin
				incrementare = 0;
				if( row == linie )
					inferior = in_pix;
				row = linie;
				col = coloana;
				next_state = 1;
		end
		
		1:
		begin							//citesc elementul superior la a doua iteratie
			if( row == 63 - linie )
				superior = in_pix;
			row = 63 - linie;
			col = coloana;
			next_state = 2;
		end

		2:
		begin										
			if( row == linie )			//scriu elementul superior pe pozitia inferioara
				begin 
					out_we = 1;
					out_pix = superior;
				end
			row = linie;
			col = coloana;
			next_state = 3;

		end
		
		3:
		begin							//scriu elementul inferior pe pozitia superioara
			if( row == 63 - linie )
				begin
					out_pix = inferior;
					out_we = 1;
				end
			row = 63 - linie;
			coloana = coloana;
			next_state = 4;
			
		end

		4:
			begin										//incrementare ma ajuta sa fac doar o singura crestere a indicelui respectiv
			if( mirror_done != 1 && incrementare != 1 )
					if( linie == 31)
						if( coloana == 63 )
							begin					//am terminat oglindirea
								next_coloana = 0;
								next_linie = 0;
								aux = 0;
								mirror_done = 1;
								next_state = 5;
								row = 0;
								col = 0;
							end
						else
							begin
								next_coloana = next_coloana + 1;	//am ajuns la ultima linie de iterat, dar nu la sfarsitul coloanelor
								next_state = 0;
								incrementare = 1;
							end
					else
						if( coloana == 63 )						//am ajuns la sfarsitul unei linii si cresc linia
							begin
								next_linie = next_linie + 1;
								next_coloana = 0;
								next_state = 0;
								incrementare = 1;
							end
					   else
							begin
								next_coloana = next_coloana + 1;	//nu am ajuns la sfarsitul unei linii si nu e ultima linie
								next_state = 0;
								incrementare = 1;
							end
				
			end	

		5:
		begin					//citesc un pixel, aplic grayscale si il scriu in imagine
			if(out_we == 0)
				begin
					incrementare = 0;
					aux = in_pix;
					max = 0;
					min = 255;
					if( aux[7:0] > max )
							max = aux[7:0]; 
							
					if( aux[7:0] < min )
							min = aux[7:0];
							
					if( aux[15:8] > max )
							max = aux[15:8]; 

					if( aux[15:8] < min)
							min = aux[15:8]; 

					if( aux[23:16] > max )
							max = aux[23:16]; 

					if( aux[23:16] < min )
							min = aux[23:16]; 
					aux[15:8] = (min + max) / 2;
					test = aux[15:8];
					aux[7:0] = 0;
					aux[23:16] = 0;
					out_we = 1;
					out_pix = aux;
				end
			next_state = 6;
		end

		6:
		begin										//verific unde ma aflu in imagine
		if( gray_done != 1 && incrementare != 1)			
				if( row != 63)
					begin
						next_state = 5;
						if(col == 63)
							begin
								row = row + 1;	//am ajuns la un capat de linie si trec la urmatoarea
								col = 0;
								incrementare = 1;
							end
						else
							begin
								incrementare = 1; //nu am ajuns la capat de linie
								col = col + 1;
							end	
					end
				else
					if(col == 63)
						begin
							
							next_linie = 0;		//am ajuns la finalul imaginii si am terminat algoritmul
							next_coloana = 0;
							row = 0;
							col = 0;
							next_state = 7;
							gray_done = 1;
							incrementare = 0;
						end
					else
						begin
							next_state = 5;		//sunt la ultima linie, dar nu am ajuns la sfarsitul acesteia
							col = col + 1;
							incrementare = 1;
						end
		end

		7:
		begin
			if(coloana == next_coloana)		//citesc un pixel din imagine si il scriu in matrice
				begin
					matrice_veche[incrementare][coloana] = in_pix[15:8];
				end
			col = next_coloana;
			next_state = 8;
		end

		8:
			begin
				if( state == next_state )
					if( coloana != 63 )	
						begin
							next_coloana = next_coloana + 1;	//nu am ajuns la final de linie
							next_state = 7;
						end
					else
						if(linie != 63)
							if(incrementare == 2)
								begin
									next_state = 9;		//am citit 3 randuri din imagine si trec la procesare
									if( linie == 2 )
										linie_anterioara = 0; //daca am primele 3 linii, asigur zerouri pentru prima linie la procesare
									else
										for( k = 0; k < 64; k = k+1)		
											linie_anterioara[k] = matrice_veche[1][k]; //memorez linia anterioara celor 3 linii ce urmeaza
								end 												   //a fi procesate
							else
								begin
									next_linie = next_linie + 1;	//am ajuns la final de linie
									next_coloana = 0;
									incrementare = incrementare + 1; //ma ajuta la evidenta liniilor ce merg la procesare
									next_state = 7;
								end
							else
								begin
									next_state = 9;	//am ajuns la ultimele 3 linii din matrice
									coloana = 0;
								end
				col = next_coloana;
				row = next_linie;
			end

		

		9:
		begin
			for( k = 0; k < 9 ; k = k+1)
				sharp[k] = 0;				//initializez cu 0 matricea in care voi calcula bitul
			for( i = 0; i < 2; i = i+1)
				for( j = 0; j < 64; j = j+1)
					begin
						if(i == 0)		//daca ma aflu pe prima linie din matricea mea si am nevoie de linia anterioara
							begin
								if(j == 0 )
									begin				//daca ma aflu la primul pixel dintr-o linie, elementele
										sharp[0] = 0;  	//din stanga sa sunt 0
										sharp[3] = 0;
										sharp[6] = 0;
									end
								else
									begin
										sharp[0] = linie_anterioara[j-1];	//initializez elementele din stanga pixelului
										sharp[3] = matrice_veche[i][j-1];
										sharp[6] = matrice_veche[i+1][j-1];
									end
							
								if(j == 63 )
									begin
										sharp[2] = 0;	//vecinii din dreapta a ultimului pixel dintr-o linie
										sharp[5] = 0;
										sharp[8] = 0;
									end
							
								else
									begin
										sharp[2] = linie_anterioara[j+1]; // vecinii din dreapta a pixelului
										sharp[5] = matrice_veche[i][j+1];
										sharp[8] = matrice_veche[i+1][j+1];
									end
							end
						else
							begin			//am trecut de prima linie din matricea mea
								if(j == 0 )
									begin
										sharp[0] = 0;
										sharp[3] = 0;
										sharp[6] = 0;
									end
								else
									begin
										sharp[0] = matrice_veche[i-1][j-1];
										sharp[3] = matrice_veche[i][j-1];
										sharp[6] = matrice_veche[i+1][j-1];
									end
								
								if(j == 63 )
									begin
										sharp[2] = 0;
										sharp[5] = 0;
										sharp[8] = 0;
									end
								else
									begin
										sharp[2] = matrice_veche[i-1][j+1];
										sharp[5] = matrice_veche[i][j+1];
										sharp[8] = matrice_veche[i+1][j+1];
									end
							end
						sharp[1] = linie_anterioara[j];
						sharp[4] = matrice_veche[i][j];
						sharp[7] = matrice_veche[i+1][j];
						matrice_noua[i][j] = 9*sharp[4] -(sharp[0] + sharp[1] + sharp[2] +
								  			 			  sharp[3]  + sharp[5] +
								  			  			  sharp[6] + sharp[7] + sharp[8]);
					end

			i = 0;
			next_coloana = 0;
			decrementare = 1;
			next_state = 10;
		end

		10:
		begin
			if( out_we == 0)		//scriu scriu pixel in imagine
				begin
					out_pix = matrice_noua[i][coloana];
					out_we = 1;
				end
			if(linie == 63)	
				begin
					col = coloana;
					next_state = 13; 	//refolosesc starea pentru scrierea ultimelei linii din matrice
				end
			else
				begin
					row = i;
					col = coloana;	 //nu am ajuns la ultima linie si scriu in continuare
					next_state = 11;
				end
		end
		
		11:
		begin
			if( coloana == next_coloana )
				if( coloana != 63 )	
					begin
						next_coloana = next_coloana + 1;	//nu am ajuns la final de linie 
						next_state = 10;	
					end
				else
					if(decrementare == 0)
						begin				//dupa ce am scris cele 2 linii din matrice, trec la citirea urmatoarelor 3 linii
							next_state = 7;
							next_linie = next_linie + 1;
							row = linie;
							col = 0;
							next_coloana = 0;
						end
					else
						begin
							decrementare = decrementare - 1;	//am ajuns la final de linie la scriere
							next_coloana = 0;
							i = i + 1;
							next_state = 10;
						end
		end

	12:
	begin					//procesez ultima linie
		i = 2;
		for( j = 0; j < 64; j = j+1)
			begin
				if(j == 0 )
					begin
						sharp[0] = 0;
						sharp[3] = 0;
					end
				else
					begin
						sharp[0] = matrice_veche[i-1][j-1];
						sharp[3] = matrice_veche[i][j-1];
					end
							
				if(j == 63 )
					begin
						sharp[0] = 0;
						sharp[3] = 0;
					end
				else
					begin
					sharp[0] = matrice_veche[i-1][j+1];
					sharp[3] = matrice_veche[i][j+1];
				end
	
				sharp[1] = linie_anterioara[j];
				sharp[4] = matrice_veche[i][j];
				sharp[6] = 0;					//cei trei pixeli din vecinatatea de jos
				sharp[7] = 0;
				sharp[8] = 0;
				matrice_noua[0][j] = 9*sharp[4] -(sharp[0] + sharp[1] + sharp[2] +
								  			 	  sharp[3]  + sharp[5] +
								  			  	  sharp[6] + sharp[7] + sharp[8]);
			end
		next_coloana = 0;
		i = 0;
		col = 0;
		next_state = 13;
		incrementare = 2;
	end

	13:
	begin						//parcurg doar ultima linie din imagine
		if( filter_done == 0)
			if( col == 63)
				filter_done = 1;	//am ajuns la finalul liniei
			else
				if(coloana == next_coloana)
					begin
						next_coloana = next_coloana + 1;	//nu am ajuns la final de linie
						next_state = 10;
					end
	end

	endcase

end


endmodule


//////////////////////////////////////////////////////////////////////////////////
// Course: Arhitectura Calculatoarelor
// Student: 	Grama Andrei 332 AA	
// Module Name:    hamming_decoder 
// Project Name: 		Hamming Decoder 
//////////////////////////////////////////////////////////////////////////////////
module hamming_decoder(	output reg [10:0] out, // mesaj corectat
								output reg [3:0] error_index, // numărul bitului corectat (1-15)
								output reg error, // 1 dacă a fost detectată cel puțin o eroare
								output reg uncorrectable, // 1 dacă au fost detectate două erori
								input [16:1] in);

reg [16:1] p;						//inițializez o copie a inputului in care voi face modificarile								 							
reg [4:0] sum;						//inițializez o sumă prin care aflu bitul de modificat					
									//poziția bitului eronat

always @(*) begin
	uncorrectable = 0;
	error = 0;
	p = in;								
  
	p[1] = p[3] + p[5] + p[7] + p[9] + p[11] + p[13] + p[15];		//calculez biții de paritate in copie

	p[2] = p[3] + p[6] + p[7] + p[10] + p[11] + p[14] + p[15];

	p[4] = p[5] + p[6] + p[7] + p[12] + p[13] + p[14] + p[15];

	p[8] = p[9] + p[10] + p[11] + p[12] + p[13] + p[14] + p[15];

	p[16] = in[1] + in[2] + in[3] + in[4] + in[5] + 		
			in[6] + in[7] + in[8] + in[9] + in[10] + 
			in[11] + in[12] + in[13] + in[14] + in[15];
	
	
		sum = 0;

		if( p[1] != in[1] )				//incep căutarea greșelilor  incrementarea sumei
			sum = sum + 1;
		
		if( p[2] != in[2] )
			sum = sum + 2;
		
 		if( p[4] != in[4] )
			sum = sum + 4;
 		
		if( p[8] != in[8] )
			sum = sum + 8;

		if ( sum != 0)					//dacă suma a fost modificată 	
			error = 1;					//înseamnă că o eroare a fost gasită

		if( error == 1)					//dacă am găsit o greseală 
					begin											
						error_index = sum;			//salvez poziția bitului
						p[sum] = p[sum] + 1;		//corectez bitul greșit				
						if( p[16] == in[16] )		//verific dacă biții de paritate sunt identici:
							begin
								uncorrectable = 1;	//dacă da, este uncorrectable și nu mai modific
								error_index = 0;
								out = { in[15], in[14], in[13], in[12], in[11], in[10], 			
										in[9], in[7], in[6], in[5], in[3]};
							end	
					end

		if( error == 0 && p[16] == in[16] )							//dacă nu s-a gasit o eroare ăi bitul 16 este corect
			out = { in[15], in[14], in[13], in[12], in[11], in[10], //nu avem ce modifica și scriu outputul			
					in[9], in[7], in[6], in[5], in[3]};
		else
			begin 
				p[16] = p[16] + 1;				//dacă bitul 16 este greșit, îl corectez,
				error = 1;						//incrementez error 
			end

	if (uncorrectable == 0 && error == 1 )
		out = { p[15], p[14], p[13], p[12], p[11], p[10], 		//dacă am găsit doar o eroare, afișez vectorul cu
				p[9], p[7], p[6], p[5], p[3]};					//modificarea efectuată
	
	
end

endmodule

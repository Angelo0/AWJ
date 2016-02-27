
//////////////////////////////////////////////////////////////////////////////////
// Course: Arhitectura Calculatoarelor
// Student: 	Grama Andrei 332 AA	
// Module Name:    hamming_encoder 
// Project Name: 		Hamming_encoder 
//
//////////////////////////////////////////////////////////////////////////////////
module hamming_encoder(	output reg[16:1] out, 
                        input [10:0] in );

always @(*) begin
	out[3] = in[0];
	out[5] = in[1];
	out[6] = in[2];
	out[7] = in[3];
	out[9] = in[4];
	out[10] = in[5];
	out[11] = in[6];
	out[12] = in[7];
	out[13] = in[8];
	out[14] = in[9];
	out[15] = in[10];
	
	out[1] = out[3] + out[5] + out[7] + out[9] + out[11] +out[13] + out[15];			//calculez fiecare bit de paritate in functie de bitii de date
																						//de care depinde
	out[2] = out[3] + out[6] + out[7] + out[10] + out[11] + out[14] + out[15];
	
	out[4] = out[5] + out[6] + out[7] + out[12] + out[13] + out[14] + out[15];
	
	out[8] = out[9] + out[10] + out[11] + out[12] + out[13] + out[14] + out[15];
	
	out[16] =  out[1] + out[2] + out[3] + out[4] + out[5] +								//pentru a afla bitul 16 de paritate
				  out[6] + out[7] + out[8] + out[9] + out[10] + 						//efectuez xor(suma) de toti ceilalti biti
				  out[11] + out[12] + out[13] + out[14] + out[15];						
end


endmodule

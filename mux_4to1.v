`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 04/24/2020 02:00:05 PM
// Design Name: 
// Module Name: mux_4to1
// Project Name: 
// Target Devices: 
// Tool Versions: 
// Description: 
// 
// Dependencies: 
// 
// Revision:
// Revision 0.01 - File Created
// Additional Comments:
// 
//////////////////////////////////////////////////////////////////////////////////


module mux_4to1 (input op, input dhe, input ose, input sum, input xor1, output dalja);
//definimi i sinjalit seleksionues dhe dalja
wire [2:0] op;
reg dalja;

always @ (*)
begin
case (op)
3'b000: dalja = dhe;
3'b010: dalja = ose;
3'b011: dalja = xor1;
3'b100: dalja = sum;
default : dalja = 1'd1;
endcase
end

endmodule

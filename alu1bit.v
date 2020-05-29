`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 04/24/2020 01:52:15 PM
// Design Name: 
// Module Name: alu1bit
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


module alu1bit(
    input a,
    input b,
    input cin,
    input ainvert,
    input binvert,
    input [2:0] op,
    output result,
    output cout
    );
    
wire a, b, cin, ainvert, binvert;
wire[2:0] op;

wire result;
wire cout;

wire net1, net2, net3, net4, net5, ajo, bjo;

not a1 (ajo, a);
not b1 (bjo, b);

mux_2to1 m2_A(ainvert, a, ajo, net1);
mux_2to1 m2_B(binvert, b, bjo, net2);

and n3 (net3, net1, net2);
or n4 (net4, net1, net2);
xor n6(net6,net1,net2);
full_adder FA (net1, net2, cin, net5, cout);

mux_4to1 m4 (op, net3, net4, net5,net6,result);

endmodule



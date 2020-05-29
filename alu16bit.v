`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 
// Design Name: 
// Module Name: alu16bit
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


module alu16bit(
    input a,
    input b,
    input cin,
    input ainvert,
    input binvert,
    input [2:0] op,
    output result,
    output cout
    );
    
wire[15:0] a, b; 
wire cin, ainvert, binvert;
wire[2:0] op;

wire[15:0] result;
wire[15:0] c;
assign cout = c[15];
wire [15:0] left;
wire [15:0] right;

alu1bit alu0(a[0], b[0], cin, ainvert, binvert, op, result[0], c[0]);
alu1bit alu1(a[1], b[1], c[0], ainvert, binvert, op, result[1], c[1]);
alu1bit alu2(a[2], b[2], c[1], ainvert, binvert, op, result[2], c[2]);
alu1bit alu3(a[3], b[3], c[2], ainvert, binvert, op, result[3], c[3]); 
alu1bit alu4(a[4], b[4], c[3], ainvert, binvert, op, result[4], c[4]);
alu1bit alu5(a[5], b[5], c[4], ainvert, binvert, op, result[5], c[5]);
alu1bit alu6(a[6], b[6], c[5], ainvert, binvert, op, result[6], c[6]);
alu1bit alu7(a[7], b[7], c[6], ainvert, binvert, op, result[7], c[7]);
alu1bit alu8(a[8], b[8], c[7], ainvert, binvert, op, result[8], c[8]);
alu1bit alu9(a[9], b[9], c[8], ainvert, binvert, op, result[9], c[9]);
alu1bit alu10(a[10], b[10], c[9], ainvert, binvert, op, result[10], c[10]);
alu1bit alu11(a[11], b[11], c[10], ainvert, binvert, op, result[11], c[11]);
alu1bit alu12(a[12], b[12], c[11], ainvert, binvert, op, result[12], c[12]);
alu1bit alu13(a[13], b[13], c[12], ainvert, binvert, op, result[13], c[13]);
alu1bit alu14(a[14], b[14], c[13], ainvert, binvert, op, result[14], c[14]);
alu1bit alu15(a[15], b[15], c[14], ainvert, binvert, op, result[15], c[15]);

/*
always @(*)
begin 
 case(op)
 3'b001: assign result = {a[14:0],1'b0}; // sll
 3'b110: assign result = {1'b0,a[15:1]}; // srl
 endcase
end
*/
assign left = {a[14:0],1'b0};
assign right = {1'b0,a[15:1]};

endmodule



.data 80h
DB 77h, 44h, 3Eh, 6Eh, 4Dh, 6Bh, 7Bh, 46h, 7Fh, 4Fh ;digitos sin punto
DB F7h, C4h, BEh, EEh, CDh, EBh, FBh, C6h, FFh, CFh ;digitos con punto

.org 1000h

; -------------------------------
; PROGRAMA PRINCIPAL
; -------------------------------
MVI C, 00h
MVI D, 05H
MVI E, 02H
MVI H, 00
MVI L, 80H
OUT 00H
INR C

SALTO:
MOV A, M
OUT 07H
CALL RETARDO
MOV A,C
ADD L
MOV L,A
CPI 0AH
JNZ SALTO
OUT 77h 44h
HLT

RETARDO:
;NOP
;NOP
;NOP
DCR D
JNZ RETARDO
NOP
NOP
MVI D,FFh
DCR E
JNZ RETARDO
RET
<?php

namespace App\Enums;

enum Position: string
{
    case GOL    = 'Goleiro';
    case ZAG    = 'Zagueiro';
    case LD     = 'Lateral Direito';
    case LE     = 'Lateral Esquerdo';
    case VOL    = 'Volante';
    case MC     = 'Meio campista';
    case MD     = 'Meia-Direito';
    case ME     = 'Meia-Esquerdo';
    case MEI    = 'Meia-Ofensivo';
    case PE     = 'Ponta Esquerda';
    case PD     = 'Ponta Direita';
    case SA     = 'Segundo Atacante';
    case ATA    = 'Atacante';
}

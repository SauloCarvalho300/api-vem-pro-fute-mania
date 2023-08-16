<?php

namespace App\Enums;

enum Step: string {
    case G = "Fase de grupos";
    case O = "Oitavas de final";
    case Q = "Quartas de final";
    case S = "Semifinais";
    case F = "Final";
}

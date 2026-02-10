<?php

namespace App\Enums;

enum InviteStatus: string
{
    case Pending = 'PENDENTE';
    case Accepted = 'ACEITO';
    case Rejected = 'RECUSADO';
    case Expired = 'EXPIRADO';
    case Cancelled = 'CANCELADO';
}

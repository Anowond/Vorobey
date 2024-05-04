<?php

namespace App\Enums;

enum videostatus: string
{
    case Published = 'Published';
    case Unpublished = 'Unpublished';
    case Archived = 'Archived';
}

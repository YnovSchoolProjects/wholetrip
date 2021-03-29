<?php


namespace App\Enum;


use MyCLabs\Enum\Enum;

class VoyageStatus extends Enum
{
    public const PRIVATE = 'private';
    public const SHARED = 'shared';
    public const PUBLIC = 'public';
}

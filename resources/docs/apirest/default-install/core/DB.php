<?php

namespace Core;

use Database\Client\Mysql;
use Database\Client\Postgre;

class DB
{
    public static function pg()
    {
        return new Postgre;
    }

    public static function mysql()
    {
        return new Mysql;
    }
}

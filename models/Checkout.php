<?php

namespace Maxaboom\Models;
use Maxaboom\Models\Helpers\Database;
use PDO;
use PDOException;

class Checkout extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->db;
    }

    public function getAddresse(){
    }
}
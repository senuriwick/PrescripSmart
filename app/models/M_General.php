<?php
class M_General
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 06.07.2020
 * Time: 08:53
 */

class Creative extends Database
{
    public $id;

    public function getCreativeDb()
    {
        $getCreativeDb = $this->fetch("SELECT * FROM files WHERE id='$this->id'");
        return (object)$getCreativeDb;
    }
}
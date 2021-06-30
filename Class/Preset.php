<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 06.07.2020
 * Time: 08:53
 */

class Preset extends Database
{
    public $id;

    public function getPresetDb()
    {
       $getPresetDb = $this->fetch("SELECT * FROM preset WHERE id='$this->id'");
       return (object)$getPresetDb;
    }

}
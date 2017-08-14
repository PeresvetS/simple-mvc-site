<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

interface DbModelInterface
{
    public function find(int $id);
    public function save();
    public function delete();
}
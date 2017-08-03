<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

interface DbModelInterface
{
    public function find($id);
    public function save();
    public function deactivate();
}
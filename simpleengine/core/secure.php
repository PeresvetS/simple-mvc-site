<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class Secure 
{
    /**
     * getSecureQuery
     * @param string $query 
     * @param number $sub 
     * @return mixed 
     */
    public function getSecureQuery(string  $query, number $sub): mixed
    {
        return substr(htmlspecialchars(urldecode(trim($query))), 0, $sub);
    }


}
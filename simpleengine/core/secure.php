<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class Secure 
{

    /**
     * getSecureQuery
     * @param string $query 
     * @param number $sub 
     * @return string 
     */
    public function getSecureQuery(string  $query, number $sub): string
    {
        return substr(htmlspecialchars(urldecode(trim($query))), 0, $sub);
    }


}
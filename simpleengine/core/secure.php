<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class Secure 
{

    
    /**
     * getSecureQuery
     * @return mixed 
     */
    public function getSecureQuery(string  $query, int $sub)
    {
        return substr(htmlspecialchars(urldecode(trim($query))), 0, $sub);
    }


}
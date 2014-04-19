<?php

class FileLibrary {

    const dir = "files";
    
    /**
     *
     * @param string $name 
     * @return string $url
     */
    public static function cssLink($name) 
    {
        return '<link rel="stylesheet" type="text/css" href="'.FileLibrary::urlOf("$name").'" media="screen" />';
    }
    
    /**
     *
     * @param string $name 
     * @return string $url
     */
    public static function urlOf($name) {
        $array = explode('.', $name);
        return 'files/'.end($array).'/'.$name;
    }
}

?>

<?php

class FileLibrary {

    const dir = "files";
    
    /**
     *
     * @param string $name 
     * @return string $url
     */
    public static function cssLink($urlOrName) 
    {
        $url = $urlOrName;
        if(substr($url, 0, 7) != "http://")
                $url = FileLibrary::urlOf($url);
        return '<link rel="stylesheet" type="text/css" href="'.$url.'" media="screen" />';
    }
    
    /**
     *
     * @param string $name 
     * @return string $url
     */
    public static function imgTag($urlOrName, $width = null, $height = null) 
    {
        $url = $urlOrName;
        if(substr($url, 0, 7) != "http://")
                $url = FileLibrary::urlOf($url);
        $output = '<img src="'.$url.'" alt="Smiley face" ';
        if($width)
            $output .= "width=".$width." ";
        if($height)
            $output .= "height=".$height;
        return $output."/>";
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

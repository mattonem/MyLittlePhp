<?php

class News extends BaseMongoRecord {

    protected static $collectionName = 'news';

    public function getContent() {
        $output = "";
        $contentBrut = parent::getContent();
        $explodeStartTags = explode('[@', $contentBrut);
        $i = 0;
        foreach ($explodeStartTags as $value) {
            if ($i == 0) {
                $output .=$value;
                $i ++;
                continue;
            }
            $j = 0;
            $explodeEndTags = explode(']', $value);
            foreach ($explodeEndTags as $value2) {
                if ($j > 0) {
                    $output .=$value2;
                    $j ++;
                    continue;
                }
                $balisenargs = explode(' ', $value2);
                $reflectionMethod = new ReflectionMethod($this,$balisenargs[0]);
                $res = $reflectionMethod->invokeArgs($this,  array_slice($balisenargs , 1));
                $output .= $res;
                $j++;
            }

            $i ++;
        }
        return $output;
    }
    
    public function img($url, $width = null, $height = null) {
        return "</p>".FileLibrary::imgTag($url, $width, $height)."<p>";
    }
    
    public function par() {
        return "</p><p>";
    }

}
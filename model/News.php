<?php

class News extends ActiveRecord\Model {

    protected static $collectionName = 'news';
    public $_env = array();

    static function br2nl($string) {
        return preg_replace('/\<br(\s*)?\/?\>/i', "&#13;&#10;", $string);
    }

    public function beforeSave() {
        if (!$this->getPublished())
            $this->setPublished(false);
        if (!$this->getDate())
            $this->setDate(time());
        parent::beforeSave();
    }

    public function getContentHtml() {
        $output = "";
        $output .= $this->openenv("p");
        $contentBrut = $this->content;
        $explodeStartTags = explode('[@', $contentBrut);
        $i = 0;
        foreach ($explodeStartTags as $value) {
            if ($i == 0) {
                $output .=$value;
                $i++;
                continue;
            }
            $j = 0;
            $explodeEndTags = explode(']', $value);
            foreach ($explodeEndTags as $value2) {
                if ($j > 0) {
                    $output .=$value2;
                    $j++;
                    continue;
                }
                $balisenargs = explode(' ', $value2);
                $reflectionMethod = new ReflectionMethod($this, $balisenargs[0]);
                $res = $reflectionMethod->invokeArgs($this, array_slice($balisenargs, 1));
                $output .= $res;
                $j++;
            }

            $i++;
        }
        if ($this->_env != array())
            $output .= $this->closeAll();
        return nl2br($output);
    }

    public function img($url, $width = null, $height = null) {
        return "</p>" . FileLibrary::imgTag($url, $width, $height) . "<p>";
    }

    public function par() {
        return "</" . end($this->_env) . ">" . "<" . end($this->_env) . ">";
    }

    public function env($envName) {
        return $this->closeenv() . $this->openenv($envName);
    }

    public function openenv($env) {
        array_push($this->_env, $env);
        return "<" . $env . ">";
    }

    public function closeenv() {
        return "</" . array_pop($this->_env) . ">";
    }

    public function closeAll() {
        $output = "";
        while (count($this->_env) > 0)
            $output .= $this->closeenv();
        return $output;
    }

    public function link($address, $_name = null) {
        $name = $_name;
        if ($name){
            foreach (array_slice(func_get_args(),1) as $value) {
                $name .= " ".$value;
            }
        } else {
            $name = $address;
        }
            
        return '<a href="' . $address . '">' . $name . '</a>';
    }

    public function youtube($address) {
        return '<iframe title="YouTube video'. 
            'player" class="youtube-player" type="text/html"'. 
            'width="400" height="300" src="' . $address . '"'.
            'frameborder="0" allowFullScreen></iframe>';
    }

}

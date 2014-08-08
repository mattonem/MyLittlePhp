<?php

class News extends \Model {

    protected static $collectionName = 'news';
    public $_env = array();
    
    public function description() {
        return array(
            TextElement::create('name', 'Name'),
            BooleanElement::create('published', 'Published'),
            TextLongElement::create('content', 'Content'),
        );
    }
    
    public function accept($visitor) {
        return $visitor->visitNews($this);
    }

    public function beforeSave() {
        if (!$this->getPublished()) {
            $this->setPublished(false);
        }
        if (!$this->getDate()) {
            $this->setDate(time());
        }
        parent::beforeSave();
    }

    public function getContentHtml() {
        return \Michelf\MarkdownExtra::defaultTransform($this->content);
    }

}

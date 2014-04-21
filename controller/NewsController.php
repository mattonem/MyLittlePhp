<?php

class NewsController extends Controller {

    public function defaultAction($args) {
        $this->redirect("News", "index");
    }

    static function indexArgs() {
        return array(
            "GET" => array(
                "page" => array(
                    "default" => 0,
                )
            ),
        );
    }

    function indexAction($args) {
        $query = array('conditions' => array('published=?', true));
        $total = News::count($query);
        $models = News::find('all', $query);
        $this->view("IndexView", array(
            "models" => $models,
            "page" => $args['page'],
            "total" => ceil($total / 5) - 1,
            "action" => "IndexAll",
        ));
    }

    static function indexAllArgs() {
        return array(
            "GET" => array(
                "page" => array(
                    "default" => 0,
                )
            ),
            'SESSION' => array(
                'user' => array(
                    'must' => function($user) {
                return $user->admin;
            },
                ),
            ),
            
        );
    }

    function indexAllAction($args) {
        $total = News::count(array());
        $models = News::findAll(array(), array('sort' => array('date' => 1), 'offset' => $args['page'] * 5, 'limit' => 5));
        $this->view("IndexView", array(
            "models" => $models,
            "page" => $args['page'],
            "total" => ceil($total / 5) - 1,
            "action" => "IndexAll",
        ));
    }

    static function viewArgs() {
        return array(
            "GET" => array(
                "id" => array(
                    "default" => false,
                )
            ),
            'SESSION' => array(
                'user' => array(
                    'may' => function($user) {
                        return $user->admin;
                    },
                ),
            ),
        );
    }

    function viewAction($args) {
        if (!$args["id"])
            return $this->redirect("News", "index");
        $model = News::find_by_pk($args["id"],array());
        if( !$args['user'] && !$model->published)
            throw new MyHttpException(403, "bad");
        $this->view("ViewView", $model);
    }

    static function editArgs() {
        return array(
            'GET' => array(
                'id' => array(
                    'required' => true,
                ),
            ),
            'POST' => array(
                'name' => array(
                    'default' => false,
                ),
                'content' => array(
                    'default' => false,
                ),
                'published' => array(
                    'default' => false,
                ),
            ),
            'SESSION' => array(
                'user' => array(
                    'must' => function($user) {
                return $user->admin;
            },
                ),
            ),
        );
    }

    function editAction($args) {
        $model = News::find_by_pk($args["id"], array());
        if (!($args["name"] || $args["content"]))
            return $this->view("EditView", $model);
        if ($args['name'])
            $model->name = $args["name"];
        if ($args['content'])
            $model->content = $args['content'];
        if ($args['published'])
            $model->published = true;
        else
            $model->published = false;
        $model->save();
        return $this->redirect("News", "view", array("id" => $model->id));
    }

    static function createArgs() {
        return array(
            'POST' => array(
                'name' => array(
                    'default' => false,
                ),
                'content' => array(
                    'default' => false,
                ),
                'published' => array(
                    'default' => false,
                ),
            ),
            'SESSION' => array(
                'user' => array(
                    'must' => function($user) {
                return $user->admin;
            },
                ),
            ),
        );
    }

    function createAction($args) {
        $model = new News();
        if (!($args["name"] || $args["content"]))
            return $this->view("CreateView", $model);
        if ($args['name'])
            $model->name = $args["name"];
        if ($args['content'])
            $model->content = $args['content'];
        if ($args['published'])
            $model->published = true;
        else
            $model->published = false;
        $model->save();
        return $this->redirect("News", "view", array("id" => $model->id));
    }
    
    static function searchArgs() {
        return array(
            "GET" => array(
                "keywords" => array(
                    "default" => false,
                )
            ),
            'SESSION' => array(
                'user' => array(
                    'may' => function($user) {
                        return $user->getAdmin();
                    },
                ),
            ),
        );
    }
    
    function searchAction($arg) {
        $words =  $arg["keywords"];
        if($arg['user'])
            $query = array();
        else
            $query = array('published' => true);
        $query['or'] = array('content' => array('regex' => '.*'."are".'.*'));
        var_dump($query);
        
        var_dump(News::count($query));
        $models = News::findAll(array(), array('sort' => array('date' => 1), 'offset' => $args['page'] * 5, 'limit' => 5));
        $this->view("IndexView", array(
            "models" => $models,
            "page" => $args['page'],
            "total" => ceil($total / 5) - 1,
            "action" => "IndexAll",
        ));
    }

}

?>

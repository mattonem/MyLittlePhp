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
        $total = News::count(array());
        $models = News::findAll(array('published' => true), array('sort' => array('date' => 1), 'offset' => $args['page'] * 5, 'limit' => 5));
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
                return $user->getAdmin();
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
                        return $user->getAdmin();
                    },
                ),
            ),
        );
    }

    function viewAction($args) {
        if (!$args["id"])
            return $this->redirect("News", "index");
        $model = News::findById($args["id"]);
        if(!$args['user'] && !$model->getPublished())
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
                return $user->getAdmin();
            },
                ),
            ),
        );
    }

    function editAction($args) {
        $model = News::findById($args["id"]);
        if (!($args["name"] || $args["content"]))
            return $this->view("EditView", $model);
        if ($args['name'])
            $model->setName($args["name"]);
        if ($args['content'])
            $model->setContent($args['content']);
        if ($args['published'])
            $model->setPublished(true);
        else
            $model->setPublished(false);
        $model->save();
        return $this->redirect("News", "view", array("id" => $model->getId()));
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
                return $user->getAdmin();
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
            $model->setName($args["name"]);
        if ($args['content'])
            $model->setContent($args['content']);
        $model->save();
        return $this->redirect("News", "view", array("id" => $model->getId()));
    }

}

?>

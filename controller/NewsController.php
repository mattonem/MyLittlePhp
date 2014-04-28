<?php

class NewsController extends Controller {

    /**
     * @Action
     */
    public function defaultAction($args) {
        $this->redirect("News", "index");
    }

    /**
     * @Action
     * @Requires(method='GET', name='page', requirement = @DefaultValue(value = 0))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function index($args) {
        $query = array('order' => 'date desc','limit' => 3,'offset' => 3*$args['page'] , 'conditions' => array('published=?', true));
        if($args['user'])
            $query['conditions'] = array();
        $total = News::count($query);
        $models = News::find('all', $query);
        $this->callView("IndexView", array(
            "models" => $models,
            "page" => $args['page'],
            "total" => ceil($total / 3) - 1,
            "action" => "index",
        ));
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='id', requirement = @DefaultValue(value = false))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function view($args) {
        if (!$args["id"])
            return $this->redirect("News", "index");
        $model = News::find_by_pk($args["id"],array());
        if( !$args['user'] && !$model->published)
            throw new MyHttpException(403, "bad");
        $this->callView("ViewView", $model);
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='id', requirement = @Required)
     * @Requires(method='POST', name='name', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='content', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='published', requirement = @DefaultValue(value = false))
     * @Requires(method='SESSION', name='user', requirement = @MustBeAdmin)
     */
    function edit($args) {
        $model = News::find_by_pk($args["id"], array());
        if (!($args["name"] || $args["content"]))
            return $this->callView("EditView", $model);
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

    /**
     * @Action
     * @Requires(method='POST', name='name', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='content', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='published', requirement = @DefaultValue(value = false))
     * @Requires(method='SESSION', name='user', requirement = @MustBeAdmin)
     */
    function create($args) {
        $model = new News();
        if (!($args["name"] || $args["content"]))
            return $this->callView("CreateView", $model);
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
    
    /**
     * @Requires(method = 'GET', name = 'keywords', requirement = @DefaultValue(value = false))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function search($arg) {
        $words =  $arg["keywords"];
        if($arg['user'])
            $query = array();
        else
            $query = array('published' => true);
        $query['or'] = array('content' => array('regex' => '.*'."are".'.*'));
        var_dump($query);
        
        var_dump(News::count($query));
        $models = News::findAll(array(), array('sort' => array('date' => 1), 'offset' => $args['page'] * 5, 'limit' => 5));
        $this->callView("IndexView", array(
            "models" => $models,
            "page" => $args['page'],
            "total" => ceil($total / 5) - 1,
            "action" => "IndexAll",
        ));
    }

}

?>

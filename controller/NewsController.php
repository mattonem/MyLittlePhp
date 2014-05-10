<?php

class NewsController extends Controller {

    /**
     * @Action
     */
    public function defaultAction() {
        $this->redirect("News", "index");
    }

    /**
     * @Action
     * @Requires(method='GET', name='page', requirement = @DefaultValue(value = 0))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function index($page, $user) {
        $query = array('order' => 'date desc','limit' => 3,'offset' => 3*$page , 'conditions' => array('published=?', true));
        if ($user) {
            $query['conditions'] = array();
        }
        $total = News::count($query);
        $models = News::find('all', $query);
        $this->callView("IndexView", array(
            "models" => $models,
            "page" => $page,
            "total" => ceil($total / 3) - 1,
            "action" => "index",
        ));
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='id', requirement = @DefaultValue(value = false))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function view($id, $user) {
        if (!$id) {
            return $this->redirect("News", "index");
        }
        $model = News::find_by_pk($id,array());
        if (!$user && !$model->published) {
            throw new MyHttpException(403, "bad");
        }
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
    function edit($id, $name, $content, $published) {
        $model = News::find_by_pk($id, array());
        if (!($name || $content)) {
            return $this->callView("EditView", $model);
        }
        if ($name) {
            $model->name = $name;
        }
        if ($content) {
            $model->content = $content;
        }
        if ($published) {
            $model->published = true;
        } else {
            $model->published = false;
        }
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
    function create($name, $content, $published) {
        $model = new News();
        if (!($name || $content)) {
            return $this->callView("CreateView", $model);
        }
        if ($name) {
            $model->name = $name;
        }
        if ($content) {
            $model->content = $content;
        }
        if ($published) {
            $model->published = true;
        } else {
            $model->published = false;
        }
        $model->save();
        return $this->redirect("News", "view", array("id" => $model->id));
    }
    
    /**
     * @Requires(method = 'GET', name = 'keywords', requirement = @DefaultValue(value = false))
     * @Requires(method = 'GET', name = 'page', requirement = @DefaultValue(value = 0))
     * @Requires(method='SESSION', name='user', requirement = @IsAdmin)
     */
    function search($keywords, $page, $user) {
        $words =  $keywords;
        if ($user) {
            $query = array();
        } else {
            $query = array('published' => true);
        }
        $query['or'] = array('content' => array('regex' => '.*'."are".'.*'));
        var_dump($query);
        
        var_dump(News::count($query));
        $models = News::findAll(array(), array('sort' => array('date' => 1), 'offset' => $page * 5, 'limit' => 5));
        $this->callView("IndexView", array(
            "models" => $models,
            "page" => $page,
            "total" => ceil($total / 5) - 1,
            "action" => "IndexAll",
        ));
    }

}

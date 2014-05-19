<?php
class TableController extends Controller {
    
    /**
     * @Action
     */
    public function defaultAction() {
        $this->redirect('Table', 'index');
    }
    
    /**
     * @Action
     */
    public function index() {
        $models = array(
            Designation::table(),
            C1C2::table(),
        );
        $this->callView('Index', $models);
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='table', requirement = @DefaultValue(value = false))
     */
    public function exploreTable($table) {
        $modelClass = ucfirst($table);
        $models = $modelClass::find('all');
        $this->callView('ExploreTable', $models);
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='table', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='Model', requirement = @DefaultValue(value = false))
     */
    public function editTable($table, $model) {
        $modelClass = ucfirst($table);
        if($model) {
            foreach ($model as $aModel) {
                if (isset($aModel['id']  ) && $aModel['id']) {
                    $model = $modelClass::find($aModel['id']);
                    $model->update_attributes($aModel);
                    $model->save();
                } else {
                    $new = false;
                    foreach ($aModel as $aField) {
                        if ($aField) {
                            $new = true;
                        }
                    }
                    if ($new) {
                        $model = $modelClass::create($aModel);
                        $model->save();
                    }
                }
            }
        }
        $models = $modelClass::find('all');
            
        $models[] = new $modelClass;
        $this->callView('EditTable', $models);
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='table', requirement = @DefaultValue(value = false))
     * @Requires(method='GET', name='id', requirement = @Required)
     */
    function deleteElement($table, $id) {
        $modelClass = ucfirst($table);
        $model = $modelClass::find($id);
        $model->delete();
        $this->redirect("Table", "editTable");
    }
}

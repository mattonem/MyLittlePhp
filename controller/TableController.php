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
     * @Requires(method='POST', name='Designation', requirement = @DefaultValue(value = false))
     */
    public function editTable($table, $designations) {
        $modelClass = ucfirst($table);
        if($designations) {
            foreach ($designations as $aDesignation) {
                if (isset($aDesignation['id']  ) && $aDesignation['id']) {
                    $model = $modelClass::find($aDesignation['id']);
                    $model->update_attributes($aDesignation);
                    $model->save();
                } else {
                    $new = false;
                    foreach ($aDesignation as $aField) {
                        if ($aField) {
                            $new = true;
                        }
                    }
                    if ($new) {
                        $model = $modelClass::create($aDesignation);
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

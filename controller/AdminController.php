<?php
/**
 * @Requires(method='SESSION', name='user', requirement = @MustBeAdmin)
 */
class AdminController extends Controller {
    
    /**
     * @Action
     */
    public function defaultAction() {
        $this->redirect("Admin", "sourceCode");
    }
    
    /**
     * @Action
     * @Requires(method='GET', name='perform', requirement = @DefaultValue(value = false))
     */
    public function sourceCode($perform) {
        $message = "";
        if ($perform) {
            switch ($perform) {
                case "update":
                    $message = shell_exec('git pull --ff-only 2>&1');
                    break;
                default:
                    break;
            }
        }
        $arr = array();
        exec('git log -1', $arr);
        $str = "";
        foreach ($arr as $string){
            $str .= $string.'</br>';
        }
        $this->callView("SourceCodeView", array(
            'commit' => $str,
            'message' => $message
            ));
    }
}

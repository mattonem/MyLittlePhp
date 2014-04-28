<?php

class AnonymousController extends Controller {
    
    /**
     * @Action
     */
    public function defaultAction($requete) {
        $this->redirect("News", "index", array("page" => 0));
    }
    
    /**
     * @Action
     * @Requires(method='POST', name='username', requirement = @DefaultValue(value = false))
     * @Requires(method='POST', name='password', requirement = @DefaultValue(value = false))
     * @Requires(method='SYS', name='msg', requirement = @DefaultValue(value = ''))
     */
    public function login($args) {
        if (!($args["username"] && $args["password"]))
            return $this->callView("LoginView", array(
                        'msg' => $args["msg"],
            ));
        $user = User::find_by_username_and_password($args['username'], $args['password']);
        if (!$user)
            return $this->redirect("Anonymous", "login", array(
                        "username" => false,
                        "password" => false,
                        "msg" => "Username or passwor incorrect.",
            ));
        $_SESSION['user'] = $user;
        return $this->redirect("Anonymous", "defaultAction");
    }
    
    /**
     * @Action
     */
    public function loggout() {
        session_destroy();
        session_start();
        $this->redirect("Anonymous", "defaultAction");
    }

}

?>

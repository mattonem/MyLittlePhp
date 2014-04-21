<?php

class AnonymousController extends Controller {

    public function defaultAction($requete) {
        $this->redirect("News", "index", array("page" => 0));
    }

    static function loginArgs() {
        return array(
            "POST" => array(
                "username" => array(
                    "default" => false
                ),
                "password" => array(
                    "default" => false
                ),
            ),
            "SYS" => array(
                "msg" => array(
                    "default" => "",
                ),
            ),
        );
    }

    public function loginAction($args) {
        if (!($args["username"] && $args["password"]))
            return $this->view("LoginView", array(
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
        return $this->redirect("Anonymous", "default");
    }

    public function loggoutAction() {
        session_destroy();
        $this->redirect("Anonymous", "default");
    }

}

?>

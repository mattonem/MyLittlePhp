<?php

class AnonymousController extends Controller {

    public function defaultAction($requete) {
        $this->redirect("News", "index");
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
        $user = User::findOne(array(
                    'username' => $args["username"],
                    'password' => $args["password"],
                ));
        if (!$user)
            return $this->redirect("Anonymous", "login", array(
                "username" => false,
                "password" => false,
                "msg" => "Username or passwor incorrect.",
            ));
        $_SESSION['user'] = $user;
        return $this->redirect("News", "index");
    }

}

?>

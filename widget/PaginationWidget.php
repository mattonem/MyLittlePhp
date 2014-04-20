<?php

class PaginationWidget extends Widget {

    public function render() {
        $args = func_get_args();
        $controller = $args[0];
        $action = $args[1];
        $total = $args[2];
        $params = $args[3];
        $output = "";
        if ($params['page'] > 0) {
            $firsturl = Controller::urlFor($controller, $action, array_merge($params, array('page' => 0)));
            $output .= '<a href="' . $firsturl . '"><<--</a> |';

            $prevurl = Controller::urlFor($controller, $action, array_merge($params, array('page' => $params['page'] - 1)));
            $output .= ' <a href="' . $prevurl . '"><-</a> ';
        }
        $output .= "|";
        if ($params['page'] < $total) {
            $nexturl = Controller::urlFor($controller, $action, array_merge($params, array('page' => $params['page'] + 1)));
            $output .= ' <a href="' . $nexturl . '">-></a> |';

            $lasturl = Controller::urlFor($controller, $action, array_merge($params, array('page' => $total)));
            $output .= ' <a href="' . $lasturl . '">-->></a>';
        }
        if($output =="|")
            return ;
        return "<div class='text-center text-muted'>" . $output . "</div>";
    }

}

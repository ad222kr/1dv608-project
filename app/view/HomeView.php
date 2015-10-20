<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-19
 * Time: 15:15
 */

namespace view;


class HomeView implements IView{

    public function render() {
        return "<p>Welcome to my app!</p>";
    }
}
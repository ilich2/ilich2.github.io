<?php

class BaseView
{
    public function generate($view, $data = []) {
        include PATH.'/application/views/template.php';
    }
}
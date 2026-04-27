<?php

require_once __DIR__ . '/View.php';

class Controller
{
    public function view(string $view, array $data = [])
    {
        View::render($view, $data);
    }
}

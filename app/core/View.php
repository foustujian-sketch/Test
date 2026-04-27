<?php

class View
{
    public static function render(string $view, array $data = [])
    {
        // Extract data array so variables are accessible in the view
        extract($data, EXTR_SKIP);
        
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($viewPath);
            exit;
        }

        require $viewPath;
    }
}

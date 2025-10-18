<?php

namespace App\Core;

class Controller {

    protected function view(string $view, array $data = []): void {
        extract($data);
        $viewFile = __DIR__ . "/../Views/{$view}.php";

        if(file_exists($viewFile)) {
            require $viewFile;
        } 
        else {
            echo "View '{$view}' não encontrada!";
        }
    }

    protected function redirect(string $url): void {
        header("Location: {$url}");
        exit;
    }

    protected function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

}
<?php
class Controller {
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    protected function view($viewName, $data = []) {
        // 将数据提取为变量
        extract($data);
        
        // 包含视图文件
        $viewFile = "views/{$viewName}.php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("视图文件 {$viewFile} 不存在");
        }
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    protected function input($key, $default = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $_POST[$key] ?? $default;
        }
        return $_GET[$key] ?? $default;
    }
    
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            
            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field] = "{$field} 是必填字段";
                continue;
            }
            
            if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "{$field} 格式不正确";
            }
            
            if (preg_match('/min:(\d+)/', $rule, $matches)) {
                $min = (int)$matches[1];
                if (strlen($value) < $min) {
                    $errors[$field] = "{$field} 至少需要 {$min} 个字符";
                }
            }
            
            if (preg_match('/max:(\d+)/', $rule, $matches)) {
                $max = (int)$matches[1];
                if (strlen($value) > $max) {
                    $errors[$field] = "{$field} 最多 {$max} 个字符";
                }
            }
        }
        
        return $errors;
    }
}
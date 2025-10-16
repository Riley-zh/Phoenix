<?php
class Controller {
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
        
        // 启动会话（如果尚未启动）
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // 设置安全头信息
        $this->setSecurityHeaders();
    }
    
    private function setSecurityHeaders() {
        // 防止XSS攻击
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        
        // 内容安全策略
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; font-src 'self' https://cdn.jsdelivr.net https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self';");
    }
    
    protected function view($viewName, $data = []) {
        // 将数据提取为变量
        extract($data);
        
        // 包含视图文件
        $viewFile = "views/{$viewName}.php";
        if (file_exists($viewFile)) {
            // 开始输出缓冲
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
            
            // 渲染布局文件
            $layoutFile = 'views/layout/app.php';
            if (file_exists($layoutFile)) {
                require_once $layoutFile;
            } else {
                echo $content;
            }
        } else {
            http_response_code(404);
            die("视图文件 {$viewFile} 不存在");
        }
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    protected function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
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
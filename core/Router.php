<?php
class Router {
    private $routes = [];
    
    public function add($route, $controller) {
        $this->routes[$route] = $controller;
    }
    
    public function dispatch($url) {
        // 移除末尾的斜杠
        $url = rtrim($url, '/');
        if (empty($url)) {
            $url = '/';
        }
        
        // 首先尝试精确匹配
        if (isset($this->routes[$url])) {
            $this->callController($this->routes[$url], []);
            return;
        }
        
        // 然后尝试参数匹配
        foreach ($this->routes as $route => $controller) {
            $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $route);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';
            
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // 移除完整匹配
                $this->callController($controller, $matches);
                return;
            }
        }
        
        // 没有找到匹配的路由
        $this->show404();
    }
    
    private function callController($controllerAction, $params) {
        list($controllerName, $actionName) = explode('@', $controllerAction);
        
        $controllerFile = "controllers/{$controllerName}.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    call_user_func_array([$controller, $actionName], $params);
                } else {
                    $this->show404();
                }
            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }
    
    private function show404() {
        http_response_code(404);
        echo "<h1>404 - 页面未找到</h1>";
        echo "<p>抱歉，您访问的页面不存在。</p>";
        echo "<a href='/'>返回首页</a>";
    }
}
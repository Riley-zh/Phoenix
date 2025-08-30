<?php
require_once 'models/User.php';

class HomeController extends Controller {
    
    public function index() {
        $userModel = new User();
        $userCount = $userModel->count();
        
        $data = [
            'title' => '欢迎使用 PHP MVC 项目',
            'userCount' => $userCount
        ];
        
        $this->view('home/index', $data);
    }
}
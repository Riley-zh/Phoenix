<?php
require_once 'models/User.php';

class UserController extends Controller {
    
    public function index() {
        $userModel = new User();
        $users = $userModel->all();
        
        $data = [
            'title' => '用户管理',
            'users' => $users
        ];
        
        $this->view('users/index', $data);
    }
    
    public function create() {
        $data = [
            'title' => '创建用户'
        ];
        
        $this->view('users/create', $data);
    }
    
    public function store() {
        // 检查请求方法
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/users/create');
            return;
        }
        
        // 验证CSRF令牌
        $csrfToken = $this->input('csrf_token');
        if (!$this->validateCSRFToken($csrfToken)) {
            $_SESSION['error'] = '无效的请求，请重试';
            $this->redirect('/users/create');
            return;
        }
        
        $userData = [
            'name' => trim($this->input('name', '')),
            'email' => trim($this->input('email', '')),
            'age' => (int)$this->input('age', 0)
        ];
        
        // 验证数据
        $errors = $this->validate($userData, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            'age' => 'required'
        ]);
        
        // 检查邮箱是否已存在
        if (empty($errors)) {
            $userModel = new User();
            $existingUser = $userModel->getByEmail($userData['email']);
            if ($existingUser && !empty($existingUser['id'])) {
                $errors['email'] = '该邮箱地址已被使用';
            }
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $userData;
            $this->redirect('/users/create');
            return;
        }
        
        $userData['created_at'] = date('Y-m-d H:i:s');
        
        try {
            $userModel = new User();
            $userId = $userModel->create($userData);
            if ($userId) {
                $_SESSION['success'] = '用户创建成功！';
                $this->redirect('/users');
            } else {
                throw new Exception('创建用户失败');
            }
        } catch (Exception $e) {
            error_log("创建用户失败: " . $e->getMessage());
            $_SESSION['error'] = '创建用户失败，请稍后重试';
            $this->redirect('/users/create');
        }
    }
    
    public function edit($id) {
        // 验证ID参数
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error'] = '无效的用户ID';
            $this->redirect('/users');
            return;
        }
        
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            $_SESSION['error'] = '用户不存在';
            $this->redirect('/users');
            return;
        }
        
        $data = [
            'title' => '编辑用户',
            'user' => $user
        ];
        
        $this->view('users/edit', $data);
    }
    
    public function update($id) {
        // 检查请求方法
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect("/users/edit/{$id}");
            return;
        }
        
        // 验证ID参数
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error'] = '无效的用户ID';
            $this->redirect('/users');
            return;
        }
        
        // 验证CSRF令牌
        $csrfToken = $this->input('csrf_token');
        if (!$this->validateCSRFToken($csrfToken)) {
            $_SESSION['error'] = '无效的请求，请重试';
            $this->redirect("/users/edit/{$id}");
            return;
        }
        
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            $_SESSION['error'] = '用户不存在';
            $this->redirect('/users');
            return;
        }
        
        $userData = [
            'name' => trim($this->input('name', '')),
            'email' => trim($this->input('email', '')),
            'age' => (int)$this->input('age', 0)
        ];
        
        // 验证数据
        $errors = $this->validate($userData, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            'age' => 'required'
        ]);
        
        // 检查邮箱是否被其他用户使用
        if (empty($errors)) {
            $existingUser = $userModel->getByEmail($userData['email']);
            if ($existingUser && $existingUser['id'] != $id) {
                $errors['email'] = '该邮箱地址已被其他用户使用';
            }
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $userData;
            $this->redirect("/users/edit/{$id}");
            return;
        }
        
        $userData['updated_at'] = date('Y-m-d H:i:s');
        
        try {
            $result = $userModel->update($id, $userData);
            if ($result !== false) {
                $_SESSION['success'] = '用户更新成功！';
                $this->redirect('/users');
            } else {
                throw new Exception('更新用户失败');
            }
        } catch (Exception $e) {
            error_log("更新用户失败: " . $e->getMessage());
            $_SESSION['error'] = '更新用户失败，请稍后重试';
            $this->redirect("/users/edit/{$id}");
        }
    }
    
    public function delete($id) {
        // 验证ID参数
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error'] = '无效的用户ID';
            $this->redirect('/users');
            return;
        }
        
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            $_SESSION['error'] = '用户不存在';
            $this->redirect('/users');
            return;
        }
        
        try {
            $userModel->delete($id);
            $_SESSION['success'] = '用户删除成功！';
        } catch (Exception $e) {
            $_SESSION['error'] = '删除用户失败：' . $e->getMessage();
        }
        
        $this->redirect('/users');
    }
}
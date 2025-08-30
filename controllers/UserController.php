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
        $userData = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'age' => $this->input('age')
        ];
        
        // 验证数据
        $errors = $this->validate($userData, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            'age' => 'required'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $userData;
            $this->redirect('/users/create');
            return;
        }
        
        $userModel = new User();
        $userData['created_at'] = date('Y-m-d H:i:s');
        
        try {
            $userModel->create($userData);
            $_SESSION['success'] = '用户创建成功！';
            $this->redirect('/users');
        } catch (Exception $e) {
            $_SESSION['error'] = '创建用户失败：' . $e->getMessage();
            $this->redirect('/users/create');
        }
    }
    
    public function edit($id) {
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
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            $_SESSION['error'] = '用户不存在';
            $this->redirect('/users');
            return;
        }
        
        $userData = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'age' => $this->input('age')
        ];
        
        // 验证数据
        $errors = $this->validate($userData, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            'age' => 'required'
        ]);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $userData;
            $this->redirect("/users/edit/{$id}");
            return;
        }
        
        $userData['updated_at'] = date('Y-m-d H:i:s');
        
        try {
            $userModel->update($id, $userData);
            $_SESSION['success'] = '用户更新成功！';
            $this->redirect('/users');
        } catch (Exception $e) {
            $_SESSION['error'] = '更新用户失败：' . $e->getMessage();
            $this->redirect("/users/edit/{$id}");
        }
    }
    
    public function delete($id) {
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
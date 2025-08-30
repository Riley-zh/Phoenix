<?php
require_once 'models/User.php';

class ApiController extends Controller {
    
    public function users() {
        try {
            $userModel = new User();
            $users = $userModel->all();
            
            $this->json([
                'success' => true,
                'data' => $users,
                'total' => count($users)
            ]);
        } catch (Exception $e) {
            $this->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
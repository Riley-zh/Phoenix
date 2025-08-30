<?php
class User extends Model {
    protected $table = 'users';
    
    public function getByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->db->fetchOne($sql, [$email]);
    }
    
    public function getRecentUsers($limit = 10) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }
    
    public function searchByName($name) {
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE ?";
        return $this->db->fetchAll($sql, ["%{$name}%"]);
    }
}
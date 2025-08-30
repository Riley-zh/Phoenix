<?php
class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->fetchAll($sql);
    }
    
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->fetchOne($sql, [$id]);
    }
    
    public function create($data) {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $this->db->query($sql, $data);
        
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $fields = [];
        foreach (array_keys($data) as $field) {
            $fields[] = "{$field} = :{$field}";
        }
        $fields = implode(', ', $fields);
        
        $sql = "UPDATE {$this->table} SET {$fields} WHERE {$this->primaryKey} = :id";
        $data['id'] = $id;
        
        return $this->db->execute($sql, $data);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->execute($sql, [$id]);
    }
    
    public function where($field, $operator, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} ?";
        return $this->db->fetchAll($sql, [$value]);
    }
    
    public function count() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $result = $this->db->fetchOne($sql);
        return $result['count'];
    }
}
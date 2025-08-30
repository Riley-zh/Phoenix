CREATE DATABASE IF NOT EXISTS php_project CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE php_project;

-- 创建用户表
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    age INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 插入示例数据
INSERT INTO users (name, email, age) VALUES 
('张三', 'zhangsan@example.com', 25),
('李四', 'lisi@example.com', 30),
('王五', 'wangwu@example.com', 28),
('赵六', 'zhaoliu@example.com', 35);

-- 显示创建的表结构
DESCRIBE users;

-- 显示插入的数据
SELECT * FROM users;
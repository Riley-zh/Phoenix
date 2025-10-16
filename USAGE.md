# PHP MVC 项目使用指南

## 🎉 项目已成功创建并运行！

您的PHP MVC项目已经完整搭建完成，**数据库已成功初始化**，包含以下功能：

### ✅ 已完成的功能

1. **完整的MVC架构**
   - 控制器 (Controllers)
   - 模型 (Models) 
   - 视图 (Views)

2. **用户管理系统**
   - 用户列表查看
   - 添加新用户
   - 编辑用户信息
   - 删除用户

3. **现代化界面**
   - Bootstrap 5 响应式设计
   - 美观的图标和样式
   - 用户友好的交互

4. **数据库功能**
   - PDO数据库连接
   - 完整的CRUD操作
   - 数据验证
   - 性能优化（包含索引以提高查询速度）

5. **RESTful API**
   - JSON格式的API接口
   - 错误处理

## 🚀 快速启动

### 方法1: 使用启动脚本
双击 `start.bat` 文件即可启动项目

### 方法2: 手动启动
在项目目录下运行：
```bash
php -S localhost:8000
```

## 🔧 数据库配置

**好消息**: 数据库已经成功初始化！

如果您需要修改数据库连接信息，可以编辑 `config/config.php` 文件。

当前配置：
- 数据库名: php_project
- 用户名: root  
- 密码: 000000
- 已包含 4 个示例用户数据

## 📱 访问项目

项目启动后，您可以访问以下页面：

- **首页**: http://localhost:8000
- **用户管理**: http://localhost:8000/users
- **API接口**: http://localhost:8000/api/users

## 🎯 主要特性

### 路由系统
- 支持参数路由 `/users/edit/{id}`
- 自动控制器调用
- 404错误处理

### 数据验证
- 必填字段验证
- 邮箱格式验证
- 字符长度限制
- 自动错误消息显示

### 响应式设计
- 适配手机、平板、桌面
- 现代化Bootstrap界面
- 丰富的图标支持

### 性能优化
- 数据库查询优化
- 使用索引提高查询速度
- 输出缓冲减少内存使用

### 安全特性
- PDO预处理语句防SQL注入
- XSS防护
- 会话管理
- CSRF保护（所有表单都包含CSRF令牌验证）
- 安全头信息（Content-Security-Policy等）

## 🛠️ 开发指南

### 添加新功能
1. 创建模型文件 (`models/`)
2. 创建控制器 (`controllers/`)
3. 创建视图文件 (`views/`)
4. 在 `index.php` 添加路由

### 数据库操作
使用模型类的方法：
```php
$userModel = new User();
$users = $userModel->all();           // 获取所有
$user = $userModel->find(1);          // 根据ID查找
$id = $userModel->create($data);      // 创建新记录
$userModel->update($id, $data);       // 更新记录
$userModel->delete($id);              // 删除记录
```

## 📁 项目结构
```
project/
├── config/          # 配置文件
├── core/            # 核心类库
├── controllers/     # 控制器
├── models/          # 数据模型
├── views/           # 视图模板
├── database/        # 数据库脚本
├── index.php        # 入口文件
├── .htaccess        # Apache重写规则
├── start.bat        # 启动脚本
└── README.md        # 说明文档
```

## 🔍 常见问题

**Q: 如何修改数据库配置？**
A: 编辑 `config/config.php` 文件中的数据库常量

**Q: 如何添加新的页面？**
A: 1) 创建控制器方法 2) 创建视图文件 3) 在index.php添加路由

**Q: 如何自定义样式？**
A: 修改视图文件中的CSS类或添加自定义样式

**Q: 如何部署到生产环境？**
A: 1) 上传所有文件 2) 配置Web服务器 3) 修改config.php中的配置

## 📞 技术支持

如果您在使用过程中遇到问题：
1. 检查PHP和数据库是否正确安装
2. 确认数据库连接配置正确
3. 查看浏览器控制台错误信息
4. 检查PHP错误日志

祝您使用愉快！ 🎉
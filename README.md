# PHP MVC 项目

这是一个使用现代化 PHP MVC 架构构建的完整项目，包含用户管理功能。

## 项目特性

- **MVC 架构**: 清晰的模型-视图-控制器分离
- **路由系统**: 灵活的URL路由管理
- **数据库抽象**: PDO数据库连接和操作
- **数据验证**: 完整的表单数据验证
- **响应式设计**: Bootstrap 5 现代化界面
- **RESTful API**: JSON API接口支持
- **会话管理**: 完整的会话和消息系统

## 项目结构

```
project/
├── config/                 # 配置文件
│   └── config.php          # 主配置文件
├── core/                   # 核心类
│   ├── Controller.php      # 基础控制器
│   ├── Database.php        # 数据库类
│   ├── Model.php          # 基础模型
│   └── Router.php         # 路由器
├── controllers/            # 控制器
│   ├── ApiController.php   # API控制器
│   ├── HomeController.php  # 首页控制器
│   └── UserController.php  # 用户控制器
├── models/                 # 模型
│   └── User.php           # 用户模型
├── views/                  # 视图
│   ├── layout/            # 布局文件
│   │   └── app.php        # 主布局
│   ├── home/              # 首页视图
│   │   └── index.php      # 首页
│   └── users/             # 用户视图
│       ├── index.php      # 用户列表
│       ├── create.php     # 创建用户
│       └── edit.php       # 编辑用户
├── database/               # 数据库文件
│   └── init.sql           # 初始化脚本
├── index.php              # 入口文件
└── README.md              # 说明文档
```

## 安装和配置

### 1. 环境要求

- PHP 7.4 或更高版本
- MySQL 5.7 或更高版本
- Web服务器 (Apache/Nginx) 或 PHP内置服务器

### 2. 数据库配置

1. 创建数据库并导入初始化脚本：
```sql
mysql -u root -p < database/init.sql
```

2. 修改 `config/config.php` 中的数据库连接信息：
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_project');
define('DB_USER', 'root');
define('DB_PASS', '你的密码');
```

### 3. 启动项目

使用PHP内置服务器：
```bash
php -S localhost:8000
```

或者配置Apache/Nginx指向项目根目录。

### 4. 访问项目

打开浏览器访问：`http://localhost:8000`

## 功能说明

### 路由

项目支持以下路由：

- `GET /` - 首页
- `GET /users` - 用户列表
- `GET /users/create` - 创建用户页面
- `POST /users/store` - 保存用户
- `GET /users/edit/{id}` - 编辑用户页面
- `POST /users/update/{id}` - 更新用户
- `GET /users/delete/{id}` - 删除用户
- `GET /api/users` - 获取用户JSON数据

### API接口

项目提供RESTful API接口：

```bash
# 获取所有用户
GET /api/users

# 返回格式
{
    "success": true,
    "data": [...],
    "total": 4
}
```

### 数据验证

支持的验证规则：
- `required` - 必填字段
- `email` - 邮箱格式
- `min:n` - 最小长度
- `max:n` - 最大长度

## 扩展开发

### 添加新模型

1. 在 `models/` 目录创建新模型类
2. 继承 `Model` 基类
3. 设置 `$table` 属性

```php
class Product extends Model {
    protected $table = 'products';
}
```

### 添加新控制器

1. 在 `controllers/` 目录创建控制器
2. 继承 `Controller` 基类
3. 在 `index.php` 中添加路由

```php
class ProductController extends Controller {
    public function index() {
        // 控制器逻辑
    }
}
```

### 添加新视图

1. 在 `views/` 目录创建视图文件
2. 使用布局系统
3. 在控制器中调用视图

```php
$this->view('products/index', $data);
```

## 许可证

本项目采用 MIT 许可证。
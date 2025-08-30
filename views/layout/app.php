<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="fade-in">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-code-slash me-2"></i>
                <?php echo APP_NAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="切换导航">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/home') ? 'active' : ''; ?>" href="/">
                            <i class="bi bi-house me-1"></i> 首页
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/users') === 0) ? 'active' : ''; ?>" href="/users">
                            <i class="bi bi-people me-1"></i> 用户管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/users" target="_blank">
                            <i class="bi bi-cloud me-1"></i> API文档
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear me-1"></i> 设置
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>个人资料</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-palette me-2"></i>主题设置</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- 消息提示 -->
        <div class="alert-container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>成功！</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="关闭"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>错误！</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="关闭"></button>
                </div>
            <?php endif; ?>
        </div>

        <!-- 页面内容 -->
        <main>
            <?php echo $content ?? ''; ?>
        </main>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start text-center">
                    <p class="mb-0">
                        <i class="bi bi-heart-fill text-danger me-1"></i>
                        &copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. 使用 PHP MVC 架构构建
                    </p>
                </div>
                <div class="col-md-6 text-md-end text-center">
                    <p class="mb-0">
                        <a href="https://github.com" class="text-decoration-none me-3" target="_blank">
                            <i class="bi bi-github me-1"></i>GitHub
                        </a>
                        <a href="#" class="text-decoration-none me-3">
                            <i class="bi bi-book me-1"></i>文档
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="bi bi-question-circle me-1"></i>帮助
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 添加页面加载动画
        document.addEventListener('DOMContentLoaded', function() {
            // 为表格行添加悬停效果
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
            
            // 为卡片添加点击反馈
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('a, button')) {
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });
        });
    </script>
</body>
</html>
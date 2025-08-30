<?php
ob_start();
?>

<?php
ob_start();
?>

<div class="row">
    <div class="col-12">
        <div class="jumbotron fade-in">
            <div class="text-center mb-4">
                <i class="bi bi-rocket-takeoff icon-large icon-primary"></i>
                <h1 class="display-4">
                    欢迎使用 PHP MVC 项目
                </h1>
                <p class="lead">这是一个使用现代化 PHP MVC 架构构建的项目，包含完整的用户管理功能。</p>
                <hr class="my-4">
                <p class="mb-4">您可以开始探索这个项目的功能，或者查看用户管理模块。</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a class="btn btn-primary btn-lg" href="/users" role="button">
                        <i class="bi bi-people me-2"></i>
                        用户管理
                    </a>
                    <a class="btn btn-outline-primary btn-lg" href="/api/users" target="_blank" role="button">
                        <i class="bi bi-cloud me-2"></i>
                        API 接口
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 g-4">
    <div class="col-md-4">
        <div class="stats-card primary">
            <div class="card-body text-center">
                <i class="bi bi-people-fill icon-large icon-primary"></i>
                <h5 class="card-title mt-3 mb-3">用户管理</h5>
                <div class="mb-3">
                    <span class="badge bg-primary fs-6 px-3 py-2"><?php echo $userCount; ?> 个用户</span>
                </div>
                <p class="card-text text-muted">完整的用户 CRUD 操作，支持数据验证和安全管理</p>
                <div class="d-grid gap-2">
                    <a href="/users" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-1"></i>查看用户
                    </a>
                    <a href="/users/create" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>添加用户
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card success">
            <div class="card-body text-center">
                <i class="bi bi-gear-fill icon-large icon-success"></i>
                <h5 class="card-title mt-3 mb-3">MVC 架构</h5>
                <div class="mb-3">
                    <span class="badge bg-success fs-6 px-3 py-2">现代化</span>
                </div>
                <p class="card-text text-muted">采用现代化的 MVC 设计模式，代码结构清晰，易于扩展</p>
                <div class="d-grid gap-2">
                    <a href="#architecture" class="btn btn-outline-success">
                        <i class="bi bi-diagram-3 me-1"></i>架构图
                    </a>
                    <a href="#" class="btn btn-success">
                        <i class="bi bi-book me-1"></i>文档说明
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card warning">
            <div class="card-body text-center">
                <i class="bi bi-database-fill icon-large icon-warning"></i>
                <h5 class="card-title mt-3 mb-3">数据库集成</h5>
                <div class="mb-3">
                    <span class="badge bg-warning fs-6 px-3 py-2">PDO</span>
                </div>
                <p class="card-text text-muted">完整的数据库 CRUD 操作和 PDO 连接，安全防注入</p>
                <div class="d-grid gap-2">
                    <a href="/api/users" class="btn btn-outline-warning" target="_blank">
                        <i class="bi bi-cloud me-1"></i>API 示例
                    </a>
                    <a href="#" class="btn btn-warning">
                        <i class="bi bi-shield-check me-1"></i>安全特性
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-stars me-2"></i>项目特性
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-check-circle-fill me-2"></i>核心功能
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>MVC 架构模式</strong> - 清晰的代码分层
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>路由系统</strong> - 灵活的URL管理
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>数据库抽象层</strong> - PDO 安全连接
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>数据验证</strong> - 完整的表单验证
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-palette-fill me-2"></i>用户体验
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>响应式设计</strong> - 适配所有设备
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>Bootstrap 5 界面</strong> - 现代化设计
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>RESTful API</strong> - 标准化接口
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-arrow-right text-success me-2"></i>
                                <strong>会话管理</strong> - 安全的用户状态
                            </li>
                        </ul>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-code-slash text-primary fs-1"></i>
                            <h6 class="mt-2 mb-0">清晰代码</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-shield-check text-success fs-1"></i>
                            <h6 class="mt-2 mb-0">安全防护</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-speedometer2 text-warning fs-1"></i>
                            <h6 class="mt-2 mb-0">高性能</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <i class="bi bi-puzzle text-info fs-1"></i>
                            <h6 class="mt-2 mb-0">易扩展</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 架构图表区域 -->
<div class="row mt-5" id="architecture">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-diagram-3 me-2"></i>MVC 架构概览
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <div class="p-4 border rounded-3 h-100 bg-primary bg-opacity-10">
                            <i class="bi bi-eye text-primary fs-1 mb-3"></i>
                            <h5 class="text-primary">View (视图)</h5>
                            <p class="text-muted mb-0">负责展示数据和用户界面，使用 Bootstrap 和自定义 CSS</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 border rounded-3 h-100 bg-success bg-opacity-10">
                            <i class="bi bi-gear text-success fs-1 mb-3"></i>
                            <h5 class="text-success">Controller (控制器)</h5>
                            <p class="text-muted mb-0">处理用户请求，调用模型和视图，实现业务逻辑</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 border rounded-3 h-100 bg-warning bg-opacity-10">
                            <i class="bi bi-database text-warning fs-1 mb-3"></i>
                            <h5 class="text-warning">Model (模型)</h5>
                            <p class="text-muted mb-0">管理数据存储和业务规则，使用 PDO 进行数据库操作</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'views/layout/app.php';
?>
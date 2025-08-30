<?php
ob_start();
?>

<div class="d-flex justify-content-between align-items-center mt-4 mb-4">
    <div>
        <h2 class="mb-1">
            <i class="bi bi-people text-primary me-2"></i>用户管理
        </h2>
        <p class="text-muted mb-0">管理系统中的所有用户信息</p>
    </div>
    <div class="d-flex gap-2">
        <a href="/users/create" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i> 添加用户
        </a>
        <button class="btn btn-outline-secondary" onclick="location.reload()">
            <i class="bi bi-arrow-clockwise me-1"></i> 刷新
        </button>
    </div>
</div>

<!-- 统计卡片 -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center border-0 bg-primary bg-opacity-10">
            <div class="card-body">
                <i class="bi bi-people-fill text-primary fs-2"></i>
                <h4 class="mt-2 mb-1 text-primary"><?php echo count($users); ?></h4>
                <p class="text-muted mb-0">总用户数</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center border-0 bg-success bg-opacity-10">
            <div class="card-body">
                <i class="bi bi-person-check-fill text-success fs-2"></i>
                <h4 class="mt-2 mb-1 text-success"><?php echo count(array_filter($users, function($user) { return $user['age'] >= 18; })); ?></h4>
                <p class="text-muted mb-0">成年用户</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center border-0 bg-info bg-opacity-10">
            <div class="card-body">
                <i class="bi bi-envelope-fill text-info fs-2"></i>
                <h4 class="mt-2 mb-1 text-info"><?php echo count(array_unique(array_column($users, 'email'))); ?></h4>
                <p class="text-muted mb-0">邮箱数量</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center border-0 bg-warning bg-opacity-10">
            <div class="card-body">
                <i class="bi bi-clock-fill text-warning fs-2"></i>
                <h4 class="mt-2 mb-1 text-warning">今日</h4>
                <p class="text-muted mb-0">最近更新</p>
            </div>
        </div>
    </div>
</div>

<?php if (empty($users)): ?>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="bi bi-person-x text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 mb-3">暂无用户数据</h4>
                    <p class="text-muted mb-4">系统中还没有任何用户信息，请先添加一些用户。</p>
                    <a href="/users/create" class="btn btn-primary btn-lg">
                        <i class="bi bi-person-plus me-2"></i>创建第一个用户
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-table me-2"></i>用户列表
                </h5>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="搜索用户..." id="userSearch">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="usersTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">
                                <i class="bi bi-hash"></i>
                            </th>
                            <th>
                                <i class="bi bi-person me-1"></i>姓名
                            </th>
                            <th>
                                <i class="bi bi-envelope me-1"></i>邮箱
                            </th>
                            <th class="text-center">
                                <i class="bi bi-calendar me-1"></i>年龄
                            </th>
                            <th class="text-center">
                                <i class="bi bi-clock me-1"></i>创建时间
                            </th>
                            <th class="text-center" style="width: 160px;">
                                <i class="bi bi-gear me-1"></i>操作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr class="user-row">
                                <td class="text-center">
                                    <span class="badge bg-light text-dark"><?php echo $user['id']; ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary text-white me-3">
                                            <?php echo strtoupper(mb_substr($user['name'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope text-muted me-2"></i>
                                        <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($user['email']); ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?php echo $user['age'] >= 18 ? 'bg-success' : 'bg-warning'; ?>">
                                        <?php echo htmlspecialchars($user['age']); ?> 岁
                                    </span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?php echo isset($user['created_at']) ? date('Y-m-d', strtotime($user['created_at'])) : '未知'; ?>
                                        <br>
                                        <i class="bi bi-clock me-1"></i>
                                        <?php echo isset($user['created_at']) ? date('H:i', strtotime($user['created_at'])) : '--:--'; ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="/users/edit/<?php echo $user['id']; ?>" 
                                           class="btn btn-outline-primary" 
                                           title="编辑用户">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/users/delete/<?php echo $user['id']; ?>" 
                                           class="btn btn-outline-danger"
                                           title="删除用户"
                                           onclick="return confirm('确定要删除用户 <?php echo htmlspecialchars($user['name']); ?> 吗？此操作不可恢复！')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    共找到 <strong><?php echo count($users); ?></strong> 个用户
                </small>
                <div class="d-flex gap-2">
                    <a href="/users/create" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus me-1"></i>添加新用户
                    </a>
                    <a href="/api/users" class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="bi bi-download me-1"></i>导出JSON
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once 'views/layout/app.php';
?>

<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
}

.user-row:hover {
    background-color: #f8f9fa;
    transform: translateX(2px);
}

.user-row {
    transition: all 0.2s ease;
}

.btn-group .btn {
    border-radius: 6px;
    margin: 0 1px;
}

@media (max-width: 768px) {
    .btn-group {
        display: flex;
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 1px 0;
        font-size: 0.8rem;
    }
}
</style>

<script>
// 用户搜索功能
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearch');
    const userTable = document.getElementById('usersTable');
    
    if (searchInput && userTable) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = userTable.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>
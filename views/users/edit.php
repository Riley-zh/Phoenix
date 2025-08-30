<?php
ob_start();
$errors = $_SESSION['errors'] ?? [];
$oldInput = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div class="row mt-4">
    <div class="col-md-8 mx-auto">
        <!-- 页面标题 -->
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-circle bg-primary text-white mx-auto" style="width: 80px; height: 80px; font-size: 2rem;">
                    <?php echo strtoupper(mb_substr($user['name'], 0, 1)); ?>
                </div>
            </div>
            <h2 class="mb-2">编辑用户</h2>
            <p class="text-muted">修改 <strong><?php echo htmlspecialchars($user['name']); ?></strong> 的信息</p>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>编辑用户信息
                </h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="/users/update/<?php echo $user['id']; ?>" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person me-1"></i>姓名 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" 
                                       id="name" 
                                       name="name" 
                                       value="<?php echo htmlspecialchars($oldInput['name'] ?? $user['name']); ?>"
                                       placeholder="请输入真实姓名"
                                       required>
                                <?php if (isset($errors['name'])): ?>
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        <?php echo $errors['name']; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>请输入2-50个字符的真实姓名
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="age" class="form-label">
                                    <i class="bi bi-calendar me-1"></i>年龄 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control <?php echo isset($errors['age']) ? 'is-invalid' : ''; ?>" 
                                       id="age" 
                                       name="age" 
                                       min="1" 
                                       max="120"
                                       value="<?php echo htmlspecialchars($oldInput['age'] ?? $user['age']); ?>"
                                       placeholder="请输入年龄"
                                       required>
                                <?php if (isset($errors['age'])): ?>
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        <?php echo $errors['age']; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>请输入1-120之间的数字
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i>邮箱地址 
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="email" 
                                   class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                                   id="email" 
                                   name="email" 
                                   value="<?php echo htmlspecialchars($oldInput['email'] ?? $user['email']); ?>"
                                   placeholder="example@domain.com"
                                   required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    <?php echo $errors['email']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>请输入有效的邮箱地址，将用于联系和通知
                        </div>
                    </div>

                    <!-- 用户信息 -->
                    <div class="alert alert-light border">
                        <h6 class="alert-heading">
                            <i class="bi bi-info-circle me-2"></i>用户信息
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="bi bi-person-badge me-1"></i>
                                    用户ID: <strong>#<?php echo $user['id']; ?></strong>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    创建时间: <strong><?php echo isset($user['created_at']) ? date('Y-m-d H:i:s', strtotime($user['created_at'])) : '未知'; ?></strong>
                                </small>
                            </div>
                        </div>
                        <?php if (isset($user['updated_at']) && $user['updated_at'] != $user['created_at']): ?>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-pencil me-1"></i>
                                    最后更新: <strong><?php echo date('Y-m-d H:i:s', strtotime($user['updated_at'])); ?></strong>
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="/users" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> 返回列表
                        </a>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-warning">
                                <i class="bi bi-arrow-clockwise me-1"></i> 重置
                            </button>
                            <a href="/users/delete/<?php echo $user['id']; ?>" 
                               class="btn btn-outline-danger"
                               onclick="return confirm('确定要删除用户 <?php echo htmlspecialchars($user['name']); ?> 吗？此操作不可恢复！')">
                                <i class="bi bi-trash me-1"></i> 删除用户
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-lg me-1"></i> 更新用户
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- 帮助信息 -->
        <div class="mt-4">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-lightbulb me-2"></i>编辑提示
                    </h6>
                    <p class="card-text text-muted mb-0">
                        修改用户信息时，请确保所有数据真实有效。邮箱地址不能与其他用户重复。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
</style>

<?php
$content = ob_get_clean();
require_once 'views/layout/app.php';
?>
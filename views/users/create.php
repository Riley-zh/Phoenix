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
                <i class="bi bi-person-plus-fill text-primary" style="font-size: 3rem;"></i>
            </div>
            <h2 class="mb-2">创建新用户</h2>
            <p class="text-muted">填写下方表单来添加一个新的用户到系统中</p>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-form me-2"></i>用户信息表单
                </h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="/users/store" novalidate>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken(); ?>">
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
                                       value="<?php echo htmlspecialchars($oldInput['name'] ?? ''); ?>"
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
                                       value="<?php echo htmlspecialchars($oldInput['age'] ?? ''); ?>"
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
                                   value="<?php echo htmlspecialchars($oldInput['email'] ?? ''); ?>"
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

                    <div class="alert alert-info">
                        <i class="bi bi-lightbulb me-2"></i>
                        <strong>提示：</strong>请确保所有信息真实有效，标有 <span class="text-danger">*</span> 的字段为必填项。
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="/users" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> 返回列表
                        </a>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-warning">
                                <i class="bi bi-arrow-clockwise me-1"></i> 重置
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> 创建用户
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
                        <i class="bi bi-question-circle me-2"></i>需要帮助？
                    </h6>
                    <p class="card-text text-muted mb-0">
                        如果您在填写表单时遇到问题，请检查输入格式是否正确。所有数据将安全存储在数据库中。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'views/layout/app.php';
?>
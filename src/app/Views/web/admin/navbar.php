<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">後台管理</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link toggle-bar" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i> User
                </a>
                <div class="dropdown-menu dropdown-menu-right text-right">
                    <a class="dropdown-item" href="#">基本資料設定</a>
                    <a class="dropdown-item" href="#">登出</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<aside class="aside">
    <ul class="sidebar">
        <?php foreach ($menus as $menu): ?>
            <li class="sidebar-item">
                <a 
                    <?php if ($menu['route'] != '#'): ?>
                        href="<?= site_url($menu['route']) ?>"
                    <?php else: ?>
                        href="#"
                    <?php endif; ?> 
                    <?php if (!empty($menu['child'])): ?>
                        class="drop-link"
                    <?php endif; ?>
                    target="<?= $menu['target'] ?>"
                    id="menu-<?= $menu['id'] ?>"
                >
                    <i class="<?= $menu['icon'] ?>"></i>
                    <?= $menu['title']['zh-TW'] ?>
                </a>
                <?php if (!empty($menu['child'])): ?>
                    <ul class="drop-block">
                        <?php foreach($menu['child'] as $child): ?>
                            <li>
                                <a 
                                    <?php if ($child['route'] != '#'): ?>
                                        href="<?= site_url($child['route']) ?>"
                                    <?php else: ?>
                                        href="#"
                                    <?php endif; ?>
                                    target="<?= $child['target'] ?>"
                                >
                                    <i class="<?= $child['icon'] ?>"></i>
                                    <?= $child['title']['zh-TW'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        
    </ul>
</aside>


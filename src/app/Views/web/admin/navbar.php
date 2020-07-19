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
        <li class="sidebar-item"><a href="#"><i class="fas fa-tachometer-alt"></i> DashBoard</a></li>
        <li class="sidebar-item">
            <a href="#" class="drop-link" >
                <i class="fab fa-blogger-b"></i>
                部落格管理
            </a>
            <ul class="drop-block" id="blog">
                <li><a href="#">文章管理</a></li>
                <li><a href="#">頁面管理</a></li>
                <li><a href="#">分類管理</a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="drop-link">
                <i class="fas fa-tools"></i>
                系統設定
            </a>
            <ul class="drop-block" id="system">
                <li><a href="#">基本設定</a></li>
            </ul>
        </li>
    </ul>
</aside>

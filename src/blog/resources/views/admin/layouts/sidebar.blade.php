<div class="sidebar-left open" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        @if (Auth::guard('admin')->user()->role_id == config('define.superAdmin'))
            <li class="nav-item {{ Request::is('adminpanel/dashboard') || Request::is('adminpanel/dashboard/*') ? "active" : "" }}">
                <a class="nav-item-hold" href="{{ route("dashboard.index") }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle">
                </div>
            </li>
        @endif
        <li class="nav-item {{ Request::is('adminpanel/users') || Request::is('adminpanel/users/*') ? "active" : "" }}">
            <a class="nav-item-hold" href="{{ route("users.index") }}">
                <i class="nav-icon i-Administrator"></i>
                <span class="nav-text">Manage User</span>
            </a>
            <div class="triangle">
            </div>
        </li>
        <li class="nav-item {{ Request::is('adminpanel/categories') || Request::is('adminpanel/categories/*') ? "active" : "" }}" >
            <a class="nav-item-hold" href="{{ route('categories.index') }}">
                <i class="nav-icon i-Suitcase"></i>
                <span class="nav-text">Manage Category</span>
            </a>
            <div class="triangle">
            </div>
        </li>
        <li class="nav-item {{ Request::is('adminpanel/books') || Request::is('adminpanel/books/*') ? "active" : "" }}">
            <a class="nav-item-hold" href="{{ route('books.index') }}">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Manage Book</span>
            </a>
            <div class="triangle">
            </div>
        </li>
        <li class="nav-item {{ Request::is('adminpanel/contacts-admin') || Request::is('adminpanel/contacts-admin/*') ? "active" : "" }}">
            <a class="nav-item-hold" href="{{ route('contacts-admin.index') }}">
                <i class="nav-icon i-File-Clipboard-File--Text"></i>
                <span class="nav-text">Manage Contact</span>
            </a>
            <div class="triangle">
            </div>
        </li>
        <li class="nav-item {{ Request::is('adminpanel/comments') || Request::is('adminpanel/comments/*') ? "active" : "" }}">
            <a class="nav-item-hold" href="{{ route('comments.index') }}">
                <i class="nav-icon i-File-Horizontal-Text"></i>
                <span class="nav-text">Manage Comment</span>
            </a>
            <div class="triangle">
            </div>
        </li>
        @if (Auth::guard('admin')->user()->role_id == config('define.superAdmin'))
            <li class="nav-item {{ Request::is('adminpanel/maintenances') || Request::is('adminpanel/maintenances/*') ? "active" : "" }}"">
                <a class="nav-item-hold" href="{{ route('maintenances.index') }}">
                    <i class="nav-icon i-Double-Tap"></i>
                    <span class="nav-text">Maintenance</span>
                </a>
                <div class="triangle">
                </div>
            </li>
        @endif
    </ul>
</div>
<div class="sidebar-overlay">
</div>

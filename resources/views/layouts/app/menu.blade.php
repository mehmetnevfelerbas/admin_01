<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <span class="align-middle">mehmet deneme</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menüler
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

     
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('profile.edit') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profilim</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('blog') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blog & Haber</span>
                </a>
            </li>

        


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('settings.index') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Ayarlar</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('users') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Kullanıcı Yönetimi</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
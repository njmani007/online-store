<ul class="nav flex-column">

    <li class="nav-item mb-2">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line me-2"></i> Dashboard
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.books.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
            <i class="fa-solid fa-book-open me-2"></i> Manage Books
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.categories.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags me-2"></i> Manage Categories
        </a>
    </li>

</ul>

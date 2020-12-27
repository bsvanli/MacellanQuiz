<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName() == 'panel.home') active @endif" href="{{ route('panel.home') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(in_array(Route::currentRouteName(), ['panel.category.all'])) active @endif" href="{{ route('panel.category.all') }}">
                    <span data-feather="folder-plus"></span>
                    Kategoriler
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(in_array(Route::currentRouteName(), ['panel.product.all'])) active @endif" href="{{ route('panel.product.all') }}">
                    <span data-feather="shopping-cart"></span>
                    Ürünler
                </a>
            </li>
        </ul>

    </div>
</nav>

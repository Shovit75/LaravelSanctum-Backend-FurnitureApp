<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/paperman.jpg">
            </div>
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ __('CMS System') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'furniture' ? 'active' : '' }}">
                <a href="{{ route('furniture.index') }}">
                    <i class="nc-icon nc-basket"></i>
                    <p>{{ __('Furniture') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'category' ? 'active' : '' }}">
                <a href="{{ route('category.index') }}">
                    <i class="nc-icon nc-ruler-pencil"></i>
                    <p>{{ __('Categories') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'subcategory' ? 'active' : '' }}">
                <a href="{{ route('subcategory.index') }}">
                    <i class="nc-icon nc-planet"></i>
                    <p>{{ __('Sub-Categories') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'trustedpartners' ? 'active' : '' }}">
                <a href="{{ route('trustedpartners.index') }}">
                    <i class="nc-icon nc-world-2"></i>
                    <p>{{ __('Trusted Partners') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'checkout' ? 'active' : '' }}">
                <a href="{{ route('checkout.index') }}">
                    <i class="nc-icon nc-cart-simple"></i>
                    <p>{{ __('Checkout') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>
                            {{ __('User Section') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        @can('superadmin_permissions')
                        <li class="{{ $elementActive == 'webusers' ? 'active' : '' }}">
                            <a href="{{ route('webusers.index') }}">
                                <span class="sidebar-mini-icon">{{ __('W') }}</span>
                                <span class="sidebar-normal">{{ __(' Webusers ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'permissions' ? 'active' : '' }}">
                            <a href="{{ route('permissions.index') }}">
                                <span class="sidebar-mini-icon">{{ __('P') }}</span>
                                <span class="sidebar-normal">{{ __(' Permissions ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'roles' ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}">
                                <span class="sidebar-mini-icon">{{ __('R') }}</span>
                                <span class="sidebar-normal">{{ __(' Roles ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'users' ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <span class="sidebar-mini-icon">{{ __('UM') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @can('superadmin_permissions')
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>

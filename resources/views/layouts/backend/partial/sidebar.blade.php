<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('storage/profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Admin Navigation -->
            @if (Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/resort*') ? 'active' : '' }}">
                    <a href="{{ route('admin.resort.index') }}">
                        <i class="material-icons">beach_access</i>
                        <span>Resorts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/event*') ? 'active' : '' }}">
                    <a href="{{ route('admin.event.index') }}">
                        <i class="material-icons">event</i>
                        <span>Events</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tourist*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tourist.index') }}">
                        <i class="material-icons">map</i>
                        <span>Tourists Spot</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/hotline*') ? 'active' : '' }}">
                    <a href="{{ route('admin.hotline.index') }}">
                        <i class="material-icons">call</i>
                        <span>Hotlines</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="material-icons">label</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="header">SYSTEM</li>
                <li class="{{ Request::is('admin/account*') ? 'active' : '' }}">
                    <a href="{{ route('admin.account.index') }}">
                        <i class="material-icons">supervisor_account</i>
                        <span>Manage Accounts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/archive*') ? 'active' : '' }}">
                    <a href="{{ route('admin.archive.index') }}">
                        <i class="material-icons">archive</i>
                        <span>Archives</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif
            <!-- Owner Navigation -->
            @if (Request::is('owner*'))
                <li class="{{ Request::is('owner/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('owner.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('owner/resort*') || Request::is('owner/image*') ? 'active' : '' }}">
                    <a href="{{ route('owner.resort.index') }}">
                        <i class="material-icons">beach_access</i>
                        <span>Resorts</span>
                    </a>
                </li>
                <li class="header">SYSTEM</li>
                <li class="{{ Request::is('owner/profile*') ? 'active' : '' }}">
                    <a href="{{ route('owner.profile.index') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif

            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>

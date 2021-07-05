<li class="nav-item ">
    <a href="{{ route('cp.users.index') }}" class="nav-link {{ Request::is('cp/users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            @lang('Users')
        </p>
        <span class="pull-right-container">
          <small class="label pull-right bg-red">*</small>
        </span>
    </a>
</li>

<li class="nav-item ">
    <a href="{{ route('cp.topics.index') }}" class="nav-link {{ Request::is('cp/topics*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            @lang('Topics')
        </p>
        <span class="pull-right-container">
          <small class="label pull-right bg-red">*</small>
        </span>
    </a>
</li>


<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('account') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('account*') ? 'active' : '' }}">Account</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('company*') ? 'active' : '' }}">Company Profile</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('category*') ? 'active' : '' }}">Category</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('expert*') ? 'active' : '' }}">Expert</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('viewlog*') ? 'active' : '' }}">View Log</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('sumarylog*') ? 'active' : '' }}">Sumary Log</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('company') }}" class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('consultant*') ? 'active' : '' }}">Consultant Manager</a>
        </li>
    </ul>
</div>

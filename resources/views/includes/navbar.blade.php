<div class="collapse navbar-collapse" id="navbarNavDropdown">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a href="{{ url('company') }}"
				class="nav-link btn btn-outline-secondary mx-2 {{ Request::is('company') ? 'active' : '' }}">Company
				Profile</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-secondary mx-2{{ Request::is('company') ? 'active' : '' }}"
				href="{{ url('company') }}">Category</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-secondary mx-2{{ Request::is('company') ? 'active' : '' }}"
				href="{{ url('company') }}">Expert</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-secondary mx-2{{ Request::is('company') ? 'active' : '' }}"
				href="{{ url('company') }}">View Log</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-secondary mx-2{{ Request::is('company') ? 'active' : '' }}"
				href="{{ url('company') }}">Sumary Log</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-outline-secondary mx-2{{ Request::is('company') ? 'active' : '' }}"
				href="{{ url('company') }}">Consultant Manager</a>
		</li>
	</ul>
</div>
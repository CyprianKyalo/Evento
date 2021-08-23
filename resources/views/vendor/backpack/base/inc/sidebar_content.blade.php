<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">	
		<a href="#" class="nav-link nav-dropdown-toggle"><i class="nav-icon la la-table"></i>Tables</a>
		<ul class="nav-dropdown-items">
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i> Users</a></li>
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon la la-question'></i> Products</a></li>
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('userproduct') }}'><i class='nav-icon la la-question'></i> Userproducts</a></li>
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('hiredproduct') }}'><i class='nav-icon la la-question'></i> Hiredproducts</a></li>
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('role') }}'><i class='nav-icon la la-users'></i> Roles</a></li>
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('permission') }}'><i class='nav-icon la la-key'></i> Permissions</a></li>

		</ul>
</li>	


<li class='nav-item'><a class='nav-link' href='{{ backpack_url('charts') }}'><i class='nav-icon la la-signal'></i> Charts</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
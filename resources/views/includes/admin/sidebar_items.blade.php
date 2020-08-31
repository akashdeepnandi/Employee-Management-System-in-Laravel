<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-check-o"></i>
        <p>
            Employees
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">3</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Add Employee</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>List Employees</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.attendance') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Attendance</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-unlock-alt"></i>
        <p>
            Authorization
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Leaves</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Expenses</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Holidays
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Add Holiday</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>List Holidays</p>
            </a>
        </li>
    </ul>
</li>
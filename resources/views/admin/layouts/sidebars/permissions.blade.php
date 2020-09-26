<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Permissions
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
      <a href="{{route('admin.list.permissions')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>List Permissions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.add.permission')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Add Permission</p>
        </a>
      </li>
    </ul>
  </li>

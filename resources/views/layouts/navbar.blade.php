<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">جدول المحاضرات</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">الرئيسية</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              المنتجات
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
              <li><a class="dropdown-item" href="#">قائمة المنتجات</a></li>
              <li><a class="dropdown-item" href="#">إضافة منتج</a></li>
              <li><a class="dropdown-item" href="#">طباعة باركود</a></li>
            </ul>
          </li> --}}

          <li class="nav-item active">
            <a class="nav-link" href="{{route('departments.index')}}">الاقسام</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('teachers.index')}}">التدريسيين</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('materials.index')}}">المواد الدراسية</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('schedules.index')}}">جدول الحصص</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('users.index')}}">المستخدمين</a>
          </li>
        
       
        </ul>
      </div>
    </div>
  </nav>
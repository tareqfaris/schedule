@extends('layouts.blank')
@section('links')
<li class="breadcrumb-item active" aria-current="page">لوحة البيانات</li>
@endsection
@section('title')
    لوحة البيانات
@endsection
@section('content')
<div class="mt-1">
     <div class="row">
        <div class="col card text-white bg-primary mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header text-center">الاقسام</div>
            <div class="card-body">
              <h3 class="card-title text-center">{{\App\Models\Department::count()}}</h3>
            </div>
          </div>
          <div class=" col card text-white bg-secondary mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header text-center">التدريسيين</div>
            <div class="card-body">
                <h3 class="card-title text-center">{{\App\Models\Teacher::count()}}</h3>
            </div>
          </div>
          <div class=" col card text-white bg-success mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header text-center">المواد</div>
            <div class="card-body">
                <h3 class="card-title text-center">{{\App\Models\Material::count()}}</h3>
            </div>
          </div>
          <div class=" col card text-white bg-dark mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header text-center">الجداول</div>
            <div class="card-body">
                <h3 class="card-title text-center">{{\App\Models\Schedule::count()}}</h3>
            </div>
          </div>
     </div>

   
    <h5>إختصارات سريعة</h5>
    <hr>
    <div class="row mt-1">
        {{-- <a class="col-2" href="{{route('prod.index')}}">
            <div class="menu-item">
                <img src="{{asset('img/box.png')}}" alt="">
                <h5>المنتجات</h5>
            </div>
        </a> --}}
    </div>

</div>


@endsection



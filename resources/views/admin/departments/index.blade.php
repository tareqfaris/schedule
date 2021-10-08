
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            الاقسام والكليات
        </h2>
    </x-slot>
  
    <div class="p-3">
        <a href="{{route('departments.create')}}" class="btn btn-sm btn-primary">إضافة قسم جديد</a>
    </div>
    <div class="mt-3 bg-light">
        <table class="table table-striped table-inverse table-responsive table-bordered table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>الشعار</th>
                    <th>اسم القسم</th>
                    <th>وصف القسم</th>
                    <th>التدريسيين</th>
                    <th>المواد</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td> <img src="{{asset('uploads/departments/'.$item->logo)}}" width="30"  alt=""></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->teacher_count}}</td>
                    <td>{{$item->material_count}}</td>
                    <td class="d-flex">
                        <a href="{{route('departments.edit',$item->id)}}" class="btn btn-warning btn-sm m-1">تعديل</a>
                        <form action="{{route('departments.destroy',$item->id)}}" method="post" id="delForm-{{$item->id}}">
                            @csrf
                            @method('delete')
                        </form>
                        <button href="{{route('departments.edit',$item->id)}}" class="btn btn-danger btn-sm delete m-1"
                            id="{{$item->id}}">حذف</button>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
        {{$departments->links()}}
    </div>
     
    @section('scripts')
    <script>
        $(document).ready(function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            $('.delete').click(function () {
                var id = $(this).attr('id');
                if (confirm('هل انت متأكد من حذف  القسم')) {
                    $('#delForm-' + id).submit();
                }
            });
        });
    
    </script>
    @endsection
  </x-app-layout>


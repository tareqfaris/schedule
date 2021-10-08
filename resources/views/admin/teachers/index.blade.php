<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           الكادر التدريسي
        </h2>
    </x-slot>

    <div class="p-3">
        <a href="{{route('teachers.create')}}" class="btn btn-sm btn-primary">إضافة تدريسي</a>
    </div>
    <div class="mt-3 bg-light">
        <table class="table table-striped table-inverse table-responsive table-bordered table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>صورة</th>
                    <th>اسم التدريسي</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td> <img src="{{asset('uploads/teachers/'.$item->logo)}}" width="30"  alt=""></td>
                    <td>{{$item->name}}</td>
                    <td class="d-flex">
                        <a href="{{route('teachers.edit',$item->id)}}" class="btn btn-warning btn-sm m-1">تعديل</a>
                        <form action="{{route('teachers.destroy',$item->id)}}" method="post" id="delForm-{{$item->id}}">
                            @csrf
                            @method('delete')
                        </form>
                        <button href="{{route('teachers.edit',$item->id)}}" class="btn btn-danger btn-sm delete m-1"
                            id="{{$item->id}}">حذف</button>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
        {{$teachers->links()}}
    </div>
    
</x-app-layout>
 
@section('scripts')
<script>
    $(document).ready(function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $('.delete').click(function () {
            var id = $(this).attr('id');
            if (confirm('هل انت متأكد من حذف  التدريسي')) {
                $('#delForm-' + id).submit();
            }
        });
    });

</script>
@endsection

 
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            المواد الدراسية
        </h2>
    </x-slot>

    <div class="p-3">
        <a href="{{route('materials.create')}}" class="btn btn-sm btn-primary">إضافة مادة</a>
    </div>
    <div class="mt-3 bg-light">
        <table class="table table-striped table-inverse table-responsive table-bordered table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>اسم المادة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td class="d-flex">
                        <a href="{{route('materials.edit',$item->id)}}" class="btn btn-warning btn-sm m-1">تعديل</a>
                        <form action="{{route('materials.destroy',$item->id)}}" method="post" id="delForm-{{$item->id}}">
                            @csrf
                            @method('delete')
                        </form>
                        <button href="{{route('materials.edit',$item->id)}}" class="btn btn-danger btn-sm delete m-1"
                            id="{{$item->id}}">حذف</button>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
        {{$materials->links()}}
    </div>
</x-app-layout>
@section('content')

 
@section('scripts')
<script>
    $(document).ready(function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $('.delete').click(function () {
            var id = $(this).attr('id');
            if (confirm('هل انت متأكد من حذف المادة')) {
                $('#delForm-' + id).submit();
            }
        });
    });

</script>
@endsection

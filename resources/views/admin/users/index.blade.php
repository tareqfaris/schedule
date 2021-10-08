<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
          مستخدمي النظام
        </h2>
    </x-slot>

    <div class="p-3">
        <a href="{{route('users.create')}}" class="btn btn-sm btn-primary">إضافة مستخدم</a>
    </div>
    <div class="mt-3 bg-light">
        <table class="table table-striped table-inverse table-responsive table-bordered table-hover">
            <thead class="thead-inverse">
                <tr class="text-center">
                    <th>#</th>
                    <th>صورة</th>
                    <th>اسم المستخدم</th>
                    <th>البريد  الالكتروني</th>
                    <th>الصلاحيات</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr class="text-center">
                    <td scope="row">{{$item->id}}</td>
                    <td>  <img class="rounded-circle" width="50" height="50" src="{{ $item->profile_photo_url }}" alt="{{ Auth::user()->name }}" /></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$levels[$item->level]}}</td>
                    <td class="d-flex">
                        <a href="{{route('users.edit',$item->id)}}" class="btn btn-warning btn-sm m-1">تعديل</a>

                        <form action="{{route('users.destroy',$item->id)}}" method="post" id="delForm-{{$item->id}}">
                            @csrf
                            @method('delete')
                        </form>
                        <button   class="btn btn-danger btn-sm delete m-1"
                            id="{{$item->id}}">حذف</button>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
        {{$users->links()}}
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
                if (confirm('هل انت متأكد من حذف  المستخدم')) {
                    $('#delForm-' + id).submit();
                }
            });
        });
    
    </script>
    @endsection
 
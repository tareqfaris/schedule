
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            المقالات والاخبار
        </h2>
    </x-slot>
  
    <div class="p-3">
        <a href="{{route('articles.create')}}" class="btn btn-sm btn-primary">إضافة مقال جديد</a>
    </div>
    <div class="mt-3 bg-light">
        <table class="table table-striped table-inverse table-responsive table-bordered table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>تأريخ  الاضافة</th>
                    <th>الناشر</th>
                    <th>القسم</th>
                    <th>المرحلة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{@$item->user->name}}</td>
                    <td>

                       @if ($item->department_id==0)
                           <span>جميع الاقسام</span>
                           @else  
                           {{@$item->department->name}}
                       @endif

                    </td>
                    <td>

                        @if ($item->section_id ==0)
                          <span>جميع المراحل</span>
                          @else 
                          {{$sections[$item->section_id]}}
                            
                        @endif
                    </td>
                    <td class="d-flex">
                        <a href="{{route('articles.edit',$item->id)}}" class="btn btn-warning btn-sm m-1">تعديل</a>
                        <form action="{{route('articles.destroy',$item->id)}}" method="post" id="delForm-{{$item->id}}">
                            @csrf
                            @method('delete')
                        </form>
                        <button href="{{route('articles.edit',$item->id)}}" class="btn btn-danger btn-sm delete m-1"
                            id="{{$item->id}}">حذف</button>
                    </td>
                </tr>
                @endforeach
    
    
            </tbody>
        </table>
        {{$articles->links()}}
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
                if (confirm('هل انت متأكد من حذف  المقال')) {
                    $('#delForm-' + id).submit();
                }
            });
        });
    
    </script>
    @endsection
  </x-app-layout>


 <x-app-layout>
     <x-slot name="header">
         <h2 class="h4 font-weight-bold">
             جدول الحصص
         </h2>
     </x-slot>

     <div class="bg-light">
         <div class="p-3 d-print-none">
             <a href="{{route('schedules.create')}}" class="btn btn-sm btn-primary">إضافة جدول</a>
         </div>
         @php
         
         function is_now($start,$end){
         $is_now=false;
         $start = $start;
            $end   =$end;
            $now   = \Carbon\Carbon::now();
            $time  = $now->format('H:i');

            if ($time >= $start && $time <= $end) {
                $is_now=true;
            }
         
         
         return $is_now; 
        
        } 
         
         
         @endphp <div class="mt-3 bg-light">
             <div>
                 <form class="form-inline d-flex  d-print-none" action="">
                     <input type="hidden" name="day" value="{{$day}}">
                     <div class="form-group m-2">
                         <select class="form-control" name="section_id" id="">
                             <option value="0">كل المراحل</option>
                             @foreach ($sections as $key=>$item)
                             <option value="{{$key}}" @if (Request::get('section_id')==$key) selected @endif>{{$item}}
                             </option>
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group m-2">
                         <select class="form-control" name="department_id" id="">
                             <option value="0">كل الاقسام</option>
                             @foreach (\App\Models\Department::get() as $item)
                             <option value="{{$item->id}}" @if (Request::get('department_id')==$item->id) selected
                                 @endif>{{$item->name}}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group m-2">
                         <select class="form-control" name="material_id" id="">
                             <option value="0">كل المواد</option>
                             @foreach (\App\Models\Material::get() as $item)
                             <option value="{{$item->id}}" @if (Request::get('material_id')==$item->id) selected
                                 @endif>{{$item->name}}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group m-2">
                         <select class="form-control" name="teacher_id" id="">
                             <option value="0">كل التدريسيين</option>
                             @foreach (\App\Models\Teacher::get() as $item)
                             <option value="{{$item->id}}" @if (Request::get('teacher_id')==$item->id) selected
                                 @endif>{{$item->name}}</option>
                             @endforeach
                         </select>
                     </div>
                     <button type="submit" class="btn btn-primary m-2">إستعلام</button>
                 </form>
             </div>
             <div class="m-2 d-print-none">
                 @foreach ($days as $key=>$item)
                 @if ($day == $key)
                 <a class="btn btn-info">{{$item}}</a>
                 @else
                 <a href="?day={{$key}}" class="btn btn-outline-info">{{$item}}</a>
                 @endif

                 @endforeach
             </div>

             <table class="table table-striped table-inverse table-bordered table-hover">
                 <thead class="thead-inverse text-center">
                     <tr>
                         <th>#</th>
                         <th>اليوم</th>
                         <th>المرحلة</th>
                         <th>الشعبة</th>
                         <th>رقم القاعة</th>
                         <th>المادة</th>
                         <th>التدريسي</th>
                         <th>القسم</th>
                         <th>وقت البدء</th>
                         <th>وقت الانتهاء</th>
                         <th class="d-print-none">إجراءات</th>
                     </tr>
                 </thead>
                 <tbody class="text-center">
                     @foreach ($schedules as $item)
                     <tr>
                         <td scope="row">
                             @if (is_now($item->time_start,$item->time_end) && $day==$item->day)
                             <i class="fas fa-circle-notch fa-spin text-danger"></i>
                             
                             @endif
                            
                            {{$item->id}}</td>
                         <td>{{$days[$item->day]}}</td>
                         <td>{{$sections[$item->section_id]}}</td>
                         <td>{{@$item->class}}</td>
                         <td>{{@$item->class_id}}</td>
                         <td>{{@$item->material->name}}</td>
                         <td>{{@$item->teacher->name}}</td>
                         <td>{{@$item->department->name}}</td>
                         <td class="text-success">{{@$item->time_start}}</td>
                         <td class="text-danger">{{@$item->time_end}}</td>
                         <td class="d-flex d-print-none">
                             <a href="{{route('schedules.edit',$item->id)}}"
                                 class="btn btn-warning btn-sm m-1">تعديل</a>
                             <form action="{{route('schedules.destroy',$item->id)}}" method="post"
                                 id="delForm-{{$item->id}}">
                                 @csrf
                                 @method('delete')
                             </form>
                             <button href="{{route('schedules.edit',$item->id)}}"
                                 class="btn btn-danger btn-sm delete m-1" id="{{$item->id}}">حذف</button>
                         </td>
                     </tr>
                     @endforeach


                 </tbody>
             </table>
             {{$schedules->links()}}
     </div>
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
             if (confirm('هل انت متأكد من حذف المادة')) {
                 $('#delForm-' + id).submit();
             }
         });
     });

 </script>
 @endsection

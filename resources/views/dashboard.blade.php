<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            لوحة البيانات
        </h2>
    </x-slot>

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
   
      
       <h5>جدول اليوم</h5>
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
       
       
       @endphp
       <hr>
       <div class="row mt-1">
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
                </tr>
                @endforeach


            </tbody>
        </table>
       </div>
   
   </div>
</x-app-layout>
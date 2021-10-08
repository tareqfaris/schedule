<x-app-layout>
  <x-slot name="header">
      <h2 class="h4 font-weight-bold">
          إضافة جدول حصص جديد
      </h2>
  </x-slot>

  <div class="p-3 bg-light">
    @php
        $allow=true;
    @endphp
    @if (\App\Models\Teacher::count() ==0)
    <div class="alert alert-danger" role="alert">
        <strong>تنبيه !</strong>
        يجب إضافة تدريسي واحد على الاقل للتمكن من إضافة جدول الحصص 
        <b><a href="{{route('teachers.create')}}">إضفط هنا للاضافة</a></b>
    </div>
    @php
        $allow=false;
    @endphp
    @endif
    @if (\App\Models\Department::count() ==0)
    <div class="alert alert-danger" role="alert">
        <strong>تنبيه !</strong>
        يجب إضافة قسم واحد على الاقل للتمكن من إضافة جدول الحصص 
        <b><a href="{{route('departments.create')}}">إضفط هنا للاضافة</a></b>
    </div>
    @php
    $allow=false;
    @endphp
    @endif
    @if (\App\Models\Material::count() ==0)
    <div class="alert alert-danger" role="alert">
        <strong>تنبيه !</strong>
        يجب إضافة مادة واحدة على الاقل للتمكن من إضافة جدول الحصص 
        <b><a href="{{route('materials.create')}}">إضفط هنا للاضافة</a></b>
    </div>
    @php
    $allow=false;
    @endphp
    @endif
    @if ($allow)
       <form action="{{route('schedules.store')}}" method="post" enctype="multipart/form-data">
     @csrf
     <div class="form-group">
       <label for="">رقم القاعة</label>
       <input type="text"
         class="form-control" name="class_id" id="" aria-describedby="helpId" placeholder="">
     </div>
     <div class="form-group">
       <label for="">المرحلة</label>
       <select class="form-control" name="section_id" id="">
          @foreach ($sections as $key=>$item)
              <option value="{{$key}}">{{$item}}</option>
          @endforeach
       </select>
     </div>
     <div class="form-group">
       <label for="">الشعبة</label>
       <input type="text"
         class="form-control" name="class" id="" aria-describedby="helpId" placeholder="">
     </div>
     <div class="form-group">
       <label for="">اليوم</label>
       <select class="form-control" name="day" id="">
           @for ($i = 0; $i < 7; $i++)
            <option value="{{ \Carbon\Carbon::now()->subDays($i)->format('N')}}">{{ \Carbon\Carbon::now()->subDays($i)->translatedFormat('l')}}</option>
           @endfor
       </select>
     </div>
     <div class="form-group">
       <label for="">القسم</label>
       <select class="form-control" name="department_id" id="">
           @foreach (\App\Models\Department::get() as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>  
           @endforeach
       </select>
     </div>
     <div class="form-group">
       <label for="">التدريسي</label>
       <select class="form-control" name="teacher_id" id="">
           @foreach (\App\Models\Teacher::get() as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>  
           @endforeach
       </select>
     </div>
     <div class="form-group">
       <label for="">المادة</label>
       <select class="form-control" name="material_id" id="">
           @foreach (\App\Models\Material::get() as $item)
               <option value="{{$item->id}}">{{$item->name}}</option>  
           @endforeach
       </select>
     </div>
     <div class="form-group">
       <label for="">وقت البدء</label>
       <input type="text"
         class="form-control timepicker"   name="time_start" id="" aria-describedby="helpId" placeholder="">
     </div>
     <div class="form-group">
       <label for="">وقت الانتهاء</label>
       <input type="text"
         class="form-control timepicker"   name="time_end" id="" aria-describedby="helpId" placeholder="">
     </div>
     <hr>
     <button type="submit" class="btn btn-primary">حفظ</button>
     <a href="{{route('schedules.index')}}" class="btn btn-secondary">إلغاء</a>

    </form> 
    @endif
    
</div>
</x-app-layout>
@section('scripts')

@endsection
 
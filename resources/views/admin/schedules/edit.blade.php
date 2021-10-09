<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            تعديل جدول الحصص
        </h2>
    </x-slot>

    @php
    $sections=collect([
        1=>'الاولى',
        2=>'الثانية',
        3=>'الثالثة',
        4=>'الرابعة',
    ]);
    @endphp
<div class="p-3 bg-light">
    <form action="{{route('schedules.update',$schedule->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
     @csrf
     <div class="form-group">
        <label for="">رقم القاعة</label>
        <input type="text"
          class="form-control" name="class_id" id="" aria-describedby="helpId" placeholder="" value="{{$schedule->class_id}}">
      </div>
      <div class="form-group">
        <label for="">المرحلة</label>
        <select class="form-control" name="section_id" id="">
           @foreach ($sections as $key=>$item)
               <option value="{{$key}}" @if ($key ==$schedule->section_id)
                   selected
               @endif>{{$item}}</option>
           @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="">الشعبة</label>
        <input type="text"
          class="form-control" name="class" id="" aria-describedby="helpId" placeholder="" value="{{$schedule->class}}">
      </div>
      <div class="form-group">
        <label for="">اليوم</label>
        <select class="form-control" name="day" id="">
            @for ($i = 0; $i < 7; $i++)
             <option value="{{ \Carbon\Carbon::now()->subDays($i)->format('N')}}"
                @if ($schedule->day==\Carbon\Carbon::now()->subDays($i)->format('N'))
                    selected
                @endif
                >{{ \Carbon\Carbon::now()->subDays($i)->translatedFormat('l')}}</option>
            @endfor
        </select>
      </div>
      <div class="form-group">
        <label for="">القسم</label>
        <select class="form-control" name="department_id" id="" >
            @foreach (\App\Models\Department::get() as $item)
                <option value="{{$item->id}}"
                    @if ($item->id == $schedule->department_id)
                        selected
                    @endif
                    >{{$item->name}}</option>  
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="">التدريسي</label>
        <select class="form-control" name="teacher_id" id="">
            @foreach (\App\Models\Teacher::get() as $item)
                <option value="{{$item->id}}" 
                    @if ($item->id == $schedule->teacher_id)
                    selected
                @endif
                    >{{$item->name}}</option>  
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="">المادة</label>
        <select class="form-control" name="material_id" id="">
            @foreach (\App\Models\Material::get() as $item)
                <option value="{{$item->id}}"
                    @if ($item->id == $schedule->material_id)
                    selected
                @endif
                    >{{$item->name}}</option>  
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="">نوع المحاضرة</label>
        <select class="form-control" name="type" >
          <option value="0" @if ($schedule->type ==0)  selected @endif>حضوري</option>
          <option value="1" @if ($schedule->type ==1)  selected @endif>الكتروني</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">وقت البدء</label>
        <input type="text"
          class="form-control timepicker"   name="time_start" id="" aria-describedby="helpId" placeholder="" value="{{$schedule->time_start}}">
      </div>
      <div class="form-group">
        <label for="">وقت الانتهاء</label>
        <input type="text"
          class="form-control timepicker"   name="time_end" id="" aria-describedby="helpId" placeholder="" value="{{$schedule->time_end}}">
      </div>
     <hr>
     <button type="submit" class="btn btn-primary">حفظ</button>
     <a href="{{route('schedules.index')}}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</x-app-layout>
 
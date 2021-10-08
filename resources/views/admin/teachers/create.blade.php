<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           إضافة تدريسي
        </h2>
    </x-slot>

    @php
    $allow=true;
    @endphp
    @if (\App\Models\Department::count() ==0)
    <div class="alert alert-danger" role="alert">
        <strong>تنبيه !</strong>
        يجب إضافة قسم واحد على الاقل للتمكن من إضافة تدريسي 
        <b><a href="{{route('departments.create')}}">إضفط هنا للاضافة</a></b>
    </div>
    @php
    $allow=false;
    @endphp
    @endif
<div class="p-3 bg-light">
  @if ($allow)
    <form action="{{route('teachers.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">صورة </label>
            <input type="file" class="form-control-file" name="avatar" id="" placeholder=""
                aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
            <label for="">اسم التدريسي</label>
            <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">القسم</label>
            <select class="form-control" name="department_id" id="">
                @foreach (\App\Models\Department::get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('teachers.index')}}" class="btn btn-secondary">إلغاء</a>

    </form>
    @endif
</div>
</x-app-layout>
 
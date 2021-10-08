<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            تعديل بيانات التدريسي ({{$teacher->name}})
        </h2>
    </x-slot>

    <div class="p-3 bg-light">
        <form action="{{route('teachers.update',$teacher->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
         @csrf
         <div class="p-3">
             <img src="{{asset('uploads/teachers/'.$teacher->avatar)}}" width="150"  alt="">
         </div>
          <div class="form-group">
            <label for="">صورة</label>
            <input type="file" class="form-control-file" name="avatar" id="" placeholder="" aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">Help text</small>
          </div>
         <div class="form-group">
           <label for="">اسم التدريسي</label>
           <input type="text"
             class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{$teacher->name}}">
         </div>
         <div class="form-group">
          <label for="">القسم</label>
          <select class="form-control" name="department_id" id="">
              @foreach (\App\Models\Department::get() as $item)
                  <option value="{{$item->id}}" @if ($item->id == $teacher->department_id)
                      selected
                  @endif>{{$item->name}}</option>  
              @endforeach
          </select>
        </div>
         <hr>
         <button type="submit" class="btn btn-primary">حفظ</button>
         <a href="{{route('teachers.index')}}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</x-app-layout>
 
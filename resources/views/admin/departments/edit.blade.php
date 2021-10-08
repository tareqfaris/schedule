
<x-app-layout>
  <x-slot name="header">
      <h2 class="h4 font-weight-bold">
          تعديل بيانات قسم ({{$department->name}})
      </h2>
  </x-slot>

  <div class="p-3 bg-light">
    <form action="{{route('departments.update',$department->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
     @csrf
     <div class="p-3">
         <img src="{{asset('uploads/departments/'.$department->logo)}}" width="150"  alt="">
     </div>
      <div class="form-group">
        <label for="">شعار القسم</label>
        <input type="file" class="form-control-file" name="logo" id="" placeholder="" aria-describedby="fileHelpId">
        <small id="fileHelpId" class="form-text text-muted">Help text</small>
      </div>
     <div class="form-group">
       <label for="">اسم القسم</label>
       <input type="text"
         class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{$department->name}}">
     </div>
     <div class="form-group">
       <label for="">وصف القسم</label>
       <textarea class="form-control" name="description" id="" rows="3">{{$department->description}}</textarea>
     </div>
     <hr>
     <button type="submit" class="btn btn-primary">حفظ</button>
     <a href="{{route('departments.index')}}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</x-app-layout>
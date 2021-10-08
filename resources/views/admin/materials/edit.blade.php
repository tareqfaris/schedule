
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           تعديل مادة ({{$material->name}})
        </h2>
    </x-slot>

    <div class="p-3 bg-light">
        <form action="{{route('materials.update',$material->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
         @csrf
         <div class="form-group">
           <label for="">اسم المادة</label>
           <input type="text"
             class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{$material->name}}">
         </div>
         <div class="form-group">
          <label for="">القسم</label>
          <select class="form-control" name="department_id" id="">
              @foreach (\App\Models\Department::get() as $item)
                  <option value="{{$item->id}}" @if ($item->id == $material->department_id)
                      selected
                  @endif>{{$item->name}}</option>  
              @endforeach
          </select>
        </div>
         <hr>
         <button type="submit" class="btn btn-primary">حفظ</button>
         <a href="{{route('materials.index')}}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</x-app-layout>
 
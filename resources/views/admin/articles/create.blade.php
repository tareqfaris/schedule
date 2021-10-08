<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           إضافة مقال جديد
        </h2>
    </x-slot>

    <div class="p-3 bg-light">
        <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
           <label for="">صورة الموضوع</label>
           <input type="file" class="form-control-file" name="image" id="" placeholder="" aria-describedby="fileHelpId">
          </div>
         <div class="form-group">
           <label for="">العنوان</label>
           <input type="text"
             class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
         </div>
         <div class="form-group">
           <label for="">الوصف</label>
           <textarea class="form-control" name="content" id="" rows="3"></textarea>
         </div>
         <div class="form-group">
           <label for="">الحالة</label>
           <select class="form-control" name="status" id="">
             <option value="1">ظاهر</option>
             <option value="0">مخفي</option>
           </select>
         </div>
         <div class="form-group">
           <label for="">القسم</label>
           <select class="form-control" name="department_id" id="">
                <option value="0">جميع الاقسام</option>
               @foreach (\App\Models\Department::get() as $item)
                   <option value="{{$item->id}}">{{$item->name}}</option>  
               @endforeach
           </select>
         </div>
         <div class="form-group">
           <label for="">المرحلة</label>
           <select class="form-control" name="section_id" id="">
            <option value="0">جميع المراحل</option>
                @foreach ($sections as $key=>$item)
                <option value="{{$key}}">{{$item}}</option>
                @endforeach
           </select>
         </div>
         <hr>
         <button type="submit" class="btn btn-primary">حفظ</button>
         <a href="{{route('articles.index')}}" class="btn btn-secondary">إلغاء</a>

        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
          تعديل صلاحية مستخدم
        </h2>
    </x-slot>
  
    <div class="p-3 bg-light">
        <form method="POST" action="{{ route('users.update',$user->id) }}">
            @csrf
            @method('put')
 
            <div class="form-group">
              <label for="">الصلاحية</label>
              <select class="form-control" name="level" id="">
                  @foreach ($levels as $key=>$item)
                     <option value="{{$key}}" @if ($user->level==$key)   selected  @endif>{{$item}}</option> 
                  @endforeach
              </select>
            </div>
 
 
 

            <div class="mb-0">
                <div class="d-flex justify-content-end align-items-baseline">
                

                    <x-jet-button>
                     تعديل مستخدم
                    </x-jet-button>
                </div>
            </div>
        </form>
  </div>
  </x-app-layout>
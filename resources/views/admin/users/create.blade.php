<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
           إضافة  مستخدم جديد
        </h2>
    </x-slot>
  
    <div class="p-3 bg-light">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <x-jet-label value="الاسم" />

                <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                             :value="old('name')" required autofocus autocomplete="name" />
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="البريد الالكتروني" />

                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                             :value="old('email')" required />
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>

            <div class="form-group">
              <label for="">الصلاحية</label>
              <select class="form-control" name="level" id="">
                <select class="form-control" name="level" id="">
                    @foreach ($levels as $key=$item)
                       <option value="{{$key}}">{{$item}}</option> 
                    @endforeach
                </select>
              </select>
            </div>

            <div class="mb-3">
                <x-jet-label value="كلمة المرور" />

                <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                             name="password" required autocomplete="new-password" />
                <x-jet-input-error for="password"></x-jet-input-error>
            </div>

            <div class="mb-3">
                <x-jet-label value="تأكيد كلمة المرور" />

                <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
 

            <div class="mb-0">
                <div class="d-flex justify-content-end align-items-baseline">
                

                    <x-jet-button>
                     إضافة مستخدم
                    </x-jet-button>
                </div>
            </div>
        </form>
  </div>
  </x-app-layout>
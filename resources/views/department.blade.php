@extends('layouts.master')
@section('content')
  
<section class="container" class="page-section portfolio" id="schedule">
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
    @endphp <div class="mt-3">
        <div>
            <form class="form-inline d-flex  d-print-none" action="">
                <input type="hidden" name="day" value="{{$day}}">
                <div class="form-group m-2">
                    <select class="form-control" name="section_id" id="">
                        <option value="0">كل المراحل</option>
                        @foreach ($sections as $key=>$item)
                        <option value="{{$key}}" @if (Request::get('section_id')==$key) selected @endif>{{$item}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group m-2">
                    <select class="form-control" name="material_id" id="">
                        <option value="0">كل المواد</option>
                        @foreach (\App\Models\Material::get() as $item)
                        <option value="{{$item->id}}" @if (Request::get('material_id')==$item->id) selected
                            @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group m-2">
                    <select class="form-control" name="teacher_id" id="">
                        <option value="0">كل التدريسيين</option>
                        @foreach (\App\Models\Teacher::get() as $item)
                        <option value="{{$item->id}}" @if (Request::get('teacher_id')==$item->id) selected
                            @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-warning m-2">إستعلام</button>
            </form>
        </div>
        <div class="m-2 d-print-none">
            @foreach ($days as $key=>$item)
            @if ($day == $key)
            <a class="btn btn-info">{{$item}}</a>
            @else
            <a href="?day={{$key}}" class="btn btn-outline-info">{{$item}}</a>
            @endif

            @endforeach
        </div>

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
                    <th>وقت البدء</th>
                    <th>وقت الانتهاء</th>
                    <th>نوع المحاضرة</th>
                 </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($schedules as $item)
                <tr>
                    <td scope="row">
                        @if (is_now($item->time_start,$item->time_end) && $day==$item->day)
                        <i class="fas fa-circle-notch fa-spin text-danger" title="بدأت حاليا"></i>
                        
                        @endif
                       
                       {{$item->id}}</td>
                    <td>{{$days[$item->day]}}</td>
                    <td>{{$sections[$item->section_id]}}</td>
                    <td>{{@$item->class}}</td>
                    <td>{{@$item->class_id}}</td>
                    <td>{{@$item->material->name}}</td>
                    <td>{{@$item->teacher->name}}</td>
                    <td class="text-success">{{@$item->time_start}}</td>
                    <td class="text-danger">{{@$item->time_end}}</td>
                    <td>
                        @if ($item->type==0)
                        <span>حضوري</span>
                        @else 
                        <span>الكتروني</span>
                        @endif
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        {{$schedules->links()}}
</div>
</section>
<section class="page-section portfolio" id="news">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <a href="" style="text-decoration:none"><h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">لوحة الاعلانات</h2></a>
        
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            @foreach ($articles as $item)
                 <div class="col-md-6 col-lg-4">
                <a class="portfolio-item mx-auto text-center"  href="{{route('article.show',$item->id)}}">
                    
                    <img  style="object-fit: cover;" src="{{asset('uploads/articles/'.$item->image)}}" alt="..." width="390px" height="215px"/>  
                </a>
                <a class="text-secondary" href="{{route('article.show',$item->id)}}">
                 <h5>{{$item->title}}</h5>   
                </a>
                
            </div>
            @endforeach
         
           
        </div>
    </div>
</section>
@endsection
@extends('layouts.master')
@section('content')

    <!-- Portfolio Section-->

    <section class="page-section portfolio" id="schedule">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">الجدول الاسبوعي</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div >
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
                                <select class="form-control" name="department_id" id="">
                                    <option value="0">كل الاقسام</option>
                                    @foreach (\App\Models\Department::get() as $item)
                                    <option value="{{$item->id}}" @if (Request::get('department_id')==$item->id) selected
                                        @endif>{{$item->name}}</option>
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
                                <th>القسم</th>
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
                                <td>{{@$item->department->name}}</td>
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
            </div>
       
        </div>
    </section>

    <section class="page-section portfolio" id="depatments">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">اقسام الكلية</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                @foreach ($departments as $item)
                     <div class="col-md-6 col-lg-4">
                    <a class="portfolio-item mx-auto text-center"  href="{{route('department.home',$item->id)}}">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-search fa-3x"></i></div>
                        </div>
                        @if ($item->logo !=null)
                         <img class="img-fluid" src="{{asset('uploads/departments/'.$item->logo)}}" alt="..." />   
                        @endif
                        
                    </a>
                    <div class="text-center">
                     <h2>{{$item->name}}</h2>   
                    </div>
                    
                </div>
                @endforeach
             
               
            </div>
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
    <!-- About Section-->
    {{-- <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ms-auto"><p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p></div>
                <div class="col-lg-4 me-auto"><p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p></div>
            </div>
            <!-- About Section Button-->
            <div class="text-center mt-4">
                <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/theme/freelancer/">
                    <i class="fas fa-download me-2"></i>
                    Free Download!
                </a>
            </div>
        </div>
    </section> --}}
    <!-- Contact Section-->
    {{-- <section class="page-section" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact Me</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Contact Section Form-->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        <!-- Submit Button-->
                        <button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Footer-->
@endsection
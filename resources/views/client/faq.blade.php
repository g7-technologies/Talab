@extends('layouts.master')
@section('content')

<main>
    <!-- privacy policy -->

    <div class="privacy_wrapper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="stor_title_area d-flex mb-55">
                        <a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a><h1>FAQs</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy_inner_wrapper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="faq_content_wrapper">
                                    <div class="faq_title text-center mb-30" dir="rtl">
                                        <h3>ما هي منصة طلب؟ نموذج</h3>
                                    </div>

                                    <div class="faq_content_wrap" dir="rtl">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            
                                            <div class="accordion-item">
                                              <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    ما هي منصة طلب؟
                                                </button>
                                              </h2>
                                              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">منصة مختصة بتوفير كافة الخيارات من متاجر الاكثر طلباً لتلبية احتياجات العميل بأقل الاسعار وبسعر الجملة، وأيضا توفير طرق متعددة للدفع وتوصيلها بأسرع وقتٍ ممكن وذلك للحصول على رضا العميل والوصول لغايته..</div>
                                              </div>
                                            </div>

                                            <div class="accordion-item">
                                              <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                   خما هي منصة طلب؟
                                                </button>
                                              </h2>
                                              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">وعند موافقه العميالمملكة العربية السعودية، جدة.</div>
                                              </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    اما هو الوقت المتوقع لإرجاع السلعة الخاصة بي؟
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">3 يوم عمل من تاريخ الاستلام.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                                            ماذا لو لم أجد المنتج؟
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">انتقل إلى صفحة "الاقتراحات والشكاوى" وتقديم اقتراح ويوجد فيه (اسم المنتج ووصفه وصورة أن امكن) ليتم توافره.                                                   </div>
                                                </div>
                                            </div>
                                            
                                             <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseThree">
                                            كيف يمكنني التسجيل؟
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">انقر عى "تسجيل" في الزاوية اليمنى العليا على أي صفحة من منصة طلب ووفر جميع المعلومات المطلوبة.</div>.                                                   </div>
                                                </div>
                                            
                                             <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingSix">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseThree">
                                            لقد نسيت كلمة المرور الخاصة بي، ماذا أفعل؟
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">انقر على زر "تسجيل الدخول" في الزاوية اليمنى العليا من أي صفحة من موقع طلب، ثم انقر على زر "نسيت كلمة السر؟" أدخل عنوان البريد الإلكتروني الذي استخدمته للتسجيل. سوف نرسل لك رسالة على البريد الالكتروني مع تعليمات إعادة ضبط كلمة السر.                                                   </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- privacy policy -->

</main>

@endsection
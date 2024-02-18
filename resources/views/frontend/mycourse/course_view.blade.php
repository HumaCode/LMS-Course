@include('frontend.mycourse.body.header')


<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!--======================================
        START HEADER AREA
    ======================================-->
    <section class="header-menu-area">

        <div class="header-menu-content bg-dark">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="logo-box logo--box">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                    </div><!-- end logo-box -->
                    <div class="course-dashboard-header-title pl-4">
                        <a href="course-details.html" class="text-white fs-15">{{ $course->course->course_name }}</a>
                    </div><!-- end course-dashboard-header-title -->
                    <div class="menu-wrapper ml-auto">
                        <div class="theme-picker d-flex align-items-center mr-3">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="nav-right-button d-flex align-items-center">
                            <a href="#"
                                class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2"
                                data-toggle="modal" data-target="#ratingModal"><i class="la la-star mr-1"></i> leave
                                a rating</a>
                            <a href="#"
                                class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2"
                                data-toggle="modal" data-target="#shareModal"><i class="la la-share mr-1"></i>
                                share</a>
                            <div class="generic-action-wrap generic--action-wrap">
                                <div class="dropdown">
                                    <a class="action-btn" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Favorite this course</a>
                                        <a class="dropdown-item" href="#">Archive this course</a>
                                        <a class="dropdown-item" href="#">Gift this course</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end nav-right-button -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </section><!-- end header-menu-area -->
    <!--======================================
        END HEADER AREA
======================================-->

    <!--======================================
        START COURSE-DASHBOARD
======================================-->
    <section class="course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">

                    <div class="lecture-viewer-container">
                        <div class="lecture-video-item">



                            <iframe width="100%" height="500" id="videoContainer" src=""
                                title="The Best Way to Learn With Videos and Online Classes I Video Notebook"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                            <div id="textLesson" class="fs-24 font-weight-semi-bold pb-2 text-center mt-4">
                                <h3></h3>
                            </div>

                        </div>
                    </div><!-- end lecture-viewer-container -->



                    <div class="lecture-video-detail">
                        <div class="lecture-tab-body bg-gray p-4">
                            <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                                <li class="nav-item mobile-menu-nav-item">
                                    <a class="nav-link" id="course-content-tab" data-toggle="tab"
                                        href="#course-content" role="tab" aria-controls="course-content"
                                        aria-selected="false">
                                        Course Content
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                        role="tab" aria-controls="overview" aria-selected="true">
                                        Overview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="question-and-ans-tab" data-toggle="tab"
                                        href="#question-and-ans" role="tab" aria-controls="question-and-ans"
                                        aria-selected="false">
                                        Question & Ans
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="announcements-tab" data-toggle="tab"
                                        href="#announcements" role="tab" aria-controls="announcements"
                                        aria-selected="false">
                                        Announcements
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="lecture-video-detail-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="course-content" role="tabpanel"
                                    aria-labelledby="course-content-tab">
                                    <div class="mobile-course-menu pt-4">
                                        <div class="accordion generic-accordion generic--accordion"
                                            id="mobileCourseAccordionCourseExample">



                                            @forelse ($section as $sec1)
                                                @php
                                                    $lectures1 = App\Models\CourseLecture::where('section_id', $sec1->id)->get();
                                                @endphp


                                                <div class="card">

                                                    <div class="card-header" id="mobileCourseHeadingOne">
                                                        <button class="btn btn-link" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#mobileCourseCollapseOne{{ $sec1->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="mobileCourseCollapseOne">
                                                            <i class="la la-angle-down"></i>
                                                            <i class="la la-angle-up"></i>
                                                            <span class="fs-15"> {{ $sec1->section_title }}</span>
                                                            <span class="course-duration">
                                                                {{-- <span>1/5</span> --}}
                                                                <span>{{ count($lectures1) }}</span>
                                                            </span>
                                                        </button>
                                                    </div><!-- end card-header -->

                                                    <div id="mobileCourseCollapseOne{{ $sec1->id }}"
                                                        class="collapse " aria-labelledby="mobileCourseHeadingOne"
                                                        data-parent="#mobileCourseAccordionCourseExample">
                                                        <div class="card-body p-0">
                                                            <ul class="curriculum-sidebar-list">
                                                                @foreach ($lectures1 as $lect1)
                                                                    <li class="course-item-link  lecture-title"
                                                                        data-video-url="{{ $lect1->video }}"
                                                                        data-content="{{ $lect1->content }}">
                                                                        <div class="course-item-content-wrap">
                                                                            <div
                                                                                class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    id="mobileCourseCheckbox" required>
                                                                                <label
                                                                                    class="custom-control-label custom--control-label"
                                                                                    for="mobileCourseCheckbox"></label>
                                                                            </div><!-- end custom-control -->
                                                                            <div class="course-item-content">
                                                                                <h4 class="fs-15 ">
                                                                                    {{ $lect1->lecture_title }}</h4>
                                                                                <div class="courser-item-meta-wrap">
                                                                                    <p class="course-item-meta"><i
                                                                                            class="la la-play-circle"></i>2min
                                                                                    </p>
                                                                                </div>
                                                                            </div><!-- end course-item-content -->
                                                                        </div><!-- end course-item-content-wrap -->
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- end card-body -->
                                                    </div><!-- end collapse -->

                                                </div><!-- end card -->
                                            @empty
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="alert alert-danger text-center">
                                                            <h4>Not Found</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse


                                        </div><!-- end accordion-->
                                    </div><!-- end mobile-course-menu -->
                                </div><!-- end tab-pane -->

                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                                    <div class="lecture-overview-wrap">
                                        <div class="lecture-overview-item">
                                            <h3 class="fs-24 font-weight-semi-bold pb-2">About this course</h3>

                                            <p>{{ $course->course->course_title }}</p>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="fs-16 font-weight-semi-bold pb-2">By the numbers</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="generic-list-item">
                                                        <li><span>Skill level:</span>{{ $course->course->label }}</li>
                                                        <li><span>Students:</span>83950</li>
                                                        <li><span>Languages:</span>English</li>
                                                        <li><span>Captions:</span>Yes</li>
                                                    </ul>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="generic-list-item">
                                                        <li><span>Resource:</span>{{ $course->course->resources }}</li>
                                                        <li><span>Video length:</span>{{ $course->course->duration }}
                                                            hours</li>
                                                        <li><span>Certificate:</span>{{ $course->course->certificate }}
                                                        </li>
                                                    </ul>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="fs-16 font-weight-semi-bold pb-2">Certificates</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                    <p class="pb-3">Get Aduca certificate by completing entire course
                                                    </p>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-transparent">Aduca
                                                        Certificate</a>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="fs-16 font-weight-semi-bold pb-2">Features</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <p>Available on <a href="#"
                                                            class="text-color hover-underline">IOS</a> and <a
                                                            href="#"
                                                            class="text-color hover-underline">Android</a></p>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="fs-16 font-weight-semi-bold pb-2">Description</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item lecture-description">
                                                    <p>{!! $course->course->description !!}</p>
                                                    <div class="collapse" id="collapseMore">

                                                        {!! $course->course->prerequisites !!}
                                                    </div>
                                                    <div class="show-more-btn-box">
                                                        <a class="collapse-btn collapse--btn fs-15"
                                                            data-toggle="collapse" href="#collapseMore"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="collapseMore">
                                                            <span class="collapse-btn-hide">Read more<i
                                                                    class="la la-angle-down ml-1 fs-14"></i></span>
                                                            <span class="collapse-btn-show">Read less<i
                                                                    class="la la-angle-up ml-1 fs-14"></i></span>
                                                        </a>
                                                    </div><!-- end show-more-btn-box -->
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>

                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex ">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="fs-16 font-weight-semi-bold pb-2">Instructor</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                    <div class="media media-card align-items-center">
                                                        <a href="teacher-detail.html"
                                                            class="media-img d-block rounded-full avatar-md">
                                                            <img src="{{ !empty($course->instructor->photo) ? url('upload/instructor_images/' . $course->instructor->photo) : url('upload/no_image.jpg') }}"
                                                                alt="Instructor avatar" class="rounded-full">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a
                                                                    href="teacher-detail.html">{{ $course->instructor->name }}</a>
                                                            </h5>
                                                            <span class="d-block lh-18 pt-2">Java Python Android and C#
                                                                Expert Developer</span>
                                                        </div>
                                                    </div>
                                                    <div class="lecture-owner-profile pt-4">
                                                        <ul class="social-icons social-icons-styled">
                                                            <li><a href="#" class="facebook-bg"><i
                                                                        class="la la-facebook"></i></a></li>
                                                            <li><a href="#" class="twitter-bg"><i
                                                                        class="la la-twitter"></i></a></li>
                                                            <li><a href="#" class="instagram-bg"><i
                                                                        class="la la-instagram"></i></a></li>
                                                            <li><a href="#" class="linkedin-bg"><i
                                                                        class="la la-linkedin"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lecture-owner-decription pt-4">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Mauris faucibus ligula vestibulum venenatis efficitur.
                                                            Phasellus posuere urna et faucibus vestibulum. Duis quis
                                                            eros. Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit. Mauris faucibus ligula vestibulum venenatis efficitur.
                                                            Phasellus posuere urna et faucibus vestibulum. Duis quis
                                                            eros.</p>
                                                        <p>Consequuntur dignissimos itaque mollitia tenetur voluptatem.
                                                            Aut beatae blanditiis consequuntur corporis delectus
                                                            deserunt dolores eos et fugit hic illo, impedit in magnam
                                                            mollitia nulla placeat porro, possimus quae quaerat quasi
                                                            quidem recusandae reprehenderit saepe, suscipit
                                                            voluptatibus.</p>
                                                        <p><strong>After Effects:</strong> The whole lot. In my course
                                                            After Effects Complete Course packed with all Techniques and
                                                            Methods (No Tricks and gimmicks).</p>
                                                        <p><strong>Video Editing:</strong> If it's Adobe Premiere Pro or
                                                            DaVinci Resolve you have excellent top rated courses.</p>
                                                        <p>I guess 208,000+ Students is a good sign that my courses will
                                                            be of benefit to you.</p>
                                                        <p>Cheers</p>
                                                        <p>Alex</p>
                                                    </div>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                    </div><!-- end lecture-overview-wrap -->
                                </div><!-- end tab-pane -->

                                <div class="tab-pane fade" id="question-and-ans" role="tabpanel"
                                    aria-labelledby="question-and-ans-tab">
                                    <div class="lecture-overview-wrap lecture-quest-wrap">
                                        <div class="new-question-wrap">
                                            <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i
                                                    class="la la-reply mr-1"></i>Back to all questions</button>
                                            <div class="new-question-body pt-40px">
                                                <h3 class="fs-20 font-weight-semi-bold">My question relates to</h3>

                                                <form method="post" action="{{ route('user.question') }}"
                                                    id="qna" class="pt-4">
                                                    @csrf


                                                    <input type="hidden" name="course_id"
                                                        value="{{ $course->course_id }}">
                                                    <input type="hidden" name="instructor_id"
                                                        value="{{ $course->instructor_id }}">

                                                    <div class="custom-control-wrap">

                                                        <div class="form-group">
                                                            <div class="custom-control custom-radio mb-3 pl-0">
                                                                <input type="text"
                                                                    class="form-control form--control pl-3"
                                                                    name="subject" id="subject"
                                                                    placeholder="Subject">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="custom-control custom-radio mb-3 pl-0">
                                                                <textarea class="form-control form--control pl-3" id="question" name="question" rows="4"
                                                                    placeholder="Write your question..."></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="btn-box text-center">
                                                        <button type="submit" class="btn theme-btn w-100">Submit
                                                            Question <i
                                                                class="la la-arrow-right icon ml-1"></i></button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div><!-- end new-question-wrap -->


                                        <div class="question-overview-result-wrap">

                                            {{-- <div class="lecture-overview-item">
                                                <div class="question-overview-filter-wrap d-flex align-items-center">
                                                    <div class="question-overview-filter-item">
                                                        <div class="select-container w-100">
                                                            <select class="select-container-select">
                                                                <option value="0">All lectures</option>
                                                                <option value="1">Current lecture</option>
                                                            </select>
                                                        </div>
                                                    </div><!-- end question-overview-filter-item -->
                                                    <div class="question-overview-filter-item">
                                                        <div class="select-container w-100">
                                                            <select class="select-container-select">
                                                                <option value="0">Sort by most recent</option>
                                                                <option value="1">Sort by most upvoted</option>
                                                                <option value="2">Sort by recommended</option>
                                                            </select>
                                                        </div>
                                                    </div><!-- end question-overview-filter-item -->
                                                    <div class="question-overview-filter-item">
                                                        <div class="generic-action-wrap">
                                                            <div class="dropdown">
                                                                <a class="btn theme-btn theme-btn-transparent w-100"
                                                                    href="#" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    Filter questions
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="custom-control custom-checkbox fs-15">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="questionsCheckbox" required>
                                                                            <label
                                                                                class="custom-control-label custom--control-label"
                                                                                for="questionsCheckbox">
                                                                                Questions I'm following
                                                                            </label>
                                                                        </div><!-- end custom-control -->
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="custom-control custom-checkbox fs-15">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="questionsCheckbox2" required>
                                                                            <label
                                                                                class="custom-control-label custom--control-label"
                                                                                for="questionsCheckbox2">
                                                                                Questions I asked
                                                                            </label>
                                                                        </div><!-- end custom-control -->
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="custom-control custom-checkbox fs-15">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="questionsCheckbox3" required>
                                                                            <label
                                                                                class="custom-control-label custom--control-label"
                                                                                for="questionsCheckbox3">
                                                                                Questions without responses
                                                                            </label>
                                                                        </div><!-- end custom-control -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end generic-action-wrap -->
                                                    </div><!-- end question-overview-filter-item -->
                                                </div>
                                            </div><!-- end lecture-overview-item --> --}}

                                            <div class="lecture-overview-item">
                                                <div
                                                    class="question-overview-result-header d-flex align-items-center justify-content-between">
                                                    <h3 class="fs-17 font-weight-semi-bold">30 questions in this course
                                                    </h3>
                                                    <button
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent ask-new-question-btn">Ask
                                                        a new question</button>
                                                </div>
                                            </div><!-- end lecture-overview-item -->

                                            <div class="section-block"></div>
                                            <div class="lecture-overview-item mt-0">
                                                <div class="question-list-item">
                                                    <div
                                                        class="media media-card border-bottom border-bottom-gray py-4 px-3">
                                                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                                                            <img class="rounded-full"
                                                                src="{{ asset('frontend') }}/images/small-avatar-1.jpg"
                                                                alt="User image">
                                                        </div>
                                                        <div class="media-body">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <div class="question-meta-content">
                                                                    <a href="javascript:void(0)" class="d-block">
                                                                        <h5 class="fs-16 pb-1">I still did't get H264
                                                                            after installing Quicktime. Please what do I
                                                                            do</h5>
                                                                        <p class="text-truncate fs-15 text-gray">
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipisicing elit,
                                                                            sed do eiusmod tempor incididunt ut labore
                                                                            et dolore magna aliqua.
                                                                            Ut enim ad minim veniam, quis nostrud
                                                                            exercitation.
                                                                        </p>
                                                                    </a>
                                                                </div><!-- end question-meta-content -->
                                                                <div class="question-upvote-action">
                                                                    <div
                                                                        class="number-upvotes pb-2 d-flex align-items-center">
                                                                        <span>1</span>
                                                                        <button type="button"><i
                                                                                class="la la-arrow-up"></i></button>
                                                                    </div>
                                                                    <div
                                                                        class="number-upvotes question-response d-flex align-items-center">
                                                                        <span>1</span>
                                                                        <button type="button"
                                                                            class="question-replay-btn"><i
                                                                                class="la la-comments"></i></button>
                                                                    </div>
                                                                </div><!-- end question-upvote-action -->
                                                            </div>
                                                            <p class="meta-tags pt-1 fs-13">
                                                                <a href="#">Alex Smith</a>
                                                                <a href="#">Lecture 20</a>
                                                                <span>3 hours ago</span>
                                                            </p>
                                                        </div><!-- end media-body -->
                                                    </div><!-- end media -->

                                                </div>
                                                <div class="question-btn-box pt-35px text-center">
                                                    <button class="btn theme-btn theme-btn-transparent w-100"
                                                        type="button">See More</button>
                                                </div>
                                            </div><!-- end lecture-overview-item -->
                                        </div>

                                    </div>
                                </div><!-- end tab-pane -->
                                <div class="tab-pane fade" id="announcements" role="tabpanel"
                                    aria-labelledby="announcements-tab">
                                    <div class="lecture-overview-wrap lecture-announcement-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="media media-card align-items-center">
                                                <a href="teacher-detail.html"
                                                    class="media-img d-block rounded-full avatar-md">
                                                    <img src="{{ asset('frontend') }}/images/small-avatar-1.jpg"
                                                        alt="Instructor avatar" class="rounded-full">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a>
                                                    </h5>
                                                    <div class="announcement-meta fs-15">
                                                        <span>Posted an announcement</span>
                                                        <span> · 3 years ago ·</span>
                                                        <a href="#" class="btn-text" data-toggle="modal"
                                                            data-target="#reportModal" title="Report abuse"><i
                                                                class="la la-flag"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="lecture-owner-decription pt-4">
                                                <h3 class="fs-19 font-weight-semi-bold pb-3">Important Q&A support</h3>
                                                <p>Happy 2019 to everyone, thank you for being a student and all of your
                                                    support.</p>
                                                <p><strong>Great job on enrolling and your current course progress. I
                                                        encourage you keep in pursuit of your dreams :)</strong></p>
                                                <p>The whole lot. In my course After Effects Complete Course packed with
                                                    all Techniques and Methods (No Tricks and gimmicks).</p>
                                                <p class="font-italic"><strong>Unfortunately this will result in
                                                        delayed responses by me in the Q&A section and to direct
                                                        messages. This is only for the next week and once back I will be
                                                        back to 100% .</strong></p>
                                                <p>I will continue to do my best to respond to as many questions as
                                                    possible but only one person, regularly I spend 4-5 hours daily on
                                                    this and with over 440000 students as you can image that its a lot
                                                    of work.</p>
                                                <p class="font-italic">Thank you once again for your understanding and
                                                    for all of the wonderful students who I have had an opportunity to
                                                    communicate with regularly and all of your encouragement.</p>
                                                <p>Have an awesome day</p>
                                                <p>Alex</p>
                                            </div>
                                            <div class="lecture-announcement-comment-wrap pt-4">
                                                <div class="media media-card align-items-center">
                                                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                        <img src="{{ asset('frontend') }}/images/small-avatar-1.jpg"
                                                            alt="Instructor avatar" class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <form action="#">
                                                            <div class="input-group">
                                                                <input
                                                                    class="form-control form--control form--control-gray pl-3"
                                                                    type="text" name="search"
                                                                    placeholder="Enter your comment">
                                                                <div class="input-group-append">
                                                                    <button class="btn theme-btn" type="button"><i
                                                                            class="la la-arrow-right"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                                <div class="comments pt-40px">
                                                    <div
                                                        class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                            <img src="{{ asset('frontend') }}/images/small-avatar-2.jpg"
                                                                alt="Instructor avatar" class="rounded-full">
                                                        </div><!-- end media-img -->
                                                        <div class="media-body">
                                                            <div class="announcement-meta fs-15 lh-20">
                                                                <a href="#" class="text-color">Tony Olsson</a>
                                                                <span> · 3 years ago ·</span>
                                                                <a href="#" class="btn-text"
                                                                    data-toggle="modal" data-target="#reportModal"
                                                                    title="Report abuse"><i
                                                                        class="la la-flag"></i></a>
                                                            </div>
                                                            <p class="pt-1">Occaecati cupiditate non provident,
                                                                similique sunt in culpa fuga.</p>
                                                        </div><!-- end media-body -->
                                                    </div><!-- end media -->
                                                    <div
                                                        class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                                                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                                            <img src="{{ asset('frontend') }}/images/small-avatar-3.jpg"
                                                                alt="Instructor avatar" class="rounded-full">
                                                        </div><!-- end media-img -->
                                                        <div class="media-body">
                                                            <div class="announcement-meta fs-15 lh-20">
                                                                <a href="#" class="text-color">Eduard-Dan</a>
                                                                <span> · 2 years ago ·</span>
                                                                <a href="#" class="btn-text"
                                                                    data-toggle="modal" data-target="#reportModal"
                                                                    title="Report abuse"><i
                                                                        class="la la-flag"></i></a>
                                                            </div>
                                                            <p class="pt-1">Occaecati cupiditate non provident,
                                                                similique sunt in culpa fuga.</p>
                                                        </div><!-- end media-body -->
                                                    </div><!-- end media -->
                                                </div><!-- end comments -->
                                            </div><!-- end lecture-announcement-comment-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                    </div>
                                </div><!-- end tab-pane -->
                            </div><!-- end tab-content -->
                        </div><!-- end lecture-video-detail-body -->
                    </div><!-- end lecture-video-detail -->
                    <div class="cta-area py-4 bg-gray">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="cta-content-wrap">
                                        <h3 class="fs-18 font-weight-semi-bold">Top companies choose <a
                                                href="for-business.html" class="text-color hover-underline">Aduca
                                                for Business</a> to build in-demand career skills.</h3>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="client-logo-wrap text-right">
                                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                                src="{{ asset('frontend') }}/images/sponsor-img.png"
                                                alt="brand image"></a>
                                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                                src="{{ asset('frontend') }}/images/sponsor-img2.png"
                                                alt="brand image"></a>
                                        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                                                src="{{ asset('frontend') }}/images/sponsor-img3.png"
                                                alt="brand image"></a>
                                    </div><!-- end client-logo-wrap -->
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </div><!-- end container-fluid -->
                    </div><!-- end cta-area -->
                    <div class="footer-area pt-50px">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <a href="index.html">
                                            <img src="{{ asset('frontend') }}/images/logo.png" alt="footer logo"
                                                class="footer__logo">
                                        </a>
                                        <ul class="generic-list-item pt-4">
                                            <li><a href="tel:+1631237884">+163 123 7884</a></li>
                                            <li><a href="mailto:support@wbsite.com">support@website.com</a></li>
                                            <li>Melbourne, Australia, 105 South Park Avenue</li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="fs-20 font-weight-semi-bold pb-3">Company</h3>
                                        <ul class="generic-list-item">
                                            <li><a href="#">About us</a></li>
                                            <li><a href="#">Contact us</a></li>
                                            <li><a href="#">Become a Teacher</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="#">FAQs</a></li>
                                            <li><a href="#">Blog</a></li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="fs-20 font-weight-semi-bold pb-3">Courses</h3>
                                        <ul class="generic-list-item">
                                            <li><a href="#">Web Development</a></li>
                                            <li><a href="#">Hacking</a></li>
                                            <li><a href="#">PHP Learning</a></li>
                                            <li><a href="#">Spoken English</a></li>
                                            <li><a href="#">Self-Driving Car</a></li>
                                            <li><a href="#">Garbage Collectors</a></li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="fs-20 font-weight-semi-bold pb-3">Download App</h3>
                                        <div class="mobile-app">
                                            <p class="pb-3 lh-24">Download our mobile app and learn on the go.</p>
                                            <a href="#" class="d-block mb-2 hover-s"><img
                                                    src="{{ asset('frontend') }}/images/appstore.png" alt="App store"
                                                    class="img-fluid"></a>
                                            <a href="#" class="d-block hover-s"><img
                                                    src="{{ asset('frontend') }}/images/googleplay.png"
                                                    alt="Google play store" class="img-fluid"></a>
                                        </div>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                            </div><!-- end row -->
                        </div><!-- end container-fluid -->
                        <div class="section-block"></div>
                        <div class="copyright-content py-4">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <p class="copy-desc">&copy; 2021 Aduca. All Rights Reserved. by <a
                                                href="https://techydevs.com/">TechyDevs</a></p>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-wrap align-items-center justify-content-end">
                                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                                <li class="mr-3"><a href="terms-and-conditions.html">Terms &
                                                        Conditions</a></li>
                                                <li class="mr-3"><a href="privacy-policy.html">Privacy Policy</a>
                                                </li>
                                            </ul>
                                            <div class="select-container select-container-sm">
                                                <select class="select-container-select">
                                                    <option value="1">English</option>
                                                    <option value="2">Deutsch</option>
                                                    <option value="3">Español</option>
                                                    <option value="4">Français</option>
                                                    <option value="5">Bahasa Indonesia</option>
                                                    <option value="6">Bangla</option>
                                                    <option value="7">日本語</option>
                                                    <option value="8">한국어</option>
                                                    <option value="9">Nederlands</option>
                                                    <option value="10">Polski</option>
                                                    <option value="11">Português</option>
                                                    <option value="12">Română</option>
                                                    <option value="13">Русский</option>
                                                    <option value="14">ภาษาไทย</option>
                                                    <option value="15">Türkçe</option>
                                                    <option value="16">中文(简体)</option>
                                                    <option value="17">中文(繁體)</option>
                                                    <option value="17">Hindi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </div><!-- end container-fluid -->
                        </div><!-- end copyright-content -->
                    </div><!-- end footer-area -->
                </div><!-- end course-dashboard-column -->
                <div class="course-dashboard-sidebar-column">
                    <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Course
                        content</button>
                    <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                        <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                            <h3 class="fs-18 font-weight-semi-bold">Course content</h3>
                            <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                        </div><!-- end course-dashboard-side-heading -->
                        <div class="course-dashboard-side-content">
                            <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">



                                @forelse ($section as $sec)
                                    @php
                                        $lectures = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                                    @endphp

                                    <div class="card">

                                        <div class="card-header" id="headingOne">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne{{ $sec->id }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="la la-angle-down"></i>
                                                <i class="la la-angle-up"></i>
                                                <span class="fs-15"> {{ $sec->section_title }}</span>
                                                <span class="course-duration">
                                                    {{-- <span>11</span> --}}
                                                    <span>{{ count($lectures) }}</span>
                                                </span>
                                            </button>
                                        </div><!-- end card-header -->

                                        <div id="collapseOne{{ $sec->id }}" class="collapse"
                                            aria-labelledby="headingOne" data-parent="#accordionCourseExample">
                                            <div class="card-body p-0">
                                                <ul class="curriculum-sidebar-list">

                                                    @foreach ($lectures as $lect)
                                                        <li class="course-item-link  lecture-title"
                                                            data-video-url="{{ $lect->video }}"
                                                            data-content="{{ $lect->content }}">
                                                            <div class="course-item-content-wrap">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input"
                                                                        id="courseCheckbox" required>
                                                                    <label
                                                                        class="custom-control-label custom--control-label"
                                                                        for="courseCheckbox"></label>
                                                                </div><!-- end custom-control -->
                                                                <div class="course-item-content">
                                                                    <h4 class="fs-15 " ">
                                                                        {{ $lect->lecture_title }}</h4>



                                                                </div>
                                                            </div><!-- end course-item-content -->
                                                        </li>
 @endforeach
                                                </ul>
                                            </div><!-- end course-item-content-wrap -->
                                        </div><!-- end card-body -->
                                    </div><!-- end collapse -->



                                @empty
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="alert alert-danger text-center">
                                                <h4>Not Found</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse


                            </div><!-- end accordion-->
                        </div><!-- end course-dashboard-side-content -->
                    </div><!-- end course-dashboard-sidebar-wrap -->
                </div><!-- end course-dashboard-sidebar-column -->
            </div><!-- end course-dashboard-container -->
        </div><!-- end course-dashboard-wrap -->
    </section><!-- end course-dashboard -->
    <!--======================================
        END COURSE-DASHBOARD
======================================-->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="ratingModal" tabindex="-1" role="dialog"
        aria-labelledby="ratingModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="ratingModalTitle">
                            How would you rate this course?
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body text-center py-5">
                    <div class="leave-rating mt-5">
                        <input type="radio" name='rate' id="star5" />
                        <label for="star5" class="fs-45"></label>
                        <input type="radio" name='rate' id="star4" />
                        <label for="star4" class="fs-45"></label>
                        <input type="radio" name='rate' id="star3" />
                        <label for="star3" class="fs-45"></label>
                        <input type="radio" name='rate' id="star2" />
                        <label for="star2" class="fs-45"></label>
                        <input type="radio" name='rate' id="star1" />
                        <label for="star1" class="fs-45"></label>
                        <div class="rating-result-text fs-20 pb-4"></div>
                    </div><!-- end leave-rating -->
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog"
        aria-labelledby="shareModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Share this course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <div class="copy-to-clipboard">
                        <span class="success-message">Copied!</span>
                        <div class="input-group">
                            <input type="text" class="form-control form--control copy-input pl-3"
                                value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
                            <div class="input-group-append">
                                <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i
                                        class="la la-copy mr-1"></i> Copy</button>
                            </div>
                        </div>
                    </div><!-- end copy-to-clipboard -->
                </div><!-- end modal-body -->
                <div class="modal-footer justify-content-center border-top-gray">
                    <ul class="social-icons social-icons-styled">
                        <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                        <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                        <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                    </ul>
                </div><!-- end modal-footer -->
            </div><!-- end modal-content-->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog"
        aria-labelledby="reportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse
                        </h5>
                        <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it
                            violates Terms of Service or Community Guidelines. If you have a question or technical
                            issue, please contact our
                            <a href="contact.html" class="text-color hover-underline">Support team here</a>.
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <form method="post">
                        <div class="input-box">
                            <label class="label-text">Select Report Type</label>
                            <div class="form-group">
                                <div class="select-container w-auto">
                                    <select class="select-container-select">
                                        <option value>-- Select One --</option>
                                        <option value="1">Inappropriate Course Content</option>
                                        <option value="2">Inappropriate Behavior</option>
                                        <option value="3">Aduca Policy Violation</option>
                                        <option value="4">Spammy Content</option>
                                        <option value="5">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Write Message</label>
                            <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="message" placeholder="Provide additional details here..."
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <div class="btn-box text-right pt-2">
                            <button type="button" class="btn font-weight-medium mr-3"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i
                                    class="la la-arrow-right icon ml-1"></i></button>
                        </div>
                    </form>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->




    <!-- template js files -->
    <script src="{{ asset('frontend') }}/js/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/isotope.js"></script>
    <script src="{{ asset('frontend') }}/js/waypoint.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/fancybox.js"></script>
    <script src="{{ asset('frontend') }}/js/plyr.js"></script>
    <script src="{{ asset('frontend') }}/js/datedropper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/emojionearea.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery-te-1.4.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.MultiFile.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script>
        var player = new Plyr('#player');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        // Function to open the first lecture when the page loads
        function openFirstLecture() {
            const firstLecture = document.querySelector('.lecture-title'); // Get the first lecture element
            if (firstLecture) {
                firstLecture.click(); // Trigger the click event on the first lecture
            }
        }

        // Function to handle lecture clicks and load content
        function viewLesson(videoUrl, vimeoUrl, textContent) {
            const video = document.getElementById("videoContainer");
            const text = document.getElementById("textLesson");
            const textContainer = document.createElement("div");

            if (videoUrl && videoUrl.trim() !== "") {
                video.classList.remove("d-none");
                text.classList.add("d-none");
                text.innerHTML = "";
                video.setAttribute("src", videoUrl);
            } else if (vimeoUrl && vimeoUrl.trim() !== "") {
                video.classList.remove("d-none");
                text.classList.add("d-none");
                text.innerHTML = "";
                video.setAttribute("src", vimeoUrl);
            } else if (textContent && textContent.trim() !== "") {
                video.classList.add("d-none");
                text.classList.remove("d-none");
                text.innerHTML = "";
                textContainer.innerText = textContent;
                textContainer.style.fontSize = "14px";
                textContainer.style.textAlign = "left";
                textContainer.style.paddingLeft = "40px";
                textContainer.style.paddingRight = "40px";
                text.appendChild(textContainer);
            }
        }

        // Add a click event listener to all lecture elements
        document.querySelectorAll('.lecture-title').forEach((lectureTitle) => {
            lectureTitle.addEventListener('click', () => {
                const videoUrl = lectureTitle.getAttribute('data-video-url');
                const vimeoUrl = lectureTitle.getAttribute('data-vimeo-url');
                const textContent = lectureTitle.getAttribute('data-content');
                viewLesson(videoUrl, vimeoUrl, textContent);
            });
        });

        // Open the first lecture when the page loads
        window.addEventListener('load', () => {
            openFirstLecture();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#qna').validate({
                rules: {
                    subject: {
                        required: true,
                    },
                    message: {
                        required: true,
                    },
                },
                messages: {
                    subject: {
                        required: 'Please Enter Subject',
                    },
                    message: {
                        required: 'Please Enter Message',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    @if ($errors->any())
        <script>
            // Mendefinisikan variabel untuk menyimpan pesan kesalahan
            var errorMessage = '';
            // Iterasi melalui setiap pesan kesalahan yang diterima dari validator
            @foreach ($errors->all() as $error)
                errorMessage += "{{ $error }}<br>";
            @endforeach

            // Menampilkan pesan kesalahan dalam SweetAlert
            Swal.fire(
                'Error!',
                errorMessage,
                'error'
            );
        </script>
    @endif

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>




</body>

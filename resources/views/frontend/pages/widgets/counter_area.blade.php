<div class="counter-area">
    <div class="counter-wrap">
        <div class="col-lg-11 ms-lg-auto">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                        <div class="icon">
                            <img src="{{ asset('assets/frontend') }}/img/icon/student.svg" alt="" />
                        </div>
                        <div class="content">
                            <div class="info">
                                    @php $sVal = $studentsCounter['value'] ?? 150; $sUnit = $studentsCounter['unit'] ?? 'k'; @endphp
                                    <span class="counter" data-to="{{ $sVal }}" data-speed="3000">{{ $sVal }}</span>
                                    <span class="unit">{{ $sUnit }}</span>
                                </div>
                                <h6 class="title">Students Enrolled</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                        <div class="icon">
                            <img src="{{ asset('assets/frontend') }}/img/icon/course-2.svg" alt="" />
                        </div>
                        <div class="content">
                            <div class="info">
                                    @php $cVal = $coursesCounter['value'] ?? 25; $cUnit = $coursesCounter['unit'] ?? 'K'; @endphp
                                    <span class="counter" data-to="{{ $cVal }}" data-speed="3000">{{ $cVal }}</span>
                                    <span class="unit">{{ $cUnit }}</span>
                            </div>
                            <h6 class="title">Total Courses</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                        <div class="icon">
                            <img src="{{ asset('assets/frontend') }}/img/icon/instructor-2.svg" alt="" />
                        </div>
                        <div class="content">
                            <div class="info">
                                    @php $tVal = $tutorsCounter['value'] ?? 120; $tUnit = $tutorsCounter['unit'] ?? '+'; @endphp
                                    <span class="counter" data-to="{{ $tVal }}" data-speed="3000">{{ $tVal }}</span>
                                    <span class="unit">{{ $tUnit }}</span>
                            </div>
                            <h6 class="title">Expert Tutors</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                        <div class="icon">
                            <img src="{{ asset('assets/frontend') }}/img/icon/award.svg" alt="" />
                        </div>
                        <div class="content">
                            <div class="info">
                                    @php $aVal = $awardsCounter['value'] ?? 50; $aUnit = $awardsCounter['unit'] ?? '+'; @endphp
                                    <span class="counter" data-to="{{ $aVal }}" data-speed="3000">{{ $aVal }}</span>
                                    <span class="unit">{{ $aUnit }}</span>
                            </div>
                            <h6 class="title">Awards</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="listing-hours">

    @if(!empty($today_schedule))
        <div class="listing-day current">
            <div class="day">امروز <span></span></div>
            <div class="time-items">
                                                    <span class="open-status"><span
                                                            class="badge bg-success-light">باز</span></span>
                <span
                    class="time">{{"$today_schedule->begin_time  $today_schedule->end_time"}}</span>
            </div>
        </div>

    @else

        <div class="listing-day closed current ">
            <div class="day">امروز</div>
            <div class="time-items">
                  <span class="time"><span
                          class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>

    @endif



    @if(!empty($Saturday))
        <div class="listing-day">
            <div class="day">شنبه</div>
            <div class="time-items">
                                     <span
                                         class="time">{{"$Saturday->begin_time  $Saturday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">شنبه</div>
            <div class="time-items">
                                                        <span class="time"><span
                                                                class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif



    @if(!empty($Sunday))
        <div class="listing-day">
            <div class="day">یکشنبه</div>
            <div class="time-items">
             <span
                 class="time">{{"$Sunday->begin_time  $Sunday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">یکشنبه</div>
            <div class="time-items">
         <span class="time"><span
                 class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif

    @if(!empty($Monday))
        <div class="listing-day">
            <div class="day">دوشنبه</div>
            <div class="time-items">
           <span
               class="time">{{"$Monday->begin_time  $Monday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">دوشنبه</div>
            <div class="time-items">
     <span class="time"><span
             class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif

    @if(!empty($Tuesday))
        <div class="listing-day">
            <div class="day">سه شنبه</div>
            <div class="time-items">
                                                            <span
                                                                class="time">{{"$Tuesday->begin_time  $Tuesday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">سه شنبه</div>
            <div class="time-items">
                                                        <span class="time"><span
                                                                class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif





    @if(!empty($Wednesday))
        <div class="listing-day">
            <div class="day">چهار شنبه</div>
            <div class="time-items">
                                                            <span
                                                                class="time">{{"$Wednesday->begin_time  $Wednesday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">چهار شنبه</div>
            <div class="time-items">
                                                        <span class="time"><span
                                                                class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif




    @if(!empty($Thursday))
        <div class="listing-day">
            <div class="day">پنجشنبه</div>
            <div class="time-items">
                                                            <span
                                                                class="time">{{"$Thursday->begin_time  $Thursday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">پنجشنبه</div>
            <div class="time-items">
                                                        <span class="time"><span
                                                                class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif





    @if(!empty($Friday))
        <div class="listing-day">
            <div class="day">جمعه</div>
            <div class="time-items">
                                                            <span
                                                                class="time">{{"$Friday->begin_time  $Friday->end_time"}}</span>
            </div>
        </div>

    @else
        <div class="listing-day closed">
            <div class="day">جمعه</div>
            <div class="time-items">
                                                        <span class="time"><span
                                                                class="badge bg-danger-light">بسته</span></span>
            </div>
        </div>
    @endif
</div>

@if($item->patient)

    <tr>
        <td>
            @if($item->patient)
                <h2 class="table-avatar">
                    <a href="#"
                       class="avatar avatar-sm me-2"><img
                            class="avatar-img rounded-circle"
                            src="{{isset($item->patient->media) ? $item->patient->media->url : asset('assets/img/avatar.jpg')}}"
                            alt="User Image"></a>
                    <a href="patient-profile.html">
                        {{$item->patient->full_name}}
                        <span>#{{$item->number}}</span></a>

                </h2>
            @else
                کاربر وجود ندارد
            @endif

        </td>
        <td>{{$item->res_date_arr[0]}} <span
                class="d-block text-info">{{$item->res_date_arr[1]}}</span>
        </td>

        <td>معاینه</td>
        <td>نوبت غیرحضوری</td>
        <td class="text-center"> {{number_format($item->price)}}
            تومان
        </td>
        <td class="text-end">
            <div class="table-action">
                <a href="{{route('doctor.profile.factor',['id'=>$item->id])}}"
                   class="btn btn-sm bg-info-light">
                    <i class="far fa-eye"></i> مشاهده
                </a>
                {{--                                                                            <a href="javascript:void(0);"--}}
                {{--                                                                               class="btn btn-sm bg-success-light">--}}
                {{--                                                                                <i class="fas fa-check"></i> قبول--}}
                {{--                                                                            </a>--}}
                {{--                                                                            <a href="javascript:void(0);"--}}
                {{--                                                                               class="btn btn-sm bg-danger-light">--}}
                {{--                                                                                <i class="fas fa-times"></i> حذف--}}
                {{--                                                                            </a>--}}
            </div>
        </td>
    </tr>
@endif

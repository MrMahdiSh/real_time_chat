<div class="booking-item-wrap">
    <ul class="booking-date">
        <li>هزینه
            محصول<span>{{number_format($patient_user->getAmountProductPrice(),null).' تومان '}}</span>
        </li>
        <li>حمل و
            نقل<span>{{(int)$product_setting->transfer_price>0 ? number_format($product_setting->transfer_price,null).'تومان' : 'رایگان'}} </span>
        </li>
    </ul>
    <ul class="booking-fee pt-4">
        <li>
            مالیات<span>{{(int)$product_setting->tax_price>0 ? "{$product_setting->tax_price}%" : 'بدون مالیات'}} </span>
        </li>
    </ul>
    <div class="booking-total">
        <ul class="booking-total-list">
            <li>
                <span>مبلغ نهایی پرداختی</span>
                <span
                    class="total-cost">{{number_format($patient_user->TotalPriceProduct(),null)}}تومان</span>
            </li>


        </ul>
    </div>
</div>

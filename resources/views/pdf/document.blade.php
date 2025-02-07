<!DOCTYPE html>
<html>
<head>
</head>
<style>
    @page {
        margin: 10px;
    }
    .footer-div {
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        text-align: center;

    }
    .page-break {

    page-break-before: always;

    }
</style>
<body>
    <table style="line-height: 1em;padding:0px;">
        <tr>
            <td style="padding:0px;"><img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:100px;width:100px;"></td>
            <td >
                <span style="font-size:30px;">Alif Medical Centre</span></br>
                <span style="font-size:16px;">Polashbari Bus Stand</span></br>
                <span style="font-size:16px;">Ashulia,Savar,Dhaka-1344,Mob:01616444566</span>
            </td>
            <td style="font-size:14px;vertical-align: top;text-align:right;font-weight:800;">Diagonostic Invoice</td>

    </table>
    <table style="width:100%;">
        <tr>
            <td style="width: 40%;">
                <img src="data:image/png;base64,{{ base64_encode($billImg) }}" style="opacity: .8;height:20px;width:100px;">
            </td>
            <td  style="width: 20%;"><span style="border:1px solid black;padding:10px;font-weight:bold;">{!! "Patient Copy" !!}</span></td>
            <td  style="width: 40%;text-align:right;">
                <img src="data:image/png;base64,{{ base64_encode($patientImg) }}" style="opacity: .8;height:20px;width:100px;">
            </td>
        </tr>
        <tr>
            <td style="width: 35%;font-size:16px;">
                Invoice No. {!! $main->bill_id !!}
            </td>
            <td  style="width: 30%;"></td>
            <td  style="width: 35%;text-align:right;font-size:16px;">
                Patient ID. {!! $main->patient->patient_id !!}
            </td>
        </tr>
    </table>
    <table style="font-size:16px;width:100%;border:1px solid black;margin-top:5px;">
        <tr>
            <td style="width: 20%;">Name</td>
            <td style="width: 30%;">: {!! $main->patient->name !!}</td>
            <td style="width: 20%;text-align:right;">Age</td>
            <td style="width: 30%;">: {!! $main->patient->age !!}</td>
        </tr>
        <tr>
            <td style="width: 20%;">Phone No.</td>
            <td style="width: 30%;">: {!! $main->patient->contact_no !!}</td>
            <td style="width: 20%;text-align:right;">Gender</td>
            <td style="width: 30%;">: {!! $main->patient->sex == "M" ? "Male" : ($main->patient->sex == "F" ? "Female" : "Other") !!}</td>
        </tr>
        <tr>
            <td style="width: 20%;">Referrenced By</td>
            <td colspan="3">: {!! @$main->reference->name_eng !!}</td>

        </tr>
    </table>
    @php
        $i=0;
    @endphp
    <table cellpadding="2px" cellspacing="2px" width="100%" style="font-size:14px;width:100%;margin-top:5px;">
        <tbody>
            <tr  style="text-align:left;font-weight:600;">
                <td style="width: 5%;text-align:left;border-bottom:1px solid black;">SL</td>
                <td style="width: 30%;text-align:left;border-bottom:1px solid black;">Item Name</td>
                <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Room No</td>
                <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Rate</td>
                <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Qty</td>
                <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Amount</td>
            </tr>
            @foreach ($details as $item)
                <tr >
                    <td style="text-align:center;">{!! ++$i !!}</td>
                    <td style="">{!! $item->item_name !!}</td>
                    <td style="text-align:center;">{!! $item->room_no !!}</td>
                    <td style="text-align:center;">{!! $item->item_rate !!}</td>
                    <td style="text-align:center;">{!! $item->quantity !!}</td>
                    <td style="text-align:center;">{!! $item->price !!}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <table cellpadding="4px" cellspacing="2px" width="100%" style="font-size:14px;border-top:1px solid black;">
        <tbody>
            <tr>
                <td rowspan="2" colspan="3" style="text-align:right;">
                    <span style="text-align:left;font-size:12px;display:block;">Bill Date: {!! $main->created_at !!}</span>
                    <span style="text-align:left;font-size:12px;display:block;">Printed by: {!! $printed_by !!}</span>
                    <span style="text-align:left;font-size:12px;display:block;">Printed date: {!! $print_date !!}</span>
                </td>
                <td colspan="2" style="text-align:right;">Total Amount :</td>
                <td style="text-align:center;"> {!! $main->total_amount !!}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">Discount Amount :</td>
                <td style="text-align:center;font-weight:bold;"> {!! $main->discount_amount !!}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;">
                    <span style="border:3px solid black;padding:10px;border-radius:10px;font-weight:bolder;">{!! (int)$main->paid_status == 0 ?"DUE":"PAID" !!}</span>
                </td>
                <td colspan="2" style="text-align:right;">Payable Amount :</td>
                <td style="text-align:center;"> {!! $main->payable_amount !!}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:left;font-size:10px;">In words :{!! $paidinwords !!} tk only.</td>
                <td colspan="2" style="text-align:right;">Paid Amount :</td>
                <td style="text-align:center;font-weight:bold;"> {!! $main->paid_amount !!}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:left;font-size:10px;"></td>
                <td colspan="2" style="text-align:right;">Due Amount :</td>
                <td style="text-align:center;font-weight:bold;"> {!! $main->due_amount !!}</td>
            </tr>


        </tbody>
    </table>
    <div class="footer-div">
        <span style="border:1px dashed black;border-radius:5px;margin-bottom:10px;display:block;padding:5px;">
        @php
            $dateList = collect($details)->unique('delivery_date')->where('service_category_id',2)->pluck('delivery_date')->toArray();
        @endphp

           @foreach ($dateList as $date)
                @php
                    $itemList = collect($details)->where('delivery_date',$date)->where('service_category_id',2)->pluck('item_name')->toArray();
                @endphp
                <span style="text-align:left;font-size:12px;display:block;">(
                    @foreach ($itemList as $item)
                        <span>{!! $item !!},</span>
                    @endforeach
                    Delivery Date -
                    <span style="font-weight:bold;">{!! $date !!}</span> )
                </span>
           @endforeach
        </span>
        <span  style="text-align:center;padding:10px;border:1px solid black;display:block;font-size:14px;">N B:PLEASE,Collect Your Test Report Within 30 Days</span>
    </div>
    @if($menu == "billing")
        @php
            $roomList = collect($details)->unique('room_no')->where('service_category_id',2)->pluck('room_no')->toArray();
        @endphp
        @if(count($roomList) > 1 )
            @foreach ($roomList as $room)
            <table style="line-height: 1em;padding:0px;" class="page-break">
                <tr>
                    <td style="padding:0px;"><img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:100px;width:100px;"></td>
                    <td >
                        <span style="font-size:30px;">Alif Medical Centre</span></br>
                        <span style="font-size:16px;">Polashbari Bus Stand</span></br>
                        <span style="font-size:16px;">Ashulia,Savar,Dhaka-1344,Mob:01616444566</span>
                    </td>
                    <td style="font-size:14px;vertical-align: top;text-align:right;font-weight:800;">Diagonostic Invoice</td>

            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width: 40%;">
                        <img src="data:image/png;base64,{{ base64_encode($billImg) }}" style="opacity: .8;height:20px;width:100px;">
                    </td>
                    <td  style="width: 20%;"><span style="border:1px solid black;padding:10px;font-weight:bold;">{!! "Medical Copy" !!}</span></td>
                    <td  style="width: 40%;text-align:right;">
                        <img src="data:image/png;base64,{{ base64_encode($patientImg) }}" style="opacity: .8;height:20px;width:100px;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%;font-size:16px;">
                        Invoice No. {!! $main->bill_id !!}
                    </td>
                    <td  style="width: 30%;"></td>
                    <td  style="width: 35%;text-align:right;font-size:16px;">
                        Patient ID. {!! $main->patient->patient_id !!}
                    </td>
                </tr>
            </table>
            <table style="font-size:16px;width:100%;border:1px solid black;margin-top:5px;">
                <tr>
                    <td style="width: 20%;">Name</td>
                    <td style="width: 30%;">: {!! $main->patient->name !!}</td>
                    <td style="width: 20%;text-align:right;">Age</td>
                    <td style="width: 30%;">: {!! $main->patient->age !!}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Phone No.</td>
                    <td style="width: 30%;">: {!! $main->patient->contact_no !!}</td>
                    <td style="width: 20%;text-align:right;">Gender</td>
                    <td style="width: 30%;">: {!! $main->patient->sex == "M" ? "Male" : ($main->patient->sex == "F" ? "Female" : "Other") !!}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Referrenced By</td>
                    <td colspan="3">: {!! @$main->reference->name_eng !!}</td>

                </tr>
            </table>
            @php
                $i=0;
            @endphp
            <table cellpadding="2px" cellspacing="2px" width="100%" style="font-size:14px;width:100%;margin-top:5px;">
                <tbody>
                    <tr  style="text-align:left;font-weight:600;">
                        <td style="width: 5%;text-align:left;border-bottom:1px solid black;">SL</td>
                        <td style="width: 30%;text-align:left;border-bottom:1px solid black;">Item Name</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Room No</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Rate</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Qty</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Amount</td>
                    </tr>
                    @foreach ($details as $item)
                        <tr >
                            <td style="text-align:center;">{!! ++$i !!}</td>
                            <td style="">{!! $item->item_name !!}</td>
                            <td style="text-align:center;">{!! $item->room_no !!}</td>
                            <td style="text-align:center;">{!! $item->item_rate !!}</td>
                            <td style="text-align:center;">{!! $item->quantity !!}</td>
                            <td style="text-align:center;">{!! $item->price !!}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table cellpadding="4px" cellspacing="2px" width="100%" style="font-size:14px;border-top:1px solid black;">
                <tbody>
                    <tr>
                        <td rowspan="2" colspan="3" style="text-align:right;">
                            <span style="text-align:left;font-size:12px;display:block;">Bill Date: {!! $main->created_at !!}</span>
                            <span style="text-align:left;font-size:12px;display:block;">Printed by: {!! $printed_by !!}</span>
                            <span style="text-align:left;font-size:12px;display:block;">Printed date: {!! $print_date !!}</span>
                        </td>
                        <td colspan="2" style="text-align:right;">Total Amount :</td>
                        <td style="text-align:center;"> {!! $main->total_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right;">Discount Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->discount_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right;">
                            <span style="border:3px solid black;padding:10px;border-radius:10px;font-weight:bolder;">{!! (int)$main->paid_status == 0 ?"DUE":"PAID" !!}</span>
                        </td>
                        <td colspan="2" style="text-align:right;">Payable Amount :</td>
                        <td style="text-align:center;"> {!! $main->payable_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:left;font-size:10px;">
                        In words : {!! $paidinwords !!} tk only.
                        </td>
                        <td colspan="2" style="text-align:right;">Paid Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->paid_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right;"></td>
                        <td colspan="2" style="text-align:right;">Due Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->due_amount !!}</td>
                    </tr>

                </tbody>
            </table>
            <div class="footer-div">
                <span style="border:1px dashed black;border-radius:5px;margin-bottom:10px;display:block;padding:5px;">
                @php
                    $dateList = collect($details)->unique('delivery_date')->where('service_category_id',2)->pluck('delivery_date')->toArray();
                @endphp

                @foreach ($dateList as $date)
                        @php
                            $itemList = collect($details)->where('delivery_date',$date)->where('service_category_id',2)->pluck('item_name')->toArray();
                        @endphp
                        <span style="text-align:left;font-size:12px;display:block;">(
                            @foreach ($itemList as $item)
                                <span>{!! $item !!},</span>
                            @endforeach
                            Delivery Date -
                            <span style="font-weight:bold;">{!! $date !!}</span> )
                        </span>
                @endforeach
                </span>
                <span  style="text-align:center;padding:10px;border:1px solid black;display:block;font-size:14px;">N B:PLEASE,Collect Your Test Report Within 30 Days</span>
            </div>
            @endforeach
        @else
            <table style="line-height: 1em;padding:0px;" class="page-break">
                <tr>
                    <td style="padding:0px;"><img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:100px;width:100px;"></td>
                    <td >
                        <span style="font-size:30px;">Alif Medical Centre</span></br>
                        <span style="font-size:16px;">Polashbari Bus Stand</span></br>
                        <span style="font-size:16px;">Ashulia,Savar,Dhaka-1344,Mob:01616444566</span>
                    </td>
                    <td style="font-size:14px;vertical-align: top;text-align:right;font-weight:800;">Diagonostic Invoice</td>

            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width: 40%;">
                        <img src="data:image/png;base64,{{ base64_encode($billImg) }}" style="opacity: .8;height:20px;width:100px;">
                    </td>
                    <td  style="width: 20%;"><span style="border:1px solid black;padding:10px;font-weight:bold;">{!! "Medical Copy" !!}</span></td>
                    <td  style="width: 40%;text-align:right;">
                        <img src="data:image/png;base64,{{ base64_encode($patientImg) }}" style="opacity: .8;height:20px;width:100px;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%;font-size:16px;">
                        Invoice No. {!! $main->bill_id !!}
                    </td>
                    <td  style="width: 30%;"></td>
                    <td  style="width: 35%;text-align:right;font-size:16px;">
                        Patient ID. {!! $main->patient->patient_id !!}
                    </td>
                </tr>
            </table>
            <table style="font-size:16px;width:100%;border:1px solid black;margin-top:5px;">
                <tr>
                    <td style="width: 20%;">Name</td>
                    <td style="width: 30%;">: {!! $main->patient->name !!}</td>
                    <td style="width: 20%;text-align:right;">Age</td>
                    <td style="width: 30%;">: {!! $main->patient->age !!}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Phone No.</td>
                    <td style="width: 30%;">: {!! $main->patient->contact_no !!}</td>
                    <td style="width: 20%;text-align:right;">Gender</td>
                    <td style="width: 30%;">: {!! $main->patient->sex == "M" ? "Male" : ($main->patient->sex == "F" ? "Female" : "Other") !!}</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Referrenced By</td>
                    <td colspan="3">: {!! @$main->reference->name_eng !!}</td>

                </tr>
            </table>
            @php
                $i=0;
            @endphp
            <table cellpadding="2px" cellspacing="2px" width="100%" style="font-size:14px;width:100%;margin-top:5px;">
                <tbody>
                    <tr  style="text-align:left;font-weight:600;">
                        <td style="width: 5%;text-align:left;border-bottom:1px solid black;">SL</td>
                        <td style="width: 30%;text-align:left;border-bottom:1px solid black;">Item Name</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Room No</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Rate</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Qty</td>
                        <td style="width: 15%;text-align:center;border-bottom:1px solid black;">Amount</td>
                    </tr>
                    @foreach ($details as $item)
                        <tr >
                            <td style="text-align:center;">{!! ++$i !!}</td>
                            <td style="">{!! $item->item_name !!}</td>
                            <td style="text-align:center;">{!! $item->room_no !!}</td>
                            <td style="text-align:center;">{!! $item->item_rate !!}</td>
                            <td style="text-align:center;">{!! $item->quantity !!}</td>
                            <td style="text-align:center;">{!! $item->price !!}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table cellpadding="4px" cellspacing="2px" width="100%" style="font-size:14px;border-top:1px solid black;">
                <tbody>
                    <tr>
                        <td rowspan="2" colspan="3" style="text-align:right;">
                            <span style="text-align:left;font-size:12px;display:block;">Bill Date: {!! $main->created_at !!}</span>
                            <span style="text-align:left;font-size:12px;display:block;">Printed by: {!! $printed_by !!}</span>
                            <span style="text-align:left;font-size:12px;display:block;">Printed date: {!! $print_date !!}</span>
                        </td>
                        <td colspan="2" style="text-align:right;">Total Amount :</td>
                        <td style="text-align:center;"> {!! $main->total_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right;">Discount Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->discount_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right;">
                            <span style="border:3px solid black;padding:10px;border-radius:10px;font-weight:bolder;">{!! (int)$main->paid_status == 0 ?"DUE":"PAID" !!}</span>
                        </td>
                        <td colspan="2" style="text-align:right;">Payable Amount :</td>
                        <td style="text-align:center;"> {!! $main->payable_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:left;font-size:10px;">
                        In words : {!! $paidinwords !!} tk only.
                        </td>
                        <td colspan="2" style="text-align:right;">Paid Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->paid_amount !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right;"></td>
                        <td colspan="2" style="text-align:right;">Due Amount :</td>
                        <td style="text-align:center;font-weight:bold;"> {!! $main->due_amount !!}</td>
                    </tr>

                </tbody>
            </table>
            <div class="footer-div">
                <span style="border:1px dashed black;border-radius:5px;margin-bottom:10px;display:block;padding:5px;">
                @php
                    $dateList = collect($details)->unique('delivery_date')->where('service_category_id',2)->pluck('delivery_date')->toArray();
                @endphp

                @foreach ($dateList as $date)
                        @php
                            $itemList = collect($details)->where('delivery_date',$date)->where('service_category_id',2)->pluck('item_name')->toArray();
                        @endphp
                        <span style="text-align:left;font-size:12px;display:block;">(
                            @foreach ($itemList as $item)
                                <span>{!! $item !!},</span>
                            @endforeach
                            Delivery Date -
                            <span style="font-weight:bold;">{!! $date !!}</span> )
                        </span>
                @endforeach
                </span>
                <span  style="text-align:center;padding:10px;border:1px solid black;display:block;font-size:14px;">N B:PLEASE,Collect Your Test Report Within 30 Days</span>
            </div>
        @endif
    @endif
</body>
</html>

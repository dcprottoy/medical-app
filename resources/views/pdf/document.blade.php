<!DOCTYPE html>
<html>
<head>
    <table style="line-height: 1em;padding:0px;">
        <tr>
            <td style="padding:0px;"><img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:70px;width:70px;"></td>
            <td >
                <span style="font-size:large;">Alif Medical Centre</span></br>
                <span style="font-size:16px;">Polashbari Bus Stand</span></br>
                <span style="font-size:16px;">Ashulia,Savar,Dhaka-1344,Mob:01616444566</span>
            </td>
            <td style="font-size:16px;vertical-align: top;text-align:right;font-weight:800;">Diagonostic Invoice</td>

    </table>
</head>
<style>
    @page {
        margin: 10px;
    }
</style>
<body>

    <table style="width:100%;">
        <tr>
            <td style="width: 40%;">
                <img src="data:image/png;base64,{{ base64_encode($billImg) }}" style="opacity: .8;height:20px;width:100px;">
            </td>
            <td  style="width: 20%;"></td>
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
            <td colspan="3">: {!! $main->referrence_id == 1 ? "Self" : "" !!}</td>

        </tr>
    </table>
    @php
        $i=0;
    @endphp
    <table cellpadding="2px" cellspacing="0" width="100%" style="font-size:16px;width:100%;border:1px solid black;margin-top:5px;">
        <tbody>
            <tr  style="text-align:left;font-weight:600;">
                <td style="width: 5%;text-align:left;">SL</td>
                <td style="width: 30%;text-align:left;">Item Name</td>
                <td style="width: 15%;text-align:left;">Del. Date</td>
                <td style="width: 15%;text-align:center;">Rate</td>
                <td style="width: 15%;text-align:center;">Qty</td>
                <td style="width: 15%;text-align:center;">Amount</td>
            </tr>
            @foreach ($details as $item)
                <tr >
                    <td style="border-top:1px solid black;text-align:center;">{!! ++$i !!}</td>
                    <td style="border-top:1px solid black;">{!! $item->item_name !!}</td>
                    <td style="border-top:1px solid black;">{!! $item->delivery_date !!}</td>
                    <td style="border-top:1px solid black;text-align:center;">{!! $item->item_rate !!}</td>
                    <td style="border-top:1px solid black;text-align:center;">{!! $item->quantity !!}</td>
                    <td style="border-top:1px solid black;text-align:center;">{!! $item->price !!}</td>

                </tr>
            @endforeach
                <tr>
                    <td rowspan="6" colspan="3" style="border-top:1px solid black;text-align:center;"></td>
                    <td colspan="2" style="text-align:right;border-top:1px solid black;">Total Amount :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->total_amount !!}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">Discount Amount :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->discount_amount !!}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">Discount Percentage :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->discount_percent !!}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">Payable Amount :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->payable_amount !!}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">Paid Amount :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->paid_amount !!}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">Due Amount :</td>
                    <td style="border-top:1px solid black;border-left:1px solid black;text-align:center;"> {!! $main->due_amount !!}</td>
                </tr>
        </tbody>
    </table>

</body>
</html>

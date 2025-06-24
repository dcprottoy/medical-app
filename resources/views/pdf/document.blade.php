<!DOCTYPE html>
<html>
<head>
</head>
<style>
    @page {
        margin:20px;
        margin-top:30px;
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
    <table style="line-height: 1em;padding:0px;width:100%;">
        <tr style="">
            <td style="padding:0px;width:50%;">
                <img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:110px;width:110px;">
            </td>
            <td style="padding:0px;width:50%;text-align:right;">
                <span style="font-size:22px;text-transform:uppercase;font-weight:bold;line-height: 2em;">DR. MD Golam Hossain</span></br>
                <span style="font-size:15px;text-transform:uppercase;">MBBS (du),mcps(bcps),fcgp(bd), FIAGP(INDIA)</span></br>
                <span style="font-size:15px;text-transform:uppercase;">ccu(sub), C.paed(bich),c.diab(birdem)</span></br>
                <span style="font-size:14px;text-transform:capitalize;">specialist in family medecine</span></br>
                <span style="font-size:14px;text-transform:capitalize;">sonologist, diabetologist & children's physician</span>
            </td>


    </table>
    <table style="width:100%;margin-top:5px;">
        <tr>
            <td style="width: 50%;">
                <img src="data:image/png;base64,{{ base64_encode($billImg) }}" style="opacity: .8;height:25px;width:200px;">
            </td>
            <td  style="width: 50%;text-align:right;">
                <img src="data:image/png;base64,{{ base64_encode($patientImg) }}" style="opacity: .8;height:25px;width:200px;">
            </td>
        </tr>
        <tr>
            <td style="width: 50%;font-size:12px;">
                Prescription No. {!! $main->bill_id !!}
            </td>
            <td  style="width: 50%;text-align:right;font-size:12px;">
                Patient ID. {!! $main->patient->patient_id !!}
            </td>
        </tr>
    </table>
    
</body>
</html>

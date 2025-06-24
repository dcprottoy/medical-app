<!DOCTYPE html>
<html>
<head>
</head>
<style>
    @page {
        margin:20px;
        margin-top:30px;
        margin-bottom:0px;
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
            <td style="padding:0px;width:25%;" align="center">
                <img src="backend/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:110px;width:110px;">
            </td>
            <td style="padding:0px;width:25%;">
                &nbsp;
            </td>
            <td style="padding:0px;width:50%;text-align:right;">
                <span style="font-size:20px;text-transform:uppercase;font-weight:bold;line-height: 2em;">DR. MD Golam Hossain</span></br>
                <span style="font-size:14px;text-transform:uppercase;">MBBS (du),mcps(bcps),fcgp(bd), FIAGP(INDIA)</span></br>
                <span style="font-size:14px;text-transform:uppercase;">ccu(sub), C.paed(bich),c.diab(birdem)</span></br>
                <span style="font-size:13px;text-transform:capitalize;">specialist in family medecine sonologist, diabetologist</span></br>
                <span style="font-size:13px;text-transform:capitalize;">children's physician</span>
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
    <table style="line-height: 1em;width:100%;border-bottom:1px solid black;border-top:1px solid black;border-collapse: collapse;margin-top:15px;">
        <tr>
            <td style="width: 25%;font-size:12px;padding-bottom:5px;" align="center">
                Name : {!! $main->patient->name !!}
            </td>
            <td  style="width: 25%;font-size:12px;padding-bottom:5px;" align="right">
                Age : {!! $main->patient->age !!}
            </td>

            <td style="width: 25%;font-size:12px;padding-bottom:5px;" align="right">
                Gender : {!! $main->patient->sex == 'M'?'Male':($main->patient->sex == 'F'?'Female':'Other') !!}
            </td>
            <td  style="width: 25%;font-size:12px;padding-bottom:5px;" align="center">
                Date : 2025-06-24
            </td>
        </tr>
    </table>
   <table cellpadding="10" cellspacing="0" width="100%">
  <tr>
    <td style="width: 35%; vertical-align: top;height:78%;border-right:1px solid black;font-size:12px;">
    <strong>Chief Complaint : </strong>
      <ul>
        <li>Fever</li>
        <li>Oain In Chest</li>
        <li>Cough</li>
        <li>Fast breathing</li>
      </ul>
      <strong>On Examination:</strong><br>
      <table style="width: 100%;">
        <tr>
            <td style="width:60%;text-align:left;">Temperature : <b>100&nbsp;<sup>o</sup>&nbsp;F</b></td>
            <td style="width:60%;text-align:left;">Pressure : <b>110/160</b></td>
        </tr>
        <tr>
            <td style="width:40%;text-align:left;">Weight : <b>52 Kg</b></td>
            <td style="width:40%;text-align:left;">Height : <b>5"4'</b></td>
        </tr>
      </table>
    </td>
    <td style="width: 68%; vertical-align: top;font-size:12px;">
      <strong>Diagnosis :</strong><br>
        <ul>
            <li>Fever</li>
            <li>Hypertension</li>
        </ul>
        <br>
      <h2>Rx</h2>
      
  
    </td>
  </tr>
</table>


       
   
</body>
</html>

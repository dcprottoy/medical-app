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
                <span style="font-size:14px;text-transform:uppercase;">ccu(sub), C.paed(bich), c.diab(birdem)</span></br>
                <span style="font-size:13px;text-transform:capitalize;">specialist in family medecine, sonologist, diabetologist &</span></br>
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
                Prescription No. {!! $main->prescription_id !!}
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
                Date : {{$main->prescribed_date}}
            </td>
        </tr>
    </table>
   <table cellpadding="10" cellspacing="0" width="100%">
  <tr>
    <td style="width: 35%; vertical-align: top;height:78%;border-right:1px solid black;font-size:12px;">
    <strong>Chief Complaint : </strong>
      <ul>
       @foreach ($complain as $x )
        <li>{{@$x->complaint}}&nbsp;{{@$x->complaint_duration}}&nbsp;{{@$x->complaint_duration_value}}&nbsp;</li>
       @endforeach
      </ul>
      <strong>On Examination:</strong><br><br>
      <table style="width: 100%;">
        <tr>
            <td style="width:60%;text-align:left;">Temperature : <b>{{@$onexam->temperature}}&nbsp;<sup>o</sup>&nbsp;F</b></td>
            <td style="width:60%;text-align:left;">Pressure : <b>{{@$onexam->pressure}}</b></td>
        </tr>
        <tr>
            <td style="width:40%;text-align:left;">Weight : <b>{{@$onexam->weight}}&nbsp;Kg</b></td>
            <td style="width:40%;text-align:left;">Height : <b>{{@$onexam->height}}&nbsp;</b></td>
        </tr>
      </table>
      <br>
      <strong>Investigations : </strong>
      <ul>
        @foreach($investigations as $x)
        <li>{{@$x->investigations_value}}</li>
        @endforeach
      </ul>
    </td>
    <td style="width: 68%; vertical-align: top;font-size:12px;">
      <strong>Diagnosis :</strong><br>
        <ul >
            @foreach($diagnosis as $x)
                <li>{{@$x->diagnosis_value}}</li>
            @endforeach
        </ul>
        <br>
      <h2>Rx</h2>
      <ol>
        @foreach($medicins as $data)
                <li style="padding:5px;">
                    <span style="font-size:15px;font-weight:500;">{{$data->medicine}}</span><br>
                    <span style="font-size:13px;"> {{$data->dose}} {{$data->dose_frequency ? " -- ".$data->dose_frequency:""}} {{$data->dose_duration ? " -- [ ".$data->dose_duration." ]":""}} {{$data->usage ? " -- ".$data->usage:""}}</span>
                </li>
        @endforeach
      </ol>
      <strong>Advice : </strong>
      <ul>
        @foreach($advices as $x)
        <li>{{@$x->advice_value}}</li>
        @endforeach
      </ul>
      <strong>Referred : </strong>
      <ul>
        @foreach($referred as $x)
        <li>{{@$x->referred}}</li>
        @endforeach
      </ul>
    </td>
  </tr>
</table>


       
   
</body>
</html>

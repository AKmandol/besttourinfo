<html>

<body style="background-color:#fff;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <div style="width:720px;border-radius:7px;border:1px solid #D47400;margin:0 auto;">
    <table style="width:670px;margin:10px auto 10px;background-color:#fff;padding:50px;border-radius:7px;border-top: solid 15px green;border-left:.1px solid green;border-right:.1px solid green;border-bottom:.1px solid green;">
        
      <thead> 
          <tr>
            <th style="text-align:left;"><img style="max-width: 180px;" src="https://besttourinfo.com/img/logo.png" alt="Besttourinfo.com"></th>
            <th style="text-align:right;font-weight:500;font-size:15px">{{ date("Y.m.d") }}</th>
          </tr>
        </thead>

        <tbody>

          <tr>
            <td style="height:20px;"></td>
          </tr>

          <tr style="text-aling:center;width:300%;background:#F0FFFF;">
            <td style="width:100%;border-radius: 7px;text-align: center;border: 1px dashed #F57017;padding:15px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);"  colspan="2">
              
              <h1 style="width:100%;text-aling: center">New Order Car Recived</h1>
              <h6 style="font-size:20px;text-aling: center; padding: 3px; color: rgb(0, 87, 22)">  Order Id:  BTI_C-{{$trans}}</h6>

            </td>
          </tr>

        </tbody>
      
    </table>

    <p style="margin-top:30px"></p>
    <h2 style="width:670px;text-align:center;margin:0 auto;color:#E06100">Booking Details</h2>
    <hr style="width:100px;height:1px;text-align:center;margin:0 auto;background-color:green">
    <table style="width:670px;margin:10px auto 10px;padding:30px 20px;border-radius: 7px;background:#EBEBEB;border:1px dashed green">

      <thead> 
        <tr>
          <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">Booking Status</th>
          <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Pick Up Date</th>
          @if($drop_off)
          <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">Drop Off Date</th>
          @endif
        </tr>
      </thead>

      <tr>
        <td style="height:10px;"></td>
      </tr>

      <tbody>
      
        <tr>
          <td style="text-align:left;color:blue">
            Pending
          </td>
          <td style="text-align:center;color:#000;">
          {{$pick_up}}
          </td>
          @if($drop_off)
          <td style="text-align:center;color:#000;">
          {{$drop_off}}
          </td>
          @endif
        </tr>

      </tbody>

    </table>

    <table style="width:670px;margin:10px auto 10px;padding:30px 20px;border-radius: 7px;background:#d4f2f0;border:1px dashed green">

        <thead> 
          <tr>
            <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">Packeage Name</th>
            <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Car Type</th>
            <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Total Cost</th>
          </tr>
        </thead>
  
        <tr>
          <td style="height:10px;"></td>
        </tr>
  
        <tbody>
        @foreach($booking as $item)
          <tr>
            <td style="text-align:left;color:rgb(0, 148, 7)">
                {{$item['extra_one']}}
            </td>
            <td style="text-align:center;color:#000;">
                {{$item['car_type']}}
            </td>
            <td style="text-align:center;color:#000;">
                {{$item['cost']}}
            </td>
          </tr>
        @endforeach
        </tbody>
  
      </table>


    <table style="width:670px;margin:60px auto 20px;background-color:#F6FDF1;padding:15px;border-radius:7px;color:#000;border-bottom: solid 1px orange;border-left:.1px solid orange;border-right:.1px solid orange;border-top:.1px solid orange;">
      <tfooter>
        <tr>
          <td style="font-size:14px;padding:5px;text-align:center;">
            <a style="verticaly-align:middle;text-decoration: none;color:#000" href="https://besttourinfo.com/admin-login">Go to Admin Panel<span style="verticaly-align:middle;text-decoration: underline;padding:0 3px;color:blue;">Click Here</span></a>
          </td>
        </tr>
      </tfooter>
    </table>

  </div>
</body>

</html>
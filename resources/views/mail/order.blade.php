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
              
              <h1 style="width:100%;text-aling: center">New Hotel Order Recived</h1>
              <p style="font-size:17px;text-aling: center">ORDER ID: <span style="font-size:13px;text-aling: center; color: #017464">BTI_H-{{$tarns}}</span></p> 

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
          <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Check In Date</th>
          <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">Check Out Date</th>
          <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">Total</th>
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
          {{$inDate}}
          </td>
          <td style="text-align:center;color:#000;">
          {{$outDate}}
          </td>
          <td style="text-align:right;color:#000;">
          {{ (strtotime($outDate) - strtotime($inDate)) / 86400 }} Nights
          </td>
        </tr>

      </tbody>

    </table>

    <p style="margin-top:10px"></p>
    <table style="width:670px;margin:10px auto 10px;padding:30px 20px;border-radius: 7px;background:#EBEBEB;border:1px dashed green">
      
      <thead> 
        <tr>
          <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">Number of Adult</th>
          <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Number of Children <span style="text-align:center;font-weight:500;font-size:13px;color:#000;">(Ages Below 10)</span></th>
        </tr>
      </thead>
      <tr>
        <td style="height:10px;"></td>
      </tr>
      <tbody>
        <tr>
          <td style="text-align:left;font-size:13px;">
          {{$adult}}
          </td>
          <td style="text-align:center;font-size:13px;">
          {{$child}}
          </td>
        </tr>

      </tbody>

    </table>

    <p style="margin-top:10px"></p>
    
    <table style="width:670px;margin:10px auto 10px;padding:30px 20px;border-radius: 7px;background:#FDFBFA;border:1px dashed green">

      <thead> 
        <tr>
          <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">Hotel Details</th>
          <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Room Type</th>
          <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">Rent Per Night</th>
        </tr>
      </thead>

      <tr>
        <td style="height:10px;"></td>
      </tr>

      <tbody>
        @foreach ($allHotel as $item)
        <tr>
          <td style="text-align:left;text-size:13px;font-weight:500;color:#00990D;margin-bottom:17px;border-bottom:.5px dashed green">
          {{$item['hotel_name']}} <br>
          {{$item['hotel_address']}} <br>
          {{$item['hotel_email']}} <br>
          {{$item['hotel_phone']}}
          </td>
          <td style="text-align:center;text-size:13px;font-weight:500;color:#000;margin-bottom:17px;">
          {{$item['room_type']}}
          </td>
          <td style="text-align:right;text-size:13px;font-weight:500;color:#000;margin-bottom:17px;">
          {{$item['price_original']}}x{{$item['room_no']}} = <span style="font-weight:bold;color:#BD1313;">৳ {{$item['price']}}</span><b style="font-size:12px;font-weight:300;margin-left: 2px">per night</b></span>
          </td>
        </tr>
        @endforeach

      </tbody>

    </table>

    <p style="margin-top:10px"></p>
    <table style="width:670px;margin:10px auto 10px;padding:30px 20px;border-radius: 7px;background:#EBEBEB;border:1px dashed green">
      @if ($payment_type != '')
      <thead> 
        <tr>
          <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">Payment Type</th>
          <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">Transaction ID</th>
          <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">Total Amount</th>
        </tr>
      </thead>
      @endif 
      <tr>
        <td style="height:10px;"></td>
      </tr>

      @if ($payment_type != '')
      <tbody>
        <tr>
          <td style="text-align:left;font-size:13px;">
          {{$payment_type}}
          </td>
          <td style="text-align:center;font-size:13px;">
          {{$transction_no}}
          </td>
          <td style="text-align:right;font-size:13px;">
          {{$subTotal}}
          </td>
        </tr>

      </tbody>
      @else
      <tbody>
        
        <p style="text-align:center;font-size:14px;font-weight:bold;;color:#000;">No Payment has been Made Yet.</p>
        <h6 style="text-align:center;font-size:16px;font-weight:bold;color:#000;margin-top:0">Amount to pay: <span style="color:#BD1313;margin-left:10px;">{{$subTotal}}</span> tk.</p>
        
      </tbody>
      @endif


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
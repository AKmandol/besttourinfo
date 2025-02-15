<html>

<body style="background-color:#fff;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <div style="width:720px;border-radius:7px;border:1px solid green;margin:0 auto;">
    <p style="font-weight:bold;text-align:center;font-size:14px;">Thank You For Choosing Us.</p>
    <table style="width:670px;margin:10px auto 10px;background-color:#fff;padding:50px;border-radius:7px;border-top: solid 15px #D47400;border-left:.1px solid #D47400;border-right:.1px solid #D47400;border-bottom:.1px solid #D47400;">
        
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
          <td style="width:100%;border-radius: 7px;text-align: center;border-bottom: 7px solid green;padding:15px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);"  colspan="2">
            <img src="https://besttourinfo.com/img/yes.png" width="100"> 
            <br>
            @if($status == "Payment_Recived")
            <h3 style="width:100%;text-aling: center;font-size:30px;color:#F26621">Payment Recived <span style="color:rgb(0, 0, 0);padding: 0 7px">৳ {{$clientEmail}}</span></h3>
            @else
            <h3 style="width:100%;text-aling: center;font-size:30px;color:#F26621">Booking is {{$status}}</h3>
            @endif
            <p style="font-size:17px;text-aling: center;font-weight:bold;">Booking Id: <span style="color:blue;padding: 0 7px">{{$orderId}}</span></p>

            <a href="https://besttourinfo.com/profile" style="font-size:14px;text-aling: center;font-weight:500;text-decoration:underline;cursor:pointer;color:#000">See Booking Details</a>

          </td>
        </tr>

      </tbody>
      
    </table>

    <p style="font-weight:bold;text-align:center;font-size:14px;">Follow us on Social Media for Exciting OFFER</p>
    <table style="width:210px;margin:10px auto 0;text-align:center">
      <thead> 
        <tr>
          <th style="text-align:center;width:70px;">
          <a href="https://www.facebook.com/besttourinfo.com.fb">
            <img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-512.png" width="35px" alt="">
          </a>
          </th>
          <th style="text-align:center;width:70px;">
          <a href="https://www.instagram.com/besttourinfo">
            <img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Instagram_colored_svg_1-512.png" width="35px" alt="">
          </a>
          </th>
          <th style="text-align:center;width:70px;">
          <a href="https://twitter.com/besttourinfocom">
            <img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Twitter_colored_svg-512.png" width="35px" alt="">
          </a>
          </th>
        </tr>
      </thead>
    
    </table>

    <table style="width:670px;margin:60px auto 20px;background-color:#E6FDF1;padding:15px;border-radius:7px;color:#000;border-bottom: solid 1px orange;border-left:.1px solid orange;border-right:.1px solid orange;border-top:.1px solid orange;">
     <tfooter>
       <tr>
         <td style="font-size:14px;padding:5px;text-align:center;">
           <a style="verticaly-align:middle;text-decoration: none;color:#000" href="https://besttourinfo.com/profile">For Changing Profile <span style="verticaly-align:middle;text-decoration: underline;padding:0 3px;color:blue;">Click Here</span> or Contact our Support Team.</a>
         </td>
       </tr>
     </tfooter>
   </table>

  </div>
</body>

</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style rel="stylesheet">
      .text-sm{
        font-size: 14px;
      }
      .border-cus{
        border: .5px solid #FAFAFA;
        border-radius: 4px;
      }

    </style>
  </head>
  <body class="p-3 m-0 border-0 m-0 border-0 bg-white">
   <div class="container-fluid border-cus p-3">
    <div class="row p-2 bg-light rounded">

      <div class="col-7 text-start">
        <img style="max-width: 150px;" src="https://besttourinfo.com/img/logo.png" alt="Besttourinfo.com">
      </div>

      <div class="col-5 my-auto text-end">
        <h6 class="text-sm">{{ date("Y.m.d") }}</h4>
      </div>

    </div>


    <div class="row mt-4">

      <div class="col-10 bg-white p-3 rounded shadow-sm  mx-auto text-center border-bottom border-success"> 
        <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 512 512"><style>svg{fill:#14ff5b}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg> <br>
          <h3>We have recived Your Booking</h5>
          <p>We will contact you shortly...</p>
      </div>

    </div>

    <div class="row mt-4">

      <div class="col-10 bg-white p-3 rounded shadow-sm  mx-auto text-center border-bottom border-success"> 
        <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 512 512"><style>svg{fill:#14ff5b}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg> <br>
          <h3>We have recived Your Booking</h5>
          <p>We will contact you shortly...</p>
      </div>

    </div>




   </div>
  </body>
</html>
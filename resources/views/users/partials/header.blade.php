<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" href="{{ home()->favicon ? \Storage::url(home()->favicon) : url('users/images/logob.png') }}" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
   rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="{{ url('users/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Additional CSS Files -->
<link rel="stylesheet" href="{{ url('users/assets/css/fontawesome.css') }}">
<!-- Font Awesome for icons (add to your head section if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('users/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ url('users/assets/css/owl.css') }}">

<meta name="google-site-verification" content="ZnhYdXGMAJInYfEIzgI2t5FkgOV2Ah-dEOEYF-XaFME" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16809560962"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16809560962');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KKC51RE044"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KKC51RE044');
</script>

<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-16809560962/9YiwCIzyoPwZEIKXts8-',
      'transaction_id': '',
      'event_callback': callback
  });
  return false;
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Word Scrambler</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        .center {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
}
    </style>
</head>
<body>
    <div class="container">
            @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $(document).ajaxError(function (e, xhr, options, exc) {
            $.unblockUI()

            if (xhr.status == 422) {

                var json = $.parseJSON(xhr.responseText);
                var errorsHtml = '';
                $('*[id*=error]').html('');
                $.each(json.errors, function (key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                    $(`#${key}_error`).html(value).show();
                });
            } else {
                var errorsHtml = xhr.responseText;
            }
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        html: errorsHtml,
                    });
            // Command: toastr["error"](errorsHtml);
        });
    </script>
    @yield('footer')
</body>
</html>
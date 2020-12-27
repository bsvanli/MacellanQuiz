<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Macellan Yönetim Paneli</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/datatables.min.css') }}" rel="stylesheet">

</head>
<body>

<div class="container-fluid">
    <div class="row">

        <main role="main" class="col-md-12">
            <div class="container">
                <div class="row mt-5">
                    <form id="loginForm"  class="form-signin" style="margin: 0 auto;">
                        <h1 class="h3 mb-3 font-weight-normal">Üye Girişi</h1>
                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" id="email" name="email" class="form-control mb-2" placeholder="E-mail Adresiniz" required autofocus>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Parolanız" required>
                        <button  id="send" class="btn btn-lg btn-primary btn-block mt-3" type="button">Giriş Yap</button>
                    </form>

                </div>
            </div>
        </main>
    </div>
</div>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/feather.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(function() {
        $(document).on('click', '#send', send);

        function send() {
            let button = $(this);
            $.ajax({
                url: '{{ route('panel.login-ajax') }}',
                method: 'POST',
                data: $('#loginForm').serialize(),
                beforeSend: function () {
                    button.text('Lütfen bekleyiniz');
                    button.attr('disabled', true);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseJSON.message);
                },
                success: function (response) {
                    location.href = response.data.redirect;
                },
                complete: function () {
                    button.text('Giriş Yap');
                    button.attr('disabled', false);
                }
            });
        }
    });
</script>
</body>
</html>

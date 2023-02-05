<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Aplikasi Absensi & Payroll</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="w-[300px] mt-[100px] mb-40 mx-auto text-center">
        <div class="text-sm font-semibold mb-1">Login Admin Aplikasi</div>
        <div class="text-xl font-bold mb-1">Absensi & Payroll</div>

        <form class="mt-10" action="/admin/login" method="POST">
            @csrf

            @include('components.alert', ['messages' => $errors->all(), 'alert' => 'error'])

            <div class="mb-4">
                <input type="text" placeholder="Username" name="username" class="anp-input" required>
            </div>
            <div class="mb-6">
                <input type="password" placeholder="Password" name="password" class="anp-input" required>
            </div>
            <div>
                <button type="submit" class="anp-submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>

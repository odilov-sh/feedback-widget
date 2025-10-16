<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Feedback App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @stack('styles')
</head>
<body>
@yield('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    function showToast(message, type = 'info') {
        let background;

        switch (type) {
            case 'success':
                background = "linear-gradient(to right, #00b09b, #96c93d)";
                break;
            case 'error':
            case 'danger':
                background = "linear-gradient(to right, #ff5f6d, #ffc371)";
                break;
            case 'info':
                background = "linear-gradient(to right, #2193b0, #6dd5ed)";
                break;
            case 'warning':
                background = "linear-gradient(to right, #f7971e, #ffd200)";
                break;
            default:
                background = "linear-gradient(to right, #00b09b, #96c93d)";
        }
        Toastify({
            text: message,
            className: type,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            style: {background},
        }).showToast();
    }

    function showErrorToast(message) {
        showToast(message, 'danger');
    }

    function showSuccessToast(message) {
        showToast(message, 'success');
    }
</script>

@stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Invoice</title>
</head>
<body>
    <script>
        window.onload = function() {
            window.location.href = "{{ route('post.download') }}";

            setTimeout(function() {
                window.location.href = "/my-dashboard/post/{{ session('post_id') }}/topup";
            }, 2000);
        }
    </script>
</body>
</html>
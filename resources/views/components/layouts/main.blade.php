<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Disk union') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        /* Set the alpine prefix to pass w3 validation contraints of project*/
        document.addEventListener('alpine:init', () => {
            const startingWith = (subject, replacement) => ({ name, value }) => {
                if (name.startsWith(subject)) {
                    name = name.replace(subject, replacement);
                }
                return { name, value };
            };

            Alpine.prefix('data-x-');
            Alpine.mapAttributes(startingWith('data-x-on.', Alpine.prefixed('on:')));
            Alpine.mapAttributes(startingWith('data-x-bind.', Alpine.prefixed('bind:')));
        })
    </script>
</head>
<body>
{{ $slot }}
</body>
</html>

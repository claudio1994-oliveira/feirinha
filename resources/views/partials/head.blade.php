<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<!-- Tema - Aplicar antes do CSS para evitar flash -->
<script>
    (function() {
        const savedTheme = localStorage.getItem('theme');
        const html = document.documentElement;

        if (savedTheme === 'light') {
            html.classList.remove('dark');
        } else if (savedTheme === 'dark') {
            html.classList.add('dark');
        } else {
            // Se não há tema salvo, use a preferência do sistema
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (systemPrefersDark) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        }
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

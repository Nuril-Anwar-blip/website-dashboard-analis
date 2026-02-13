<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Component Preview - {{ $component ?? 'none' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Figtree', sans-serif; }

        .preview-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            padding: 2rem;
        }

        .preview-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 1.5rem;
        }
    </style>
</head>
<body class="antialiased">
    <div class="preview-wrapper">
        <div class="preview-card">
            @php
                // Normalisasikan nama komponen ke huruf kecil
                $name = strtolower($component ?? '');
            @endphp

            @if ($name === 'dashboard-sidebar')
                <div class="flex">
                    <x-dashboard.sidebar />
                </div>
            @elseif ($name === 'dashboard-analytics-sidebar')
                <x-dashboard.analytics-sidebar />
            @elseif ($name === 'dashboard-header')
                <x-dashboard.header />
            @elseif ($name === 'dashboard-activity-chart')
                <x-dashboard.activity-chart />
            @elseif ($name === 'dashboard-sales-chart')
                <x-dashboard.sales-chart />
            @else
                <div class="text-gray-700">
                    <p class="font-semibold mb-2">Component Preview</p>
                    <p>Pilih komponen dengan query di URL, contoh:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        <li><code>/preview?component=dashboard-sidebar</code></li>
                        <li><code>/preview?component=dashboard-analytics-sidebar</code></li>
                        <li><code>/preview?component=dashboard-header</code></li>
                        <li><code>/preview?component=dashboard-activity-chart</code></li>
                        <li><code>/preview?component=dashboard-sales-chart</code></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
</html>



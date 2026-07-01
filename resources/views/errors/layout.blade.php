<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Terjadi Kendala') - PT. BERITO JAYA MEDIKA</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        :root {
            color-scheme: light;
            --blue: #1e4094;
            --blue-dark: #122a66;
            --red: #dc2626;
            --yellow: #facc15;
            --slate: #111827;
            --muted: #64748b;
            --line: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--slate);
            background:
                radial-gradient(circle at 12% 18%, rgba(30, 64, 148, 0.12), transparent 28rem),
                radial-gradient(circle at 88% 82%, rgba(220, 38, 38, 0.10), transparent 24rem),
                linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
        }

        .panel {
            width: min(100%, 860px);
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
            overflow: hidden;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 24px 28px;
            border-bottom: 1px solid var(--line);
        }

        .logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
            flex: 0 0 auto;
        }

        .brand {
            font-weight: 800;
            color: var(--blue);
            letter-spacing: 0;
            font-size: clamp(20px, 4vw, 28px);
            line-height: 1.15;
        }

        .content {
            display: grid;
            grid-template-columns: 0.9fr 1.4fr;
            gap: 28px;
            padding: 42px 28px 34px;
            align-items: center;
        }

        .code {
            display: grid;
            place-items: center;
            min-height: 220px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .code::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 24px solid rgba(250, 204, 21, 0.18);
            border-radius: 999px;
            right: -64px;
            top: -64px;
        }

        .code span {
            position: relative;
            z-index: 1;
            font-size: clamp(54px, 14vw, 104px);
            font-weight: 900;
            line-height: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 800;
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 14px;
        }

        .eyebrow::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--yellow);
            box-shadow: 0 0 0 5px rgba(250, 204, 21, 0.2);
        }

        h1 {
            margin: 0 0 14px;
            color: var(--blue-dark);
            font-size: clamp(30px, 6vw, 46px);
            line-height: 1.08;
            letter-spacing: 0;
        }

        p {
            margin: 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.65;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            border: 1px solid transparent;
        }

        .button.primary {
            background: var(--red);
            color: white;
            box-shadow: 0 12px 26px rgba(220, 38, 38, 0.22);
        }

        .button.secondary {
            background: white;
            color: var(--blue);
            border-color: #bfdbfe;
        }

        .note {
            padding: 18px 28px 26px;
            border-top: 1px solid var(--line);
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 720px) {
            .page {
                padding: 16px;
            }

            .panel {
                border-radius: 18px;
            }

            .header {
                padding: 20px;
            }

            .logo {
                width: 42px;
                height: 42px;
            }

            .content {
                grid-template-columns: 1fr;
                padding: 26px 20px 28px;
            }

            .code {
                min-height: 150px;
            }

            .button {
                width: 100%;
            }

            .note {
                padding: 16px 20px 22px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="panel" aria-labelledby="error-title">
            <div class="header">
                <img class="logo" src="{{ asset('image/logo.png') }}" alt="Logo PT. Berito Jaya Medika">
                <div class="brand">PT. BERITO JAYA MEDIKA</div>
            </div>

            <div class="content">
                <div class="code" aria-hidden="true">
                    <span>@yield('code', '500')</span>
                </div>

                <div>
                    <div class="eyebrow">@yield('eyebrow', 'Terjadi Kendala')</div>
                    <h1 id="error-title">@yield('heading', 'Halaman sedang dalam perbaikan')</h1>
                    <p>@yield('message', 'Mohon maaf, halaman ini belum bisa ditampilkan saat ini. Tim kami sedang melakukan pengecekan agar layanan kembali normal.')</p>

                    <div class="actions">
                        <a class="button primary" href="{{ url('/') }}">Kembali ke Beranda</a>
                        <a class="button secondary" href="{{ url('/contact') }}">Hubungi Kami</a>
                    </div>
                </div>
            </div>

            <div class="note">
                Jika kendala masih terjadi, silakan hubungi tim PT. Berito Jaya Medika melalui halaman kontak.
            </div>
        </section>
    </main>
</body>
</html>

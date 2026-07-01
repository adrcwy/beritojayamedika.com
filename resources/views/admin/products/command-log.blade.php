<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800">{{ $title }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $subtitle }}</p>
            </div>
            <a href="{{ $backUrl }}" class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 hover:bg-gray-200">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl">
                <div class="flex flex-col gap-3 border-b border-gray-100 bg-slate-950 px-5 py-4 text-white sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-sm font-extrabold">Live Progress</div>
                        <div id="command-status" class="mt-1 text-xs text-slate-300">Menghubungkan ke proses...</div>
                    </div>
                    <button type="button" id="copy-log" class="rounded-xl bg-white/10 px-4 py-2 text-xs font-bold hover:bg-white/20">
                        Copy Log
                    </button>
                </div>

                <pre id="command-log" class="min-h-[65vh] max-h-[75vh] overflow-auto bg-slate-950 p-5 text-xs leading-relaxed text-green-300 sm:text-sm"></pre>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const log = document.getElementById('command-log');
            const status = document.getElementById('command-status');
            const copy = document.getElementById('copy-log');
            const startUrl = @json($startUrl);
            const readUrlTemplate = @json($readUrlTemplate);
            let lastText = '';

            function render(text) {
                log.textContent = text;
                log.scrollTop = log.scrollHeight;
            }

            function wait(ms) {
                return new Promise((resolve) => setTimeout(resolve, ms));
            }

            async function start() {
                try {
                    const response = await fetch(startUrl, {
                        headers: { 'Accept': 'application/json' },
                        credentials: 'same-origin'
                    });

                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }

                    const started = await response.json();
                    const readUrl = started.readUrl || readUrlTemplate.replace('__TOKEN__', started.token);
                    status.textContent = 'Proses berjalan di background... halaman ini membaca log otomatis.';

                    while (true) {
                        const logResponse = await fetch(readUrl, {
                            headers: { 'Accept': 'application/json' },
                            credentials: 'same-origin',
                            cache: 'no-store'
                        });

                        if (!logResponse.ok) {
                            throw new Error('Log HTTP ' + logResponse.status);
                        }

                        const data = await logResponse.json();
                        if (data.text !== lastText) {
                            lastText = data.text || '';
                            render(lastText);
                        }

                        if (data.done) {
                            status.textContent = 'Selesai.';
                            break;
                        }

                        await wait(1500);
                    }
                } catch (error) {
                    status.textContent = 'Gagal membaca progress.';
                    render((lastText || '') + "\n[ERROR] " + error.message + "\n");
                }
            }

            copy?.addEventListener('click', async () => {
                await navigator.clipboard.writeText(log.textContent);
                copy.textContent = 'Copied';
                setTimeout(() => copy.textContent = 'Copy Log', 1200);
            });

            start();
        })();
    </script>
</x-app-layout>

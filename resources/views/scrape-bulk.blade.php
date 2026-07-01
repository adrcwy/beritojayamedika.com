<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Scraper - Inaproc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .url-box {
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 14px;
            line-height: 1.5;
        }
        .loading {
            display: none;
        }
        .result-box {
            max-height: 500px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen p-4 md:p-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                    <i class="fas fa-robot mr-3 text-blue-500"></i>Bulk Product Scraper
                </h1>
                <p class="text-gray-600">Scrape banyak produk dari Inaproc sekaligus</p>
                <div class="mt-4">
                    <a href="/scrape" class="text-blue-500 hover:text-blue-700 mr-4">
                        <i class="fas fa-link mr-1"></i>Single URL
                    </a>
                    <a href="/products" class="text-green-500 hover:text-green-700">
                        <i class="fas fa-database mr-1"></i>Lihat Database
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <form id="scrapeForm" class="space-y-6">
                    @csrf
                    
                    <!-- URL Input -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-3">
                            <i class="fas fa-list mr-2"></i>List URL Produk (satu per baris)
                        </label>
                        <textarea 
                            id="urls" 
                            name="urls" 
                            rows="10" 
                            class="w-full p-4 border border-gray-300 rounded-lg url-box focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="https://katalog.inaproc.id/product/12345&#10;https://katalog.inaproc.id/product/67890&#10;https://katalog.inaproc.id/product/24680"
                            required
                        ></textarea>
                        <p class="text-sm text-gray-500 mt-2">
                            Contoh format: Satu URL per baris. Minimal 1 URL, maksimal 100 URL.
                        </p>
                        <div class="mt-2 text-right">
                            <button type="button" id="btnPaste" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded">
                                <i class="fas fa-paste mr-1"></i>Tempel dari Clipboard
                            </button>
                            <button type="button" id="btnClear" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded ml-2">
                                <i class="fas fa-trash mr-1"></i>Bersihkan
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Delay -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-clock mr-2"></i>Delay (detik)
                            </label>
                            <input 
                                type="number" 
                                name="delay" 
                                value="2" 
                                min="0" 
                                max="10" 
                                step="0.5"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            >
                            <p class="text-sm text-gray-500 mt-1">Rekomendasi: 2-3 detik untuk hindari blokir</p>
                        </div>
                        
                        <div class="flex items-center pt-6">
                            <input 
                                type="checkbox" 
                                id="auto_category" 
                                name="auto_category" 
                                value="1"
                                class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                                checked
                            >
                            <label for="auto_category" class="ml-3 text-gray-700">
                                Auto-detect kategori dari nama produk
                            </label>
                        </div>
                        
                        <div class="flex items-center pt-6">
                            <input 
                                type="checkbox" 
                                id="category_from_description" 
                                name="category_from_description" 
                                value="1"
                                class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                                checked
                            >
                            <label for="category_from_description" class="ml-3 text-gray-700">
                                Prioritaskan pencarian kategori dari deskripsi
                            </label>
                        </div>

                        <!-- Max Products -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-chart-line mr-2"></i>Batas Maksimal
                            </label>
                            <input 
                                type="number" 
                                name="max" 
                                value="0" 
                                min="0" 
                                max="100"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            >
                            <p class="text-sm text-gray-500 mt-1">0 = proses semua URL</p>
                        </div>

                        <!-- Skip Duplicate -->
                        <div class="flex items-center pt-6">
                            <input 
                                type="checkbox" 
                                id="skip_duplicate" 
                                name="skip_duplicate" 
                                value="1"
                                class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                                checked
                            >
                            <label for="skip_duplicate" class="ml-3 text-gray-700">
                                Skip produk yang sudah ada
                            </label>
                        </div>
                    </div>

                    <!-- URL Count -->
                    <div id="urlCount" class="text-lg font-semibold text-gray-700 hidden">
                        <i class="fas fa-link mr-2"></i><span id="count">0</span> URL ditemukan
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            id="btnSubmit"
                            class="w-full py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-lg rounded-lg transition duration-300 shadow-lg hover:shadow-xl"
                        >
                            <i class="fas fa-play mr-2"></i>Mulai Scraping
                        </button>
                    </div>
                </form>
            </div>

            <!-- Loading Indicator -->
            <div id="loading" class="loading text-center p-8">
                <div class="inline-block">
                    <i class="fas fa-cog fa-spin fa-3x text-blue-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Sedang Memproses...</h3>
                    <p class="text-gray-600" id="loadingText">Menyiapkan robot scraper</p>
                    <div class="w-64 h-2 bg-gray-200 rounded-full overflow-hidden mt-4 mx-auto">
                        <div id="progressBar" class="h-full bg-blue-500 transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div id="results" class="hidden">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-chart-bar mr-2 text-green-500"></i>Hasil Scraping
                    </h2>
                    
                    <!-- Stats -->
                    <div id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Stats akan diisi oleh JavaScript -->
                    </div>

                    <!-- Output -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Log Output:</h3>
                        <div id="output" class="bg-gray-900 text-green-400 p-4 rounded-lg result-box"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="/products" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition">
                            <i class="fas fa-database mr-2"></i>Lihat Database
                        </a>
                        <button onclick="window.location.reload()" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition">
                            <i class="fas fa-redo mr-2"></i>Scrape Lagi
                        </button>
                        <button id="btnCopy" class="px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white rounded-lg font-medium transition">
                            <i class="far fa-copy mr-2"></i>Salin Hasil
                        </button>
                        <a href="/" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const form = document.getElementById('scrapeForm');
        const urlsTextarea = document.getElementById('urls');
        const urlCountDiv = document.getElementById('urlCount');
        const countSpan = document.getElementById('count');
        const loadingDiv = document.getElementById('loading');
        const resultsDiv = document.getElementById('results');
        const outputDiv = document.getElementById('output');
        const statsDiv = document.getElementById('stats');
        const loadingText = document.getElementById('loadingText');
        const progressBar = document.getElementById('progressBar');
        const btnPaste = document.getElementById('btnPaste');
        const btnClear = document.getElementById('btnClear');
        const btnCopy = document.getElementById('btnCopy');
        const btnSubmit = document.getElementById('btnSubmit');

        // Update URL count
        function updateUrlCount() {
            const urls = urlsTextarea.value.trim().split('\n').filter(url => url.trim().length > 0);
            const count = urls.length;
            
            countSpan.textContent = count;
            
            if (count > 0) {
                urlCountDiv.classList.remove('hidden');
                
                // Warn if too many
                if (count > 100) {
                    urlCountDiv.classList.add('text-red-600');
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Maksimal 100 URL';
                    btnSubmit.classList.remove('from-blue-500', 'to-blue-600', 'hover:from-blue-600', 'hover:to-blue-700');
                    btnSubmit.classList.add('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
                } else {
                    urlCountDiv.classList.remove('text-red-600');
                    urlCountDiv.classList.add('text-green-600');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = '<i class="fas fa-play mr-2"></i>Mulai Scraping';
                    btnSubmit.classList.remove('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
                    btnSubmit.classList.add('from-blue-500', 'to-blue-600', 'hover:from-blue-600', 'hover:to-blue-700');
                }
            } else {
                urlCountDiv.classList.add('hidden');
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>Masukkan URL';
                btnSubmit.classList.remove('from-blue-500', 'to-blue-600', 'hover:from-blue-600', 'hover:to-blue-700');
                btnSubmit.classList.add('from-gray-400', 'to-gray-500', 'hover:from-gray-500', 'hover:to-gray-600');
            }
        }

        // Paste from clipboard
        btnPaste.addEventListener('click', async () => {
            try {
                const text = await navigator.clipboard.readText();
                urlsTextarea.value = text;
                updateUrlCount();
                
                // Show success message
                const originalText = btnPaste.innerHTML;
                btnPaste.innerHTML = '<i class="fas fa-check mr-1"></i>Telah ditempel!';
                btnPaste.classList.remove('bg-gray-100', 'hover:bg-gray-200');
                btnPaste.classList.add('bg-green-100', 'hover:bg-green-200', 'text-green-700');
                
                setTimeout(() => {
                    btnPaste.innerHTML = originalText;
                    btnPaste.classList.remove('bg-green-100', 'hover:bg-green-200', 'text-green-700');
                    btnPaste.classList.add('bg-gray-100', 'hover:bg-gray-200');
                }, 2000);
            } catch (err) {
                alert('Gagal membaca clipboard. Pastikan browser mendukung fitur ini.');
            }
        });

        // Clear textarea
        btnClear.addEventListener('click', () => {
            if (confirm('Hapus semua URL?')) {
                urlsTextarea.value = '';
                updateUrlCount();
            }
        });

        // Copy results
        btnCopy.addEventListener('click', () => {
            const text = outputDiv.textContent;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btnCopy.innerHTML;
                btnCopy.innerHTML = '<i class="fas fa-check mr-2"></i>Tersalin!';
                btnCopy.classList.add('bg-green-500', 'hover:bg-green-600');
                
                setTimeout(() => {
                    btnCopy.innerHTML = originalText;
                    btnCopy.classList.remove('bg-green-500', 'hover:bg-green-600');
                }, 2000);
            });
        });

        // Auto-update URL count
        urlsTextarea.addEventListener('input', updateUrlCount);
        updateUrlCount(); // Initial check

        // Form submission
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(form);
            const urls = formData.get('urls').trim().split('\n').filter(url => url.trim().length > 0);
            
            if (urls.length === 0) {
                alert('Masukkan minimal satu URL!');
                return;
            }
            
            if (urls.length > 100) {
                alert('Maksimal 100 URL per proses!');
                return;
            }
            
            // Show loading
            form.classList.add('hidden');
            loadingDiv.style.display = 'block';
            
            // Simulate progress
            let progress = 0;
            const progressInterval = setInterval(() => {
                if (progress < 90) {
                    progress += Math.random() * 15;
                    progressBar.style.width = Math.min(progress, 90) + '%';
                    
                    // Update loading text
                    const messages = [
                        'Mengunduh halaman...',
                        'Memproses deskripsi...',
                        'Menghapus background gambar...',
                        'Menyimpan ke database...'
                    ];
                    const randomMsg = messages[Math.floor(Math.random() * messages.length)];
                    loadingText.textContent = randomMsg;
                }
            }, 1000);
            
            try {
                const response = await fetch('/scrape-bulk', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });
                
                clearInterval(progressInterval);
                progressBar.style.width = '100%';
                loadingText.textContent = 'Selesai! Menampilkan hasil...';
                
                const data = await response.json();
                
                // Wait a bit for smooth transition
                setTimeout(() => {
                    loadingDiv.style.display = 'none';
                    resultsDiv.classList.remove('hidden');
                    
                    // Display output
                    outputDiv.textContent = data.output;
                    
                    // Parse stats from output
                    const stats = {
                        total: data.total_urls || 0,
                        success: (data.output.match(/Berhasil\s+:\s+(\d+)/) || [])[1] || 0,
                        skipped: (data.output.match(/Dilewati\s+:\s+(\d+)/) || [])[1] || 0,
                        failed: (data.output.match(/Gagal\s+:\s+(\d+)/) || [])[1] || 0
                    };
                    
                    // Display stats
                    statsDiv.innerHTML = `
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <div class="text-blue-800 font-bold text-3xl mb-2">${stats.total}</div>
                            <div class="text-blue-600 font-medium">Total URL</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <div class="text-green-800 font-bold text-3xl mb-2">${stats.success}</div>
                            <div class="text-green-600 font-medium">Berhasil</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                            <div class="text-yellow-800 font-bold text-3xl mb-2">${stats.skipped + stats.failed}</div>
                            <div class="text-yellow-600 font-medium">Gagal/Dilewati</div>
                        </div>
                    `;
                    
                    // Scroll to results
                    resultsDiv.scrollIntoView({ behavior: 'smooth' });
                    
                }, 500);
                
            } catch (error) {
                clearInterval(progressInterval);
                loadingDiv.style.display = 'none';
                alert('Terjadi kesalahan: ' + error.message);
                form.classList.remove('hidden');
            }
        });

        // Auto-focus on textarea
        urlsTextarea.focus();

        // Add example URLs on double click placeholder
        urlsTextarea.addEventListener('dblclick', function() {
            if (this.value.trim() === '') {
                this.value = `https://katalog.inaproc.id/product/12345
https://katalog.inaproc.id/product/67890
https://katalog.inaproc.id/product/11223
https://katalog.inaproc.id/product/44556
https://katalog.inaproc.id/product/77889`;
                updateUrlCount();
            }
        });
    </script>
</body>
</html>
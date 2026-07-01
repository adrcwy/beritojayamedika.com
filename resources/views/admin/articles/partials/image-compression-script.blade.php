<script>
(() => {
    const form = document.getElementById('articleForm');
    const submitButton = document.getElementById('articleSubmitButton');
    const uploadStatus = document.getElementById('uploadStatus');

    if (!form) return;

    const maxEdge = 1800;
    const thumbnailWidth = 1200;
    const thumbnailHeight = 750;
    const jpegQuality = 0.82;

    const setStatus = (message) => {
        if (!uploadStatus) return;
        uploadStatus.textContent = message;
        uploadStatus.classList.remove('hidden');
    };

    const loadImage = (file) => new Promise((resolve, reject) => {
        const image = new Image();
        const url = URL.createObjectURL(file);

        image.onload = () => {
            URL.revokeObjectURL(url);
            resolve(image);
        };

        image.onerror = () => {
            URL.revokeObjectURL(url);
            reject(new Error('Gagal membaca gambar.'));
        };

        image.src = url;
    });

    const canvasToFile = async (canvas, name, quality = jpegQuality) => {
        const blob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', quality));
        if (!blob) return null;

        const cleanName = name.replace(/\.[^.]+$/, '') || 'article-image';
        return new File([blob], `${cleanName}.jpg`, {
            type: 'image/jpeg',
            lastModified: Date.now(),
        });
    };

    const createThumbnail = async (file) => {
        if (!file.type.startsWith('image/')) {
            return file;
        }

        const image = await loadImage(file);
        const mode = document.querySelector('input[name="thumbnail_mode"]:checked')?.value || 'contain';
        const canvas = document.createElement('canvas');
        canvas.width = thumbnailWidth;
        canvas.height = thumbnailHeight;

        const context = canvas.getContext('2d');
        context.fillStyle = '#ffffff';
        context.fillRect(0, 0, thumbnailWidth, thumbnailHeight);

        const scale = mode === 'cover'
            ? Math.max(thumbnailWidth / image.width, thumbnailHeight / image.height)
            : Math.min(thumbnailWidth / image.width, thumbnailHeight / image.height);

        const drawWidth = Math.round(image.width * scale);
        const drawHeight = Math.round(image.height * scale);
        const drawX = Math.round((thumbnailWidth - drawWidth) / 2);
        const drawY = Math.round((thumbnailHeight - drawHeight) / 2);

        context.drawImage(image, drawX, drawY, drawWidth, drawHeight);

        return await canvasToFile(canvas, `${file.name.replace(/\.[^.]+$/, '')}-thumbnail-1200x750`, 0.86) || file;
    };

    const compressImage = async (file) => {
        if (!file.type.startsWith('image/') || file.size < 700 * 1024) {
            return file;
        }

        const image = await loadImage(file);
        const scale = Math.min(1, maxEdge / Math.max(image.width, image.height));
        const width = Math.max(1, Math.round(image.width * scale));
        const height = Math.max(1, Math.round(image.height * scale));

        if (scale === 1 && file.size < 1.2 * 1024 * 1024) {
            return file;
        }

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;

        const context = canvas.getContext('2d');
        context.fillStyle = '#ffffff';
        context.fillRect(0, 0, width, height);
        context.drawImage(image, 0, 0, width, height);

        const compressedFile = await canvasToFile(canvas, file.name);
        if (!compressedFile || compressedFile.size >= file.size) {
            return file;
        }

        return compressedFile;
    };

    const replaceInputFiles = async (input, label) => {
        if (!input || !input.files || input.files.length === 0) return;

        const files = Array.from(input.files);
        const dataTransfer = new DataTransfer();

        for (let index = 0; index < files.length; index += 1) {
            setStatus(`Mengoptimalkan ${label} ${index + 1}/${files.length}...`);
            dataTransfer.items.add(await compressImage(files[index]));
        }

        input.files = dataTransfer.files;
    };

    const replaceThumbnail = async () => {
        const input = document.getElementById('image');
        if (!input || !input.files || input.files.length === 0) return;

        const dataTransfer = new DataTransfer();
        setStatus('Membuat thumbnail 1200 x 750...');
        dataTransfer.items.add(await createThumbnail(input.files[0]));
        input.files = dataTransfer.files;
    };

    form.addEventListener('submit', async (event) => {
        if (form.dataset.optimized === '1') {
            return;
        }

        event.preventDefault();

        submitButton?.setAttribute('disabled', 'disabled');
        submitButton?.classList.add('opacity-70', 'cursor-wait');

        try {
            await replaceThumbnail();
            await replaceInputFiles(document.getElementById('content_images'), 'foto konten');
            form.dataset.optimized = '1';
            setStatus('Mengirim artikel...');
            form.submit();
        } catch (error) {
            setStatus('Gagal mengoptimalkan gambar. Coba pilih foto yang lebih kecil.');
            submitButton?.removeAttribute('disabled');
            submitButton?.classList.remove('opacity-70', 'cursor-wait');
            console.error(error);
        }
    });
})();
</script>

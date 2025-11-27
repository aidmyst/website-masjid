@props(['final'])

<span
    x-data="{
        start: false,
        currentValue: 0,
        finalValue: {{ $final }}
    }"
    x-intersect.once:enter="start = true"
    x-init="$watch('start', value => {
        if (value) {
            const duration = 2000; // Durasi animasi 2 detik
            let startTime = null;
            const easeOutQuint = t => 1 - Math.pow(1 - t, 5);

            const animate = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const elapsed = timestamp - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easedProgress = easeOutQuint(progress);

                currentValue = Math.round(easedProgress * finalValue);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    currentValue = finalValue;
                }
            };
            requestAnimationFrame(animate);
        }
    })"
    x-text="currentValue.toLocaleString('id-ID')"
>
    {{-- Tampilkan 0 sebagai nilai awal sebelum JS berjalan --}}
    0
</span>
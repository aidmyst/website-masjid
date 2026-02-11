@props([
    'final',
    'label',
    'plus' => false,
])

<div x-data="{
        start: false,
        currentValue: 0,
        finalValue: {{ $final }}
    }"
    x-intersect.once:enter="start = true"
    x-init="$watch('start', value => {
        if (value) {
            const duration = 2000;
            let startTime = null;
            const easeOutQuint = t => 1 - Math.pow(1 - t, 5);

            const animate = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const elapsed = timestamp - startTime;

                // Hitung progres (0 sampai 1) dan pastikan tidak melebihi 1
                const progress = Math.min(elapsed / duration, 1);
                const easedProgress = easeOutQuint(progress);

                // GANTI Math.floor() menjadi Math.round() untuk pembulatan yang lebih akurat di akhir
                currentValue = Math.round(easedProgress * finalValue);

                // Lanjutkan animasi jika progres belum mencapai 1 (selesai)
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    // Sebagai jaminan, pastikan nilai akhir disetel dengan tepat
                    currentValue = finalValue;
                }
            };
            requestAnimationFrame(animate);
        }
    })">
    
    <div class="flex items-center justify-center">
        <span class="text-4xl font-extrabold text-indigo-500" x-text="currentValue"></span>
        @if($plus)
            <span class="text-4xl font-extrabold text-indigo-500">+</span>
        @endif
    </div>
    <p class="mt-2 text-lg font-medium text-gray-500">{{ $label }}</p>
</div>
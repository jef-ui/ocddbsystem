import './bootstrap';
import Alpine from 'alpinejs';
import SignaturePad from 'signature_pad';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('signature-pad');
    if (!canvas) return;

    const signaturePad = new SignaturePad(canvas);

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function () {
            document.getElementById('e_signature').value = signaturePad.toDataURL();
        });
    }

    const clearBtn = document.getElementById('clear-btn');
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            signaturePad.clear();
        });
    }
});

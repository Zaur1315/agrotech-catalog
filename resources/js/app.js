import Alpine from 'alpinejs';
import {initAjaxForms} from "./ajax-forms.js";

document.addEventListener('DOMContentLoaded', () => {
    initAjaxForms();
});

window.Alpine = Alpine;

Alpine.data('heroSlider', ({interval = 6500, autoplay = true, count = 0}) => ({
    current: 0,
    timer: null,
    paused: false,
    interval,
    autoplay,
    count,

    init() {
        this.handleVisibility = () => document.hidden ? this.pause() : this.resume();
        document.addEventListener('visibilitychange', this.handleVisibility);

        if (this.autoplay && this.count > 1 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.resume();
        }

        this.$el.addEventListener('alpine:destroy', () => {
            this.stop();
            document.removeEventListener('visibilitychange', this.handleVisibility);
        });
    },

    start() {
        this.stop();
        if (!this.paused && !document.hidden && this.count > 1) {
            this.timer = window.setInterval(() => this.next(), this.interval);
        }
    },

    stop() {
        if (this.timer) {
            window.clearInterval(this.timer);
            this.timer = null;
        }
    },

    pause() {
        this.paused = true;
        this.stop();
    },

    resume() {
        this.paused = false;
        if (this.autoplay && this.count > 1 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.start();
        }
    },

    goTo(index) {
        this.current = index;
        if (!this.paused) this.start();
    },

    next() {
        if (this.count < 2) return;
        this.current = (this.current + 1) % this.count;
    },

    previous() {
        if (this.count < 2) return;
        this.current = (this.current - 1 + this.count) % this.count;
    },
}));

const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const delay = entry.target.dataset.revealDelay ?? 0;
        entry.target.style.setProperty('--reveal-delay', `${delay}ms`);
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
    });
}, {threshold: 0.12});

document.addEventListener('DOMContentLoaded', () => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('[data-reveal]').forEach((element) => element.classList.add('is-visible'));
        return;
    }

    document.querySelectorAll('[data-reveal]').forEach((element) => revealObserver.observe(element));
});

Alpine.data('productGallery', ({images = []}) => ({
    images,
    currentIndex: 0,
    isLightbox: false,
    lastFocused: null,

    get currentImage() {
        return this.images[this.currentIndex] ?? this.images[0] ?? {full: '', thumb: '', alt: ''};
    },

    open(index = this.currentIndex) {
        this.currentIndex = index;
        this.lastFocused = document.activeElement;
        this.isLightbox = true;
        document.body.classList.add('overflow-hidden');
        this.$nextTick(() => this.$refs.closeButton?.focus());
    },

    close() {
        this.isLightbox = false;
        document.body.classList.remove('overflow-hidden');
        this.$nextTick(() => this.lastFocused?.focus?.());
    },

    previous() {
        if (this.images.length < 2) return;
        this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
    },

    next() {
        if (this.images.length < 2) return;
        this.currentIndex = this.currentIndex === this.images.length - 1 ? 0 : this.currentIndex + 1;
    },

    select(index) {
        this.currentIndex = index;
    },

    trapFocus(event) {
        const focusable = [...event.currentTarget.querySelectorAll('button:not([style*="display: none"])')];
        if (focusable.length === 0) return;
        const current = focusable.indexOf(document.activeElement);
        const next = event.shiftKey
            ? (current <= 0 ? focusable.length - 1 : current - 1)
            : (current + 1) % focusable.length;
        focusable[next].focus();
    },
}));

function getCookie(name) {
    const cookies = document.cookie.split(';');

    for (const cookie of cookies) {
        const [key, value] = cookie.trim().split('=');

        if (key === name) {
            return decodeURIComponent(value);
        }
    }

    return null;
}

function getFbc() {
    const fbcCookie = getCookie('_fbc');

    if (fbcCookie) {
        return fbcCookie;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const fbclid = urlParams.get('fbclid');

    if (!fbclid) {
        return null;
    }

    const timestamp = Math.floor(Date.now() / 1000);

    return `fb.1.${timestamp}.${fbclid}`;
}

document.addEventListener('submit', function (event) {
    const form = event.target;

    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    const fbpInput = form.querySelector('input[name="fbp"]');
    const fbcInput = form.querySelector('input[name="fbc"]');

    if (fbpInput instanceof HTMLInputElement) {
        fbpInput.value = getCookie('_fbp') ?? '';
    }

    if (fbcInput instanceof HTMLInputElement) {
        fbcInput.value = getFbc() ?? '';
    }
});

Alpine.start();

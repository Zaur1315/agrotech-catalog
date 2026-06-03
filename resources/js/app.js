import Alpine from 'alpinejs';
import {initAjaxForms} from "./ajax-forms.js";

document.addEventListener('DOMContentLoaded', () => {
    initAjaxForms();
});

window.Alpine = Alpine;

Alpine.data('productGallery', ({images, visibleCount = 8}) => ({
    images,
    visibleCount,
    isExpanded: false,
    isOpen: false,
    currentIndex: 0,

    get visibleImages() {
        if (this.isExpanded) {
            return this.images;
        }

        return this.images.slice(0, this.visibleCount);
    },

    get currentImage() {
        return this.images[this.currentIndex] ?? {
            full: '',
            thumb: '',
            alt: '',
        };
    },

    toggleExpanded() {
        this.isExpanded = !this.isExpanded;
    },

    open(index) {
        this.currentIndex = index;
        this.isOpen = true;
        document.body.classList.add('overflow-hidden');

        this.$nextTick(() => {
            this.scrollActiveThumbnailIntoView();
        });
    },

    close() {
        this.isOpen = false;
        document.body.classList.remove('overflow-hidden');
    },

    previous() {
        if (!this.isOpen || this.images.length === 0) {
            return;
        }

        this.currentIndex = this.currentIndex === 0
            ? this.images.length - 1
            : this.currentIndex - 1;

        this.$nextTick(() => {
            this.scrollActiveThumbnailIntoView();
        });
    },

    next() {
        if (!this.isOpen || this.images.length === 0) {
            return;
        }

        this.currentIndex = this.currentIndex === this.images.length - 1
            ? 0
            : this.currentIndex + 1;

        this.$nextTick(() => {
            this.scrollActiveThumbnailIntoView();
        });
    },

    setCurrentIndex(index) {
        this.currentIndex = index;

        this.$nextTick(() => {
            this.scrollActiveThumbnailIntoView();
        });
    },

    scrollActiveThumbnailIntoView() {
        const thumbnails = this.$refs.lightboxThumbnails;

        if (!thumbnails) {
            return;
        }

        const activeThumbnail = thumbnails.querySelector(`[data-gallery-index="${this.currentIndex}"]`);

        if (!activeThumbnail) {
            return;
        }

        activeThumbnail.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center',
        });
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

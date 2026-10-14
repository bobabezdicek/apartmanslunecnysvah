import '@fontsource/plus-jakarta-sans/300.css';
import '@fontsource/plus-jakarta-sans/400.css';
import '@fontsource/plus-jakarta-sans/500.css';
import '@fontsource/plus-jakarta-sans/600.css';
import '@fontsource/plus-jakarta-sans/700.css';
import '@fontsource/outfit/300.css';
import '@fontsource/outfit/400.css';
import '@fontsource/outfit/500.css';
import '@fontsource/outfit/600.css';
import '@fontsource/outfit/700.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

const siteHeader = document.querySelector('.js-site-header');
const headerCompactAt = 120;
const languageScrollStorageKey = 'slunecny-svah-language-scroll';

const getLanguageScrollMemory = () => {
    try {
        const stored = window.sessionStorage?.getItem(languageScrollStorageKey);

        if (!stored) {
            return null;
        }

        const data = JSON.parse(stored);
        const targetUrl = new URL(data.href, window.location.origin);

        if (targetUrl.pathname !== window.location.pathname || Number(data.expiresAt) < Date.now()) {
            window.sessionStorage?.removeItem(languageScrollStorageKey);
            return null;
        }

        return data;
    } catch {
        return null;
    }
};

const languageScrollMemory = getLanguageScrollMemory();

const restoreLanguageScroll = () => {
    if (!languageScrollMemory || window.location.hash) {
        return false;
    }

    const targetTop = Math.max(Number(languageScrollMemory.scrollY) || 0, 0);
    const applyScroll = () => {
        const maxTop = Math.max(document.documentElement.scrollHeight - window.innerHeight, 0);

        window.scrollTo({
            top: Math.min(targetTop, maxTop),
            left: 0,
            behavior: 'auto',
        });
    };

    try {
        window.sessionStorage?.removeItem(languageScrollStorageKey);
    } catch {
        // Session storage can be unavailable in strict browser modes.
    }

    applyScroll();
    window.requestAnimationFrame(applyScroll);
    window.setTimeout(applyScroll, 120);

    return true;
};

if ('scrollRestoration' in window.history) {
    window.history.scrollRestoration = 'manual';
}

if (!window.location.hash && !languageScrollMemory) {
    window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
}

window.addEventListener('pageshow', () => {
    if (window.location.hash) {
        return;
    }

    window.requestAnimationFrame(() => {
        if (restoreLanguageScroll()) {
            return;
        }

        window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
    });
});

const updateHeaderState = () => {
    if (!siteHeader) {
        return;
    }

    const currentScrollY = Math.max(window.scrollY, 0);

    siteHeader.setAttribute('data-scrolled', String(currentScrollY >= headerCompactAt));
};

let headerFrame = null;

const requestHeaderUpdate = () => {
    if (headerFrame) {
        return;
    }

    headerFrame = window.requestAnimationFrame(() => {
        headerFrame = null;
        updateHeaderState();
    });
};

restoreLanguageScroll();
updateHeaderState();
window.addEventListener('scroll', requestHeaderUpdate, { passive: true });
window.addEventListener('resize', requestHeaderUpdate);

document.querySelectorAll('[data-language-switch]').forEach((link) => {
    link.addEventListener('click', () => {
        try {
            window.sessionStorage?.setItem(languageScrollStorageKey, JSON.stringify({
                href: link.href,
                scrollY: window.scrollY,
                expiresAt: Date.now() + 10000,
            }));
        } catch {
            // The language switch still works when session storage is blocked.
        }
    });
});

const revealItems = [...document.querySelectorAll('.reveal')];
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.querySelectorAll('section, footer').forEach((section) => {
    section.querySelectorAll('.reveal').forEach((item, index) => {
        item.style.setProperty('--reveal-delay', `${Math.min(index * 70, 420)}ms`);
    });
});

if (prefersReducedMotion || !('IntersectionObserver' in window)) {
    revealItems.forEach((item) => item.classList.add('is-visible'));
} else {
    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        {
            rootMargin: '0px 0px -12% 0px',
            threshold: 0.16,
        },
    );

    revealItems.forEach((item) => revealObserver.observe(item));
}

const scrollToTarget = (targetId) => {
    const target = document.getElementById(targetId);

    if (!target) {
        return;
    }

    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

const closeMobileMenu = () => {
    const mobileMenu = document.querySelector('.js-mobile-menu');
    const menuToggle = document.querySelector('.js-menu-toggle');
    const siteHeader = document.querySelector('.js-site-header');
    const icon = menuToggle?.querySelector('i');

    mobileMenu?.classList.add('hidden');
    menuToggle?.setAttribute('aria-expanded', 'false');
    siteHeader?.setAttribute('data-menu-open', 'false');
    icon?.classList.add('fa-bars');
    icon?.classList.remove('fa-xmark');
};

document.querySelectorAll('.js-scroll-target').forEach((button) => {
    button.addEventListener('click', () => {
        closeMobileMenu();
        window.requestAnimationFrame(() => scrollToTarget(button.dataset.target));
    });
});

document.querySelector('.js-menu-toggle')?.addEventListener('click', (event) => {
    const button = event.currentTarget;
    const mobileMenu = document.querySelector('.js-mobile-menu');
    const siteHeader = document.querySelector('.js-site-header');
    const icon = button.querySelector('i');
    const isOpen = button.getAttribute('aria-expanded') === 'true';

    button.setAttribute('aria-expanded', String(!isOpen));
    siteHeader?.setAttribute('data-menu-open', String(!isOpen));
    mobileMenu?.classList.toggle('hidden', isOpen);
    icon?.classList.toggle('fa-bars', isOpen);
    icon?.classList.toggle('fa-xmark', !isOpen);
});

const galleryItems = [...document.querySelectorAll('.js-gallery-item')];
const lightbox = document.querySelector('.js-gallery-lightbox');
const lightboxImage = document.querySelector('.js-gallery-image');
const lightboxClose = document.querySelector('.js-gallery-close');
const lightboxPrev = document.querySelector('.js-gallery-prev');
const lightboxNext = document.querySelector('.js-gallery-next');
const lightboxBackdrop = document.querySelector('.js-gallery-backdrop');

let activeGalleryIndex = 0;
let lastFocusedGalleryItem = null;

const updateLightbox = () => {
    const item = galleryItems[activeGalleryIndex];

    if (!item || !lightboxImage) {
        return;
    }

    const alt = item.dataset.alt || '';

    lightboxImage.src = item.dataset.fullSrc;
    lightboxImage.alt = alt;
};

const openLightbox = (index) => {
    if (!lightbox || !galleryItems.length) {
        return;
    }

    activeGalleryIndex = index;
    lastFocusedGalleryItem = document.activeElement;
    updateLightbox();
    lightbox.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    lightboxClose?.focus();
};

const closeLightbox = () => {
    if (!lightbox) {
        return;
    }

    lightbox.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    lastFocusedGalleryItem?.focus?.();
};

const showAdjacentImage = (direction) => {
    if (!galleryItems.length) {
        return;
    }

    activeGalleryIndex = (activeGalleryIndex + direction + galleryItems.length) % galleryItems.length;
    updateLightbox();
};

galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => openLightbox(index));
});

lightboxClose?.addEventListener('click', closeLightbox);
lightboxPrev?.addEventListener('click', () => showAdjacentImage(-1));
lightboxNext?.addEventListener('click', () => showAdjacentImage(1));

lightboxBackdrop?.addEventListener('click', (event) => {
    if (event.target === lightboxBackdrop) {
        closeLightbox();
    }
});

document.addEventListener('keydown', (event) => {
    if (!lightbox || lightbox.classList.contains('hidden')) {
        return;
    }

    if (event.key === 'Escape') {
        closeLightbox();
    }

    if (event.key === 'ArrowLeft') {
        showAdjacentImage(-1);
    }

    if (event.key === 'ArrowRight') {
        showAdjacentImage(1);
    }
});

const getFieldSelector = (name) => {
    const escapedName = window.CSS?.escape ? window.CSS.escape(name) : name.replace(/"/g, '\\"');

    return `[name="${escapedName}"]`;
};

const setContactStatus = (form, message, type = 'success') => {
    const status = form.querySelector('[data-contact-status]');

    if (!status) {
        return;
    }

    status.textContent = message;
    status.classList.remove('hidden', 'border-red-200', 'bg-red-50', 'text-red-700', 'border-[var(--gold)]/30', 'bg-[var(--gold)]/10', 'text-[var(--foreground)]');

    if (type === 'error') {
        status.classList.add('border-red-200', 'bg-red-50', 'text-red-700');
        return;
    }

    status.classList.add('border-[var(--gold)]/30', 'bg-[var(--gold)]/10', 'text-[var(--foreground)]');
};

const clearContactErrors = (form) => {
    form.querySelectorAll('[data-error-for]').forEach((error) => {
        error.textContent = '';
        error.classList.add('hidden');
    });

    form.querySelectorAll('input[name], textarea[name]').forEach((field) => {
        field.classList.remove('border-red-400');
        field.classList.add('border-[var(--soft-border)]');
    });
};

const setContactErrors = (form, errors = {}) => {
    Object.entries(errors).forEach(([name, messages]) => {
        const field = form.querySelector(getFieldSelector(name));
        const error = form.querySelector(`[data-error-for="${name}"]`);
        const message = Array.isArray(messages) ? messages[0] : messages;

        field?.classList.remove('border-[var(--soft-border)]');
        field?.classList.add('border-red-400');

        if (error && message) {
            error.textContent = message;
            error.classList.remove('hidden');
        }
    });
};

const wait = (duration) => new Promise((resolve) => {
    window.setTimeout(resolve, duration);
});

const setSubmitLoading = (button, isLoading) => {
    if (!button) {
        return;
    }

    const label = button.querySelector('[data-submit-label]');
    const loading = button.querySelector('[data-submit-loading]');

    button.disabled = isLoading;

    if (!label || !loading) {
        const form = button.closest('form');
        button.textContent = isLoading
            ? (form?.dataset.loadingText || 'Odesílám...')
            : (form?.dataset.submitText || 'Odeslat zprávu');
        return;
    }

    label.classList.toggle('hidden', isLoading);
    loading.classList.toggle('hidden', !isLoading);
    loading.classList.toggle('inline-flex', isLoading);
};

const initContactForms = () => {
    document.querySelectorAll('.js-contact-form').forEach((form) => {
        if (form.dataset.ajaxReady === 'true') {
            return;
        }

        form.dataset.ajaxReady = 'true';
        let isSubmitting = false;

        const submitContactForm = async () => {
            if (isSubmitting) {
                return;
            }

            isSubmitting = true;
            const submitButton = form.querySelector('button[type="submit"]');

            clearContactErrors(form);
            setSubmitLoading(submitButton, true);

            const minimumLoadingTime = wait(1000);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                });
                await minimumLoadingTime;
                const data = await response.json().catch(() => ({}));

                if (response.status === 422) {
                    setContactErrors(form, data.errors);
                    setContactStatus(form, data.message || form.dataset.validationMessage || 'Zkontrolujte prosím zvýrazněná pole.', 'error');
                    return;
                }

                if (!response.ok) {
                    setContactStatus(form, data.message || form.dataset.errorMessage || 'Zprávu se nepodařilo odeslat. Zkuste to prosím znovu.', 'error');
                    return;
                }

                form.reset();
                setContactStatus(form, data.message || form.dataset.successMessage || 'Děkujeme, zpráva byla odeslána. Ozveme se Vám co nejdříve.');
            } catch {
                await minimumLoadingTime;
                setContactStatus(form, form.dataset.errorMessage || 'Zprávu se nepodařilo odeslat. Zkuste to prosím znovu.', 'error');
            } finally {
                isSubmitting = false;
                setSubmitLoading(submitButton, false);
            }
        };

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            submitContactForm();
        });

        form.querySelector('button[type="submit"]')?.addEventListener('click', (event) => {
            event.preventDefault();
            submitContactForm();
        });
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForms, { once: true });
} else {
    initContactForms();
}

const initCookieConsent = () => {
    const consentForm = document.querySelector('.js-cookie-consent');
    const settingsButtons = document.querySelectorAll('[data-cookie-settings]');

    const getCookieConsent = () => {
        const match = document.cookie
            .split('; ')
            .find((row) => row.startsWith('slunecny-svah-cookie-consent='));

        return match ? decodeURIComponent(match.split('=').slice(1).join('=')) : null;
    };

    const getStoredConsentValue = () => {
        try {
            return window.localStorage?.getItem('slunecny-svah-cookie-consent');
        } catch {
            return getCookieConsent();
        }
    };

    const getStoredConsent = () => {
        const storedConsent = getStoredConsentValue();

        if (!storedConsent) {
            return null;
        }

        try {
            return JSON.parse(storedConsent);
        } catch {
            return { choice: storedConsent };
        }
    };

    const storeConsent = (choice) => {
        try {
            window.localStorage?.setItem('slunecny-svah-cookie-consent', JSON.stringify({
                choice,
                acceptedAt: new Date().toISOString(),
            }));
        } catch {
            document.cookie = `slunecny-svah-cookie-consent=${choice}; path=/; max-age=31536000; SameSite=Lax`;
        }
    };

    const clearConsent = () => {
        try {
            window.localStorage?.removeItem('slunecny-svah-cookie-consent');
        } catch {
            // Local storage can be blocked in strict browser modes.
        }

        document.cookie = 'slunecny-svah-cookie-consent=; path=/; max-age=0; SameSite=Lax';
    };

    const showConsentForm = () => {
        if (!consentForm) {
            return;
        }

        consentForm.classList.remove('hidden', 'opacity-0', 'translate-y-4', 'pointer-events-none');
        consentForm.classList.add('flex');
    };

    const hideConsentForm = () => {
        if (!consentForm) {
            return;
        }

        consentForm.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');

        window.setTimeout(() => {
            consentForm.classList.add('hidden');
            consentForm.classList.remove('flex');
        }, 260);
    };

    const storedConsent = getStoredConsent();

    if (!storedConsent) {
        showConsentForm();
    }

    settingsButtons.forEach((button) => {
        button.addEventListener('click', () => {
            clearConsent();
            showConsentForm();
        });
    });

    consentForm?.addEventListener('submit', (event) => {
        event.preventDefault();

        const submitter = event.submitter;
        const choice = submitter?.dataset.cookieChoice || 'necessary';

        storeConsent(choice);
        hideConsentForm();
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCookieConsent, { once: true });
} else {
    initCookieConsent();
}

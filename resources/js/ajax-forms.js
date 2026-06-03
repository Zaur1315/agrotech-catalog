function clearFormState(form) {
    form.querySelectorAll('[data-form-alert]').forEach((element) => {
        element.remove();
    });

    form.querySelectorAll('[data-field-error]').forEach((element) => {
        element.remove();
    });

    form.querySelectorAll('[aria-invalid="true"]').forEach((element) => {
        element.removeAttribute('aria-invalid');
        element.classList.remove('border-red-500', 'ring-red-200');
    });
}

function createAlert(type, message) {
    const alert = document.createElement('div');
    alert.dataset.formAlert = type;
    alert.className = type === 'success'
        ? 'rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-bold text-green-800'
        : 'rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-800';

    alert.textContent = message;

    return alert;
}

function showFormAlert(form, type, message) {
    const alert = createAlert(type, message);

    form.prepend(alert);

    // alert.scrollIntoView({
    //     behavior: 'smooth',
    //     block: 'center',
    // });
}

function findField(form, fieldName) {
    return form.querySelector(`[name="${CSS.escape(fieldName)}"]`);
}

function showFieldErrors(form, errors) {
    Object.entries(errors).forEach(([fieldName, messages]) => {
        const field = findField(form, fieldName);

        if (!field) {
            return;
        }

        field.setAttribute('aria-invalid', 'true');
        field.classList.add('border-red-500', 'ring-red-200');

        const error = document.createElement('div');
        error.dataset.fieldError = fieldName;
        error.className = 'mt-1 text-sm font-semibold text-red-700';
        error.textContent = Array.isArray(messages) ? messages[0] : String(messages);

        const wrapper = field.closest('[data-field-wrapper]') ?? field.parentElement;

        if (wrapper) {
            wrapper.append(error);
        }
    });
}

function setSubmitState(form, isSubmitting) {
    const submitButton = form.querySelector('[type="submit"]');

    if (!submitButton) {
        return;
    }

    if (isSubmitting) {
        submitButton.dataset.originalText = submitButton.textContent.trim();
        submitButton.disabled = true;
        submitButton.classList.add('opacity-70', 'cursor-not-allowed');
        submitButton.textContent = submitButton.dataset.loadingText || 'Sending...';

        return;
    }

    submitButton.disabled = false;
    submitButton.classList.remove('opacity-70', 'cursor-not-allowed');

    if (submitButton.dataset.originalText) {
        submitButton.textContent = submitButton.dataset.originalText;
    }
}

function sendMetaLeadEvent(metaEvent) {
    if (!metaEvent || metaEvent.name !== 'Lead') {
        return;
    }

    if (typeof fbq !== 'function') {
        console.warn('[Meta Pixel] Lead event was not sent because fbq is not available.', metaEvent);

        return;
    }

    console.info('[Meta Pixel] Sending Lead event after AJAX form submit.', metaEvent);

    fbq('track', 'Lead', metaEvent.payload || {}, {
        eventID: metaEvent.event_id || null,
    });
}

async function submitAjaxForm(form) {
    clearFormState(form);
    setSubmitState(form, true);

    try {
        const response = await fetch(form.action, {
            method: form.method || 'POST',
            body: new FormData(form),
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin',
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            if (response.status === 422 && data.errors) {
                showFieldErrors(form, data.errors);
            }

            showFormAlert(
                form,
                'error',
                data.message || 'Please check the form and try again.',
            );

            return;
        }

        showFormAlert(
            form,
            'success',
            data.message || form.dataset.successMessage || 'Thank you! Your request has been sent successfully.',
        );

        sendMetaLeadEvent(data.meta_event);

        form.reset();

        if (data.redirect_url) {
            window.setTimeout(() => {
                window.location.href = data.redirect_url;
            }, 5000);
        }
    } catch (error) {
        console.error('[AJAX Form] Submit failed.', error);

        showFormAlert(
            form,
            'error',
            'Something went wrong. Please try again or call us directly.',
        );
    } finally {
        setSubmitState(form, false);
    }
}

export function initAjaxForms() {
    document.querySelectorAll('form[data-ajax-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            submitAjaxForm(form);
        });
    });
}

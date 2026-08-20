// ========================================
// Sapienter - Certamen Juvenil de Gestión
// JavaScript principal
// ========================================

(function() {
    'use strict';

    // Inicialización cuando el DOM está listo
    document.addEventListener('DOMContentLoaded', function() {
        initializeTooltips();
        initializeFormValidation();
        initializeAutoDismissAlerts();
        initializeSmoothScroll();
    });

    // Inicializar tooltips de Bootstrap
    function initializeTooltips() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Validación de formularios
    function initializeFormValidation() {
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }

    // Auto-dismiss alerts after 5 seconds
    function initializeAutoDismissAlerts() {
        var alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    }

    // Smooth scroll para enlaces internos
    function initializeSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                var target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Función para mostrar loading
    window.showLoading = function(message) {
        var overlay = document.createElement('div');
        overlay.className = 'spinner-overlay';
        overlay.id = 'loading-overlay';
        overlay.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="mt-3">${message || 'Cargando...'}</p>
            </div>
        `;
        document.body.appendChild(overlay);
    };

    // Función para ocultar loading
    window.hideLoading = function() {
        var overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.remove();
        }
    };

    // Función para mostrar toast notification
    window.showToast = function(message, type) {
        var toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        var toastId = 'toast-' + Date.now();
        var bgClass = type === 'error' ? 'bg-danger' : (type === 'success' ? 'bg-success' : 'bg-info');
        
        var toastHtml = `
            <div id="${toastId}" class="toast ${bgClass} text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Sapienter</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">${message}</div>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);
        var toastEl = document.getElementById(toastId);
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
        
        toastEl.addEventListener('hidden.bs.toast', function() {
            toastEl.remove();
        });
    };

    // Confirmación antes de enviar formularios críticos
    window.confirmAction = function(message, callback) {
        if (confirm(message)) {
            callback();
        }
    };

    // Formateo de números
    window.formatNumber = function(number, decimals) {
        return new Intl.NumberFormat('es-AR', {
            minimumFractionDigits: decimals || 0,
            maximumFractionDigits: decimals || 2
        }).format(number);
    };

    // Formateo de moneda
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('es-AR', {
            style: 'currency',
            currency: 'ARS',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    };

})();
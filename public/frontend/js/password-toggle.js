// Password Toggle Functionality
(function() {
    'use strict';
    
    // Initialize password toggle for all password fields
    function initPasswordToggle() {
        // Find all password inputs
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        
        passwordInputs.forEach(function(input) {
            // Skip if already wrapped
            if (input.closest('.password-toggle-wrapper')) {
                return;
            }
            
            // Skip if it's a confirm password or similar (we'll handle those separately)
            const isConfirmPassword = input.name && (
                input.name.includes('confirm') || 
                input.name.includes('confirmation') ||
                input.id && input.id.includes('confirm')
            );
            
            // Create wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'password-toggle-wrapper';
            
            // Wrap the input
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
            
            // Create toggle button
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'password-toggle-icon';
            toggleBtn.setAttribute('aria-label', 'Toggle password visibility');
            toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
            
            // Add toggle functionality
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
                    toggleBtn.setAttribute('aria-label', 'Hide password');
                } else {
                    input.type = 'password';
                    toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
                    toggleBtn.setAttribute('aria-label', 'Show password');
                }
            });
            
            // Insert toggle button
            wrapper.appendChild(toggleBtn);
        });
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPasswordToggle);
    } else {
        initPasswordToggle();
    }
    
    // Also initialize after a short delay to catch dynamically added forms
    setTimeout(initPasswordToggle, 500);
})();

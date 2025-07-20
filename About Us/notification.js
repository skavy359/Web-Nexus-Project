/**
 * Notification System for Web-Nexus Project
 * Displays notifications on the right side of the screen
 */

// Function to create and show a notification
function showNotification(message, type = 'success', duration = 5000) {
    // Create notification container if it doesn't exist
    let container = document.querySelector('.notification-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'notification-container';
        document.body.appendChild(container);
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    // Create content
    const content = document.createElement('div');
    content.className = 'notification-content';
    content.textContent = message;
    
    // Create close button
    const closeBtn = document.createElement('button');
    closeBtn.className = 'notification-close';
    closeBtn.innerHTML = '&times;';
    closeBtn.addEventListener('click', () => {
        hideNotification(notification);
    });
    
    // Assemble notification
    notification.appendChild(content);
    notification.appendChild(closeBtn);
    container.appendChild(notification);
    
    // Show notification with a slight delay for animation effect
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Auto-hide after duration
    if (duration > 0) {
        setTimeout(() => {
            hideNotification(notification);
        }, duration);
    }
    
    return notification;
}

// Function to hide a notification
function hideNotification(notification) {
    notification.classList.remove('show');
    notification.classList.add('hide');
    
    // Remove from DOM after animation completes
    setTimeout(() => {
        if (notification.parentElement) {
            notification.parentElement.removeChild(notification);
        }
    }, 400); // Match the CSS transition duration
}

// Check for session messages on page load
document.addEventListener('DOMContentLoaded', function() {
    // Look for success message in the page
    const successMsg = document.querySelector('.contact-success-message');
    if (successMsg) {
        showNotification(successMsg.textContent, 'success');
        successMsg.style.display = 'none'; // Hide the original message
    }
    
    // Look for error message in the page
    const errorMsg = document.querySelector('.contact-error-message');
    if (errorMsg) {
        showNotification(errorMsg.textContent, 'error');
        errorMsg.style.display = 'none'; // Hide the original message
    }
});
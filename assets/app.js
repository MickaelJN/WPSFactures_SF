import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


document.addEventListener('turbo:submit-start', ({ target }) => {
    console.log("turbo:submit-start");
    const submitButton = target.querySelector('[type="submit"]');
    toggleButtonState(submitButton, true);
});

document.addEventListener('turbo:submit-end', ({ target }) => {
    console.log("turbo:submit-end");
    const submitButton = target.querySelector('[type="submit"]');
    toggleButtonState(submitButton, false);
});

function toggleButtonState(button, isLoading) {
    console.log("toggleButtonState");
    if (!button) return;
    
    button.disabled = isLoading;
    const spinner = button.querySelector('.spinner-border');
    const text = button.querySelector('.submit-text');
    
    spinner?.classList.toggle('d-none', !isLoading);
    text?.classList.toggle('d-none', isLoading);
}
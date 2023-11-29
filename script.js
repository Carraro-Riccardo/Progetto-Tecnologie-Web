document.addEventListener('DOMContentLoaded', function() {
    let hamburger = document.getElementById('hamburger');

    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.onclick = function() {
        if(this.getAttribute('aria-expanded') == 'false') {
            this.setAttribute('aria-expanded', 'true');
        } else {
            this.setAttribute('aria-expanded', 'false');
        }
    }
});
import './bootstrap';
import Alpine from 'alpinejs';

Alpine.start();
window.Alpine = Alpine

let adminButton = document.getElementById('adminButton');
let content1 = document.getElementById('tabContent1')
let content2 = document.getElementById('tabContent2')

adminButton.addEventListener('click', () => {
    content1.classList.toggle('hidden');
    content2.classList.toggle('hidden');
    if (adminButton.textContent == "Switch to Users") {
        adminButton.textContent = "Switch to Admins"
    } else if (adminButton.textContent == "Switch to Admins") {
        adminButton.textContent = "Switch to Users"
    }
})


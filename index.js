const themeToggle = document.getElementById('switch');

themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
});

const avatarBlock = document.querySelector('.avatar-block');
const avatarInput = document.querySelector('#avatar-input');
const chooseAvatarBtn = document.querySelector('#choose-avatar-btn');
const avatarImg = document.querySelector('#avatar');

chooseAvatarBtn.addEventListener('click', () => {
  avatarInput.click();
});

avatarInput.addEventListener('change', (e) => {
  const file = avatarInput.files[0];
  const reader = new FileReader();
  reader.onload = () => {
    const imageDataUrl = reader.result;
    avatarImg.src = imageDataUrl;
  };
  reader.readAsDataURL(file);
});

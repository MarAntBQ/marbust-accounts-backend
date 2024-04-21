// Menu
const header = document.getElementsByTagName('header')[0];

header.addEventListener('click', (event) => {
  const menuSection = 'header__section';
  const sectionTitle = event.target.closest(`.${menuSection}-title`);
  const sectionIcon = event.target.closest('i');
  if (sectionTitle || sectionIcon) {
    const sectionBlock = sectionTitle ? sectionTitle.parentElement : sectionIcon.parentElement;
    sectionBlock.classList.toggle(`${menuSection}--active`);
  }
});
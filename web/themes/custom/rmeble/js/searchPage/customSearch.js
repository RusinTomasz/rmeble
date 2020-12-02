class CustomSearch {
  constructor(menuElement, dataContainer) {
    this.dataContainer = document.querySelector(dataContainer);
    this.searchMenu = document.querySelector(menuElement);
    this.init();
    this.setListenerToMenuItems();
  }

init() {
  const activeElement = this.searchMenu.querySelector('.active');
  if(activeElement) {
    const dataContainer = this.dataContainer.querySelector(activeElement.dataset.toggle);
    console.log(dataContainer.querySelector('.no-search-results'))
    if(dataContainer && !dataContainer.classList.contains('no-search-result') && !dataContainer.querySelector('.no-results')) {
      dataContainer.classList.add('active-search-container');
    }else {
      const numberOfMenuElements = this.getMenuElements();
      for( let i = 1; i < numberOfMenuElements; i++) {
        const childMenuElement = this.searchMenu.querySelector(`[data-toggle="#search-wrap-${i}"]`);
        const dataContainer = this.dataContainer.querySelector(childMenuElement.dataset.toggle);
        if(dataContainer && !dataContainer.querySelector('.no-results')) {
          activeElement.classList.remove('active');
          childMenuElement.classList.add('active');
          dataContainer.classList.add('active-search-container');
          break;
        }
      }
    }
  }
}

getMenuElements() {
  const numberOfMenuElements = this.searchMenu.childElementCount;
  return numberOfMenuElements;
}

setListenerToMenuItems () {
  const numberOfMenuElements = this.getMenuElements();
  for( let i = 0; i < numberOfMenuElements; i++) {
    const childMenuElement = this.searchMenu.querySelector(`[data-toggle="#search-wrap-${i}"]`);
    childMenuElement.addEventListener('click', (e) => {
      if(!e.currentTarget.classList.contains('active')) {
        const elData = e.currentTarget.dataset.toggle;
        const dataContainer = document.querySelector(elData);
        const activeContainer = document.querySelector('.active-search-container');
        const activeButton = this.searchMenu.querySelector('.active');
        activeButton.classList.remove('active');
        e.currentTarget.classList.add('active');
        if(activeContainer) {
          activeContainer.classList.remove('active-search-container');
        }
        if(dataContainer) {
          dataContainer.classList.add('active-search-container');
        }
      }
      window.dispatchEvent(new Event('resize'));
    });
  }
}
}
window.addEventListener('DOMContentLoaded', () => {
  const accordions = Array.from(document.querySelectorAll('.mtdev-accordion'))

  accordions.forEach(accordion => {
    const accordionHeader = accordion.querySelector('.mtdev-accordion__header')

    accordionHeader.addEventListener('click', () => {
      accordion.classList.toggle('is-showed')
    })
  })
})

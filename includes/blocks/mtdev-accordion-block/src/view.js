import { arrowString } from './Arrow'

const ERROR_MARGIN = 30

window.addEventListener('DOMContentLoaded', () => {
  const accordions = Array.from(document.querySelectorAll('.mtdev-accordion'))

  accordions.forEach(accordion => {
    const accordionHeader = accordion.querySelector('.mtdev-accordion__header')

    accordionHeader.addEventListener('click', () => {
      const isOpen = accordion.classList.contains('is-open')
      const content = accordionHeader.nextElementSibling

      const maxHeight = isOpen ? '0px' : `${content.scrollHeight + ERROR_MARGIN}px`
      content.style.maxHeight = maxHeight

      accordion.classList.toggle('is-open')
    })

    accordionHeader.insertAdjacentHTML('beforeend', arrowString)
  })
})

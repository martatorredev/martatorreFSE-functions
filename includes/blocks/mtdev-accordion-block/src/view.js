import { arrowString } from './Arrow'
import jQuery from 'jquery'
import 'jquery-ui/ui/widgets/accordion.js'

const ACCORDION_OPTIONS = {
  header: '.mtdev-accordion__header',
  collapsible: true,
  active: false,
  heightStyle: 'content',
  icons: null
}

window.addEventListener('DOMContentLoaded', () => {
  const accordions = Array.from(document.querySelectorAll('.mtdev-accordion'))
  const [firstAccordion] = accordions
  const isFaq = !!firstAccordion?.parentElement?.classList?.contains('wp-block-group')
  // ? If isFaqs is true, then we are in the FAQs group block, so we need to initialize the accordion on the parent element

  accordions.forEach(accordion => {
    const accordionHeader = accordion.querySelector('.mtdev-accordion__header')

    if (!isFaq) jQuery(accordion).accordion(ACCORDION_OPTIONS)

    accordionHeader.insertAdjacentHTML('beforeend', arrowString)
  })

  if (isFaq) jQuery(firstAccordion.parentElement).accordion(ACCORDION_OPTIONS)
})

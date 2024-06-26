import { inRange, throttle } from 'lodash'
import { logoString } from './assets/logo'
import { createLine, createMarker, createPoints } from './utils'

const MARKER_OFFSET = 25

window.addEventListener('load', () => {
  const timeline = document.querySelector('.mtdev-timeline')
  if (!timeline) return

  const line = createLine()
  const points = createPoints(timeline)
  const marker = createMarker()

  // Insert the logo
  marker.innerHTML = logoString

  // Insert the line and points
  line.append(marker, ...points)
  timeline.append(line)

  let pointPositions = points.map(point => point.getBoundingClientRect().top + window.scrollY)

  const handleScroll = throttle(() => {
    const centerPosition = window.scrollY + window.innerHeight / 2
    const isMobile = window.innerWidth < 768
    const offset = !isMobile
      ? MARKER_OFFSET
      : MARKER_OFFSET * 0.6

    if (pointPositions.some(position => inRange(centerPosition, position - offset, position + offset))) {
      marker.classList.add('active')
    } else {
      marker.classList.remove('active')
    }
  }, 100)

  const handleResize = throttle(() => {
    // Recalculate points top style
    const items = timeline.querySelectorAll('.mtdev-timeline-item')
    items.forEach((item, index) => {
      const position = item.offsetTop + item.offsetHeight / 2
      points[index].style.top = `${position}px`
    })

    // Recalculate pointPositions
    pointPositions = points.map(point => point.getBoundingClientRect().top + window.scrollY)
  }, 100)

  window.addEventListener('scroll', handleScroll)
  window.addEventListener('resize', handleResize)
})

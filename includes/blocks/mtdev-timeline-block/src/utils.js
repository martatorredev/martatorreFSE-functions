import { logoString } from './assets/logo'

export const createLine = () => {
  const line = document.createElement('div')
  line.classList.add('mtdev-timeline__line')

  return line
}

export const createMarker = () => {
  const marker = document.createElement('div')
  marker.classList.add('mtdev-timeline__marker')
  marker.innerHTML = logoString

  return marker
}

export const points = []
export let pointValues = []

export const createPoints = (timeline, track) => {
  const items = timeline.querySelectorAll('.mtdev-timeline-item')

  if (items.length < points.length) {
    const removed = points.splice(items.length)
    removed.map(point => {
      point.remove()
      return null
    })
  }

  for (let i = points.length; i < items.length; i++) {
    if (points[i]) continue
    const point = document.createElement('div')
    point.className = 'mtdev-timeline__point'
    points.push(point)
  }
  track.append(...points)

  return positionPoints(timeline)
}

export const positionPoints = (timeline) => {
  const contentBoxes = timeline.querySelectorAll(
    '.mtdev-timeline-item__content'
  )

  const timelineHeight = timeline.offsetHeight
  pointValues = []

  contentBoxes.forEach((cb, index) => {
    const y = cb.offsetTop
    const h = cb.offsetHeight
    const pos = y + h / 2

    points[index].style.top = `${pos}px`
    pointValues.push(pos)
  })

  return timelineHeight
}


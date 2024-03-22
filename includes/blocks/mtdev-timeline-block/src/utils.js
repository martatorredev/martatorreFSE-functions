export const createLine = () => {
  const line = document.createElement('div')
  line.classList.add('mtdev-timeline__line')

  return line
}

export const createPoints = (timeline) => {
  const items = timeline.querySelectorAll('.mtdev-timeline-item')
  const points = []

  items.forEach(item => {
    const point = document.createElement('div')
    point.classList.add('mtdev-timeline__point')

    const position = item.offsetTop + item.offsetHeight / 2
    point.style.top = `${position}px`

    item.append(point)
    points.push(point)
  })
  return points
}

export const createMarker = () => {
  const marker = document.createElement('div')
  marker.classList.add('mtdev-timeline__marker')

  return marker
}

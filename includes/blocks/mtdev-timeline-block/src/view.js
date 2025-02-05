
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { createLine, createMarker, createPoints, pointValues, positionPoints } from './utils'

gsap.registerPlugin(ScrollTrigger)

const SNAP_PROXIMITY = 40
const SNAP_EASE = 0.5

window.addEventListener('DOMContentLoaded', () => {
  const timeline = document.querySelector('.mtdev-timeline')
  if (!timeline) return

  const line = createLine()
  const marker = createMarker()

  line.append(marker)
  timeline.append(line)

  let timelineHeight = createPoints(timeline, line)

  const scrollPos = { pos: 0 }

  const easedAnimation = gsap
    .timeline({ paused: true, defaults: { ease: 'linear' } })
    .to(marker, {
      y: timelineHeight
    })

  const animation = gsap
    .timeline({
      defaults: {
        ease: 'linear'
      },
      onUpdate: () => {
        marker.dataset.snapped = pointValues.includes(scrollPos.pos)
        marker.dataset.start = scrollPos.pos === 0
        marker.dataset.end = scrollPos.pos === timelineHeight
      }
    })
    .to(scrollPos, {
      pos: timelineHeight,
      snap: {
        pos: {
          values: pointValues,
          radius: SNAP_PROXIMITY
        }
      }
    })

  ScrollTrigger.create({
    animation,
    trigger: timeline,
    start: 'top center',
    end: 'bottom center',
    scrub: true,
    onRefresh: () => {
      timelineHeight = positionPoints(timeline)
      animation.clear().fromTo(
        scrollPos,
        { pos: 0 },
        {
          pos: timelineHeight,
          snap: {
            pos: {
              values: pointValues,
              radius: SNAP_PROXIMITY
            }
          }
        }
      )
      easedAnimation.clear().fromTo(
        marker,
        { y: 0 },
        {
          y: timelineHeight
        }
      )
    }
  })

  gsap.ticker.add(() => {
    let easedProgress = easedAnimation.progress()
    const animationProgress = scrollPos.pos / timelineHeight
    easedProgress += (animationProgress - easedProgress) * SNAP_EASE * gsap.ticker.deltaRatio(30)
    easedAnimation.progress(easedProgress)
  })
})

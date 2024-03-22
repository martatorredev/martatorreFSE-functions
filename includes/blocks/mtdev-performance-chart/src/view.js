window.addEventListener('DOMContentLoaded', () => {
  const observerHandler = (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-in-view')
      } else {
        entry.target.classList.remove('is-in-view')
      }
    })
  }

  const observer = new window.IntersectionObserver(observerHandler, {
    threshold: 1
  })

  const perfCharts = document.querySelectorAll('.mtdev-perf-chart')

  perfCharts.forEach(chart => {
    observer.observe(chart)
  })
})

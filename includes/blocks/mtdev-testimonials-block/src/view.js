window.addEventListener('DOMContentLoaded', () => {
  const paragraphs = document.querySelectorAll('.testimonial p')

  for (const paragraph of paragraphs) {
    const isEmpty = paragraph.textContent.trim() === ''

    if (isEmpty) {
      paragraph.remove()
    }
  }
})

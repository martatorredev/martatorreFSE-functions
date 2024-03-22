export const SCORE_COLORS = {
  low: '#ff7480',
  medium: '#fbce13',
  high: '#28e8a3'
}

export const getScoreColor = (percent) => {
  let score = 'high'

  switch (true) {
    case percent < 50:
      score = 'low'
      break

    case percent >= 50 && percent < 90:
      score = 'medium'
      break

    case percent >= 90:
      score = 'high'
      break
  }

  return SCORE_COLORS[score]
}

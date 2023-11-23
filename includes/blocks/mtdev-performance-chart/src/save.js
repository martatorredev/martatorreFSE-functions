import { useBlockProps } from '@wordpress/block-editor'
import { getScoreColor } from './constants'

const Save = ({ attributes: { percent } }) => {
  const style = {
    '--percent': `${percent}`,
    '--color': getScoreColor(percent)
  }

  return (
    <div {...useBlockProps.save({ className: 'mtdev-perf-chart' })} style={style}>
      <span className='mtdev-perf-chart__percent'>
        {percent}%
      </span>
    </div>
  )
}

export default Save

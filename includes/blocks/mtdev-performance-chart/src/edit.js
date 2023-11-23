import { useBlockProps, InspectorControls } from '@wordpress/block-editor'
import { RangeControl, PanelBody } from '@wordpress/components'
import { getScoreColor } from './constants'

const Edit = ({ attributes, setAttributes }) => {
  const { percent } = attributes

  const style = {
    '--percent': percent,
    '--color': getScoreColor(percent)
  }

  return (
    <>
      <InspectorControls>
        <PanelBody title='Opciones'>
          <RangeControl
            label='Porcentaje'
            value={percent}
            onChange={(percent) => setAttributes({ percent })}
            min={0}
            max={100}
            withInputField
          />
        </PanelBody>
      </InspectorControls>

      <div {...useBlockProps()}>
        <div className='mtdev-perf-chart is-in-view' style={style}>
          <span className='mtdev-perf-chart__percent'>
            {percent}%
          </span>
        </div>
      </div>
    </>
  )
}

export default Edit

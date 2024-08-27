import {
  InnerBlocks,
  RichText,
  useBlockProps,
  InspectorControls
} from '@wordpress/block-editor'
import { __experimentalBoxControl as BoxControl, PanelBody } from '@wordpress/components'
import { useState, useEffect } from '@wordpress/element'
import { capitalize } from 'lodash'
import Arrow from './Arrow'

const edit = ({ attributes, setAttributes }) => {
  const { headerContent, spacing } = attributes

  const [style, setStyle] = useState({})

  useEffect(() => {
    const newStyle = {}

    for (const direction in spacing) {
      newStyle[`padding${capitalize(direction)}`] = spacing[direction]
    }

    setStyle(newStyle)
    console.log(style)
  }, [spacing])

  const blockProps = useBlockProps({
    className: 'mtdev-accordion is-showed',
    style
  })

  return (
    <>
      <InspectorControls>
        <PanelBody>
          <BoxControl
            label='Espaciado externo'
            values={spacing || {
              top: '0rem',
              left: '0rem',
              right: '0rem',
              bottom: '0rem'
            }}
            onChange={spacing => setAttributes({ spacing })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        <div className='mtdev-accordion__header'>
          <RichText
            formattingControls={[]}
            onChange={headerContent => setAttributes({ headerContent })}
            placeholder='Escribe el titulo del acordeon aqui…'
            tagName='p'
            value={headerContent}
          />

          <Arrow />
        </div>
        <div className='mtdev-accordion__content'>
          <InnerBlocks />
        </div>
      </div>
    </>
  )
}

export default edit

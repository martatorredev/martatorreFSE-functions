import {
  InnerBlocks,
  RichText,
  useBlockProps,
  BlockControls,
  InspectorControls
} from '@wordpress/block-editor'
import { __experimentalBoxControl as BoxControl, PanelBody } from '@wordpress/components'
import { useState, useEffect } from '@wordpress/element'
import { capitalize } from 'lodash'
import Arrow from './Arrow'
import HeadingLevelDropdown from './heading-level-dropdown'

const Edit = ({ attributes, setAttributes }) => {
  const { headerContent, level, spacing } = attributes

  const [style, setStyle] = useState({})

  useEffect(() => {
    const newStyle = {}

    for (const direction in spacing) {
      newStyle[`padding${capitalize(direction)}`] = spacing[direction]
    }

    setStyle(newStyle)
  }, [spacing])

  const blockProps = useBlockProps({
    className: 'mtdev-accordion is-open',
    style
  })

  const tagName = level ? `h${level}` : 'p'

  return (
    <>
      <BlockControls group='block'>
        <HeadingLevelDropdown
          value={level}
          onChange={level => setAttributes({ level })}
        />
      </BlockControls>
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
            tagName={tagName}
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

export default Edit

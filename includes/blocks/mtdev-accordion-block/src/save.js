import { InnerBlocks, RichText, useBlockProps } from '@wordpress/block-editor'
import Arrow from './Arrow'

const save = ({ attributes }) => {
  const { headerContent, spacing } = attributes

  const style = {}

  for (const direction in spacing) {
    const formattedDirection = direction[0].toUpperCase() + direction.slice(1)
    style[`padding${formattedDirection}`] = spacing[direction]
  }
  const blockProps = useBlockProps.save({
    className: 'mtdev-accordion',
    style
  })

  return (
    <div {...blockProps}>
      <div className='mtdev-accordion__header'>
        <RichText.Content tagName='p' value={headerContent} />

        <Arrow />
      </div>
      <div className='mtdev-accordion__content'>
        <InnerBlocks.Content />
      </div>
    </div>
  )
}

export default save

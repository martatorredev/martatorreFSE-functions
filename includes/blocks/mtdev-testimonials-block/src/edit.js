import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
  PanelBody,
  QueryControls,
  ToggleControl
} from '@wordpress/components'
import { useSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import metadata from './block.json'
import './editor.scss'

const Edit = ({ attributes, setAttributes }) => {
  const {
    postsToShow: numberOfItems,
    category,
    order,
    orderBy,
    selectRandomTestimonials
  } = attributes

  const testimonialsCategories = useSelect(select => (
    select('core').getEntityRecords('taxonomy', 'testimonials_categories')
  ))

  const panelControls = (
    <InspectorControls>
      <PanelBody title='Opciones'>
        <QueryControls
          {...{ orderBy, order, numberOfItems }}
          categoriesList={testimonialsCategories}
          selectedCategoryId={category}
          onOrderByChange={orderBy => setAttributes({ orderBy })}
          onOrderChange={order => setAttributes({ order })}
          onCategoryChange={category => setAttributes({ category: category || -1 })}
          onNumberOfItemsChange={postsToShow => setAttributes({ postsToShow })}
        />

        <ToggleControl
          label='Seleccionar testimonios aleatoriamente'
          checked={selectRandomTestimonials}
          onChange={
            (selectRandomTestimonials) => {
              setAttributes({ selectRandomTestimonials })
            }
          }
        />
      </PanelBody>
    </InspectorControls>
  )

  return (
    <>
      {panelControls}

      <div {...useBlockProps()}>
        <ServerSideRender
          block={metadata.name}
          attributes={attributes}
        />
      </div>
    </>
  )
}

export default Edit

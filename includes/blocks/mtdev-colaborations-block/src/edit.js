import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
  PanelBody,
  QueryControls
} from '@wordpress/components'
import { useSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import metadata from './block.json'
import './editor.scss'

const Edit = ({ attributes, setAttributes }) => {
  const {
    numberOfItems,
    category,
    order,
    orderBy
  } = attributes

  const testimonialsCategories = useSelect(select => (
    select('core').getEntityRecords('taxonomy', 'colaboradoras_category')
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
          onNumberOfItemsChange={numberOfItems => setAttributes({ numberOfItems })}
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

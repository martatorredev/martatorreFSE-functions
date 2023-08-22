import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
  PanelBody,
  QueryControls
} from '@wordpress/components'
import { useSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import { registerBlockType } from '@wordpress/blocks'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => {
    const {
      postsToShow: numberOfItems,
      category,
      order,
      orderBy
    } = attributes

    const postCategories = useSelect(select => (
      select('core').getEntityRecords('taxonomy', 'category')
    ))

    const panelControls = (
      <InspectorControls>
        <PanelBody title='Opciones'>
          <QueryControls
            {...{ orderBy, order, numberOfItems }}
            categoriesList={postCategories}
            selectedCategoryId={category}
            onOrderByChange={orderBy => setAttributes({ orderBy })}
            onOrderChange={order => setAttributes({ order })}
            onCategoryChange={category => setAttributes({ category: category || -1 })}
            onNumberOfItemsChange={postsToShow => setAttributes({ postsToShow })}
          />
        </PanelBody>
      </InspectorControls>
    )

    return (
      <>
        {panelControls}

        <div {...useBlockProps()}>
          <ServerSideRender
            block='mtdev/lastest-posts'
            attributes={attributes}
          />
        </div>
      </>
    )
  }
})

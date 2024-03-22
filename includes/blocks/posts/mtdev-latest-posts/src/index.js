import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
  PanelBody,
  QueryControls,
  ToggleControl,
  SelectControl
} from '@wordpress/components'
import { useSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import { registerBlockType } from '@wordpress/blocks'
import { __ } from '@wordpress/i18n'

import metadata from './block.json'

import './style.scss'

const ORDER_BY_OPTIONS = [
  {
    label: __('Newest to oldest'),
    value: 'desc'
  },
  {
    label: __('Oldest to newest'),
    value: 'asc'
  }
]

const MAX_POSTS = 30

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => {
    const {
      postsToShow: numberOfItems,
      category,
      order,
      // orderBy,
      hasPagination,
      hasFilters,
      inheritQuery
    } = attributes

    const postCategories = useSelect(select => (
      select('core').getEntityRecords('taxonomy', 'category')
    ))

    const panelControls = (
      <InspectorControls>
        <PanelBody title='Opciones'>
          <ToggleControl
            label='Activar paginación'
            checked={hasPagination}
            onChange={hasPagination => setAttributes({ hasPagination })}
          />

          <ToggleControl
            label='Activar filtros'
            checked={hasFilters}
            onChange={hasFilters => setAttributes({ hasFilters })}
          />

          <ToggleControl
            label='Heredar la consulta de la plantilla'
            help='Alternar el uso del contexto de la consulta global que se establece con la plantilla actual, como un archivo o una búsqueda. Desactívalo para personalizar los ajustes independientemente.'
            checked={inheritQuery}
            onChange={inheritQuery => setAttributes({ inheritQuery })}
          />
          {
            !inheritQuery && (
              <>
                <SelectControl
                  label={__('Order by')}
                  value={order}
                  options={ORDER_BY_OPTIONS}
                  onChange={(order) => setAttributes({ order })}
                />

                <QueryControls
                  numberOfItems={numberOfItems}
                  categoriesList={postCategories}
                  selectedCategoryId={category}
                  onCategoryChange={category => setAttributes({ category: Number(category) || -1 })}
                  onNumberOfItemsChange={postsToShow => setAttributes({ postsToShow })}
                  maxItems={MAX_POSTS}
                />
              </>
            )
          }
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
})

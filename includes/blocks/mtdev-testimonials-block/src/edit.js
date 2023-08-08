import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import {
  PanelBody,
  QueryControls,
  RangeControl,
  SelectControl,
  ToggleControl
} from '@wordpress/components'
import { useSelect } from '@wordpress/data'
import ServerSideRender from '@wordpress/server-side-render'
import { isEmpty } from 'lodash'
import metadata from './block.json'
import './editor.scss'

const Edit = ({ attributes, setAttributes }) => {
  const {
    postsToShow,
    category,
    order,
    orderBy,
    selectRandomTestimonials
  } = attributes

  const defaultCategory = [{
    name: 'Todas las categorias',
    id: -1,
    count: 1
  }]

  const testimonialsCategories = useSelect(select => (
    select('core').getEntityRecords('taxonomy', 'testimonials_categories')
  ))

  const categories = !isEmpty(testimonialsCategories)
    ? defaultCategory.concat(testimonialsCategories)
      .filter(({ count }) => count !== 0)
      .map(({ id, name }) => ({
        label: name,
        value: id
      }))
    : [{
        label: '...',
        value: -1
      }]

  const panelControls = (
    <InspectorControls>
      <PanelBody title='Opciones'>
        <RangeControl
          label='Cantidad de posts'
          value={postsToShow}
          onChange={
            (postsToShow) => {
              setAttributes({ postsToShow })
            }
          }
          min={1}
          max={20}
          required
        />

        <QueryControls
          {...{ orderBy, order }}
          onOrderByChange={(orderBy) => setAttributes({ orderBy })}
          onOrderChange={(order) => setAttributes({ order })}
        />

        <SelectControl
          label='Categoria'
          value={category}
          options={categories}
          onChange={
            (category) => {
              setAttributes({ category })
            }
          }
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

import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps, InspectorControls } from '@wordpress/block-editor'
import { PanelBody, RangeControl, SelectControl } from '@wordpress/components'
import ServerSideRender from '@wordpress/server-side-render'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => {
    const { postType, postsToShow } = attributes

    return (
      <>
        <InspectorControls>
          <PanelBody title='Opciones'>
            <SelectControl
              label='Post type'
              value={postType}
              options={[
                { label: 'Todos', value: 'all' },
                { label: 'Entradas', value: 'post' },
                { label: 'Colaboraciones', value: 'colaboraciones' }
              ]}
              onChange={
                (postType) => {
                  setAttributes({ postType })
                }
              }
            />
            <RangeControl
              label='Cantidad de posts'
              value={postsToShow}
              onChange={
                (postsToShow) => {
                  setAttributes({ postsToShow })
                }
              }
              min={1}
              max={3}
              required
            />
          </PanelBody>
        </InspectorControls>

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

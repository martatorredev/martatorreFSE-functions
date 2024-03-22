import ServerSideRender from '@wordpress/server-side-render'
import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import { PanelBody, ToggleControl } from '@wordpress/components'
import { registerBlockType } from '@wordpress/blocks'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => (
    <>
      <InspectorControls>
        <PanelBody title='Opciones'>
          <ToggleControl
            label='Con link'
            checked={attributes.withLink}
            onChange={withLink => setAttributes({ withLink })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...useBlockProps()}>
        <ServerSideRender
          block={metadata.name}
          attributes={attributes}
        />
      </div>
    </>
  )
})

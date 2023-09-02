import ServerSideRender from '@wordpress/server-side-render'
import { useBlockProps } from '@wordpress/block-editor'
import { registerBlockType } from '@wordpress/blocks'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => (
    <div {...useBlockProps()}>
      <ServerSideRender
        block={metadata.name}
        attributes={attributes}
      />
    </div>
  )
})

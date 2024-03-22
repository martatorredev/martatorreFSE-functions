import { useBlockProps } from '@wordpress/block-editor'
import { registerBlockType } from '@wordpress/blocks'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => (
    <div {...useBlockProps()}>
      En este bloque se mostrará la información del proyecto
    </div>
  )
})

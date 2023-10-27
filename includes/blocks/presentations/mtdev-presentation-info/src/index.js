import { useBlockProps } from '@wordpress/block-editor'
import { registerBlockType } from '@wordpress/blocks'

import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, {
  edit: ({ attributes, setAttributes }) => (
    <div {...useBlockProps()}>
      En este bloque se mostrará la información de la ponencia como por ejemplo: El video y el link hacia las slides.
    </div>
  )
})

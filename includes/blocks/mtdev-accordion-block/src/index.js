import { registerBlockType } from '@wordpress/blocks'
import edit from './editor'
import save from './save'
import metadata from './block.json'

import './style.scss'

registerBlockType(metadata.name, { edit, save })

import { registerBlockType } from '@wordpress/blocks'
import { category as icon } from '@wordpress/icons'
import metadata from './block.json'
import edit from './edit'
import './style.scss'

registerBlockType(metadata.name, {
  edit,
  icon
})

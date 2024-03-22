import { registerBlockType } from '@wordpress/blocks'
import edit from './edit'
import save from './save'
import { name } from '../block.json'
import './style.scss'

registerBlockType(name, {
  edit,
  save
})

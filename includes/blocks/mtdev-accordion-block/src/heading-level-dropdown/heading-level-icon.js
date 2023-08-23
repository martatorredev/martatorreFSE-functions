/**
 * WordPress dependencies
 */
import {
  headingLevel1,
  headingLevel2,
  headingLevel3,
  headingLevel4,
  headingLevel5,
  headingLevel6,
  paragraph
} from '@wordpress/icons'
import { Icon } from '@wordpress/components'

const LEVEL_TO_PATH = {
  0: paragraph,
  1: headingLevel1,
  2: headingLevel2,
  3: headingLevel3,
  4: headingLevel4,
  5: headingLevel5,
  6: headingLevel6
}

export default function HeadingLevelIcon ({ level }) {
  if (LEVEL_TO_PATH[level]) {
    return <Icon icon={LEVEL_TO_PATH[level]} />
  }

  return null
}

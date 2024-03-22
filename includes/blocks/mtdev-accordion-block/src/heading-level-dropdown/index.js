import { ToolbarDropdownMenu } from '@wordpress/components'
import { __, sprintf } from '@wordpress/i18n'

import HeadingLevelIcon from './heading-level-icon'

const HEADING_LEVELS = [0, 1, 2, 3, 4, 5, 6]

const POPOVER_PROPS = {
  className: 'block-library-heading-level-dropdown'
}

export default function HeadingLevelDropdown ({
  options = HEADING_LEVELS,
  value,
  onChange
}) {
  return (
    <ToolbarDropdownMenu
      popoverProps={POPOVER_PROPS}
      icon={<HeadingLevelIcon level={value} />}
      label={__('Change level')}
      controls={options.map((targetLevel) => {
        const isActive = targetLevel === value

        return {
          icon: (
            <HeadingLevelIcon
              level={targetLevel}
              isPressed={isActive}
            />
          ),
          label:
            targetLevel === 0
              ? __('Paragraph')
              : sprintf(
                __('Heading %d'),
                targetLevel
              ),
          isActive,
          onClick () {
            onChange(targetLevel)
          },
          role: 'menuitemradio'
        }
      })}
    />
  )
}

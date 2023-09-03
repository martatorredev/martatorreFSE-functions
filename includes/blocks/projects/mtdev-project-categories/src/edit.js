import classnames from 'classnames'
import {
  PanelBody,
  Placeholder,
  Spinner,
  ToggleControl
} from '@wordpress/components'
import { InspectorControls, useBlockProps } from '@wordpress/block-editor'
import { decodeEntities } from '@wordpress/html-entities'
import { __ } from '@wordpress/i18n'
import { pin } from '@wordpress/icons'
import { useEntityRecords } from '@wordpress/core-data'

import './editor.scss'

export default function CategoriesEdit ({
  attributes: {
    showHierarchy,
    showPostCounts,
    showOnlyTopLevel,
    showEmpty
  },
  setAttributes,
  className
}) {
  const query = { per_page: -1, hide_empty: !showEmpty, context: 'view' }
  if (showOnlyTopLevel) {
    query.parent = 0
  }

  const { records: categories, isResolving } = useEntityRecords(
    'taxonomy',
    'mis_proyectos_web_category',
    query
  )

  const getCategoriesList = (parentId) => {
    if (!categories?.length) {
      return []
    }
    if (parentId === null) {
      return categories
    }
    return categories.filter(({ parent }) => parent === parentId)
  }

  const toggleAttribute = (attributeName) => (newValue) =>
    setAttributes({ [attributeName]: newValue })

  const renderCategoryName = (name) =>
    !name ? __('(Untitled)') : decodeEntities(name).trim()

  const renderCategoryList = () => {
    const parentId = showHierarchy ? 0 : null
    const categoriesList = getCategoriesList(parentId)
    return categoriesList.map((category) =>
      renderCategoryListItem(category)
    )
  }

  const renderCategoryListItem = (category) => {
    const childCategories = getCategoriesList(category.id)
    const { id, link, count, name } = category
    return (
      <li key={id} className={`cat-item cat-item-${id}`}>
        <a href={link} target='_blank' rel='noreferrer noopener'>
          {renderCategoryName(name)}
        </a>
        {showPostCounts && ` (${count})`}
        {showHierarchy && !!childCategories.length && (
          <ul className='children'>
            {childCategories.map((childCategory) =>
              renderCategoryListItem(childCategory)
            )}
          </ul>
        )}
      </li>
    )
  }

  const TagName =
    !!categories?.length && !isResolving
      ? 'ul'
      : 'div'

  const classes = classnames(className, {
    'mtdev-block-categories-list':
      !!categories?.length && !isResolving
  })

  const blockProps = useBlockProps({
    className: classes
  })

  return (
    <TagName {...blockProps}>
      <InspectorControls>
        <PanelBody title={__('Settings')}>
          <ToggleControl
            __nextHasNoMarginBottom
            label={__('Show post counts')}
            checked={showPostCounts}
            onChange={toggleAttribute('showPostCounts')}
          />
          <ToggleControl
            __nextHasNoMarginBottom
            label={__('Show only top level categories')}
            checked={showOnlyTopLevel}
            onChange={toggleAttribute('showOnlyTopLevel')}
          />
          <ToggleControl
            __nextHasNoMarginBottom
            label={__('Show empty categories')}
            checked={showEmpty}
            onChange={toggleAttribute('showEmpty')}
          />
          {!showOnlyTopLevel && (
            <ToggleControl
              __nextHasNoMarginBottom
              label={__('Show hierarchy')}
              checked={showHierarchy}
              onChange={toggleAttribute('showHierarchy')}
            />
          )}
        </PanelBody>
      </InspectorControls>
      {isResolving && (
        <Placeholder icon={pin} label={__('Categories')}>
          <Spinner />
        </Placeholder>
      )}
      {!isResolving && categories?.length === 0 && (
        <p>
          {__(
            'Your site does not have any posts, so there is nothing to display here at the moment.'
          )}
        </p>
      )}
      {!isResolving &&
        categories?.length > 0 &&
        (renderCategoryList())}
    </TagName>
  )
}

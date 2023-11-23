import { concatUrlWithParams, debounce, getPageHtml, getPageNumber, removeDoubleSlashes, removePageNumber, useStore } from './utils'

const start = () => {
  const endpoint = getEndpoint()
  const presentations = document.querySelector('.mtdev-presentations')

  const initialAttributes = JSON.parse(presentations.dataset.attributes)
  const [getAttributes, setAttributes] = useStore({
    ...initialAttributes,
    base: removePageNumber(window.location.href)
  })

  const [getAbort, setAbort] = useStore(new AbortController())
  const [, setIsLoading, subscribeIsLoading] = useStore(false)

  const searchInput = document.getElementById('s-search')
  const sortSelect = document.getElementById('s-order')
  const categorySelect = document.getElementById('s-category')
  const form = document.querySelector('.mtdev-presentations-filters__form')

  subscribeIsLoading(isLoading => {
    if (isLoading) {
      presentations.classList.add('is-loading')
    } else {
      presentations.classList.remove('is-loading')
    }
  })

  const handleAttributesChange = async (newAttributes) => {
    setIsLoading(true)
    try {
      // Abort previous request
      const abortController = getAbort()
      abortController.abort()

      // Create new abort controller
      const newAbortController = new AbortController()
      setAbort(newAbortController)

      const endpointWithParams = concatUrlWithParams(endpoint, newAttributes)
      const html = await getPageHtml(endpointWithParams, newAbortController)

      presentations.innerHTML = html

      // Replace url with the new one
      window.history.pushState({}, document.title, endpointWithParams.replace(endpoint, window.location.href))

      setAttributes(newAttributes)
      setIsLoading(false)
    } catch (error) {
      if (error.name === 'AbortError') return
      setIsLoading(false)
      console.error('[handleAttributesChange] Unexpected error:', error)
    }
  }

  // Create event handlers
  const onClickPagination = createClickHandler(getAttributes, handleAttributesChange)
  const onChangeSort = createSelectHandler(getAttributes, handleAttributesChange, 's-order')
  const onChangeCategory = createSelectHandler(getAttributes, handleAttributesChange, 's-category')
  const onSearch = createSearchHandler(getAttributes, handleAttributesChange)
  const onSubmit = createSubmitHandler()
  // Attach event listeners
  form?.addEventListener('submit', onSubmit)
  presentations?.addEventListener('click', onClickPagination)
  searchInput?.addEventListener('input', onSearch)
  sortSelect?.addEventListener('change', onChangeSort)
  categorySelect?.addEventListener('change', onChangeCategory)
}

const createClickHandler = (getAttributes, onChange) => event => {
  const { target: { classList, tagName } } = event
  const isPaginationItem = classList.contains('page-numbers') && tagName === 'A'

  if (isPaginationItem) {
    event.preventDefault()
    const pageNumber = getPageNumber(event.target)

    const newAttributes = {
      ...getAttributes(),
      paged: pageNumber
    }

    onChange(newAttributes)
  }
}

const createSelectHandler = (getAttributes, onChange, attribute) => ({ target: { value: id } }) => {
  const newAttributes = {
    ...getAttributes(),
    paged: 1,
    [attribute]: id
  }

  onChange(newAttributes)
}

const createSearchHandler = (getAttributes, onChange) => debounce(({ target: { value } }) => {
  const newAttributes = {
    ...getAttributes(),
    paged: 1,
    's-search': value
  }

  onChange(newAttributes)
}, 500)

const createSubmitHandler = () => event => {
  event.preventDefault()
}

const getEndpoint = () => {
  const wpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]')?.href

  if (!wpJsonUrl) throw new Error('Wordpress REST API url not found')
  const endpoint = removeDoubleSlashes(`${wpJsonUrl}/mtdev/get_presentations`)

  return endpoint
}

// const createSearchInput = () => {
//   const searchInput = document.createElement('input')
//   searchInput.setAttribute('type', 'search')
//   searchInput.setAttribute('placeholder', 'Buscar...')
//   searchInput.classList.add('search-input')

//   return searchInput
// }

// const createOption = ({ value, label }) => {
//   const option = document.createElement('option')
//   option.setAttribute('value', value)
//   option.textContent = label

//   return option
// }

// const createCategorySelect = async (endpoint) => {
//   try {
//     const categorySelect = document.createElement('select')
//     categorySelect.classList.add('category-select')

//     const response = await fetch(endpoint)
//     const data = await response.json()

//     if (!Array.isArray(data)) return console.error('Unexpected response from categories endpoint')

//     for (const category of data) {
//       if (!category.count > 0) continue

//       const option = createOption({ value: category.id, label: category.name })
//       categorySelect.appendChild(option)
//     }

//     const defaultOption = createOption({ value: -1, label: 'Elige una categoría' })
//     categorySelect.appendChild(defaultOption)

//     return categorySelect
//   } catch (error) {
//     console.error('[createCategorySelect] Unexpected error:', error)
//     return null
//   }
// }

// const createSortSelect = () => {
//   const sortSelect = document.createElement('select')
//   sortSelect.classList.add('sort-select')

//   const sortOptions = [
//     { value: 'desc', label: 'Mas nuevas primero' },
//     { value: 'asc', label: 'Mas antiguas primero' }
//   ]

//   for (const sortOption of sortOptions) {
//     const option = createOption(sortOption)
//     sortSelect.appendChild(option)
//   }

//   return sortSelect
// }

window.addEventListener('DOMContentLoaded', start)

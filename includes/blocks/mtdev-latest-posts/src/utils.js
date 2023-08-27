// Pseudo useState implementation
export const useStore = (initialState) => {
  let state = initialState
  const subscribers = []

  const getState = () => {
    return state
  }

  const setState = newState => {
    state = newState
    subscribers.forEach(callback => callback(newState))
  }

  const subscribe = (callback) => {
    callback(state)
    subscribers.push(callback)
  }

  return [getState, setState, subscribe]
}

export const removeDoubleSlashes = url => url.replace(/([^:]\/)\/+/g, '$1')

export const concatUrlWithParams = (url, params) => {
  const urlObject = new URL(url)
  const paramsObject = new URLSearchParams(params)
  return `${urlObject}?${paramsObject.toString()}`
}

export const removePageNumber = (url) => {
  // Check if the URL ends with "/page/{number}/"
  if (!url.includes('/page/')) return url

  const urlParts = url.split('/page/')
  // Reconstruct the URL without the page number
  const newUrl = urlParts[0] + '/'

  return newUrl
}

export const getPageHtml = (endpoint, params, abortController) => {
  const endpointWithParams = concatUrlWithParams(endpoint, params)

  return fetch(endpointWithParams, { signal: abortController.signal })
    .then(response => response.json())
}

export const getPageNumberFromUrl = (url) => {
  console.log({ url })
  // Check if the URL ends with "/page/{number}/"
  if (!url.includes('/page/')) return 1

  const urlParts = url.split('/page/')
  // Reconstruct the URL without the page number
  const page = urlParts[1].replace('/', '')

  return Number(page)
}

export const getPageNumber = (element) => {
  try {
    const url = new URL(element.href)
    const page = getPageNumberFromUrl(url.pathname)
    const pageNumber = Number(page)

    if (pageNumber > 0) {
      return pageNumber
    }
  } catch (error) {
    console.warn('[getPageNumber] Unexpected error:', error)
    return 1
  }
}

export const debounce = (callback, delay) => {
  let timeoutId

  return (...args) => {
    if (timeoutId) clearTimeout(timeoutId)

    timeoutId = setTimeout(() => {
      // eslint-disable-next-line n/no-callback-literal
      if (typeof callback === 'function') callback(...args)
    }, delay)
  }
}

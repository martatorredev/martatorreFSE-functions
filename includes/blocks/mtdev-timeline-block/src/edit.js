import { useBlockProps, RichText } from '@wordpress/block-editor'
import { useAutoAnimate } from '@formkit/auto-animate/react'
import { nanoid } from 'nanoid'
import { Arrow } from './assets/arrow'
import { Cross } from './assets/cross'

import './editor.scss'
import { Plus } from './assets/plus'

const Edit = ({ attributes, setAttributes }) => {
  const { data } = attributes
  const [parent, enableAnimation] = useAutoAnimate()

  const updateItem = (uuid, newValue) => {
    const newData = data.map(item => {
      if (item.uuid === uuid) {
        return {
          ...item,
          ...newValue
        }
      }
      return item
    })

    setAttributes({ data: newData })
  }

  const removeItem = uuid => {
    enableAnimation(false)

    const newData = data.filter(item => item.uuid !== uuid)
    setAttributes({ data: newData })

    setTimeout(() => {
      enableAnimation(true)
    }, 1000)
  }

  const createItem = () => {
    const newItem = {
      uuid: nanoid(),
      title: '',
      content: ''
    }

    setAttributes({ data: [...data, newItem] })
  }

  const moveItem = (uuid, direction = 'up') => {
    const index = data.findIndex(item => item.uuid === uuid)
    const newIndex = direction === 'up'
      ? index - 1
      : index + 1

    if (newIndex < 0 || newIndex >= data.length) return

    const newData = [...data]
    const item = newData.splice(index, 1)[0]
    newData.splice(newIndex, 0, item)

    setAttributes({ data: newData })
  }

  return (
    <div {...useBlockProps()}>
      <section className='mtdev-timeline' ref={parent}>
        {
          data.map((item, index) => {
            const isFirst = index === 0
            const isLast = index === data.length - 1

            return (
              <article className='mtdev-timeline-item' key={item.uuid}>
                <RichText
                  tagName='h5'
                  className='mtdev-timeline-item__title'
                  placeholder='Escribe el titulo aqui…'
                  value={item.title}
                  onChange={title => updateItem(item.uuid, { title })}
                />
                <RichText
                  tagName='div'
                  className='mtdev-timeline-item__content'
                  placeholder='Escribe el contenido aqui…'
                  value={item.content}
                  onChange={content => updateItem(item.uuid, { content })}
                />
                <div className='mtdev-timeline-item__controls'>
                  <button className='mtdev-timeline-item__button' onClick={() => removeItem(item.uuid)}>
                    <Cross />
                  </button>
                  {
                    !isFirst && (
                      <button className='mtdev-timeline-item__button' onClick={() => moveItem(item.uuid, 'up')}>
                        <Arrow direction='up' />
                      </button>
                    )
                  }
                  {
                    !isLast && (
                      <button className='mtdev-timeline-item__button' onClick={() => moveItem(item.uuid, 'down')}>
                        <Arrow direction='down' />
                      </button>
                    )
                  }
                </div>
              </article>
            )
          })
        }
        <button className='mtdev-timeline-item__button' onClick={createItem}>
          <Plus />
        </button>
      </section>
    </div>
  )
}

export default Edit

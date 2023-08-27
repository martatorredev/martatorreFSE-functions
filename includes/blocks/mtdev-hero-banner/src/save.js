import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor'
import background from './img/fondopixeles.png'

const save = ({ attributes: { title, comment, titleLevel } }) => {
  const TitleTag = 'h' + titleLevel

  return (
    <header {...useBlockProps.save({ className: 'hero-banner' })}>
      <section className='hero-banner__content'>
        {
          title && (
            <TitleTag className='hero-banner__title'><RichText.Content value={title} /></TitleTag>
          )
        }

        <div
          {
            ...useInnerBlocksProps.save({
              className: 'hero-banner__inner-blocks'
            })
          }
        />
      </section>
      <img
        className='hero-banner__background'
        src={background}
        alt='Imagen de fondo'
      />
    </header>
  )
}

export default save

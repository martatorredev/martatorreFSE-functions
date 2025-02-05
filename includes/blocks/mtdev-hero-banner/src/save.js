import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor'
import background from './img/fondopixeles.webp'

const save = ({ attributes: { title, subtitle, titleLevel } }) => {
  const TitleTag = 'h' + titleLevel

  return (
    <header {...useBlockProps.save({ className: 'hero-banner' })}>
      <section className='hero-banner__content'>
        {
          title && (
            <TitleTag className='hero-banner__title'><RichText.Content value={title} /></TitleTag>
          )
        }
        {
          subtitle && (
            <p className='hero-banner__subtitle'><RichText.Content value={subtitle} /></p>
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
        width={1920}
        height={460}
      />
    </header>
  )
}

export default save

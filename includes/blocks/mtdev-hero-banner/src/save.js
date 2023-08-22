import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor'
import classnames from 'classnames'
import background from './img/fondopixeles.png'

const save = ({ attributes: { title, subtitle, comment, titleLevel } }) => {
  const TitleTag = 'h' + titleLevel

  return (
    <header {...useBlockProps.save({ className: classnames('hero-banner', !comment && 'without-comment') })}>
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
        {
          comment && (
            <p className='hero-banner__comment'><RichText.Content value={comment} /></p>
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

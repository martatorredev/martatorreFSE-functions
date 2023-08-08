import {
  RichText,
  useBlockProps,
  BlockControls
} from '@wordpress/block-editor'
import HeadingLevelDropdown from './heading-level-dropdown'

const edit = (props) => {
  const { attributes, setAttributes } = props || {}
  const { title, subtitle, comment, titleLevel } = attributes || {}

  return (
    <>
      <BlockControls group='block'>
        <HeadingLevelDropdown
          value={titleLevel}
          onChange={(newLevel) => setAttributes({ titleLevel: newLevel })}
        />
      </BlockControls>
      <header {...useBlockProps({ className: 'hero-banner' })}>
        <section className='hero-banner__content'>
          <RichText
            tagName={`h${titleLevel}`}
            className='hero-banner__title'
            value={title}
            onChange={title => setAttributes({ title })}
            placeholder='Titulo principal...'
          />
          <RichText
            tagName='p'
            className='hero-banner__subtitle'
            value={subtitle}
            onChange={subtitle => setAttributes({ subtitle })}
            placeholder='Subtitulo...'
          />
          <RichText
            tagName='p'
            className='hero-banner__comment'
            value={comment}
            onChange={comment => setAttributes({ comment })}
            placeholder='Comentario...'
          />
        </section>
        <img
          className='hero-banner__background'
          src='https://martatorre.test/wp-content/uploads/2023/07/Fondo-de-pixeles.png'
          alt='Imagen de fondo'
        />
      </header>
    </>
  )
}

export default edit

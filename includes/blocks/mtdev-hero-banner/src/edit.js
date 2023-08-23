import {
  RichText,
  useBlockProps,
  BlockControls,
  InnerBlocks
} from '@wordpress/block-editor'
import HeadingLevelDropdown from './heading-level-dropdown'
import background from './img/fondopixeles.png'

const Edit = ({ attributes, setAttributes }) => {
  const { title, subtitle, titleLevel } = attributes || {}

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
          <InnerBlocks />
        </section>
        <img
          className='hero-banner__background'
          src={background}
          alt='Imagen de fondo'
        />
      </header>
    </>
  )
}

export default Edit

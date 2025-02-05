import {
  RichText,
  useBlockProps,
  BlockControls,
  InnerBlocks,
  InspectorControls
} from '@wordpress/block-editor'
import {
  ToggleControl,
  PanelBody
} from '@wordpress/components'

import HeadingLevelDropdown from './heading-level-dropdown'
import background from './img/fondopixeles.webp'

const Edit = ({ attributes, setAttributes }) => {
  const { title, subtitle, titleLevel, showOnlyInnerBlocks } = attributes || {}

  return (
    <>
      <InspectorControls>
        <PanelBody title='Opciones'>
          <ToggleControl
            label='Mostrar solo bloques internos'
            checked={showOnlyInnerBlocks}
            onChange={showOnlyInnerBlocks => setAttributes({ showOnlyInnerBlocks })}
          />
        </PanelBody>
      </InspectorControls>

      {
        !showOnlyInnerBlocks && (
          <BlockControls group='block'>
            <HeadingLevelDropdown
              value={titleLevel}
              onChange={titleLevel => setAttributes({ titleLevel })}
            />
          </BlockControls>
        )
      }
      <header {...useBlockProps({ className: 'hero-banner' })}>
        <section className='hero-banner__content'>
          {
            !showOnlyInnerBlocks && (
              <>
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
              </>
            )
          }

          <InnerBlocks />
        </section>
        <img
          className='hero-banner__background'
          src={background}
          alt='Imagen de fondo'
          width={1920}
          height={460}
        />
      </header>
    </>
  )
}

export default Edit

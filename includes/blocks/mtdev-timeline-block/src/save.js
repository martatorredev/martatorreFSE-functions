import { useBlockProps, RichText } from '@wordpress/block-editor'

const Save = ({ attributes: { data } }) => (
  <div {...useBlockProps.save()}>
    <section className='mtdev-timeline'>
      {
        data.map(item => (
          <article className='mtdev-timeline-item' key={item.uuid}>
            <RichText.Content
              tagName='h5'
              className='mtdev-timeline-item__title'
              value={item.title}
            />
            <RichText.Content
              tagName='div'
              className='mtdev-timeline-item__content'
              value={item.content}
            />
          </article>
        ))
      }
    </section>
  </div>
)

export default Save

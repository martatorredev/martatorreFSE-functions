export const Arrow = ({ direction }) => {
  const style = {
    transform: direction === 'up' ? 'rotate(180deg)' : 'rotate(0deg)'
  }

  return (
    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' style={style}>
      <path
        fill='none'
        stroke='currentColor'
        stroke-linecap='round'
        stroke-linejoin='round'
        stroke-width='48'
        d='M112 268l144 144 144-144M256 392V100'
      />
    </svg>
  )
}

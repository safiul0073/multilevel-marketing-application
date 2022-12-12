import React from 'react'

const BlockView = ({ lists }) => {
  return (
    <>
        <div className='grid grid-flow-row md:grid-cols-2 xl:grid-cols-4 gap-2'>
            {
                lists?.map((product) => (
                    <div key={Math.random()} className='text-center py-4 px-4 bg-gray-400 text-white hover:bg-gray-600'>
                        <div>{product?.name}</div>
                        <div>{product?.category?.title}</div>
                        <div>{product?.price + " tk"}</div>
                    </div>
                ))
            }
        </div>
    </>
  )
}

export default BlockView

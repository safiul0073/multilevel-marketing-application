import React, { useState } from 'react'
import { UseStore } from '../../../../store'

const BlockView = ({ productId, setProductId, lists }) => {
    const [selectedId, setSelectedId] = useState(productId)
    const {setProduct} = UseStore()
    const handleTRClick = (product) => {
        setProduct(product)
        setSelectedId(product?.id)
        setProductId(product?.id)
        console.log(product)
    }
  return (
    <>
        <div className='grid grid-flow-row md:grid-cols-2 xl:grid-cols-4 gap-2'>
            {
                lists?.map((product) => (
                    <div key={Math.random()} onClick={() => handleTRClick(product)} className={selectedId == product?.id ? ' cursor-pointer text-center py-4 px-4 text-white bg-gray-600' : 'cursor-pointer text-center py-4 px-4 bg-gray-400 text-white hover:bg-gray-600'}>
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

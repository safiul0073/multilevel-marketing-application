import React from 'react'

const OrderSummary = ({ setTab }) => {
  return (
    <button className='btn btn-secondary' onClick={() => setTab('userInfo')}>Back</button>
  )
}

export default OrderSummary

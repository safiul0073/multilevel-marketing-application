import React from 'react'

export const NewAddView = ({ sponsor_id }) => {

    const newUserCreate = (sponsor_id) => {
        console.log("sponsor id: "+ sponsor_id)
    }
  return (
    <>
    <div onClick={() => newUserCreate(sponsor_id)} key={Math.random()} className="flex flex-col justify-center items-center border-2 border-green-600 m-5 cursor-pointer">
        <h1 className='bg-green-600 p-2 w-full'>Add new</h1>
        <img
            src="https://cdn-icons-png.flaticon.com/512/561/561169.png"
            width={100}
            height={100}
            className=" p-3"
            alt="" />
    </div>
    </>
  )
}

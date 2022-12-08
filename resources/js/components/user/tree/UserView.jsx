import React from 'react'

export default function UserView({user}) {
  return (
    <>
        <div className="flex justify-center items-center">
            <div className='flex flex-col justify-center items-center border-2 border-green-600 m-5'>
                <h1 className='bg-green-600 p-2 w-full'>{user?.first_name+" "+user?.last_name}</h1>
                <img
                src="https://xsgames.co/randomusers/assets/avatars/male/24.jpg"
                width={150}
                height={150}
                className=" p-3"
                alt="" />
            </div>
        </div>
    </>
  )
}

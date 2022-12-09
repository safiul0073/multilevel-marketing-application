import React from 'react'

export default function UserView({user}) {
  return (
    <>
        <div className="flex justify-center items-center">
            <div className='px-4 py-4'>
                <img
                src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png"
                width={50}
                height={50}
                className="rounded-full"
                alt="" />
                <h1>{user?.id}</h1>
            </div>
        </div>
    </>
  )
}

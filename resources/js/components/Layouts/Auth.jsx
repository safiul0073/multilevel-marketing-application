
import React from 'react'

export default function AuthLayout ({children}) {
  return (
    <div>
        {/* only login component using this layout */}
        {children}
    </div>
  )
}
